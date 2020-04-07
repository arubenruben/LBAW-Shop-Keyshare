-- trigger 1
CREATE OR REPLACE FUNCTION insert_product_tsvector()
RETURNS TRIGGER AS $$
BEGIN
    NEW.name_tsvector := to_tsvector(NEW.name || coalesce(NEW.description, ''));
	NEW.weight_tsvector := setweight(to_tsvector(NEW.name), 'A') || 
            setweight(to_tsvector(coalesce(NEW.description, '')), 'B');
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS insert_product_tsvector_tg ON product;
CREATE TRIGGER insert_product_tsvector_tg 
BEFORE INSERT ON product
FOR EACH ROW 
EXECUTE PROCEDURE insert_product_tsvector();


-- trigger 2
CREATE OR REPLACE FUNCTION update_product_tsvector()
RETURNS TRIGGER AS $$
BEGIN
    NEW.name_tsvector := to_tsvector(NEW.name || coalesce(NEW.description, ''));
    NEW.weight_tsvector := setweight(to_tsvector(NEW.name), 'A') || 
        setweight(to_tsvector(coalesce(NEW.description, '')), 'B');
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_product_tsvector_tg ON product;
CREATE TRIGGER update_product_tsvector_tg 
BEFORE UPDATE ON product
FOR EACH ROW 
WHEN (NEW.name <> OLD.name or NEW.description <> OLD.description)
EXECUTE PROCEDURE update_product_tsvector();


-- trigger 3
CREATE OR REPLACE FUNCTION insert_user_tsvector()
RETURNS TRIGGER AS $$
BEGIN
    NEW.name_tsvector := to_tsvector(NEW.name || coalesce(NEW.description, ''));
	NEW.weight_tsvector := setweight(to_tsvector(NEW.name), 'A') || 
			setweight(to_tsvector(coalesce(NEW.description, '')), 'B');
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS insert_user_tsvector_tg ON regular_user;
CREATE TRIGGER insert_user_tsvector_tg 
BEFORE INSERT ON regular_user
FOR EACH ROW 
EXECUTE PROCEDURE insert_user_tsvector();


-- trigger 4
CREATE OR REPLACE FUNCTION update_user_tsvector()
RETURNS TRIGGER AS $$
BEGIN
	NEW.name_tsvector := to_tsvector(NEW.name || coalesce(NEW.description, ''));
	NEW.weight_tsvector := setweight(to_tsvector(NEW.name), 'A') || 
		setweight(to_tsvector(coalesce(NEW.description, '')), 'B');
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_user_tsvector_tg ON regular_user;
CREATE TRIGGER update_user_tsvector_tg 
BEFORE UPDATE ON regular_user
FOR EACH ROW 
WHEN(NEW.username <> OLD.username or NEW.description <> OLD.description)
EXECUTE PROCEDURE update_user_tsvector();


-- trigger 5
CREATE OR REPLACE FUNCTION product_num_sells() 
RETURNS TRIGGER AS $$
DECLARE 
    sells INTEGER;
    product_id INTEGER;
BEGIN
    SELECT COUNT(p.id), product.id 
    INTO sells, product_id
    FROM offer JOIN product ON product.id = offer.product        
    WHERE offer.id = NEW.offer
    GROUP BY(product.id);

    UPDATE product 
    SET num_sells = sells
    WHERE id = product_id;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS product_num_sales_tg ON key CASCADE;
CREATE TRIGGER product_num_sales_tg
AFTER UPDATE OF orders ON key
FOR EACH ROW 
EXECUTE PROCEDURE product_num_sells();


-- trigger 6
CREATE OR REPLACE FUNCTION user_num_sells()
RETURNS TRIGGER AS $$
DECLARE 
    sells INTEGER;
    user_id INTEGER;
BEGIN    
    user_id := get_seller_through_key(NEW.id);
    
    sells := (
        SELECT COUNT(key.id)
        FROM key JOIN offer ON key.offer = offer.id 
        JOIN regular_user AS seller ON seller.id = offer.seller 
        WHERE seller.id = user_id
        GROUP BY(seller.id)
    );
    
    UPDATE regular_user
    SET num_sells = sells
    WHERE id = user_id;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS user_num_sells_tg ON key CASCADE;
CREATE TRIGGER user_num_sells_tg
AFTER UPDATE OF orders ON key
FOR EACH ROW 
EXECUTE PROCEDURE user_num_sells();


-- trigger 7
CREATE OR REPLACE FUNCTION update_seller_feedback()
RETURNS TRIGGER AS $$
DECLARE
    seller_id integer;
    positive_reviews integer;
    num_reviews integer;
    total_feedback float;
BEGIN
    seller_id := get_seller_through_key(NEW.key);

    -- Number of positive reviews of seller with id seller_id
    SELECT COUNT(u.id) INTO positive_reviews
    FROM feedback f JOIN key k ON f.key = k.id
    JOIN offer o ON k.offer = o.id
    JOIN regular_user u ON o.seller = u.id
    WHERE f.evaluation = true and u.id = seller_id
    GROUP BY u.id;
	
    IF positive_reviews IS NULL THEN
        positive_reviews := 0;
    END IF;	
    
    -- Number of reviews of seller with id seller_id
    SELECT COUNT(u.id) INTO num_reviews
    FROM feedback f JOIN key k ON f.key = k.id
    JOIN offer o ON k.offer = o.id
    JOIN regular_user u ON o.seller = u.id
    WHERE u.id = seller_id
    GROUP BY u.id;
	
    IF num_reviews IS NULL THEN
        num_reviews := 0;
    END IF;

    total_feedback := 100 * (positive_reviews / num_reviews); -- PROB DA COR E DAQUI
	
    UPDATE regular_user 
    SET rating = total_feedback
    WHERE regular_user.id = seller_id;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_seller_feedback_tg ON feedback CASCADE;
CREATE TRIGGER update_seller_feedback_tg 
AFTER INSERT ON feedback
FOR EACH ROW 
EXECUTE PROCEDURE update_seller_feedback();


-- trigger 8
CREATE OR REPLACE FUNCTION check_user_bought_product()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT *
        FROM orders o JOIN key k ON o.id = k.orders
        WHERE NEW.key = k.id
        AND o.regular_user = NEW.regular_user
    )
    THEN RAISE EXCEPTION 'Cannot review a product that you did not buy';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS check_user_bought_product_tg ON feedback CASCADE;
CREATE TRIGGER check_user_bought_product_tg 
BEFORE INSERT
ON feedback
FOR EACH ROW 
EXECUTE PROCEDURE check_user_bought_product();


-- trigger 9
CREATE OR REPLACE FUNCTION update_product_stock()
RETURNS TRIGGER AS $$
DECLARE
    stock_quantity INTEGER;
BEGIN
    stock_quantity := ( 
        SELECT COUNT(key.id)
        FROM key
        WHERE key.orders IS NULL AND key.offer = NEW.offer
        GROUP BY(key.id)
    );
	
    IF stock_quantity IS NULL THEN
        stock_quantity := 0;
    END IF;
	
    UPDATE offer
    SET stock = stock_quantity
    WHERE id = NEW.offer;    
	
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_product_stock_tg ON key CASCADE;
CREATE TRIGGER update_product_stock_tg 
AFTER UPDATE OF orders ON key
FOR EACH ROW 
EXECUTE PROCEDURE update_product_stock();


-- trigger 10
CREATE OR REPLACE FUNCTION delete_from_cart()
RETURNS TRIGGER AS $$
DECLARE
    deleted_var BOOLEAN;
BEGIN
    DELETE FROM cart
    WHERE offer IN (
        SELECT offer.id 
        FROM offer 
        WHERE offer.product = NEW.id
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS delete_from_cart_tg ON product CASCADE;
CREATE TRIGGER delete_from_cart_tg 
AFTER INSERT OR UPDATE OF deleted ON product
FOR EACH ROW 
WHEN (NEW.deleted = true)
EXECUTE PROCEDURE delete_from_cart();


-- trigger 11
DROP FUNCTION IF EXISTS check_not_self_buying() CASCADE;
CREATE OR REPLACE FUNCTION check_not_self_buying()
RETURNS TRIGGER AS $$
DECLARE
    seller_id INTEGER;    
BEGIN
    seller_id := (
        SELECT offer.seller
        FROM offer 
        WHERE offer.id=NEW.offer
    );
                
    IF seller_id = NEW.regular_user THEN
        RAISE EXCEPTION 'You cannot buy product that you are already selling!';
    END IF;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS check_not_self_buying_tg ON cart CASCADE;
CREATE TRIGGER check_not_self_buying_tg 
AFTER INSERT ON cart
FOR EACH ROW 
EXECUTE PROCEDURE check_not_self_buying();


-- trigger 12
CREATE OR REPLACE FUNCTION delete_keys_from_canceled_offers()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM key
    WHERE key.offer = NEW.id AND key.order IS NULL;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS delete_keys_from_canceled_offers_tg ON offer CASCADE;
CREATE TRIGGER delete_keys_from_canceled_offers_tg 
AFTER UPDATE OF deleted ON offer
FOR EACH ROW 
WHEN(NEW.deleted = TRUE)
EXECUTE PROCEDURE delete_keys_from_canceled_offers();


-- trigger 13
CREATE OR REPLACE FUNCTION rollback_offer_of_deleted_products()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS( 
        SELECT *
        FROM product
        WHERE NEW.product = product.id AND product.deleted = TRUE
     ) THEN
        RAISE EXCEPTION 'You cannot insert an offer of a product that was deleted by the admin';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS rollback_offer_of_deleted_products_tg ON offer CASCADE;
CREATE TRIGGER rollback_offer_of_deleted_products_tg 
BEFORE INSERT ON offer
FOR EACH ROW 
EXECUTE PROCEDURE rollback_offer_of_deleted_products();


-- trigger 14
CREATE OR REPLACE FUNCTION update_offer_date_end()
RETURNS TRIGGER AS $$
BEGIN
    UPDATE offer
    SET end_date = now()
    WHERE id = NEW.id;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_offer_date_end_tg ON offer CASCADE;
CREATE TRIGGER update_offer_date_end_tg 
AFTER UPDATE OF deleted ON offer
FOR EACH ROW
WHEN(NEW.deleted=TRUE OR NEW.stock=0)
EXECUTE PROCEDURE update_offer_date_end();

-- trigger 15
CREATE OR REPLACE FUNCTION check_discount_date_overlap()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS( 
		SELECT *
		FROM discount
		WHERE start_date IS NOT NULL AND
		start_date <= NEW.start_date AND
		end_date >= NEW.start_date AND
		NEW.offer = discount.offer
	) THEN
        RAISE EXCEPTION 'There is already a discount for that offer during the same time period';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS overlap_discount_dates_tg ON discount CASCADE;
CREATE TRIGGER overlap_discount_dates_tg 
BEFORE INSERT OR UPDATE ON discount
FOR EACH ROW
EXECUTE PROCEDURE check_discount_date_overlap();


-- trigger 16
CREATE OR REPLACE FUNCTION refresh_active_products_view()
RETURNS TRIGGER AS $$
BEGIN
    REFRESH MATERIALIZED VIEW active_products;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS refresh_active_products_view_tg ON product CASCADE;
CREATE TRIGGER refresh_active_products_view_tg 
AFTER INSERT OR DELETE OR UPDATE ON product
FOR EACH ROW
EXECUTE PROCEDURE refresh_active_products_view();
