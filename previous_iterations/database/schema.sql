-----------------------------------------
-- Drop old schmema
-----------------------------------------

DROP SCHEMA IF EXISTS  public CASCADE;
CREATE SCHEMA public;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO public;

-----------------------------------------
-- Tables
-----------------------------------------

CREATE TABLE category (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

CREATE TABLE genre (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

CREATE TABLE platform (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

CREATE TABLE image (
  id SERIAL PRIMARY KEY,
  url TEXT NOT NULL UNIQUE
);

CREATE TABLE product (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL UNIQUE,
  name_tsvector tsvector DEFAULT NULL,
  weight_tsvector  tsvector DEFAULT NULL,
  description TEXT,
  category INTEGER REFERENCES category (id) ON DELETE SET NULL ON UPDATE CASCADE,
  image INTEGER DEFAULT 1 NOT NULL REFERENCES image (id) ON DELETE SET DEFAULT ON UPDATE CASCADE,
  deleted BOOLEAN NOT NULL DEFAULT FALSE,
  launch_date DATE NOT NULL,
  num_sells INTEGER NOT NULL DEFAULT 0,
  CONSTRAINT num_sells_chk CHECK (num_sells >= 0)
);

CREATE TABLE product_has_genre (
  genre INTEGER NOT NULL REFERENCES genre(id) ON DELETE CASCADE ON UPDATE CASCADE,
  product INTEGER NOT NULL REFERENCES product(id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (genre, product)
);

CREATE TABLE product_has_platform(
  platform INTEGER REFERENCES platform(id) ON DELETE CASCADE ON UPDATE CASCADE,
  product INTEGER REFERENCES product(id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (platform, product)
);

CREATE TABLE regular_user (
  id SERIAL PRIMARY KEY,
  username TEXT NOT NULL UNIQUE,
  email TEXT NOT NULL UNIQUE,
  description TEXT DEFAULT NULL,
  name_tsvector tsvector DEFAULT NULL,
  weight_tsvector  tsvector DEFAULT NULL,
  password TEXT NOT NULL,
  rating INTEGER DEFAULT NULL,
  birth_date date NOT NULL,
  paypal TEXT,
  image INTEGER NOT NULL DEFAULT 0 REFERENCES image(id) ON DELETE SET DEFAULT ON UPDATE CASCADE,
  num_sells INTEGER NOT NULL DEFAULT 0,

  CONSTRAINT rating_ck CHECK (rating >= 0 AND rating <= 100),
  CONSTRAINT birthdate_ck CHECK (date_part('year', age(birth_date)) >= 18),
  CONSTRAINT num_sells_ck CHECK (num_sells >= 0)
);

CREATE TABLE offer (
  id SERIAL PRIMARY KEY,
  price REAL NOT NULL,
  init_date date NOT NULL DEFAULT NOW(),
  final_date date,
  profit REAL DEFAULT 0,
  platform INTEGER NOT NULL REFERENCES platform(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  seller INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  product INTEGER REFERENCES product(id) ON DELETE SET NULL ON UPDATE CASCADE,
  stock INTEGER NOT NULL DEFAULT 1,    
  CONSTRAINT price_ck CHECK (price > 0),
  CONSTRAINT init_date_ck CHECK (init_date <= NOW()),
  CONSTRAINT final_date_ck CHECK (final_date IS NULL OR final_date >= init_date),
  CONSTRAINT profit_ck CHECK (profit >= 0),
  CONSTRAINT stock_ck CHECK (stock >= 0)
);

CREATE TABLE discount (
  id SERIAL PRIMARY KEY,
  rate INTEGER NOT NULL,
  start_date date NOT NULL,
  end_date date NOT NULL,
  offer INTEGER NOT NULL REFERENCES offer(id) ON DELETE CASCADE ON UPDATE CASCADE,
  
  --   TODO:
--   CONSTRAINT start_date_ck CHECK (start_date >= NOW()),
  CONSTRAINT end_date_ck CHECK (end_date > start_date),
  CONSTRAINT rate_ck CHECK (rate >= 0 AND rate <= 100)
);

CREATE TABLE banned_user (
  regular_user INTEGER PRIMARY KEY REFERENCES regular_user(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE admin (
  id SERIAL PRIMARY KEY,
  username TEXT NOT NULL UNIQUE,
  email TEXT NOT NULL UNIQUE,
  description TEXT,
  password TEXT NOT NULL,
  image INTEGER NOT NULL DEFAULT 0 REFERENCES image(id) ON DELETE SET DEFAULT ON UPDATE CASCADE
);

CREATE TABLE ban_appeal (
  banned_user INTEGER PRIMARY KEY REFERENCES banned_user(regular_user) ON DELETE CASCADE ON UPDATE CASCADE,
  admin INTEGER REFERENCES admin(id) ON DELETE SET NULL ON UPDATE CASCADE,
  ban_appeal TEXT NOT NULL,
  date date NOT NULL DEFAULT NOW(),
  
  CONSTRAINT date_ck CHECK(date <= NOW())
);

CREATE TABLE orders (
  number SERIAL PRIMARY KEY,
  date DATE NOT NULL DEFAULT NOW(),
  buyer INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
    
  CONSTRAINT date_ck CHECK(date <= NOW())
);

CREATE TABLE key (
  id SERIAL PRIMARY KEY,
  key TEXT NOT NULL UNIQUE,
  price_sold REAL DEFAULT NULL,
  offer integer NOT NULL REFERENCES offer(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  orders integer DEFAULT NULL REFERENCES orders(number) ON DELETE RESTRICT ON UPDATE CASCADE,
  
  CONSTRAINT price_ck CHECK(price_sold IS NULL OR price_sold > 0),
  CONSTRAINT sold_key_ck CHECK((price_sold IS NULL AND orders IS NULL) or (price_sold IS NOT NULL AND orders IS NOT NULL))
  
);

CREATE TABLE feedback (
  id SERIAL PRIMARY KEY,
  evaluation BOOLEAN NOT NULL,
  comment TEXT,
  evaluation_date DATE NOT NULL DEFAULT NOW() CONSTRAINT fb_date_ck CHECK(evaluation_date <= NOW()),
  buyer INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  key INTEGER UNIQUE NOT NULL REFERENCES key(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE report (
  id SERIAL PRIMARY KEY,
  date date NOT NULL DEFAULT NOW(),
  description TEXT NOT NULL,
  title TEXT NOT NULL,
  status BOOLEAN NOT NULL DEFAULT false,
  key INTEGER NOT NULL UNIQUE REFERENCES key(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  reporter INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  reportee INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  
  CONSTRAINT user_ck CHECK(reporter <> reportee),
  CONSTRAINT date_ck CHECK(date <= NOW())
);

CREATE TABLE message (
  id SERIAL PRIMARY KEY,
  date date NOT NULL DEFAULT NOW(),
  description TEXT NOT NULL,
  regular_user INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  admin INTEGER REFERENCES admin(id) ON DELETE SET NULL ON UPDATE CASCADE,
  report INTEGER NOT NULL REFERENCES report(id) ON DELETE CASCADE ON UPDATE CASCADE,

  CONSTRAINT date_ck CHECK(date <= NOW()),
  CONSTRAINT user_type_ck CHECK((regular_user IS NULL AND admin IS NOT NULL ) OR (regular_user IS NOT NULL AND admin IS NULL))
);

CREATE TABLE cart (
  id SERIAL PRIMARY KEY,
  buyer INTEGER NOT NULL REFERENCES regular_user(id) ON DELETE CASCADE ON UPDATE CASCADE,
  offer INTEGER NOT NULL REFERENCES offer(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE about_us (
  id SERIAL PRIMARY KEY,
  description TEXT NOT NULL
);

CREATE TABLE faq (
  id SERIAL PRIMARY KEY,
  question TEXT NOT NULL,
  answer TEXT NOT NULL
);

----------------------------------------
--Materialized Views
CREATE MATERIALIZED VIEW active_products AS 
    SELECT product.id AS product_id
	FROM product
    WHERE product.deleted = FALSE;

CREATE MATERIALIZED VIEW active_offers AS 
    SELECT offer.id AS offer_id
	FROM offer
    WHERE final_date IS NULL;

----------------------------------------



-----------------------------------------
-- INDEXES
-----------------------------------------

-- Performance Indices

CREATE INDEX offer_product_idx ON offer (product);
CREATE INDEX offer_seller_idx ON offer (seller);
CREATE INDEX disocunt_offer_idx ON discount (offer);
CREATE INDEX key_offer_idx ON key (offer);
CREATE INDEX discount_date_idx ON discount (start_date, end_date);
CREATE INDEX cart_buyer_idx ON cart (buyer);

CREATE INDEX product_name_idx 
ON product
USING GIST(name_tsvector);

CREATE INDEX user_username_idx 
ON regular_user
USING GIST (name_tsvector);


-- Full-text Search Indices


-----------------------------------------
-- UDFs and TRIGGERS
-----------------------------------------

DROP FUNCTION IF EXISTS get_seller_through_key(integer) CASCADE;
CREATE OR REPLACE FUNCTION get_seller_through_key(key_id integer)
RETURNS INTEGER AS $seller_id$
DECLARE
    seller_id integer;
BEGIN
    SELECT u.id INTO seller_id
    FROM key k JOIN offer o ON k.offer = o.id
    JOIN regular_user u ON o.seller = u.id
    WHERE k.id = key_id;
	
    RETURN seller_id;
END;
$seller_id$ LANGUAGE plpgsql;



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

CREATE OR REPLACE FUNCTION insert_user_tsvector()
RETURNS TRIGGER AS $$
BEGIN
    NEW.name_tsvector := (to_tsvector('english',NEW.username) || to_tsvector('english',NEW.description));
    NEW.weight_tsvector := setweight(to_tsvector('english',NEW.username), 'A') || 
        setweight(to_tsvector('english',NEW.description), 'B');
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;


DROP TRIGGER IF EXISTS insert_user_tsvector_tg ON regular_user;
CREATE TRIGGER insert_user_tsvector_tg 
BEFORE INSERT ON regular_user
FOR EACH ROW 
EXECUTE PROCEDURE insert_user_tsvector();

CREATE OR REPLACE FUNCTION update_user_tsvector()
RETURNS TRIGGER AS $$
BEGIN
   NEW.name_tsvector := (to_tsvector('english',NEW.username) || to_tsvector('english',NEW.description));
    NEW.weight_tsvector := setweight(to_tsvector('english',NEW.username), 'A') || 
        setweight(to_tsvector('english',NEW.description), 'B');
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_user_tsvector_tg ON regular_user;
CREATE TRIGGER update_user_tsvector_tg 
BEFORE UPDATE ON regular_user
FOR EACH ROW 
WHEN (NEW.username <> OLD.username or NEW.description <> OLD.description)
EXECUTE PROCEDURE update_user_tsvector();

CREATE OR REPLACE FUNCTION product_num_sells() 
RETURNS TRIGGER AS $$
DECLARE 
    sells INTEGER;
    product_id INTEGER;
BEGIN
    SELECT COUNT(product.id), product.id 
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
AFTER INSERT OR UPDATE OF orders ON key
FOR EACH ROW 
EXECUTE PROCEDURE product_num_sells();


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
AFTER INSERT OR UPDATE OF orders ON key
FOR EACH ROW 
EXECUTE PROCEDURE user_num_sells();

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
AFTER INSERT OR UPDATE OR DELETE ON feedback
FOR EACH ROW 
EXECUTE PROCEDURE update_seller_feedback();

CREATE OR REPLACE FUNCTION check_user_bought_product()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT *
        FROM orders AS o JOIN key AS k ON o.number = k.orders
        WHERE NEW.key = k.id AND o.buyer = NEW.buyer
    ) THEN 
        RAISE EXCEPTION 'Cannot review a product that you did not buy';
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

CREATE OR REPLACE FUNCTION update_product_stock()
RETURNS TRIGGER AS $$
DECLARE
    stock_quantity INTEGER;
BEGIN
  
    SELECT COUNT(key.id) into stock_quantity
    FROM key
    WHERE key.orders IS NULL AND key.offer = NEW.offer
    GROUP BY(key.id);

	
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
AFTER INSERT OR DELETE OR UPDATE OF orders ON key
FOR EACH ROW 
EXECUTE PROCEDURE update_product_stock();

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

DROP FUNCTION IF EXISTS check_not_self_buying() CASCADE;
CREATE OR REPLACE FUNCTION check_not_self_buying()
RETURNS TRIGGER AS $$
DECLARE
    seller_id INTEGER;    
BEGIN
    seller_id := (
        SELECT offer.seller
        FROM offer 
        WHERE offer.id = NEW.offer
    );
                
    IF seller_id = NEW.buyer THEN
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

CREATE OR REPLACE FUNCTION delete_keys_from_canceled_offers()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM key
    WHERE key.offer = NEW.id AND key.orders IS NULL;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS delete_keys_from_canceled_offers_tg ON offer CASCADE;
CREATE TRIGGER delete_keys_from_canceled_offers_tg 
AFTER UPDATE OF final_date ON offer
FOR EACH ROW 
WHEN(NEW.final_date IS NOT NULL)
EXECUTE PROCEDURE delete_keys_from_canceled_offers();

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

CREATE OR REPLACE FUNCTION update_offer_final_date()
RETURNS TRIGGER AS $$
BEGIN
    UPDATE offer
    SET final_date = now()
    WHERE id = NEW.id;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_offer_final_date_tg ON offer CASCADE;
CREATE TRIGGER update_offer_final_date_tg 
AFTER UPDATE OF stock ON offer
FOR EACH ROW
WHEN(NEW.final_date IS NULL AND NEW.stock=0)
EXECUTE PROCEDURE update_offer_final_date();

CREATE OR REPLACE FUNCTION check_discount_date_overlap()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS( 
        SELECT *
        FROM discount
        WHERE start_date IS NOT NULL 
			AND start_date <= NEW.end_date 
			AND end_date >= NEW.start_date 
			AND NEW.offer = discount.offer
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

CREATE OR REPLACE FUNCTION refresh_active_offers_view()
RETURNS TRIGGER AS $$
BEGIN
    REFRESH MATERIALIZED VIEW active_offers;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS refresh_active_offers_view_tg ON offer CASCADE;
CREATE TRIGGER refresh_active_offers_view_tg 
AFTER INSERT OR DELETE OR UPDATE OF final_date ON offer
FOR EACH ROW
EXECUTE PROCEDURE refresh_active_offers_view();

CREATE OR REPLACE FUNCTION verify_banned_user_orders()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.buyer IN (SELECT regular_user FROM banned_user) THEN
        RAISE EXCEPTION 'User with ID % is banned and cannot make purchases', NEW.buyer;
    END IF;
        
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS verify_banned_user_orders_tg ON orders CASCADE;
CREATE TRIGGER verify_banned_user_orders_tg 
BEFORE INSERT ON orders
FOR EACH ROW
EXECUTE PROCEDURE verify_banned_user_orders();

CREATE OR REPLACE FUNCTION update_offer_profit()
RETURNS TRIGGER AS $$
DECLARE
    rate REAL;
    offer_profit REAL;

BEGIN

    SELECT SUM(key.price_sold) into offer_profit
    FROM key
    WHERE key.offer = NEW.offer
        AND key.price_sold IS NOT NULL
    GROUP BY key.offer;

    UPDATE offer
    SET profit = profit + offer_profit
    WHERE id = NEW.offer;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;  

DROP TRIGGER IF EXISTS update_offer_profit_tg ON key CASCADE;
CREATE TRIGGER update_offer_profit_tg 
AFTER INSERT OR DELETE OR UPDATE OF price_sold ON key
FOR EACH ROW
EXECUTE PROCEDURE update_offer_profit();

CREATE OR REPLACE FUNCTION verify_banned_user_offer()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.seller IN (SELECT regular_user FROM banned_user) THEN
        RAISE EXCEPTION 'User with ID % is banned and cannot make offers', NEW.seller;
    END IF;
        
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS verify_banned_user_offer_tg ON offer CASCADE;
CREATE TRIGGER verify_banned_user_offer_tg 
BEFORE INSERT ON offer
FOR EACH ROW
EXECUTE PROCEDURE verify_banned_user_offer();

