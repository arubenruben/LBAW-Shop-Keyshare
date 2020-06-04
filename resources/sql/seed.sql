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

CREATE TABLE categories (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

CREATE TABLE genres (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

CREATE TABLE platforms (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

CREATE TABLE pictures (
  id SERIAL PRIMARY KEY,
  url TEXT NOT NULL UNIQUE
);

CREATE TABLE products (
  id SERIAL PRIMARY KEY,
  name TEXT NOT NULL UNIQUE,
  name_tsvector tsvector DEFAULT NULL,
  weight_tsvector  tsvector DEFAULT NULL,
  description TEXT,
  category_id INTEGER NOT NULL REFERENCES categories (id) ON DELETE RESTRICT ON UPDATE CASCADE,
  picture_id INTEGER DEFAULT 2 NOT NULL REFERENCES pictures (id) ON DELETE SET DEFAULT ON UPDATE CASCADE,
  deleted BOOLEAN NOT NULL DEFAULT FALSE,
  launch_date DATE NOT NULL,
  num_sells INTEGER NOT NULL DEFAULT 0,
  CONSTRAINT num_sells_chk CHECK (num_sells >= 0)
);

CREATE TABLE product_has_genres (
  genre_id INTEGER NOT NULL REFERENCES genres(id) ON DELETE CASCADE ON UPDATE CASCADE,
  product_id INTEGER NOT NULL REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (genre_id, product_id)
);

CREATE TABLE product_has_platforms (
  platform_id INTEGER REFERENCES platforms(id) ON DELETE CASCADE ON UPDATE CASCADE,
  product_id INTEGER REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (platform_id, product_id)
);

CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username TEXT NOT NULL UNIQUE,
  email TEXT NOT NULL UNIQUE,
  description TEXT NOT NULL DEFAULT '',
  name_tsvector tsvector DEFAULT NULL,
  weight_tsvector  tsvector DEFAULT NULL,
  password TEXT NOT NULL,
  rating INTEGER DEFAULT NULL,
  birth_date date NOT NULL,
  paypal TEXT,
  picture_id INTEGER NOT NULL DEFAULT 1 REFERENCES pictures(id) ON DELETE SET DEFAULT ON UPDATE CASCADE,
  num_sells INTEGER NOT NULL DEFAULT 0,
  remember_token VARCHAR,
  CONSTRAINT rating_ck CHECK (rating >= 0 AND rating <= 100),
  CONSTRAINT birthdate_ck CHECK (date_part('year', age(birth_date)) >= 18),
  CONSTRAINT num_sells_ck CHECK (num_sells >= 0)
);

CREATE TABLE offers (
  id SERIAL PRIMARY KEY,
  price REAL NOT NULL,
  init_date date NOT NULL DEFAULT NOW(),
  final_date date,
  profit REAL NOT NULL DEFAULT 0,
  platform_id INTEGER NOT NULL REFERENCES platforms(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  user_id INTEGER REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
  product_id INTEGER REFERENCES products(id) ON DELETE SET NULL ON UPDATE CASCADE,
  stock INTEGER NOT NULL DEFAULT 0,
  CONSTRAINT price_ck CHECK (price > 0),
  CONSTRAINT init_date_ck CHECK (init_date <= NOW()),
  CONSTRAINT final_date_ck CHECK (final_date IS NULL OR final_date >= init_date),
  CONSTRAINT profit_ck CHECK (profit >= 0),
  CONSTRAINT stock_ck CHECK (stock >= 0)
);

CREATE TABLE discounts (
  id SERIAL PRIMARY KEY,
  rate INTEGER NOT NULL,
  start_date date NOT NULL,
  end_date date NOT NULL,
  offer_id INTEGER NOT NULL REFERENCES offers(id) ON DELETE CASCADE ON UPDATE CASCADE,

  CONSTRAINT start_date_ck CHECK (start_date >= NOW()),
  CONSTRAINT end_date_ck CHECK (end_date > start_date),
  CONSTRAINT rate_ck CHECK (rate >= 0 AND rate <= 100)
);

CREATE TABLE banned_users (
  id INTEGER PRIMARY KEY REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE admins (
  id SERIAL PRIMARY KEY,
  username TEXT NOT NULL UNIQUE,
  email TEXT NOT NULL UNIQUE,
  description TEXT NOT NULL DEFAULT '',
  password TEXT NOT NULL,
  picture_id INTEGER NOT NULL DEFAULT 1 REFERENCES pictures(id) ON DELETE SET DEFAULT ON UPDATE CASCADE
);

CREATE TABLE ban_appeals (
  id INTEGER PRIMARY KEY REFERENCES banned_users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  admin_id INTEGER REFERENCES admins(id) ON DELETE SET NULL ON UPDATE CASCADE,
  ban_appeal TEXT NOT NULL,
  date date NOT NULL DEFAULT NOW(),

  CONSTRAINT date_ck CHECK(date <= NOW())
);

CREATE TABLE orders (
  number SERIAL PRIMARY KEY,
  date DATE NOT NULL DEFAULT NOW(),
  user_id INTEGER REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
  order_info_name TEXT NOT NULL,
  order_info_email TEXT NOT NULL,
  order_info_address TEXT NOT NULL,
  order_info_zipcode TEXT NOT NULL,
  
  CONSTRAINT date_ck CHECK(date <= NOW())
);

CREATE TABLE keys (
  id SERIAL PRIMARY KEY,
  key TEXT NOT NULL UNIQUE,
  price_sold REAL DEFAULT NULL,
  offer_id integer NOT NULL REFERENCES offers(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  order_id integer DEFAULT NULL REFERENCES orders(number) ON DELETE RESTRICT ON UPDATE CASCADE,

  CONSTRAINT price_ck CHECK(price_sold IS NULL OR price_sold > 0),
  CONSTRAINT sold_key_ck CHECK((price_sold IS NULL AND order_id IS NULL) or (price_sold IS NOT NULL AND order_id IS NOT NULL))

);

CREATE TABLE feedback (
  id SERIAL PRIMARY KEY,
  evaluation BOOLEAN NOT NULL,
  comment TEXT,
  evaluation_date DATE NOT NULL DEFAULT NOW() CONSTRAINT fb_date_ck CHECK(evaluation_date <= NOW()),
  user_id INTEGER REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
  key_id INTEGER UNIQUE NOT NULL REFERENCES keys(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE reports (
  id SERIAL PRIMARY KEY,
  date date NOT NULL DEFAULT NOW(),
  description TEXT NOT NULL ,
  title TEXT NOT NULL,
  status BOOLEAN NOT NULL DEFAULT false,
  key_id INTEGER NOT NULL UNIQUE REFERENCES keys(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  reporter_id INTEGER REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
  reported_id INTEGER REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,

  CONSTRAINT user_ck CHECK(reporter_id <> reported_id),
  CONSTRAINT date_ck CHECK(date <= NOW())
);

CREATE TABLE messages (
  id SERIAL PRIMARY KEY,
  date date NOT NULL DEFAULT NOW(),
  description TEXT NOT NULL,
  user_id INTEGER REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
  admin_id INTEGER REFERENCES admins(id) ON DELETE SET NULL ON UPDATE CASCADE,
  report_id INTEGER NOT NULL REFERENCES reports(id) ON DELETE CASCADE ON UPDATE CASCADE,

  CONSTRAINT date_ck CHECK(date <= NOW()),
  CONSTRAINT user_type_ck CHECK((user_id IS NULL AND admin_id IS NOT NULL ) OR (user_id IS NOT NULL AND admin_id IS NULL))
);

CREATE TABLE carts (
  id SERIAL PRIMARY KEY,
  user_id INTEGER NOT NULL REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
  offer_id INTEGER NOT NULL REFERENCES offers(id) ON DELETE CASCADE ON UPDATE CASCADE
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
CREATE TABLE password_resets (
    email TEXT,
    token TEXT,
    created_at TIMESTAMP
);

-----------------------------------------
-- MATERIALIZED VIEWS
-----------------------------------------
CREATE MATERIALIZED VIEW active_products AS
    SELECT products.id AS product_id
	FROM products
    WHERE products.deleted = FALSE;

CREATE MATERIALIZED VIEW active_offers AS
    SELECT offers.id AS offer_id
	FROM offers
    WHERE final_date IS NULL;

-----------------------------------------
-- INDEXES
-----------------------------------------
CREATE INDEX offer_product_idx ON offers (product_id);
CREATE INDEX offer_seller_idx ON offers (user_id);
CREATE INDEX discount_offer_idx ON discounts (offer_id);
CREATE INDEX key_offer_idx ON keys (offer_id);
CREATE INDEX discount_date_idx ON discounts (start_date, end_date);
CREATE INDEX cart_buyer_idx ON carts (user_id);

CREATE INDEX product_name_idx
ON products
USING GIST(name_tsvector);

CREATE INDEX user_username_idx
ON users
USING GIST (name_tsvector);

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
    FROM keys k JOIN offers o ON k.offer_id = o.id
    JOIN users u ON o.user_id = u.id
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

DROP TRIGGER IF EXISTS insert_product_tsvector_tg ON products;
CREATE TRIGGER insert_product_tsvector_tg
BEFORE INSERT ON products
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

DROP TRIGGER IF EXISTS update_product_tsvector_tg ON products;
CREATE TRIGGER update_product_tsvector_tg
BEFORE UPDATE ON products
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


DROP TRIGGER IF EXISTS insert_user_tsvector_tg ON users;
CREATE TRIGGER insert_user_tsvector_tg
BEFORE INSERT ON users
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

DROP TRIGGER IF EXISTS update_user_tsvector_tg ON users;
CREATE TRIGGER update_user_tsvector_tg
BEFORE UPDATE ON users
FOR EACH ROW
WHEN (NEW.username <> OLD.username or NEW.description <> OLD.description)
EXECUTE PROCEDURE update_user_tsvector();

CREATE OR REPLACE FUNCTION product_num_sells()
RETURNS TRIGGER AS $$
DECLARE
    sells INTEGER;
    product_id INTEGER;
BEGIN
    SELECT COUNT(products.id), products.id
    INTO sells, product_id
    FROM offers JOIN products ON products.id = offers.product_id
    WHERE offers.id = NEW.offer_id
    GROUP BY(products.id);

    UPDATE products
    SET num_sells = sells
    WHERE id = product_id;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS product_num_sales_tg ON keys CASCADE;
CREATE TRIGGER product_num_sales_tg
AFTER INSERT OR UPDATE OF order_id ON keys
FOR EACH ROW
EXECUTE PROCEDURE product_num_sells();


CREATE OR REPLACE FUNCTION user_num_sells()
RETURNS TRIGGER AS $$
DECLARE
    sells INTEGER;
    seller_id INTEGER;
BEGIN
    seller_id := get_seller_through_key(NEW.id);

    sells := (
        SELECT COUNT(keys.id)
        FROM keys JOIN offers ON keys.offer_id = offers.id
        JOIN users AS seller ON seller.id = offers.user_id
        WHERE seller.id = seller_id
        GROUP BY(seller.id)
    );

    UPDATE users
    SET num_sells = sells
    WHERE id = seller_id;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS user_num_sells_tg ON keys CASCADE;
CREATE TRIGGER user_num_sells_tg
AFTER UPDATE OF order_id ON keys
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
    seller_id := get_seller_through_key(NEW.key_id);

    -- Number of positive reviews of seller with id seller_id
    SELECT COUNT(u.id) INTO positive_reviews
    FROM feedback f JOIN keys k ON f.key_id = k.id
                    JOIN offers o ON k.offer_id = o.id
                    JOIN users u ON o.user_id = u.id
    WHERE f.evaluation = true and u.id = o.user_id
    GROUP BY u.id;

    IF positive_reviews IS NULL THEN
        positive_reviews := 0;
    END IF;

    -- Number of reviews of seller with id seller_id
    SELECT COUNT(u.id) INTO num_reviews
    FROM feedback f JOIN keys k ON f.key_id = k.id
                    JOIN offers o ON k.offer_id = o.id
                    JOIN users u ON o.user_id = u.id
    WHERE u.id = o.user_id
    GROUP BY u.id;

    IF num_reviews IS NULL THEN
        num_reviews := 0;
    END IF;

    total_feedback := 100 * (positive_reviews / num_reviews); -- PROB DA COR E DAQUI

    UPDATE users
    SET rating = total_feedback
    WHERE users.id = seller_id;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_seller_feedback_tg ON feedback CASCADE;
CREATE TRIGGER update_seller_feedback_tg
    AFTER INSERT OR UPDATE ON feedback
    FOR EACH ROW
EXECUTE PROCEDURE update_seller_feedback();


CREATE OR REPLACE FUNCTION update_seller_feedback_delete()
    RETURNS TRIGGER AS $$
DECLARE
    seller_id integer;
    positive_reviews integer;
    num_reviews integer;
    total_feedback float;
BEGIN
    seller_id := get_seller_through_key(OLD.key_id);

    -- Number of positive reviews of seller with id seller_id
    SELECT COUNT(u.id) INTO positive_reviews
    FROM feedback f JOIN keys k ON f.key_id = k.id
                    JOIN offers o ON k.offer_id = o.id
                    JOIN users u ON o.user_id = u.id
    WHERE f.evaluation = true and u.id = o.user_id
    GROUP BY u.id;

    IF positive_reviews IS NULL THEN
        positive_reviews := 0;
    END IF;

    -- Number of reviews of seller with id seller_id
    SELECT COUNT(u.id) INTO num_reviews
    FROM feedback f JOIN keys k ON f.key_id = k.id
                    JOIN offers o ON k.offer_id = o.id
                    JOIN users u ON o.user_id = u.id
    WHERE u.id = o.user_id
    GROUP BY u.id;

    IF num_reviews IS NULL THEN
        num_reviews := 0;
    END IF;

    total_feedback := 100 * (positive_reviews / num_reviews); -- PROB DA COR E DAQUI

    UPDATE users
    SET rating = total_feedback
    WHERE users.id = seller_id;
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_seller_feedback_delete_tg ON feedback CASCADE;
CREATE TRIGGER update_seller_feedback_delete_tg
    AFTER DELETE ON feedback
    FOR EACH ROW
EXECUTE PROCEDURE update_seller_feedback_delete();


CREATE OR REPLACE FUNCTION check_user_bought_product()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT *
        FROM orders AS o JOIN keys AS k ON o.number = k.order_id
        WHERE NEW.key_id = k.id AND o.user_id = NEW.user_id
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
    SELECT COUNT(id) INTO stock_quantity
    FROM keys
    WHERE keys.offer_id = NEW.offer_id AND keys.order_id IS NULL;

    IF(stock_quantity IS NULL) THEN
        stock_quantity:=0;
    END IF;

    UPDATE offers
    SET stock = stock_quantity
    WHERE id = NEW.offer_id;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
DROP TRIGGER IF EXISTS update_product_stock_tg ON keys CASCADE;
CREATE TRIGGER update_product_stock_tg
AFTER INSERT OR UPDATE OF order_id ON keys
FOR EACH ROW
EXECUTE PROCEDURE update_product_stock();


CREATE OR REPLACE FUNCTION update_product_stock_cancel()
RETURNS TRIGGER AS $$
DECLARE
    stock_quantity INTEGER;
BEGIN

    SELECT COUNT(id) INTO stock_quantity
    FROM keys
    WHERE keys.offer_id = NEW.offer_id AND keys.order_id IS NULL;

    IF(stock_quantity IS NULL) THEN
        stock_quantity:=0;
    END IF;

    UPDATE offers
    SET stock = stock_quantity
    WHERE id = OLD.offer_id;

    RETURN OLD;
END;
$$ LANGUAGE plpgsql;
DROP TRIGGER IF EXISTS update_product_stock_delete_tg ON keys CASCADE;
CREATE TRIGGER update_product_stock_delete_tg
AFTER DELETE ON keys
FOR EACH ROW
EXECUTE PROCEDURE update_product_stock_cancel();



CREATE OR REPLACE FUNCTION delete_from_cart()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM carts
    WHERE offer_id IN (
        SELECT offers.id
        FROM offers
        WHERE offers.product_id = NEW.id
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS delete_from_cart_tg ON products CASCADE;
CREATE TRIGGER delete_from_cart_tg
AFTER INSERT OR UPDATE OF deleted ON products
FOR EACH ROW
WHEN (NEW.deleted = true)
EXECUTE PROCEDURE delete_from_cart();



CREATE OR REPLACE FUNCTION delete_from_cart_offer()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM carts
    WHERE offer_id=NEW.id;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;


DROP TRIGGER IF EXISTS delete_from_cart_update_tg ON products CASCADE;
CREATE TRIGGER delete_from_cart_update_tg
AFTER UPDATE OF final_date ON offers
FOR EACH ROW
WHEN (NEW.final_date IS NOT NULL)
EXECUTE PROCEDURE delete_from_cart_offer();


DROP FUNCTION IF EXISTS check_not_self_buying() CASCADE;
CREATE OR REPLACE FUNCTION check_not_self_buying()
RETURNS TRIGGER AS $$
DECLARE
    seller_id INTEGER;
BEGIN
    seller_id := (
        SELECT offers.user_id
        FROM offers
        WHERE offers.id = NEW.offer_id
    );

    IF seller_id = NEW.user_id THEN
        RAISE EXCEPTION 'You cannot buy product that you are already selling!';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS check_not_self_buying_tg ON carts CASCADE;
CREATE TRIGGER check_not_self_buying_tg
AFTER INSERT ON carts
FOR EACH ROW
EXECUTE PROCEDURE check_not_self_buying();


CREATE OR REPLACE FUNCTION delete_keys_from_canceled_offers()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM keys
    WHERE keys.offer_id = NEW.id AND keys.order_id IS NULL;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
DROP TRIGGER IF EXISTS delete_keys_from_canceled_offers_tg ON offers CASCADE;
CREATE TRIGGER delete_keys_from_canceled_offers_tg
AFTER UPDATE OF final_date ON offers
FOR EACH ROW
WHEN(NEW.final_date IS NOT NULL)
EXECUTE PROCEDURE delete_keys_from_canceled_offers();


CREATE OR REPLACE FUNCTION rollback_offer_of_deleted_products()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS(
        SELECT *
        FROM products
        WHERE NEW.product_id = products.id AND products.deleted = TRUE
     ) THEN
        RAISE EXCEPTION 'You cannot insert an offer of a product that was deleted by the admin';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS rollback_offer_of_deleted_products_tg ON offers CASCADE;
CREATE TRIGGER rollback_offer_of_deleted_products_tg
BEFORE INSERT ON offers
FOR EACH ROW
EXECUTE PROCEDURE rollback_offer_of_deleted_products();


CREATE OR REPLACE FUNCTION update_offer_final_date()
RETURNS TRIGGER AS $$
BEGIN
    UPDATE offers
    SET final_date = now()
    WHERE id = NEW.id;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_offer_final_date_tg ON offers CASCADE;
CREATE TRIGGER update_offer_final_date_tg
AFTER UPDATE OF stock ON offers
FOR EACH ROW
WHEN(NEW.final_date IS NULL AND NEW.stock=0)
EXECUTE PROCEDURE update_offer_final_date();


CREATE OR REPLACE FUNCTION check_discount_date_overlap()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS(
        SELECT *
        FROM discounts
        WHERE start_date IS NOT NULL
			AND start_date <= NEW.end_date
			AND end_date >= NEW.start_date
			AND NEW.offer_id = discounts.offer_id
    ) THEN
        RAISE EXCEPTION 'There is already a discount for that offer during the same time period';
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS overlap_discount_dates_tg ON discounts CASCADE;
CREATE TRIGGER overlap_discount_dates_tg
BEFORE INSERT OR UPDATE ON discounts
FOR EACH ROW
EXECUTE PROCEDURE check_discount_date_overlap();


CREATE OR REPLACE FUNCTION refresh_active_products_view()
RETURNS TRIGGER AS $$
BEGIN
    REFRESH MATERIALIZED VIEW active_products;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS refresh_active_products_view_tg ON products CASCADE;
CREATE TRIGGER refresh_active_products_view_tg
AFTER INSERT OR DELETE OR UPDATE ON products
FOR EACH ROW
EXECUTE PROCEDURE refresh_active_products_view();


CREATE OR REPLACE FUNCTION refresh_active_offers_view()
RETURNS TRIGGER AS $$
BEGIN
    REFRESH MATERIALIZED VIEW active_offers;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS refresh_active_offers_view_tg ON offers CASCADE;
CREATE TRIGGER refresh_active_offers_view_tg
AFTER INSERT OR DELETE OR UPDATE OF final_date ON offers
FOR EACH ROW
EXECUTE PROCEDURE refresh_active_offers_view();


CREATE OR REPLACE FUNCTION verify_banned_user_orders()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.user_id IN (SELECT id FROM banned_users) THEN
        RAISE EXCEPTION 'User with ID % is banned and cannot make purchases', NEW.user_id;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS verify_banned_user_orders_tg ON orders CASCADE;
CREATE TRIGGER verify_banned_user_orders_tg
BEFORE INSERT ON orders
FOR EACH ROW
EXECUTE PROCEDURE verify_banned_user_orders();


---
CREATE OR REPLACE FUNCTION update_offer_profit()
RETURNS TRIGGER AS $$
DECLARE
    offer_profit REAL;

BEGIN

    SELECT SUM(keys.price_sold) into offer_profit
    FROM keys
    WHERE keys.offer_id = NEW.offer_id
        AND keys.price_sold IS NOT NULL
    GROUP BY keys.offer_id;

    IF (offer_profit IS NULL) THEN
        offer_profit:=0;
    END IF; 

    UPDATE offers
    SET profit = profit + offer_profit
    WHERE id = NEW.offer_id;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
DROP TRIGGER IF EXISTS update_offer_profit_tg ON keys CASCADE;
CREATE TRIGGER update_offer_profit_tg
AFTER INSERT OR UPDATE OF price_sold ON keys
FOR EACH ROW
EXECUTE PROCEDURE update_offer_profit();
---

CREATE OR REPLACE FUNCTION update_offer_profit_delete()
RETURNS TRIGGER AS $$
DECLARE
    offer_profit REAL;

BEGIN

    SELECT SUM(keys.price_sold) into offer_profit
    FROM keys
    WHERE keys.offer_id = OLD.offer_id
        AND keys.price_sold IS NOT NULL
    GROUP BY keys.offer_id;

    IF (offer_profit IS NULL) THEN
        offer_profit:=0;
    END IF; 


    UPDATE offers
    SET profit = profit + offer_profit
    WHERE id = OLD.offer_id;

    RETURN OLD;
END;
$$ LANGUAGE plpgsql;
DROP TRIGGER IF EXISTS update_offer_profit_delete_tg ON keys CASCADE;
CREATE TRIGGER update_offer_profit_delete_tg
AFTER DELETE ON keys
FOR EACH ROW
EXECUTE PROCEDURE update_offer_profit_delete();


CREATE OR REPLACE FUNCTION verify_banned_user_offer()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.user_id IN (SELECT id FROM banned_users) THEN
        RAISE EXCEPTION 'User with ID % is banned and cannot make offers', NEW.user_id;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS verify_banned_user_offer_tg ON offers CASCADE;
CREATE TRIGGER verify_banned_user_offer_tg
BEFORE INSERT ON offers
FOR EACH ROW
EXECUTE PROCEDURE verify_banned_user_offer();

-----------------------------------------
-- Drop all old table data  (TRUNCATE quickly removes all rows from a set of tables. It has the same effect as an unqualified DELETE on each table, but since it does not actually scan the tables it is faster)
-----------------------------------------

TRUNCATE admins RESTART IDENTITY CASCADE;
TRUNCATE ban_appeals RESTART IDENTITY CASCADE; 
TRUNCATE banned_users RESTART IDENTITY CASCADE; 
TRUNCATE carts RESTART IDENTITY CASCADE; 
TRUNCATE categories RESTART IDENTITY CASCADE; 
TRUNCATE discounts RESTART IDENTITY CASCADE; 
TRUNCATE faq RESTART IDENTITY CASCADE; 
TRUNCATE feedback RESTART IDENTITY CASCADE;
TRUNCATE genres RESTART IDENTITY CASCADE; 
TRUNCATE pictures RESTART IDENTITY CASCADE; 
TRUNCATE keys RESTART IDENTITY CASCADE; 
TRUNCATE messages RESTART IDENTITY CASCADE; 
TRUNCATE offers RESTART IDENTITY CASCADE; 
TRUNCATE orders RESTART IDENTITY CASCADE;  
TRUNCATE platforms RESTART IDENTITY CASCADE; 
TRUNCATE products RESTART IDENTITY CASCADE; 
TRUNCATE product_has_genres RESTART IDENTITY CASCADE; 
TRUNCATE product_has_platforms RESTART IDENTITY CASCADE; 
TRUNCATE users RESTART IDENTITY CASCADE; 
TRUNCATE reports RESTART IDENTITY CASCADE;

-----------------------------------------
-- Populate the database
-----------------------------------------

-- static pages
INSERT INTO faq(question, answer) VALUES(UPPER('WHAT IS KEYSHARE?'),'KeyShare is a global marketplace which specializes in the sale of gaming related digital products using redemption keys');
INSERT INTO faq(question, answer) VALUES(UPPER('WHAT PAYMENT METHODS CAN I USE TO MAKE PURCHASE ON THE KEYSHARE WEBSITE?'),'The only available payment method Paypal');
INSERT INTO faq(question, answer) VALUES(UPPER('WHY DO I NEED TO CREATE AN ACCOUNT ON THE KEYSHARE WEBSITE?'),'Even though you can buy products without an account, if you register you can see your purchase history, have a savable cart, give feedback, etc');
INSERT INTO faq(question, answer) VALUES(UPPER('DO I NEED TO PAY ANY EXTRA TAX AFTER MAKEING A PURCHASE ON THE keyHARE WEBSITE?'),'The full price is as listed, so no!');
INSERT INTO faq(question, answer) VALUES(UPPER('DO I HAVE THE RIGHT TO A REFUND IN CASE A PRODUCT IS NOT WORKING?'),'In case a product does not work, you should report the seller and the admin will analyze yoyr situation');
INSERT INTO faq(question, answer) VALUES(UPPER('DO I HAVE ACCESS TO THE GAMES I BUY ON THE KEYSHARE WEBISTE FOREVER?'),'Yes, after buying any product, the key will work forever. If it does not, then you should report the seller');

-- categories
INSERT INTO categories(name) VALUES('GAME');
INSERT INTO categories(name) VALUES('DLC');
INSERT INTO categories(name) VALUES('EXPANSION');

-- genres
INSERT INTO genres(name) VALUES('ACTION');
INSERT INTO genres(name) VALUES('SPORT');
INSERT INTO genres(name) VALUES('ADVENTURE');
INSERT INTO genres(name) VALUES('PUZZLE');
INSERT INTO genres(name) VALUES('FPS');
INSERT INTO genres(name) VALUES('SIMULATION');
INSERT INTO genres(name) VALUES('SHOOTER');
INSERT INTO genres(name) VALUES('RACING');
INSERT INTO genres(name) VALUES('FOOTBALL');
INSERT INTO genres(name) VALUES('CO-OP');
INSERT INTO genres(name) VALUES('MULTIPLAYER');
INSERT INTO genres(name) VALUES('OPEN-WORLD');

-- platforms
INSERT INTO platforms(name) VALUES('PC');
INSERT INTO platforms(name) VALUES('PS5');
INSERT INTO platforms(name) VALUES('PS4');
INSERT INTO platforms(name) VALUES('PS3');
INSERT INTO platforms(name) VALUES('PS2');
INSERT INTO platforms(name) VALUES('XBOX SERIES X');
INSERT INTO platforms(name) VALUES('XBOX ONE');
INSERT INTO platforms(name) VALUES('XBOX 360');
INSERT INTO platforms(name) VALUES('SWITCH');

-- product pictures
INSERT INTO pictures (id, url) VALUES (2 ,'product.png');
INSERT INTO pictures (url) VALUES ('dcdb4945904bf4da6b15ce79ad9e0492.png');
INSERT INTO pictures (url) VALUES ('6aeb7836dcb2ba2b4269accb3c2e64c7.png');
INSERT INTO pictures (url) VALUES ('5353286093c4de6d762effd4d84f3259.png');
INSERT INTO pictures (url) VALUES ('5427b3c4946d24d90cd0a91ad4934a53.png');
INSERT INTO pictures (url) VALUES ('10ad90a11279f840d1f308d29b532ad4.png');
INSERT INTO pictures (url) VALUES ('5fd9a24f8770576b18c7266167179e93.png');
INSERT INTO pictures (url) VALUES ('1a5ae8867077dd2ae4b913a76b271f4a.png');
INSERT INTO pictures (url) VALUES ('ff4a0493cae3168be2ef6117e62e7067.png');
INSERT INTO pictures (url) VALUES ('261f44e3020433d5f0b8693688ae44b5.png');
INSERT INTO pictures (url) VALUES ('942f3505aadd31c7953628370d00bf22.png');
INSERT INTO pictures (url) VALUES ('4be39b743bb0015f7dab201fa5eb7a79.png');
INSERT INTO pictures (url) VALUES ('cfd24ee575794d52a83151b0162b19d5.png');
INSERT INTO pictures (url) VALUES ('8f6e9443a4df277f7bb8bebebca94d82.png');
INSERT INTO pictures (url) VALUES ('8aeccc1d837017adc065bcbc0163aaa0.png');
INSERT INTO pictures (url) VALUES ('fda1a4aab3b10a57b2cf50ce83464840.png');
INSERT INTO pictures (url) VALUES ('7f1144248c995587e4dd4368b3bd73ce.png');
INSERT INTO pictures (url) VALUES ('b5e294ae186ce239a940349e91c825ec.png');
INSERT INTO pictures (url) VALUES ('7c7a700123deef94dcee679725acd992.png');
INSERT INTO pictures (url) VALUES ('3744b3689b77e0b216c3f76ba7eb0ecf.png');
INSERT INTO pictures (url) VALUES ('69b4252d8b1b8ed83fed1c4333a5f39e.png');
INSERT INTO pictures (url) VALUES ('b644be6b0f7e7be8977c5a43f37fd26f.png');
INSERT INTO pictures (url) VALUES ('34bf0e63edc4b2e4949b49b63d1da5c0.png');
INSERT INTO pictures (url) VALUES ('0afbae6ad65703271103dc8f392a7304.png');
INSERT INTO pictures (url) VALUES ('7684fb3f03509f9bc99149488016db68.png');
INSERT INTO pictures (url) VALUES ('ec886fbf9042af6ded4f786ce5e24e5a.png');
INSERT INTO pictures (url) VALUES ('7969c0e76cfa69a61fdba2a4896b4238.png');
INSERT INTO pictures (url) VALUES ('c4ec383184df526c005f4a26a1404349.png');
INSERT INTO pictures (url) VALUES ('d3d2bc681cef6a0631f32299b25da87d.png');
INSERT INTO pictures (url) VALUES ('14e93deeb687d1302180f7129d8a75a3.png');


INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('GTA V'), 'Grand Theft Auto V for PC will take full advantage of the power of PC to deliver across-the-board enhancements including increased resolution and graphical detail, denser traffic, greater draw distances, upgraded AI, new wildlife, and advanced weather and damage effects for the ultimate open world experience. Grand Theft Auto V for PC features the all-new First Person Mode, giving players the chance to explore the incredibly detailed world of Los Santos and Blaine County in an entirely new way across both Story Mode and Grand Theft Auto Online.Los Santos: a sprawling sun-soaked metropolis full of self-help gurus, starlets and fading celebrities, once the envy of the Western world, now struggling to stay afloat in an era of economic uncertainty and cheap reality TV. Amidst the turmoil, three very different criminals risk everything in a series of daring and dangerous heists that could set them up for life.The biggest, most dynamic and most diverse open world ever created and now packed with layers of new detail, Grand Theft Auto V blends storytelling and gameplay in new ways as players repeatedly jump in and out of the lives of the game’s three lead characters, playing all sides of the game’s interwoven story.Grand Theft Auto V for PC also includes Grand Theft Auto Online, the ever-evolving Grand Theft Auto universe. Explore the vast world or rise through the criminal ranks by banding together to complete Jobs for cash, purchase properties, vehicles and character upgrades, compete in traditional competitive', 11, 1, '2013-09-17');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,1);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(7,1);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,1);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,1);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(4,1);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,1);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(8,1);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Red Dead Redemption 2'), 'America, 1899. The end of the wild west era has begun as lawmen hunt down the last remaining outlaw gangs. Those who will not surrender or succumb are killed. After a robbery goes badly wrong in the western town of Blackwater, Arthur Morgan and the Van der Linde gang are forced to flee. With federal agents and the best bounty hunters in the nation massing on their heels, the gang must rob, steal and fight their way across the rugged heartland of America in order to survive. As deepening internal divisions threaten to tear the gang apart, Arthur must make a choice between his own ideals and loyalty to the gang who raised him.From the creators of Grand Theft Auto V and Red Dead Redemption, Red Dead Redemption 2 is an epic tale of life in America at the dawn of the modern age.', 17, 1, '2018-10-26');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,2);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(7,2);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,2);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,2);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(6,2);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('PAYDAY 2'), 'PAYDAY 2 is an 0-packed, four-player 9 6 that once again lets gamers don the masks of the original PAYDAY crew - Dallas, Hoxton, Wolf and Chains - as they descend on Washington DC for an epic crime spree. The new CRIMENET network offers a huge range of dynamic contracts, and players are free to choose anything from small-time convenience store hits or kidnappings, to big league cyber-crime or emptying out major bank vaults for that epic PAYDAY. While in DC, why not participate in the local community, and run a few political errands?Up to four friends 9erate on the hits, and as the crew progresses the jobs become bigger, better and more rewarding. Along with earning more money and becoming a legendary criminal comes a new character customization and crafting system that lets crews build and customize their own guns and gear.', 24, 1, '2013-08-13');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,3);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(7,3);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,3);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,3);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,3);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(4,3);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,3);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(8,3);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('PAYDAY 2 - San Martin Bank Heist'), 'The Payday Gang is down in Mexico, preparing to hit a small town bank that has ties to a powerful drug cartel.

A Bank Down South
This is a one-day heist taking place in the small and sleepy Mexican town of San Martín, which is about to receive a rude awakening as the Payday Gang arrives to hit the local bank.

This DLC sees the Mexican police force make its debut appearance in PAYDAY 2, and players will find that the Mexican SWAT officers are every bit as tough as their US counterparts.

The heist is available in both stealth and loud, and has a variety of preplanning options to allow players to customize their approach.', 24, 2, '2020-02-27');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,4);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(7,4);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,4);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,4);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,4);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(4,4);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,4);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(8,4);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Rocket League'), 'What do soccer and cars have in common? Neither of them are as cool as Rocket League. This one-of-a-kind competition lets you drive a custom vehicle in a revamped soccer arena. Roll up the walls, do sick tricks, and try to smash the ball into your opponents goal. Rocket League is a hugely popular game from a tiny studio. They started out on PS3 with Supersonic Acrobatic Rocket-Powered Battle Cars in 2008 and have leveled up their game in the years since then. The latest game from the designers at Psyonix was nominated for hundreds of awards in 2015 when it released including Game of the Year! Critics love it, fans cant stop playing it. So the only question is: why dont you have it already? Buy Rocket League today and boost into 0!', 28, 1, '2015-07-07');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,5);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(8,5);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(10,5);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(11,5);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,5);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,5);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,5);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Battlefield V'), 'With Battlefield V, the series goes back to its roots in a never-before-seen portrayal of World War 2. Take on physical, all-out multiplayer with your squad in modes like the vast Grand Operations and the cooperative Combined Arms, or witness human drama set against global combat in the single player War Stories. As you fight in epic, unexpected locations across the globe, enjoy the richest and most immersive Battlefield yet.World War 2 as youve never seen it before Get ready to immerse yourself in iconic World War 2 0 - from paratrooper assaults to tank warfare. Charge into pivotal battles in the early days of the war for an experience unlike any other. This isnt the World War 2 youve come to expect - this is Battlefield V. Customize your soldiersYour journey through the world of Battlefield V starts with your Company - where every soldier is unique. Create and customize soldiers,weapons and vehicles, from the way they look to how they play.', 10, 1, '2018-09-04');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,6);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(8,6);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(11, 6);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,6);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,6);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,6);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Battlefield 4'), 'Take 0 and rise above the chaos in Battlefield 4. This FPS from Electronic Arts is part of a genre-defining series that fans love and critics praise. In BF4 you can experience a new level of reality. Good soldiers are needed on the frontlines to lead the way. Immerse yourself in an epic single player story that puts you in the heat of the battle. The intense graphics and completely destructible environment make this Battlefield feel incredible. Master your weapons and take the fight online with great multiplayer capability. Buy it and see for yourself.FeaturesControl the battle - You decide how things happen in Battlefield 4. This game is designed to be totally interactive, allowing you more choices than in any previous Battlefield game. Explosives, bullets, and collisions have a serious impact on the environment. You can take down a building, or unleash a flood on your enemies. Even the car alarms work! When you play Battlefield 4 you re not just seeing destruction, you re experiencing it first-hand. Get creative with your strategy and experience a new way of gaming. Youve played 6s before, but this game is about strategy and tactics more than just holding down the trigger. Are you smart enough to survive the war of tomorrow?Fight for the future - Battlefield 4 offers an exciting single player campaign which takes place in the not-so-distant future. The world powers are at eachothers throats and your elite squad, the Tombstone, must work to restore balance. Make use of high-tech explosives, guns, and surveillance gear to stay one step ahead of your enemies. There are four main classes with multiple specializations to choose from. Are you a support focused player? A friendly medic? Or a deadly sniper? If you like to blow things up, try the Engineers toolkit. The future of war is waiting for you. Find your place in Battlefield.Battle anywhere - Take the fight to the skies or to the seas. Battlefield 4 offers you the opportunity to engage in naval combat, pilot planes, and drive tanks. Vehicles are an awesome feature of both the campaign and online gameplay. Get behind the wheel of every combat vehicle you can imagine. Different scenarios come with unique challenges, and special ways to blow stuff up! Play through the campaign on your own and then take your skills online. Multiplayer in BF4 is strategic and intense. There are tons of other players online that you can learn from and get to know. Don t worry about getting bored because there are tons of expansion packs to pick up. Once you get into Battlefield 4, you ll keep coming back for more. Buy it today and add a game to your library that you wont ever forget.', 19, 1, '2013-10-29');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,7);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(8,7);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(11,7);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,7);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,7);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(4,7);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,7);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(8,7);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('FIFA 20'), 'Play the beautiful game the way you want with various forms of 3v3, 4v4, and 5v5 both with and without walls, as well as Professional Futsal. Or, take your unique player through the VOLTA Story Mode culminating in the VOLTA World Championship in Buenos Aires. Find out more about VOLTA Football in FIFA 20 here. Experience the new Football Intelligence system which unlocks an unprecedented platform of football realism, putting you at the centre of every match in FIFA 20.Authentic Game Flow gives players more awareness of time, space, and positioning, putting greater emphasis on your play. You ll also have more control over the Decisive Moments that decide the outcome of games in both attack and defence with a Set Piece Refresh, Controlled Tackling, and Composed Finishing. Finally, the Ball Physics System offers new shot trajectories, more realistic tackle inter0s, and physics-driven behaviour, elevating gameplay to a new level of realism.', 6, 1, '2019-09-10');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(2,8);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(9,8);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(11,8);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,8);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,8);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,8);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(9,8);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('F1 2019'), 'The official videogame of the 2019 FIA FORMULA ONE WORLD CHAMPIONSHIP™, F1® 2019 challenges you to Defeat your Rivals in the most ambitious F1® game in Codemasters’ history.F1® 2019 features all the official teams, drivers and all 21 circuits from the 2019 season. This year sees the inclusion of F2™ with players being able to complete the 2018 season with the likes of George Russell, Lando Norris and Alexander Albon.With greater emphasis on graphical fidelity, the environments have been significantly enhanced, and the tracks come to life like never before. Night races have been completely overhauled creating vastly improved levels of realism and the upgraded F1® broadcast sound and visuals add further realism to all aspects of the race weekend.', 13, 1, '2019-06-25');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(2,9);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(8,9);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(11,9);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,9);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,9);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,9);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('DIRT RALLY'), 'GDiRT Rally is the most authentic and thrilling rally game ever made, road-tested over 80 million miles by the DiRT community. It perfectly captures that white knuckle feeling of racing on the edge as you hurtle along dangerous roads at breakneck speed, knowing that one crash could irreparably harm your stage time. DiRT Rally also includes officially licensed World Rallycross content, allowing you to experience the breathless, high-speed thrills of some of the world’s fastest off-road cars as you trade paint with other drivers at some of the series’ best-loved circuits, in both singleplayer and high-intensity multiplayer races.', 7, 1, '2015-12-07');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(2,10);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(8,10);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(11,10);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,10);

INSERT INTO products(name,description, picture_id,category_id,launch_date)VALUES (UPPER('Project CARS 2'), 'THE ULTIMATE DRIVER JOURNEY! Project CARS 2 delivers the soul of motor racing in the world’s most beautiful, authentic, and technically-advanced racing game.', 14, 1, '2017-09-21');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(2,11);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(8,11);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(11,11);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,11);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,11);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,11);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Pro Cycling Manager 2019'), 'Manage your own team of professional cyclists in the new 2019 season. Take the lead in over 200 races and 600 stages around the world and try to win legendary races like La Vuelta and the Tour de France. Manage, negotiate contracts and land new sponsors, plan your training and strategy, and execute your tactics during races to pedal your way to victory!Pull on the jersey of a professional cyclist and pursue your career to become a champion in Pro Cyclist mode. Compete against or team up with your friends in Online mode with up to 16 players. Solo or online, be the best to take your team to the top.', 22, 1, '2019-06-27');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(2,12);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(8,12);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(11,12);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,12);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Mount & Blade 2'), 'The horns sound, the ravens gather. An empire is torn by civil war. Beyond its border, new kingdoms rise. Gird on your sword, don your armour, summon your followers and ride forth to win glory on the battlefields of Calradia. Establish your hegemony and create a new world out of the ashes of the old. Mount & Blade II: Bannerlord is the eagerly awaited sequel to the acclaimed medieval combat simulator and role-playing game Mount & Blade: Warband. Set 200 years before, it expands both the detailed fighting system and the world of Calradia. Bombard mountain fastnesses with siege engines, establish secret criminal empires in the back alleys of cities, or charge into the thick of chaotic battles in your quest for power.', 30, 1, '2020-03-30');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,13);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,13);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,13);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,13);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,13);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,13);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(9,13);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Age of Empires 2: Definitive Edition'), 'Age of Empires II: Definitive Edition celebrates the 20th anniversary of one of the most popular strategy games ever with stunning 4K Ultra HD graphics, a new and fully remastered soundtrack, and brand-new content, “The Last Khans” with 3 new campaigns and 4 new civilizations.Explore all the original campaigns like never before as well as the best-selling expansions, spanning over 200 hours of gameplay and 1,000 years of human history. Head online to challenge other players with 35 different civilizations in your quest for world domination throughout the ages. Choose your path to greatness with this definitive remaster to one of the most beloved strategy games of all time.', 12, 1, '2019-11-14');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,14);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,14);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,14);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,14);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Cities: Skylines'), 'Cities: Skylines is a modern take on the classic city 5. The game introduces new game play elements to realize the thrill and hardships of creating and maintaining a real city whilst expanding on some well-established tropes of the city building experience. From the makers of the Cities in Motion franchise, the game boasts a fully realized transport system. It also includes the ability to mod the game to suit your play style as a fine counter balance to the layered and challenging 5. You’re only limited by your imagination, so take control and reach for the sky!', 18, 1, '2015-03-10');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,15);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,15);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,15);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,15);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,15);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,15);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(9,15);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Europa Universalis IV'), 'Fulfill your quest for global domination! Paradox Development Studio is back with the fourth installment of the award-winning Europa Universalis series. The empire building game Europa Universalis IV gives you control of a nation to guide through the years in order to create a dominant global empire. Rule your nation through the centuries, with unparalleled freedom, depth and historical accuracy. True exploration, trade, warfare and diplomacy will be brought to life in this epic title rife with rich strategic and tactical depth.', 23, 1, '2013-08-13');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,16);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,16);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,16);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,16);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Civilization V'), 'Become Ruler of the World by establishing and leading a civilization from the dawn of man into the space age: Wage war, conduct diplomacy, discover new technologies, go head-to-head with some of history’s greatest leaders and build the most powerful empire the world has ever known.', 27, 1, '2010-09-21');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,17);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,17);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,17);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,17);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Watch Dogs 2'), 'The sequel to Watch Dogs has been announced, and is now right around the corner. Buy the game today to immerse yourself in the world of hackers mixed with a little violence to help you achieve your sought after goal. From the makers of the Best 0/2 Game of 2013 from the E3 Game Critics Awards, Watch Dogs, we are presented with Watch Dogs 1, a sequel which will see gameplay take place in a different city, San Francisco.', 31, 1, '2016-11-15');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,18);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,18);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,18);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,18);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,18);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,18);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Assassins Creed Brotherhood'), 'Live and breathe as Ezio, a legendary Master Assassin, in his enduring struggle against the powerful Templar Order. He must journey into Italy’s greatest city, Rome, center of power, greed and corruption to strike at the heart of the enemy. Defeating the corrupt tyrants entrenched there will require not only strength, but leadership, as Ezio commands an entire Brotherhood who will rally to his side. Only by working together can the Assassins defeat their mortal enemies.And for the first time, introducing an award-winning multiplayer layer that allows you to choose from a wide range of unique characters, each with their own signature weapons and assassination techniques, and match your skills against other players from around the world.It’s time to join the Brotherhood.', 29, 1, '2010-11-16');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,19);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,19);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,19);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,19);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,19);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(4,19);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,19);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(8,19);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Minecraft'), 'Explore randomly generated worlds and build amazing things from the simplest of homes to the grandest of castles. Play in creative mode with unlimited resources or mine deep into the world in survival mode, crafting weapons and armor to fend off the dangerous mobs. Craft, create, and explore alone, or with friends on mobile devices or Windows 10. Millions of crafters around the world have smashed billions of blocks - now you can join in the fun on Windows 10! ', 8, 1, '2009-05-17');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,20);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,20);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,20);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,20);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('The Crew 2'), 'The newest iteration in the revolutionary franchise, The Crew® 2 captures the thrill of the American motorsports spirit in one of the most exhilarating open worlds ever created. Welcome to Motornation, a huge, varied, 0-packed, and beautiful playground built for motorsports throughout the entire US of A. Enjoy unrestrained exploration on ground, sea, and sky. From coast to coast, street and pro racers, off-road explorers, and freestylers gather and compete in all kinds of disciplines. Join them in high-octane contests and share every glorious moment with the world.', 20, 1, '2018-06-29');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(8,21);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,21);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,21);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,21);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,21);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,21);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Assassins Creed Unity'), 'Paris, 1789. The French Revolution turns a once-magnificent city into a place of terror and chaos. Its cobblestone streets run red with the blood of commoners who dared to rise up against the oppressive aristocracy. As the nation tears itself apart, a young man named Arno will embark on an extraordinary journey to expose the true powers behind the Revolution. His pursuit will throw him into the middle of a ruthless struggle for the fate of a nation, and transform him into a true Master Assassin. Introducing Assassin s Creed Unity, the next-gen evolution of the blockbuster franchise powered by an all-new game engine. From the storming of the Bastille to the execution of King Louis XVI, experience the French Revolution as never before, and help the people of France carve an entirely new destiny.', 16, 1, '2014-11-11');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,22);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,22);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,22);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,22);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,22);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,22);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Grand Theft Auto III'), 'The sprawling crime epic that changed open-world games forever.Welcome to Liberty City. Where it all began. The critically acclaimed blockbuster Grand Theft Auto III brings to life the dark and seedy underworld of Liberty City. With a massive and diverse open world, a wild cast of characters from every walk of life and the freedom to explore at will, Grand Theft Auto III puts the dark, intriguing and ruthless world of crime at your fingertips.With stellar voice acting, a darkly comic storyline, a stunning soundtrack and revolutionary open-world gameplay, Grand Theft Auto III is the game that defined the open world genre for a generation.', 9, 1, '2001-10-22');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(2,23);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(7,23);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(13,23);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(8,23);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,23);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,23);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(4,23);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(5,23);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(8,23);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('The Elder Scrolls V - Skyrim'), ' true, full-length open-world game for VR has arrived from award-winning developers, Bethesda Game Studios. Skyrim VR reimagines the complete epic fantasy masterpiece with an unparalleled sense of scale, depth, and immersion. From battling ancient dragons to exploring rugged mountains and more, Skyrim VR brings to life a complete open world for you to experience any way you choose. Skyrim VR includes the critically-acclaimed core game and official add-ons – Dawnguard, Hearthfire, and Dragonborn. Dragons, long lost to the passages of the Elder Scrolls, have returned to Tamriel and the future of the Empire hangs in the balance. As Dragonborn, the prophesied hero born with the power of The Voice, you are the only one who can stand amongst them.', 21, 1, '2011-11-11');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,24);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,24);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(3,24);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,24);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,24);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(4,24);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,24);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(8,24);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(9,24);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Witcher 3'), 'The Witcher 3: Wild Hunt Game of the Year edition brings together the base game and all the additional content released to date. Includes the Hearts of Stone and Blood & Wine expansions, which offer a massive 50 hours of additional storytelling as well as new features and new areas that expand the explorable world by over a third! Affords access to all additional content released so far, including weapons, armor, side quests, game modes and new GWENT cards! Features all technical and visual updates as well as a new user interface completely redesigned on the basis of feedback from members of the Witcher Community. Become a professional monster slayer and embark on an 2 of epic proportions! Upon its release, The Witcher 3: Wild Hunt became an instant classic, claiming over 250 Game of the Year awards. Now you can enjoy this huge, over 100-hour long, open-world 2 along with both its story-driven expansions worth an extra 50 hours of gameplay. This edition includes all additional content - new weapons, armor, companion outfits, new game mode and side quests.', 5, 1, '2015-05-19');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,25);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,25);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(3,25);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,25);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,25);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,25);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(9,25);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('The Sims 4 - Cats & Dogs 1'), 'Create a variety of cats and dogs, add them to your Sims’ homes to forever change their lives and care for neighbourhood pets as a veterinarian with The Sims™ 4 Cats & Dogs. The powerful new Create A Pet tool lets you personalise cats and dogs, each with their own unique appearances, distinct behaviours and for the first time, expressive outfits! These wonderful, lifelong companions will change your Sims’ lives in new and special ways. Treat animal ailments as a veterinarian and run your own clinic in a beautiful coastal world where there’s so much for your Sims and their pets to discover.', 15, 1, '2017-11-10');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,26);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(3,26);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,26);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,26);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,26);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Euro Truck Simulator 2 - Vive la France') , 'Vive la France ! is a large map expansion add-on for Euro Truck Simulator 2. Make your way through broad boulevards of industrial cities and narrow streets of rural hamlets. Enjoy French outdoors with its diverse looks and disparate vegetation from north to south. Discover famous landmarks, deliver to expansive industrial areas, navigate complex intersections and interchanges, enjoy visually unique roundabouts inspired by real locations. Transport a variety of new cargo to service new local French companies as well as connecting the region to the rest of Europe.', 26, 1, '2012-10-19');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,27);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,27);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,27);

INSERT INTO products(name,description, picture_id,category_id, launch_date)VALUES (UPPER('Europa Universalis IV - Wealth of Nations Expansion'), 'Wealth of Nations is the second expansion for the critically praised strategy game Europa Universalis IV, focusing on trade and how to make the wealth of the world flow into your coffers. The expansion allows you to create trade conflicts in secret, steal from your competitors with the use of privateers, use peace treaties to gain trade power and create a new trade capital to strengthen your grasp over trade. The age of exploration is brought to life in this epic game of trade, diplomacy, warfare and exploration by Paradox Development Studio, the Masters of Strategy. Europa Universalis IV gives you control of a nation to rule an empire that lasts through the ages.', 25, 3, '2014-05-29');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,28);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(6,28);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(12,28);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,28);

INSERT INTO products(name,description, picture_id,category_id,deleted, launch_date)VALUES (UPPER('DRAGON BALL FighterZ'), 'DRAGON BALL FighterZ is born from what makes the DRAGON BALL series so loved and famous: endless spectacular fights with its all-powerful fighters.', 3, 1, TRUE, '2018-01-26');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,29);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(13,29);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,29);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,29);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,29);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(9,29);

INSERT INTO products(name,description, picture_id,category_id,deleted, launch_date)VALUES (UPPER('Shenmue I & II'), 'Originally released for the Dreamcast in 2000 and 2001, Shenmue I & II is an open world action 2 combining jujitsu combat, investigative sleuthing, RPG elements, and memorable mini-games. It pioneered many aspects of modern gaming, including open world city exploration, and was the game that coined the Quick Time Event (QTE). It was one of the first games with a persistent open world, where day cycles to night, weather changes, shops open and close and NPCs go about their business all on their own schedules. Its engrossing epic story and living world created a generation of passionate fans, and the game consistently makes the list of “greatest games of all time”.', 4, 1, TRUE, '2018-08-21');
INSERT INTO product_has_genres(genre_id, product_id)VALUES(1,30);
INSERT INTO product_has_genres(genre_id, product_id)VALUES(13,30);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(1,30);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(3,30);
INSERT INTO product_has_platforms(platform_id, product_id)VALUES(7,30);

-- users
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('motapinto', 'martimpintodasilva@gmail.com', 'Hey there! I am a software engineer and i am looking forward to trade with you', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', '1998-12-05', 100);
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('trustlessuser123', 'trustlessuser123@gmail.com', 'You should not, at all, trust me. Even then, there are some fools who will :)', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', '200-02-11', 101);
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('lpvramos', 'up201706253@g.uporto.com', 'Doom and CS addict sometimes. When I am not that i am a game connoisseur  looking for some good deals', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', '1949-06-21 20:06:49', 103);
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('lockdown', 'kkeelinge1p@g.co', 'Bootstrap master by day, Trader by night', '1968-06-10', 102);
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('arubenruben', 'lhumberstone1q@topsy.com', 'Hey! I am the one you gave up on google login. Ban me if you think that was the wrong move', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', '1972-03-11 ', 104);
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('odin123', 'odinMaster@valhalla.god', 'If you want to join me in Valhalla buy from me.', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', '1989-08-20', 1);
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('ragnarok', 'ragnarok@gmail.com', 'No introductions needed', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', '1991-07-25', 100);
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('yodajedi', 'yodajedi@gmail.com', 'I am really good person. May the force be with you', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', '1960-10-10', 100);
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('sithloard', 'sithloard@gmail.com', 'You either buy from me or dont buy at all', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', '1990-02-11', 100);
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('enzioauditore', 'enzioauditore@gmail.com', 'I am part of an Assassins creed and fight for justice and good commercial relationships', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', '1991-04-26', 100);
INSERT INTO users (username, email, description, password, birth_date, picture_id)VALUES('bjornironside', 'bjornironside@gmail.com', 'I am the true successor of Ragnar LothBrok', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', '1948-08-12', 100);
-- users images
INSERT INTO pictures (id, url)VALUES(100, 'user.png');
INSERT INTO pictures (id, url)VALUES(101, '7b28b3589283f938bd68c2941d0d69d5.png');
INSERT INTO pictures (id, url)VALUES(102, '8d3e8eb63f8681d36f182a9d80e73c5a.png');
INSERT INTO pictures (id, url)VALUES(103, '2bd8cc3a6021fe4ea0f6bf3ce8575efc.png');
INSERT INTO pictures (id, url)VALUES(104, 'c03a67ae76e1937cc8f5b741f264e71a.png');
INSERT INTO pictures (id, url)VALUES(105, '557a2acefd26cbecbd832951aaa66c16.png');
-- banned users
INSERT INTO banned_users(id)VALUES(1);
INSERT INTO banned_users(id)VALUES(5);
INSERT INTO banned_users(id)VALUES(9);
-- ban appeals
INSERT INTO ban_appeals(id, admin_id, ban_appeal, date)VALUES(5, 2, 'I swear i will never sell to third parties. Please forgive me! This is my job!!', '2020-02-25');
INSERT INTO ban_appeals(id, admin_id, ban_appeal, date)VALUES(9, 2, 'Just because i am a sith that does not mean i not a good cumminity member. I think there was a mistake', '2020-05-12');
-- admins
INSERT INTO admins (username, email, description, password, picture_id)VALUES('admin', 'admin@keyhare.com', 'Hello. Welcome to my Profile.', '$2y$10$.8Ql.bH9QsbCQMKNf5XR6Oz.4yt8/i0mKEy4EcX7prMZtG3jsuJ22', 1);
INSERT INTO admins (username, email, description, password, picture_id)VALUES('ssn', 'up310021@g.uporto.pt', 'LBAW teacher and comercial master moderator', '$2y$10$PA30ELTzJN7HOUSZ./TyQOBAT6fUntWicXLQiXxWPFu/LKU456yn6', 6);
-- admins images
INSERT INTO pictures (id, url)VALUES(106, 'user.png');
INSERT INTO pictures (id, url)VALUES(107, '557a2acefd26cbecbd832951aaa66c16.png');
-- reports
INSERT INTO reports(date, description, title, key_id, status, reporter_id, reported_id)VALUES('2020-03-30', 'This is a report','Key dont work', 1, true, 2, 3);
INSERT INTO reports(date, description, title, key_id, status, reporter_id, reported_id)VALUES('2020-03-30', 'This is a report','Key dont work', 2, true, 3, 2);
INSERT INTO reports(date, description, title, key_id, status, reporter_id, reported_id)VALUES('2020-03-30', 'This is a report','Key dont work', 3, true, 10, 11);



















INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (308.98, '2019-06-17 16:30:33', null, 0, 2, 94, 12, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (308.98, '2019-06-17 16:30:33', null, 0, 2, 94, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (23.4, '2019-08-05 00:05:43', null, 0, 2, 98, 10, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (23.4, '2019-08-05 00:05:43', null, 0, 2, 98, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (201.72, '2020-02-27 20:26:32', null, 0, 5, 22, 25, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (201.72, '2020-02-27 20:26:32', null, 0, 2, 22, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (907.84, '2019-08-07 11:05:46', null, 0, 1, 25, 3, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (907.84, '2019-08-07 11:05:46', null, 0, 2, 25, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (986.68, '2019-12-13 07:19:42', null, 0, 6, 68, 3, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (393.52, '2019-12-02 04:46:25', '2020-10-05 02:39:57', 734.87, 8, 77, 2, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (645.86, '2019-05-05 13:42:00', '2020-06-30 08:03:14', 582.24, 2, 94, 12, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (645.86, '2019-05-05 13:42:00', '2020-06-30 08:03:14', 582.24, 2, 94, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (201.25, '2019-12-03 20:56:41', '2020-12-29 07:28:13', 593.43, 3, 48, 5, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (668.14, '2019-05-30 14:55:28', '2020-09-24 20:03:04', 509.44, 2, 94, 10, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (826.8, '2019-11-29 07:19:25', '2020-09-08 02:51:51', 885.41, 8, 33, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (550.04, '2020-02-25 05:13:31', '2020-05-30 17:53:02', 968.84, 1, 24, 6, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (550.04, '2020-02-25 05:13:31', '2020-05-30 17:53:02', 968.84, 2, 24, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (576.32, '2019-10-27 00:50:02', '2020-05-14 12:14:10', 757.09, 3, 91, 11, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (647.14, '2020-04-07 21:02:32', '2020-10-14 19:00:27', 873.67, 3, 34, 13, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (711.3, '2019-07-15 16:13:44', '2020-11-10 21:31:19', 560.44, 8, 33, 16, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (711.3, '2019-07-15 16:13:44', '2020-11-10 21:31:19', 560.44, 2, 33, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (693.62, '2019-06-10 19:43:13', '2020-11-14 11:35:24', 727.14, 6, 66, 27, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (623.53, '2019-10-29 01:44:07', '2020-06-13 11:48:08', 664.22, 4, 95, 3, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (48.1, '2019-05-26 05:36:19', '2020-09-11 18:55:23', 734.32, 6, 1, 5, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (796.28, '2019-08-18 16:42:18', '2020-07-11 01:20:13', 300.53, 7, 77, 8, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (796.28, '2019-08-18 16:42:18', '2020-07-11 01:20:13', 300.53, 2, 77, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (27.11, '2019-12-07 11:20:57', '2020-07-04 14:16:09', 392.98, 3, 68, 26, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (657.76, '2019-10-28 21:50:45', '2020-10-04 11:31:53', 221.93, 9, 71, 12, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (530.91, '2020-03-06 00:11:10', '2020-10-05 02:27:49', 13.41, 1, 77, 8, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (530.91, '2020-03-06 00:11:10', '2020-10-05 02:27:49', 13.41, 2, 77, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (424.17, '2019-12-13 09:21:34', '2020-10-08 13:37:32', 81.32, 6, 41, 6, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (910.99, '2019-05-26 06:05:24', '2020-07-14 05:32:16', 246.1, 4, 52, 21, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (577.29, '2019-10-31 02:16:20', '2020-06-20 17:25:48', 228.09, 1, 25, 18, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (298.07, '2020-03-11 08:52:00', '2020-06-29 22:03:18', 999.32, 9, 2, 23, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (420.82, '2020-01-17 01:44:13', '2020-05-31 16:48:01', 291.46, 8, 12, 18, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (187.16, '2019-10-31 17:37:24', '2020-10-01 00:51:03', 990.82, 1, 81, 7, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (639.52, '2019-08-18 14:36:02', '2020-05-20 05:25:08', 945.87, 7, 8, 25, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (938.09, '2019-08-25 04:28:30', '2020-10-08 13:43:05', 836.37, 8, 8, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (568.37, '2019-05-10 18:32:24', '2020-09-24 10:06:01', 253.78, 9, 69, 10, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (159.0, '2019-07-02 07:33:59', '2020-10-24 02:47:48', 111.09, 3, 29, 17, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (704.66, '2019-08-08 10:23:40', '2020-09-09 07:50:18', 426.51, 2, 67, 5, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (813.13, '2019-12-14 05:14:00', '2020-10-13 09:25:59', 646.73, 2, 70, 21, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (18.41, '2019-04-26 16:10:28', '2020-05-24 03:00:46', 45.4, 6, 66, 27, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (274.52, '2019-12-03 23:37:11', '2020-05-12 09:40:56', 341.76, 2, 63, 14, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (352.13, '2019-07-25 06:28:22', '2020-06-26 13:41:14', 823.5, 6, 43, 13, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (425.32, '2019-09-02 08:08:16', '2020-08-08 06:00:22', 609.0, 8, 67, 21, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (662.04, '2019-06-16 02:19:24', '2020-12-10 19:01:40', 503.15, 6, 47, 23, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (471.4, '2019-08-30 16:21:11', '2020-06-04 07:02:33', 240.51, 5, 40, 22, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (32.79, '2019-11-24 02:06:53', '2020-10-14 04:59:18', 852.95, 4, 62, 7, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (329.6, '2019-11-02 09:58:27', '2020-08-08 13:04:56', 825.94, 4, 32, 26, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (199.9, '2019-09-12 05:26:13', '2020-07-01 06:24:54', 496.96, 7, 61, 10, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (744.21, '2019-05-06 09:36:50', '2020-09-11 23:09:37', 338.35, 6, 33, 6, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (830.96, '2019-07-18 14:54:17', '2020-06-04 06:40:22', 80.98, 5, 53, 19, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (38.72, '2019-07-17 01:30:42', '2020-11-24 09:56:57', 349.66, 2, 61, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (618.08, '2019-10-20 17:38:25', '2020-08-30 21:24:40', 931.96, 2, 72, 13, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (181.56, '2019-11-26 20:33:09', '2020-05-10 13:07:43', 329.38, 7, 53, 2, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (512.95, '2019-04-25 09:17:19', '2020-10-29 19:09:28', 104.26, 6, 73, 26, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (521.26, '2020-02-14 09:47:35', '2020-08-24 06:26:16', 976.08, 1, 50, 14, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (293.96, '2019-06-06 01:07:10', '2020-07-10 17:50:38', 865.65, 8, 73, 26, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (601.89, '2019-06-01 06:57:53', '2020-06-01 02:48:23', 315.76, 7, 74, 18, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (452.42, '2019-08-16 00:56:38', '2020-11-21 16:34:28', 551.31, 8, 99, 24, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (661.37, '2019-05-30 09:25:04', '2020-08-24 05:07:01', 256.34, 6, 24, 24, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (910.56, '2019-12-11 20:27:25', '2020-08-28 17:47:41', 113.43, 4, 67, 2, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (990.82, '2020-03-05 10:18:15', '2020-12-18 07:40:49', 588.57, 8, 59, 8, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (622.38, '2020-02-16 06:15:27', '2020-10-15 03:32:01', 115.83, 4, 34, 10, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (16.7, '2019-05-21 09:40:43', '2020-10-20 16:52:29', 765.78, 6, 66, 15, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (515.28, '2019-08-02 21:58:53', '2020-12-14 13:40:13', 237.4, 9, 85, 10, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (175.69, '2019-10-26 10:35:13', '2020-11-02 10:02:10', 934.9, 1, 60, 27, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (111.11, '2019-10-29 04:37:38', '2020-05-25 19:38:23', 112.32, 4, 51, 20, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (591.97, '2019-06-22 22:56:26', '2020-12-24 20:39:29', 777.04, 8, 84, 19, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (61.94, '2020-02-15 16:51:38', '2020-06-23 00:55:02', 382.66, 1, 34, 9, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (479.87, '2020-01-14 01:38:55', '2020-12-21 02:35:24', 948.4, 9, 27, 26, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (287.13, '2019-10-16 22:13:46', '2020-06-30 00:21:44', 81.89, 8, 88, 18, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (423.91, '2019-10-03 01:26:16', '2020-09-26 00:53:08', 451.66, 7, 68, 16, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (370.37, '2019-11-01 14:11:00', '2020-09-17 09:09:44', 767.12, 3, 81, 6, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (980.96, '2019-09-20 19:05:04', '2020-08-10 07:07:15', 98.21, 4, 11, 1, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (53.34, '2019-10-11 15:59:10', '2020-09-23 19:17:39', 96.49, 6, 99, 4, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (599.42, '2019-09-25 05:45:37', '2020-07-13 11:39:11', 396.38, 7, 37, 26, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (690.43, '2019-10-27 23:11:26', '2020-09-02 20:23:47', 406.23, 6, 55, 17, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (475.48, '2019-07-06 18:18:24', '2020-08-23 08:14:41', 397.78, 7, 37, 13, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (571.81, '2019-11-18 14:40:36', '2020-09-28 07:29:57', 572.89, 2, 22, 3, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (825.42, '2019-05-15 03:59:29', '2020-12-07 04:26:41', 689.94, 3, 41, 15, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (78.92, '2020-03-03 14:11:53', '2020-05-28 19:28:00', 395.08, 5, 64, 23, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (847.45, '2020-03-22 13:44:22', '2020-11-28 17:57:42', 312.75, 9, 24, 9, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (811.11, '2020-02-21 15:25:56', '2020-08-11 07:31:00', 93.22, 5, 44, 15, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (873.62, '2019-07-08 06:57:15', '2020-11-06 22:45:48', 954.48, 2, 22, 15, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (417.24, '2020-03-16 14:55:48', '2020-08-13 12:23:36', 649.78, 2, 93, 25, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (782.13, '2019-10-25 21:16:20', '2020-11-15 00:14:10', 546.88, 8, 58, 15, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (422.28, '2019-11-12 07:20:57', '2020-06-24 18:43:27', 163.9, 6, 40, 12, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (882.51, '2019-06-23 23:39:40', '2020-08-15 19:55:30', 342.35, 6, 7, 25, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (556.6, '2020-01-16 08:40:23', '2020-10-27 06:52:01', 328.85, 9, 59, 17, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (254.03, '2019-11-13 09:59:04', '2020-07-22 14:39:00', 610.29, 9, 54, 14, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (794.08, '2019-04-09 03:20:42', '2020-12-12 10:39:28', 573.33, 9, 48, 6, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (37.73, '2019-04-25 23:09:15', '2020-05-26 03:52:10', 355.03, 6, 34, 3, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (966.48, '2019-10-09 23:44:50', '2020-11-19 03:01:15', 532.33, 7, 66, 3, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (374.24, '2019-11-19 00:14:25', '2020-09-23 12:43:08', 859.45, 3, 22, 25, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (314.51, '2019-09-16 07:45:22', '2020-11-29 14:32:56', 85.36, 8, 61, 18, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (562.63, '2019-10-17 09:37:43', '2020-12-02 12:43:32', 67.14, 5, 5, 17, 0);


INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (417.24, '2020-03-16 14:55:48', '2020-08-13 12:23:36', 649.78, 3, 93, 6, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (782.13, '2019-10-25 21:16:20', '2020-11-15 00:14:10', 546.88, 3, 58, 6, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (422.28, '2019-11-12 07:20:57', '2020-06-24 18:43:27', 163.9, 3, 40, 6, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (882.51, '2019-06-23 23:39:40', '2020-08-15 19:55:30', 342.35, 3, 7, 6, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (556.6, '2020-01-16 08:40:23', '2020-10-27 06:52:01', 328.85, 3, 59, 6, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (254.03, '2019-11-13 09:59:04', '2020-07-22 14:39:00', 610.29, 3, 54, 6, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (37.73, '2019-04-25 23:09:15', '2020-05-26 03:52:10', 355.03, 3, 34, 6, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (966.48, '2019-10-09 23:44:50', '2020-11-19 03:01:15', 532.33, 3, 66, 6, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (374.24, '2019-11-19 00:14:25', '2020-09-23 12:43:08', 859.45, 3, 22, 6, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (314.51, '2019-09-16 07:45:22', '2020-11-29 14:32:56', 85.36, 3, 61, 6, 20);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (562.63, '2019-10-17 09:37:43', '2020-12-02 12:43:32', 67.14, 3, 5, 6, 10);




INSERT INTO discounts (rate, start_date, end_date, offer_id)values (40, '2020-04-01 23:59:00', '2020-05-13 14:55:39', 36);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (5, '2020-04-01 23:59:00', '2020-09-29 11:08:42', 67);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (70, '2020-04-01 23:59:00', '2020-11-21 02:21:55', 16);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (79, '2020-04-01 23:59:00', '2020-06-22 04:46:03', 65);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (90, '2020-04-01 23:59:00', '2020-05-19 03:03:38', 19);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (48, '2020-04-01 23:59:00', '2020-06-12 08:10:40', 84);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (84, '2020-04-01 23:59:00', '2020-08-14 00:27:07', 24);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (2, '2020-04-01 23:59:00', '2020-12-24 04:55:42', 80);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (36, '2020-04-01 23:59:00', '2020-12-02 00:55:35', 7);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (21, '2020-04-01 23:59:00', '2020-09-17 04:46:07', 22);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (69, '2020-04-01 23:59:00', '2020-06-10 04:34:23', 89);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (67, '2020-04-01 23:59:00', '2020-07-28 09:33:40', 72);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (26, '2020-04-01 23:59:00', '2020-11-14 23:57:19', 59);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (55, '2020-04-01 23:59:00', '2020-12-18 07:33:00', 21);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (49, '2020-04-01 23:59:00', '2020-04-17 01:15:35', 30);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (17, '2020-04-01 23:59:00', '2020-07-11 00:03:17', 14);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (53, '2020-04-01 23:59:00', '2020-12-10 15:49:34', 33);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (19, '2020-04-01 23:59:00', '2020-06-07 21:05:48', 64);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (5, '2020-04-01 23:59:00', '2020-07-22 06:46:26', 77);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (20, '2020-04-01 23:59:00', '2020-04-16 22:19:44', 15);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (15, '2020-04-01 23:59:00', '2020-12-24 01:24:19', 56);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (77, '2020-04-01 23:59:00', '2020-05-20 00:09:31', 53);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (47, '2020-04-01 23:59:00', '2020-04-24 16:59:16', 1);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (7, '2020-04-01 23:59:00', '2020-05-22 02:09:55', 31);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (96, '2020-04-01 23:59:00', '2020-11-12 15:02:46', 70);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (7, '2020-04-01 23:59:00', '2020-09-17 05:33:47', 27);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (59, '2020-04-01 23:59:00', '2020-07-17 22:43:08', 12);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (37, '2020-04-01 23:59:00', '2020-12-24 10:55:43', 13);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (34, '2020-04-01 23:59:00', '2020-09-14 08:49:48', 8);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (92, '2020-04-01 23:59:00', '2020-06-21 11:36:47', 87);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (44, '2020-04-01 23:59:00', '2020-12-12 17:29:20', 42);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (43, '2020-04-01 23:59:00', '2020-08-04 12:27:18', 11);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (34, '2020-04-01 23:59:00', '2020-08-11 14:20:03', 28);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (84, '2020-04-01 23:59:00', '2020-05-07 00:56:17', 44);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (84, '2020-04-01 23:59:00', '2020-05-07 14:09:38', 88);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (69, '2020-04-01 23:59:00', '2020-05-06 03:00:21', 10);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (66, '2020-04-01 23:59:00', '2020-12-19 08:13:58', 9);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (29, '2020-04-01 23:59:00', '2020-07-25 07:10:31', 55);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (48, '2020-04-01 23:59:00', '2020-06-07 14:01:23', 32);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (18, '2020-04-01 23:59:00', '2020-07-08 20:01:57', 52);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (63, '2020-04-01 23:59:00', '2020-07-12 13:26:40', 61);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (20, '2020-04-01 23:59:00', '2020-05-18 00:10:10', 50);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (45, '2020-04-01 23:59:00', '2020-10-09 07:28:34', 26);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (72, '2020-04-01 23:59:00', '2020-12-27 21:31:53', 43);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (7, '2020-04-01 23:59:00', '2020-08-08 17:53:04', 78);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (39, '2020-04-01 23:59:00', '2020-10-22 18:29:57', 66);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (42, '2020-04-01 23:59:00', '2020-05-28 17:03:54', 83);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (55, '2020-04-01 23:59:00', '2020-12-28 22:24:43', 51);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (35, '2020-04-01 23:59:00', '2020-12-19 21:52:10', 2);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (92, '2020-04-01 23:59:00', '2020-07-14 15:33:07', 48);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (97, '2020-04-01 23:59:00', '2020-11-22 23:53:12', 75);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (28, '2020-04-01 23:59:00', '2020-08-30 01:45:22', 54);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (64, '2020-04-01 23:59:00', '2020-05-23 12:48:34', 39);
INSERT INTO discounts (rate, start_date, end_date, offer_id)values (44, '2020-04-01 23:59:00', '2020-08-25 00:08:25', 85);

INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-08-18 16:52:45', 49, 'Léonie', 'kfraschini0@furl.net', 'pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in', '06563');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-08-14 01:35:21', 37, 'Clémence', 'lkeling1@deviantart.com', 'ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse potenti nullam porttitor lacus at turpis donec posuere', '0126');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-09-09 04:33:04', 53, 'Léa', 'gwestrip2@delicious.com', 'velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra', '806');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-07-05 01:27:40', 88, 'Judicaël', 'cwreight3@goodreads.com', 'pharetra magna ac consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus', '576');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-02-19 06:30:19', 3, 'Audréanne', 'dvorley4@exblog.jp', 'ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices', '8502');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-08-20 10:28:29', 89, 'Camélia', 'sarmytage5@ustream.tv', 'eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-05-04 13:05:25', 31, 'Cunégonde', 'sdeverill6@scientificamerican.com', 'cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor sit', '632');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-09-15 04:45:48', 57, 'Tán', 'svero7@ezinearticles.com', 'mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor risus', '81612');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-09-07 09:59:54', 78, 'Lèi', 'nlaing8@networkadvertising.org', 'integer pede justo lacinia eget tincidunt eget tempus vel pede', '25343');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-01-16 11:06:41', 68, 'Dà', 'pmuzzini9@nyu.edu', 'quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero', '16911');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-01-14 17:39:29', 65, 'Maëlla', 'cfullicka@ovh.net', 'sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo', '27666');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-08-06 21:03:07', 92, 'Séverine', 'acaulfieldb@1688.com', 'nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus', '96');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-09-30 19:18:56', 6, 'Eliès', 'kboheac@dailymail.co.uk', 'aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend', '056');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-10-18 06:35:38', 79, 'Mélina', 'rdinniesd@statcounter.com', 'ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices', '3');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-07-22 15:42:26', 21, 'Eugénie', 'rwarsape@studiopress.com', 'id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus sit amet sem fusce consequat nulla', '050');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-08-08 19:28:09', 60, 'Desirée', 'esaurf@domainmarket.com', 'pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim', '897');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-01-13 04:16:09', 52, 'Andrée', 'scopingg@engadget.com', 'sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis at velit eu est', '36312');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-10-23 01:15:37', 73, 'Françoise', 'bkelleherh@hatena.ne.jp', 'donec posuere metus vitae ipsum aliquam non mauris morbi non', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-03-29 11:41:14', 26, 'Nadège', 'mmckelleni@google.it', 'curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla', '24');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-11-08 18:17:06', 50, 'Réjane', 'ocearleyj@is.gd', 'eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat', '44');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-11-17 17:24:40', 1, 'Béatrice', 'mknappek@dropbox.com', 'sem praesent id massa id nisl venenatis lacinia aenean sit amet justo morbi ut odio cras mi pede malesuada in', '0506');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-09-13 08:02:58', 73, 'Cécilia', 'kcalderonl@hibu.com', 'vitae nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper', '31');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-03-01 00:55:48', 64, 'Océane', 'cfitzsimonsm@ibm.com', 'posuere cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec', '2421');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-02-11 04:06:58', 93, 'Cécile', 'lseamarken@nymag.com', 'in consequat ut nulla sed accumsan felis ut at dolor quis', '63');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-02-04 18:29:55', 93, 'Daphnée', 'smacgauhyo@feedburner.com', 'sit amet eleifend pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla', '69');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-12-31 11:09:09', 24, 'Ráo', 'pelesp@shareasale.com', 'in faucibus orci luctus et ultrices posuere cubilia curae nulla dapibus dolor vel est donec odio', '689');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-10-04 00:18:03', 28, 'Mà', 'twenzelq@csmonitor.com', 'rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo', '38');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-11-21 23:03:52', 71, 'Océanne', 'ymariansr@elegantthemes.com', 'ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim', '2');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-12-30 01:51:11', 26, 'Yú', 'sstroobants@youtu.be', 'justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id', '51837');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-11-24 00:22:26', 69, 'Wá', 'hjouannott@cocolog-nifty.com', 'curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec', '3643');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-23 00:16:50', 71, 'Ruì', 'ngarralsu@meetup.com', 'platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat', '92');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-03-16 16:14:42', 90, 'Anaël', 'gheddenv@desdev.cn', 'dui vel sem sed sagittis nam congue risus semper porta volutpat quam pede lobortis', '59969');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-15 19:10:51', 3, 'Michèle', 'gphilippartw@hatena.ne.jp', 'posuere cubilia curae nulla dapibus dolor vel est donec odio justo sollicitudin ut suscipit a feugiat et eros', '739');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-04-14 05:59:05', 48, 'Ruì', 'cbaggotx@livejournal.com', 'sit amet consectetuer adipiscing elit proin risus praesent lectus vestibulum quam sapien', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-04-30 20:43:47', 24, 'Eugénie', 'skillgusy@uiuc.edu', 'volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus sapien ut nunc', '05');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-01-20 20:47:36', 86, 'Stévina', 'gfloydz@booking.com', 'orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus', '2718');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-05-19 17:38:38', 55, 'Bérangère', 'kmcgavigan10@flavors.me', 'consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam', '1739');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-12-21 13:17:10', 28, 'Nadège', 'jstuttman11@imgur.com', 'amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus', '729');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-09-19 08:13:47', 12, 'Zoé', 'zoverstone12@issuu.com', 'purus sit amet nulla quisque arcu libero rutrum ac lobortis vel dapibus at diam', '0298');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-02-14 20:37:20', 52, 'Lóng', 'dpearmine13@europa.eu', 'sit amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in', '6924');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-06-14 12:23:54', 6, 'Åsa', 'jpidgeon14@yelp.com', 'pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque', '386');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-12-16 06:16:51', 19, 'Eliès', 'jleipoldt15@nba.com', 'pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse platea dictumst maecenas ut massa', '51');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-07-10 09:19:18', 55, 'Kévina', 'zterrill16@deliciousdays.com', 'orci pede venenatis non sodales sed tincidunt eu felis fusce', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-12-18 03:54:39', 64, 'Örjan', 'jdeclerk17@jiathis.com', 'pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient', '1176');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-10-17 21:53:13', 54, 'Miléna', 'delt18@gov.uk', 'arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo', '90554');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-08-04 23:11:24', 32, 'Bénédicte', 'agunby19@cpanel.net', 'semper rutrum nulla nunc purus phasellus in felis donec semper sapien a', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-01-25 15:07:56', 94, 'Maëline', 'pwolverson1a@washington.edu', 'et tempus semper est quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus', '58786');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-10-30 11:24:40', 41, 'Angélique', 'mkidde1b@state.tx.us', 'convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque id', '9695');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-03-08 06:35:54', 84, 'Estève', 'lsharman1c@unc.edu', 'suscipit nulla elit ac nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula', '61953');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-10-04 03:54:00', 3, 'Stéphanie', 'achasemoore1d@google.fr', 'odio condimentum id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat', '47790');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-04-01 05:58:16', 34, 'Réservés', 'agrob1e@wikispaces.com', 'imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor sit amet', '6818');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-02-19 15:57:25', 4, 'Maïly', 'slindsay1f@acquirethisname.com', 'in tempus sit amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis', '6907');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-03-11 17:34:42', 66, 'Pénélope', 'msolesbury1g@etsy.com', 'odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis tristique fusce congue', '964');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-08-24 07:00:13', 62, 'Adélie', 'jkernell1h@plala.or.jp', 'duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi', '066');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-05-14 10:59:33', 63, 'Måns', 'bwickie1i@cloudflare.com', 'cursus urna ut tellus nulla ut erat id mauris vulputate elementum nullam varius nulla facilisi cras', '57');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-05-03 09:37:45', 8, 'Nuó', 'htreanor1j@ibm.com', 'vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra', '8715');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-09-03 08:18:15', 25, 'Frédérique', 'anunesnabarro1k@spiegel.de', 'sem duis aliquam convallis nunc proin at turpis a pede posuere nonummy integer non velit donec diam neque vestibulum eget', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-09-17 15:58:40', 25, 'Maéna', 'klainge1l@addthis.com', 'vulputate elementum nullam varius nulla facilisi cras non velit nec nisi vulputate nonummy maecenas tincidunt lacus at velit', '88');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-10-16 03:31:52', 91, 'Dafnée', 'jenos1m@bloglovin.com', 'morbi vestibulum velit id pretium iaculis diam erat fermentum justo nec', '62744');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-06-27 00:12:42', 58, 'Gaëlle', 'jpudsall1n@aboutads.info', 'vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum', '93674');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-11-11 12:12:24', 8, 'Maëline', 'kainley1o@mapquest.com', 'nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum', '1');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-12-08 17:51:07', 84, 'Bérénice', 'bsterke1p@technorati.com', 'nunc rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat quam pede lobortis ligula', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-07-26 15:00:09', 100, 'Torbjörn', 'aharsum1q@buzzfeed.com', 'id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus', '804');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-10-14 06:21:33', 33, 'Anaïs', 'cvernalls1r@miitbeian.gov.cn', 'viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit amet', '66562');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-06-04 05:00:24', 54, 'Kù', 'agregoretti1s@sciencedaily.com', 'proin at turpis a pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate', '07083');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-02-25 14:01:30', 39, 'Nadège', 'mcashley1t@usgs.gov', 'fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat', '40');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-11-13 16:54:48', 57, 'Naëlle', 'astout1u@diigo.com', 'arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis orci eget', '72630');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-01-26 01:11:48', 26, 'Pélagie', 'jfort1v@google.co.uk', 'mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante vivamus tortor', '2177');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-02-21 03:46:21', 92, 'Véronique', 'rbrach1w@earthlink.net', 'adipiscing elit proin risus praesent lectus vestibulum quam sapien varius ut', '44921');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-11-16 02:40:23', 48, 'Mélodie', 'hsterricker1x@columbia.edu', 'eu massa donec dapibus duis at velit eu est congue', '370');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-07-20 09:37:51', 17, 'Loïc', 'bsapauton1y@discuz.net', 'convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet', '36252');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-11-24 10:04:09', 28, 'Léane', 'hwrassell1z@myspace.com', 'rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus', '8909');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-07-11 12:37:58', 74, 'Yóu', 'jbeadnell20@flickr.com', 'at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante', '07');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-08-21 09:11:39', 57, 'Mélina', 'mdavitt21@macromedia.com', 'quisque arcu libero rutrum ac lobortis vel dapibus at diam nam tristique tortor eu', '32');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-09-02 18:27:47', 87, 'Daphnée', 'wmustin22@hostgator.com', 'diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed', '87');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-07-01 19:47:41', 93, 'Marie-ève', 'glorentzen23@macromedia.com', 'aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-11-04 21:55:51', 71, 'Laïla', 'hchasemore24@skype.com', 'praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem', '71');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-03-29 01:23:30', 62, 'Maéna', 'lvenables25@quantcast.com', 'nulla pede ullamcorper augue a suscipit nulla elit ac nulla', '287');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-08-29 12:31:58', 93, 'Séverine', 'ncovell26@studiopress.com', 'varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices', '78');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-11-03 21:49:00', 64, 'Uò', 'qvlasin27@samsung.com', 'vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo', '777');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-05-16 17:03:33', 20, 'Cunégonde', 'mbrabham28@auda.org.au', 'in hac habitasse platea dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut', '6012');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-05-09 19:53:41', 31, 'Françoise', 'hcroal29@addtoany.com', 'odio cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices', '3226');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-02-06 16:50:36', 87, 'Méghane', 'mfurman2a@huffingtonpost.com', 'est donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis tristique fusce congue', '791');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-11-22 00:26:29', 61, 'Annotés', 'zfairbourne2b@ucla.edu', 'in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae', '420');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-27 18:13:00', 17, 'Hélèna', 'svalentinetti2c@bbb.org', 'mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue', '98617');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-10-19 20:53:27', 19, 'Marie-françoise', 'vingray2d@usatoday.com', 'metus aenean fermentum donec ut mauris eget massa tempor convallis', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-09-20 16:02:05', 34, 'Kallisté', 'nchildes2e@goo.gl', 'donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris', '9447');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-03-16 01:18:11', 58, 'Uò', 'mplaskett2f@google.ru', 'in blandit ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque', '5533');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-11-27 23:42:14', 99, 'Méline', 'arediers2g@weibo.com', 'semper est quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante ipsum primis', '02966');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-02-20 17:15:13', 55, 'Yú', 'alayborn2h@feedburner.com', 'nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum', '45026');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-10-08 22:13:39', 38, 'Méghane', 'kgrishagin2i@bloglines.com', 'ultrices mattis odio donec vitae nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit', '9');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-06-07 04:30:12', 20, 'Kuí', 'mwitton2j@squidoo.com', 'ipsum dolor sit amet consectetuer adipiscing elit proin risus praesent lectus vestibulum quam sapien varius ut blandit non', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-11-17 21:27:24', 80, 'Edmée', 'bcastellini2k@blinklist.com', 'arcu sed augue aliquam erat volutpat in congue etiam justo', '940');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-12-27 22:58:22', 68, 'Eléa', 'jshotton2l@geocities.jp', 'semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis', '34');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-01-24 04:47:17', 93, 'Magdalène', 'mtowns2m@pictureshack.us', 'eget tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat', '95');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-11-15 14:49:35', 2, 'Maëline', 'gdyzart2n@theglobeandmail.com', 'at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus', '3');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-12-10 19:50:15', 21, 'Amélie', 'cmapledorum2o@ft.com', 'nec dui luctus rutrum nulla tellus in sagittis dui vel nisl duis ac nibh fusce lacus purus aliquet', '5753');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-05-24 21:12:27', 6, 'Rachèle', 'btorrejon2p@shop-pro.jp', 'ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam', '829');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-06-10 22:21:19', 26, 'Noëlla', 'ccuncarr2q@hao123.com', 'eu massa donec dapibus duis at velit eu est congue elementum in hac habitasse platea dictumst', '762');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-12-05 07:40:56', 18, 'Maëline', 'etackle2r@flavors.me', 'leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet', '05');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-01-30 00:29:02', 5, 'Maëlyss', 'kflag2s@xrea.com', 'ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae mauris', '1');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-19 22:25:05', 92, 'Dorothée', 'bdaniellot2t@stumbleupon.com', 'a libero nam dui proin leo odio porttitor id consequat in', '54335');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-09 08:41:14', 46, 'Cinéma', 'gpacher2u@princeton.edu', 'pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim sit amet nunc viverra dapibus nulla', '9076');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-03-25 01:36:29', 16, 'Örjan', 'ztoby2v@unicef.org', 'iaculis diam erat fermentum justo nec condimentum neque sapien placerat ante', '738');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-10-21 03:04:13', 20, 'Léa', 'cskipworth2w@wunderground.com', 'sed tincidunt eu felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus', '895');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-01-14 03:21:27', 95, 'Simplifiés', 'gwybourne2x@sogou.com', 'sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus', '94');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-01-11 17:50:12', 14, 'Anaëlle', 'bmatteacci2y@nasa.gov', 'donec quis orci eget orci vehicula condimentum curabitur in libero ut massa volutpat convallis morbi odio odio', '8');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-09-16 06:38:33', 89, 'Desirée', 'madamovitch2z@rambler.ru', 'nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac', '88035');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-02-17 20:38:52', 30, 'Maëlla', 'tscala30@unicef.org', 'fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis integer', '276');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-09-06 11:09:35', 91, 'Angélique', 'collin31@clickbank.net', 'imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi sem', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-03-22 05:30:18', 82, 'Håkan', 'pschwandt32@shutterfly.com', 'faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum nullam varius nulla facilisi cras non', '221');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-12-15 02:52:59', 36, 'Björn', 'brounce33@flavors.me', 'dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum', '76439');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-02-16 20:32:57', 21, 'Ráo', 'rtampin34@de.vu', 'viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-01-11 01:14:11', 23, 'Renée', 'ejeves35@gravatar.com', 'nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo', '2');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-04-09 18:49:48', 15, 'Thérèsa', 'lgoodwyn36@sbwire.com', 'justo sollicitudin ut suscipit a feugiat et eros vestibulum ac', '935');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-10-19 22:22:59', 74, 'Garçon', 'raps37@php.net', 'elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-12-17 10:46:38', 23, 'Léana', 'gpickersgill38@booking.com', 'accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi', '85764');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-02-21 10:40:36', 72, 'Faîtes', 'achoppin39@artisteer.com', 'diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum', '0706');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-09-30 18:31:22', 21, 'Adélaïde', 'cpridding3a@123-reg.co.uk', 'tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat', '863');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-01-16 21:23:28', 93, 'Angèle', 'kruskin3b@amazon.co.uk', 'quis tortor id nulla ultrices aliquet maecenas leo odio condimentum id luctus nec molestie sed justo', '5961');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-03-21 18:00:53', 15, 'Lyséa', 'escaice3c@printfriendly.com', 'justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas tristique est et tempus', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-07-03 20:03:19', 46, 'Rachèle', 'fbrager3d@so-net.ne.jp', 'at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio', '63327');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-11-29 11:47:03', 34, 'Alizée', 'gogglebie3e@jigsy.com', 'nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor', '1');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-12-05 14:16:09', 7, 'Naëlle', 'bwillstrop3f@blogspot.com', 'pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus in', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-06-03 03:24:04', 84, 'Åsa', 'ddorant3g@nasa.gov', 'integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-12-22 01:23:59', 4, 'Esbjörn', 'znisbet3h@nature.com', 'nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id', '685');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-05-13 16:32:02', 42, 'Méthode', 'lmailey3i@behance.net', 'volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante', '2727');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-03-10 10:43:29', 14, 'Gaétane', 'smatiasek3j@goo.gl', 'sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus', '9');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-09-04 21:18:28', 51, 'Yóu', 'tbeazey3k@home.pl', 'eget eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra', '594');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-07-23 22:54:28', 64, 'Lèi', 'nmuggeridge3l@com.com', 'fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor', '05');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-05-07 15:44:27', 9, 'Cléa', 'dhamprecht3m@meetup.com', 'mauris morbi non lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci pede venenatis non', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-11-09 02:47:45', 86, 'Mårten', 'gfenech3n@woothemes.com', 'sem praesent id massa id nisl venenatis lacinia aenean sit amet justo morbi ut odio cras mi pede malesuada in', '68');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-09-20 02:53:06', 10, 'Mélys', 'lcrinion3o@wikispaces.com', 'est donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis', '86');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-12-19 23:31:57', 98, 'Estée', 'rpatron3p@walmart.com', 'lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit', '6219');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-06-27 06:18:56', 94, 'Estée', 'yschorah3q@instagram.com', 'nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula', '49565');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-07-01 14:05:49', 70, 'Ráo', 'hsharpin3r@telegraph.co.uk', 'felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-03-27 16:21:09', 51, 'Daphnée', 'adacosta3s@vimeo.com', 'odio porttitor id consequat in consequat ut nulla sed accumsan felis ut at dolor quis odio', '9');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-01-12 01:24:43', 100, 'Garçon', 'rnoades3t@census.gov', 'venenatis lacinia aenean sit amet justo morbi ut odio cras mi pede malesuada in', '335');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-04-05 14:12:16', 44, 'Loïca', 'rbartalini3u@imdb.com', 'morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus', '70');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-07-29 07:39:01', 70, 'Mélia', 'cgilchrist3v@go.com', 'quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in', '21587');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-07-05 01:39:47', 99, 'Märta', 'dblanche3w@springer.com', 'vitae nisl aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum', '0045');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-05-28 05:22:56', 95, 'Östen', 'cmaxwell3x@state.tx.us', 'eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante vivamus', '02515');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-08-31 04:00:19', 60, 'Lài', 'sfearney3y@shinystat.com', 'phasellus in felis donec semper sapien a libero nam dui', '193');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-08-05 08:28:39', 81, 'Inès', 'elalley3z@army.mil', 'ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est', '16');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-08-25 03:20:57', 3, 'Wá', 'achue40@webs.com', 'consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent', '26350');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-01-23 00:20:09', 11, 'Maïly', 'jzanetello41@dyndns.org', 'aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante vivamus', '624');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-02-07 00:55:16', 37, 'Léane', 'gpleuman42@prweb.com', 'integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio', '20096');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-05-28 22:07:43', 9, 'Léone', 'ateggart43@nyu.edu', 'nullam porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam', '594');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-03-24 11:16:56', 69, 'Naéva', 'tmilius44@nature.com', 'sapien placerat ante nulla justo aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros suspendisse', '920');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-03-13 20:26:02', 43, 'Gwenaëlle', 'ngremain45@51.la', 'pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla', '8');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-08-13 12:03:57', 99, 'Clémence', 'gmoultrie46@gravatar.com', 'venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl', '183');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-04-26 23:45:46', 18, 'Gérald', 'edarton47@github.com', 'vitae ipsum aliquam non mauris morbi non lectus aliquam sit', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-10-21 22:38:18', 45, 'Cléopatre', 'abyneth48@vkontakte.ru', 'in faucibus orci luctus et ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse', '3');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-08-26 18:26:33', 43, 'Lucrèce', 'kbarden49@time.com', 'ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id', '1882');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-12-24 02:31:17', 95, 'Pò', 'edecourcy4a@wordpress.com', 'ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-01-17 23:23:16', 2, 'Célestine', 'fharrison4b@macromedia.com', 'fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat', '17609');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-12-02 00:26:04', 96, 'Pélagie', 'aellsom4c@nih.gov', 'viverra pede ac diam cras pellentesque volutpat dui maecenas tristique est et tempus', '81689');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-04-04 08:53:15', 42, 'Geneviève', 'materidge4d@berkeley.edu', 'cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor', '8');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-12-12 07:11:46', 7, 'Maëlla', 'mmeeron4e@mayoclinic.com', 'metus vitae ipsum aliquam non mauris morbi non lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci pede', '653');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-10-15 06:48:08', 81, 'Maéna', 'emoorcroft4f@state.tx.us', 'lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-06-10 22:29:42', 88, 'Maëlla', 'agehring4g@google.ca', 'non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim sit amet nunc viverra', '64862');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-07-05 02:45:10', 78, 'Cécilia', 'cjarrard4h@walmart.com', 'morbi ut odio cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum', '47238');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-03-17 10:56:46', 9, 'Bécassine', 'lcogle4i@slideshare.net', 'quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin', '1');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-09-06 23:16:33', 43, 'Amélie', 'kwaszkiewicz4j@google.ca', 'mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim sit amet nunc viverra', '74');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-10 11:36:09', 59, 'Cécile', 'mwoolham4k@va.gov', 'ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan odio', '27');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-09-14 21:54:45', 64, 'Réservés', 'dmash4l@soundcloud.com', 'a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor', '0524');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-03-11 15:54:20', 48, 'Loïc', 'gleathers4m@vk.com', 'morbi non quam nec dui luctus rutrum nulla tellus in sagittis dui', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-07-31 20:57:43', 15, 'Ophélie', 'tealam4n@sfgate.com', 'ligula sit amet eleifend pede libero quis orci nullam molestie nibh', '60762');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-02-16 10:16:20', 83, 'Lén', 'rquarrell4o@un.org', 'iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum', '458');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-03-31 11:42:19', 84, 'Gwenaëlle', 'oharteley4p@wordpress.org', 'leo rhoncus sed vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor', '522');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-08-13 12:19:07', 96, 'Stéphanie', 'cclappison4q@paypal.com', 'vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis', '15');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-05-27 15:41:32', 47, 'Pò', 'bpillington4r@nps.gov', 'pede venenatis non sodales sed tincidunt eu felis fusce posuere felis', '48819');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-11-15 16:35:02', 18, 'Marylène', 'kbaddeley4s@addthis.com', 'in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum', '67767');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-11-13 14:11:02', 94, 'Esbjörn', 'vclaesens4t@ucsd.edu', 'sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis', '215');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-10-02 09:15:53', 20, 'Maïlis', 'bcraft4u@fotki.com', 'nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in', '20399');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-12-20 22:43:25', 14, 'Andrée', 'bmcvey4v@over-blog.com', 'volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci', '5029');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-08-08 19:45:44', 30, 'Magdalène', 'pandreou4w@fastcompany.com', 'vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod', '201');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-10-29 18:24:30', 18, 'Lorène', 'ismitheram4x@nsw.gov.au', 'diam vitae quam suspendisse potenti nullam porttitor lacus at turpis donec posuere metus vitae ipsum aliquam', '02027');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-09-19 16:45:48', 25, 'Laurélie', 'wmohun4y@naver.com', 'iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-03-02 18:55:36', 95, 'Gaétane', 'zfewless4z@mit.edu', 'tempus vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac', '4283');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-01-13 03:07:56', 45, 'Kù', 'mdanielkiewicz50@google.ca', 'semper interdum mauris ullamcorper purus sit amet nulla quisque arcu libero rutrum ac lobortis vel', '5051');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-07-13 21:35:50', 74, 'Agnès', 'mlaverack51@hc360.com', 'vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec', '397');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-14 02:34:48', 73, 'Mylène', 'sfouracres52@nih.gov', 'est phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin eu', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-07 12:22:29', 1, 'Renée', 'ahumbert53@hc360.com', 'viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit amet nulla', '06');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-05-07 13:05:07', 8, 'Maëlann', 'ggretham54@prweb.com', 'montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque', '30377');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-10-27 02:15:01', 97, 'Maïwenn', 'jstuckow55@tinypic.com', 'montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque', '29');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-01-23 20:10:23', 33, 'Uò', 'dshannahan56@slideshare.net', 'porttitor pede justo eu massa donec dapibus duis at velit eu est congue elementum in', '88');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-03-15 07:14:35', 27, 'Méghane', 'csvanetti57@bloomberg.com', 'praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi', '1436');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-02-04 21:32:35', 81, 'Frédérique', 'bhinchshaw58@economist.com', 'faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-04-17 20:19:02', 61, 'Vérane', 'sornillos59@wikispaces.com', 'ut erat id mauris vulputate elementum nullam varius nulla facilisi cras', '465');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-02-03 03:42:22', 80, 'Léa', 'ykubek5a@soundcloud.com', 'sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel', '12');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-05-29 20:00:13', 19, 'Måns', 'nfoulger5b@nytimes.com', 'montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes', '689');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-04-18 13:39:58', 62, 'Mégane', 'ebutterfill5c@acquirethisname.com', 'semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam', '1918');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-05-31 18:02:43', 88, 'Méline', 'jyoull5d@ezinearticles.com', 'nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit', '84');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-10-07 15:11:26', 82, 'Léane', 'fkellard5e@seesaa.net', 'nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis', '11');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-11-03 08:55:41', 26, 'Sòng', 'vinsley5f@stumbleupon.com', 'imperdiet nullam orci pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus', '5474');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-01-13 15:45:47', 21, 'Uò', 'aseage5g@wikimedia.org', 'sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-29 06:30:22', 32, 'Aí', 'epirelli5h@pictureshack.us', 'pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim sit amet nunc viverra', '01');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-02-25 23:27:41', 41, 'Cunégonde', 'sswindin5i@webnode.com', 'rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna at', '9');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-02-11 06:49:03', 76, 'Naéva', 'pgalliver5j@wix.com', 'arcu adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus pellentesque eget nunc donec quis orci eget orci', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-07-27 20:37:47', 89, 'Salomé', 'mparadise5k@nifty.com', 'nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-10-14 13:40:50', 2, 'Rébecca', 'hbrann5l@stumbleupon.com', 'luctus rutrum nulla tellus in sagittis dui vel nisl duis ac nibh fusce lacus purus aliquet at feugiat non pretium', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-07-02 18:28:52', 98, 'Maëly', 'awickey5m@patch.com', 'quam nec dui luctus rutrum nulla tellus in sagittis dui vel nisl duis ac', '2363');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-09-18 20:41:58', 15, 'Irène', 'dpenfold5n@salon.com', 'cras pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna', '22');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-01-23 00:35:12', 39, 'Görel', 'vraden5o@jalbum.net', 'etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus', '1471');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-02-27 20:45:44', 79, 'Clémence', 'kmckimm5p@shareasale.com', 'sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget', '39819');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-01-27 17:39:06', 92, 'Mélissandre', 'eweaver5q@jalbum.net', 'in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec', '01');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-03-21 19:40:31', 51, 'Vénus', 'pmablestone5r@slashdot.org', 'lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien', '83');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-01-20 18:43:09', 3, 'Maëline', 'erudgerd5s@bravesites.com', 'tortor quis turpis sed ante vivamus tortor duis mattis egestas metus aenean fermentum donec ut mauris eget massa tempor convallis', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-10-18 22:26:54', 54, 'Méghane', 'jrenackowna5t@sohu.com', 'quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-02-07 16:26:05', 12, 'Pénélope', 'vgiamuzzo5u@live.com', 'ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis', '10');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-01-03 21:58:13', 12, 'Léane', 'mhanfrey5v@vistaprint.com', 'sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh', '0648');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-12-29 11:54:59', 25, 'Mégane', 'afaltin5w@histats.com', 'metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci', '08046');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-08-29 09:03:04', 66, 'Adélaïde', 'igowans5x@amazon.de', 'hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-10-18 05:30:32', 34, 'Garçon', 'zbudge5y@multiply.com', 'proin leo odio porttitor id consequat in consequat ut nulla sed accumsan', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-09-26 13:46:11', 14, 'Maëlle', 'cjermyn5z@issuu.com', 'id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien', '30452');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-28 07:59:04', 82, 'Erwéi', 'cguyonnet60@51.la', 'est risus auctor sed tristique in tempus sit amet sem fusce consequat nulla nisl', '58');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-05-06 06:50:24', 93, 'Adèle', 'bdickie61@dailymail.co.uk', 'molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-06-08 09:22:48', 21, 'Rachèle', 'amould62@booking.com', 'feugiat non pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse', '47494');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-01-12 22:47:56', 59, 'Thérèse', 'mcafferky63@irs.gov', 'pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse platea', '44726');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-08-08 20:15:22', 40, 'Célia', 'lfolonin64@uol.com.br', 'lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique in tempus', '9');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-05-16 12:21:36', 82, 'Adèle', 'rgreenall65@merriam-webster.com', 'amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor', '9669');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-01-01 00:46:44', 2, 'Desirée', 'aemmer66@google.it', 'eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante vivamus tortor duis mattis egestas', '53');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-01-01 02:03:57', 100, 'Marie-françoise', 'eadkin67@latimes.com', 'duis ac nibh fusce lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a odio', '2');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-04-06 14:06:34', 39, 'Kallisté', 'pfibbitts68@columbia.edu', 'eget massa tempor convallis nulla neque libero convallis eget eleifend luctus', '3');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-06-01 05:06:44', 25, 'Liè', 'eshord69@unc.edu', 'praesent blandit nam nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id', '3');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-07-21 10:42:47', 13, 'Yú', 'gsyversen6a@economist.com', 'pede venenatis non sodales sed tincidunt eu felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet', '6332');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-05 01:14:39', 31, 'Aloïs', 'rkehir6b@com.com', 'cursus urna ut tellus nulla ut erat id mauris vulputate elementum nullam varius nulla', '6286');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-02-07 19:31:17', 59, 'Méthode', 'tconfait6c@cdbaby.com', 'ac diam cras pellentesque volutpat dui maecenas tristique est et tempus', '28');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-03-24 04:04:01', 6, 'Thérèse', 'kslorach6d@rambler.ru', 'porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor', '6035');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-09-24 09:57:36', 33, 'Rachèle', 'dmiebes6e@uol.com.br', 'fermentum donec ut mauris eget massa tempor convallis nulla neque libero convallis eget eleifend luctus ultricies', '3119');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-06-11 00:45:27', 100, 'Örjan', 'asuscens6f@51.la', 'montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor', '742');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-12-06 15:19:21', 36, 'Loïs', 'estobbes6g@simplemachines.org', 'duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-05-10 18:23:34', 31, 'Wá', 'lbarff6h@tiny.cc', 'convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus', '66');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-10-24 19:14:41', 2, 'Märta', 'tscripture6i@nasa.gov', 'cras in purus eu magna vulputate luctus cum sociis natoque', '8');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-07-07 09:36:27', 44, 'Nadège', 'ndeye6j@dyndns.org', 'velit id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam', '45');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-12-10 11:55:18', 98, 'Miléna', 'mcuzen6k@sitemeter.com', 'duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-03-09 03:03:35', 67, 'Hélèna', 'lhalward6l@princeton.edu', 'pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim lorem', '8948');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-10-20 19:20:45', 6, 'Clémentine', 'sstammers6m@craigslist.org', 'vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis', '60016');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-02-26 15:00:18', 64, 'Françoise', 'kcarlick6n@spotify.com', 'lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget', '76773');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-04-26 23:46:41', 29, 'Léa', 'carens6o@huffingtonpost.com', 'ut massa volutpat convallis morbi odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-29 17:02:08', 92, 'Yè', 'ehaydn6p@mapquest.com', 'ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero non mattis', '231');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-03-23 21:46:55', 78, 'Mélissandre', 'ksweetland6q@hao123.com', 'turpis a pede posuere nonummy integer non velit donec diam neque vestibulum', '583');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-07-13 21:54:53', 3, 'Märta', 'agidden6r@prlog.org', 'mauris ullamcorper purus sit amet nulla quisque arcu libero rutrum ac lobortis vel dapibus at diam', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-09-07 04:56:22', 30, 'Maëlann', 'tlamperti6s@a8.net', 'lectus in est risus auctor sed tristique in tempus sit', '61');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-05-06 03:14:17', 36, 'André', 'ggarvill6t@google.cn', 'eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-06-30 10:52:42', 35, 'Félicie', 'mmartinson6u@archive.org', 'nulla pede ullamcorper augue a suscipit nulla elit ac nulla sed vel enim', '4996');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-04-07 18:41:15', 22, 'Mahélie', 'dlafferty6v@npr.org', 'vulputate nonummy maecenas tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat', '3');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-10 15:54:04', 98, 'Rachèle', 'hgentry6w@utexas.edu', 'interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis', '20321');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-13 12:20:08', 59, 'Ophélie', 'bwimbush6x@last.fm', 'nulla elit ac nulla sed vel enim sit amet nunc viverra', '43');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-07 08:21:03', 27, 'Athéna', 'dyerill6y@jimdo.com', 'egestas metus aenean fermentum donec ut mauris eget massa tempor convallis nulla neque libero convallis', '70274');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-06-13 16:17:36', 94, 'Mahélie', 'cbricksey6z@squarespace.com', 'vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer', '17');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-06-28 22:53:36', 35, 'Maëlann', 'kcooley70@hp.com', 'eu mi nulla ac enim in tempor turpis nec euismod', '054');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-10-16 16:58:22', 20, 'Hélène', 'egirardini71@netvibes.com', 'porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor sed tristique', '460');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-27 02:46:29', 35, 'Märta', 'acawthery72@alibaba.com', 'donec ut mauris eget massa tempor convallis nulla neque libero convallis eget eleifend', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-01-16 20:56:21', 77, 'Måns', 'rtrembley73@biglobe.ne.jp', 'orci eget orci vehicula condimentum curabitur in libero ut massa volutpat', '33');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-04-01 22:05:57', 5, 'Mà', 'tbrice74@de.vu', 'natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean', '3');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-05-21 19:53:27', 1, 'Alizée', 'lvearnals75@upenn.edu', 'sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin eu', '0534');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-01-01 16:45:34', 74, 'Loïs', 'gcalf76@ebay.com', 'ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-04-17 03:28:53', 21, 'Angèle', 'ssparshatt77@cpanel.net', 'lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti in eleifend quam a odio', '4633');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-06-30 00:50:46', 57, 'Uò', 'ccaiger78@booking.com', 'at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio', '0080');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-05-06 11:19:35', 88, 'Maïlis', 'nfonzo79@simplemachines.org', 'pede posuere nonummy integer non velit donec diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis', '1173');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-11-09 16:03:21', 82, 'Åsa', 'rcadwaladr7a@google.nl', 'massa donec dapibus duis at velit eu est congue elementum in hac habitasse platea dictumst morbi', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-02-19 10:55:41', 61, 'Mårten', 'odunkley7b@networksolutions.com', 'non mi integer ac neque duis bibendum morbi non quam nec dui luctus rutrum nulla tellus', '000');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-05-16 22:36:00', 56, 'Géraldine', 'mtaggerty7c@youtube.com', 'nulla ut erat id mauris vulputate elementum nullam varius nulla facilisi cras non', '610');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-06-16 21:50:06', 98, 'Cléa', 'ealbasiny7d@rakuten.co.jp', 'libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti cras in purus', '06');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-08-27 02:24:24', 97, 'Maëline', 'galliberton7e@kickstarter.com', 'vel accumsan tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis elementum ligula vehicula', '3134');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-04-30 10:28:28', 59, 'Mahélie', 'tletch7f@quantcast.com', 'blandit ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit proin interdum mauris', '336');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-05-28 09:43:35', 35, 'Uò', 'rsimmill7g@cnn.com', 'nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum neque aenean auctor', '8');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-05-29 23:35:02', 88, 'Mélys', 'ccollister7h@bbc.co.uk', 'sed nisl nunc rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat quam pede lobortis ligula sit', '78350');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-07-04 00:39:55', 18, 'Eloïse', 'dalexsandrowicz7i@tripadvisor.com', 'pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat', '9');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-08-25 09:06:10', 97, 'Jú', 'pbuckenham7j@google.pl', 'pede libero quis orci nullam molestie nibh in lectus pellentesque at nulla suspendisse potenti', '1658');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-07-11 03:02:06', 89, 'Andréanne', 'hjencken7k@google.com.au', 'massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida nisi at', '64669');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-10-06 04:19:59', 76, 'Örjan', 'rdollar7l@zimbio.com', 'ac diam cras pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus sapien', '7370');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-19 17:39:55', 3, 'Irène', 'mmaclaine7m@freewebs.com', 'suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque', '5259');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-11-11 22:00:22', 88, 'Pò', 'sheald7n@slashdot.org', 'erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam', '31');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-11-03 15:47:37', 78, 'Erwéi', 'arickcord7o@go.com', 'convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis', '19');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-09-29 15:37:52', 69, 'Lyséa', 'dmcilvenna7p@booking.com', 'sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi', '9554');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-01-31 10:57:21', 73, 'Görel', 'chaslewood7q@bandcamp.com', 'consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit', '407');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-02-12 00:42:00', 77, 'Mylène', 'rshobrook7r@prlog.org', 'metus aenean fermentum donec ut mauris eget massa tempor convallis nulla neque', '90100');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-12-29 05:26:02', 38, 'Liè', 'alearned7s@drupal.org', 'pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus', '47321');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-12-07 03:14:58', 15, 'Faîtes', 'mgude7t@shareasale.com', 'nisl aenean lectus pellentesque eget nunc donec quis orci eget orci vehicula condimentum curabitur in', '485');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-08-01 18:09:05', 87, 'Marlène', 'chaughton7u@vinaora.com', 'sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-12 22:09:01', 45, 'Loïca', 'ewarhurst7v@weibo.com', 'tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus', '888');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-06-09 05:37:42', 17, 'Cléa', 'bklemps7w@sogou.com', 'suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id ornare', '13');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-03-10 14:06:24', 2, 'Görel', 'bglasgow7x@altervista.org', 'sed tincidunt eu felis fusce posuere felis sed lacus morbi sem mauris laoreet', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-03-18 18:35:21', 38, 'Adélie', 'lfeldmesser7y@de.vu', 'magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-09-18 04:08:34', 12, 'Gisèle', 'lhassin7z@psu.edu', 'dui vel sem sed sagittis nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero', '181');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-12-03 04:22:01', 94, 'Naëlle', 'dcrampsey80@dailymail.co.uk', 'elit ac nulla sed vel enim sit amet nunc viverra dapibus nulla', '48743');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-06-28 13:08:44', 44, 'Clémence', 'ltinto81@mapquest.com', 'fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis', '087');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-05-05 03:07:19', 87, 'Simplifiés', 'rforsbey82@comsenz.com', 'maecenas rhoncus aliquam lacus morbi quis tortor id nulla ultrices aliquet maecenas leo odio condimentum id luctus nec', '702');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-09-30 20:08:24', 49, 'Amélie', 'scrosio83@php.net', 'luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum', '18311');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-07-21 21:33:22', 26, 'Maïly', 'gagiolfinger84@admin.ch', 'enim blandit mi in porttitor pede justo eu massa donec dapibus', '1314');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-12-02 07:20:46', 41, 'Cécilia', 'ecurr85@xrea.com', 'elementum ligula vehicula consequat morbi a ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus', '6407');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-06-25 07:47:52', 5, 'Dorothée', 'dcheco86@hexun.com', 'non pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse platea dictumst maecenas ut', '70');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-17 11:59:53', 89, 'Clémence', 'heveril87@wp.com', 'odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus sit', '3710');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-06-17 17:35:14', 34, 'Amélie', 'sbossingham88@bravesites.com', 'vitae ipsum aliquam non mauris morbi non lectus aliquam sit', '0569');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-02-06 21:41:05', 28, 'Almérinda', 'mparrish89@stumbleupon.com', 'velit id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis', '1');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-04-08 14:03:06', 70, 'Cécilia', 'eprestige8a@4shared.com', 'nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in faucibus', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-05-28 09:33:11', 1, 'Thérèsa', 'gsorley8b@irs.gov', 'curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-11-02 20:49:08', 80, 'Cléopatre', 'nault8c@sciencedaily.com', 'dictumst maecenas ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida', '45630');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-06-07 09:36:50', 16, 'Miléna', 'nkobierzycki8d@com.com', 'cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices', '3036');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-03-16 19:43:03', 71, 'Maëly', 'bpedreschi8e@chron.com', 'dis parturient montes nascetur ridiculus mus etiam vel augue vestibulum rutrum rutrum', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-08-14 09:51:32', 23, 'Yénora', 'ghandyside8f@spiegel.de', 'adipiscing lorem vitae mattis nibh ligula nec sem duis aliquam convallis nunc proin at turpis a pede posuere nonummy', '93');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-06-29 11:49:21', 40, 'Renée', 'bsemeradova8g@barnesandnoble.com', 'quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh in', '000');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-06-15 23:26:24', 36, 'Josée', 'ltaverner8h@google.cn', 'justo in hac habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate', '488');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-03-14 18:01:01', 97, 'Edmée', 'ecalabry8i@va.gov', 'at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat quisque', '09339');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-03-24 16:15:38', 43, 'Maïté', 'amillimoe8j@rediff.com', 'mollis molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue', '461');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-01-14 13:39:29', 39, 'Anaël', 'bflute8k@mac.com', 'curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit amet', '363');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-09-25 21:34:08', 10, 'Mégane', 'lmaddams8l@nba.com', 'tempus vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac', '951');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-07-12 15:50:20', 90, 'Laurène', 'ksondon8m@jigsy.com', 'vitae nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla', '040');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-11-25 21:16:11', 56, 'Aurélie', 'mwhettleton8n@wunderground.com', 'nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin', '71');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-10 16:36:47', 52, 'Faîtes', 'pchadburn8o@wikimedia.org', 'duis aliquam convallis nunc proin at turpis a pede posuere nonummy integer non velit donec', '32');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-26 04:55:41', 12, 'Maïwenn', 'scurrin8p@usa.gov', 'a odio in hac habitasse platea dictumst maecenas ut massa', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-13 09:35:53', 5, 'Danièle', 'drumbelow8q@nymag.com', 'velit vivamus vel nulla eget eros elementum pellentesque quisque porta', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-05-02 09:08:05', 62, 'Maïwenn', 'cmcloughlin8r@dyndns.org', 'sapien arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse', '472');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-12-22 04:10:55', 80, 'Clémence', 'cbramstom8s@cocolog-nifty.com', 'sed vestibulum sit amet cursus id turpis integer aliquet massa id lobortis convallis tortor risus dapibus augue', '77468');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-09-09 13:23:12', 98, 'Magdalène', 'fwharmby8t@amazonaws.com', 'morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel', '2669');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-01-07 07:30:27', 3, 'Maïlis', 'csempill8u@tripadvisor.com', 'semper sapien a libero nam dui proin leo odio porttitor id', '554');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-02-04 06:59:58', 52, 'Angélique', 'pyorston8v@uol.com.br', 'semper sapien a libero nam dui proin leo odio porttitor id consequat in consequat', '965');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-11-30 13:51:12', 50, 'Loïca', 'efirmager8w@blogger.com', 'interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis at velit eu est congue', '10086');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-04-06 05:09:16', 60, 'Camélia', 'tquinsee8x@arizona.edu', 'ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae mauris viverra diam vitae', '296');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-12-07 21:17:26', 90, 'Vénus', 'gmacparlan8y@webnode.com', 'eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante vivamus tortor', '8959');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-21 03:56:10', 76, 'Amélie', 'dboston8z@mit.edu', 'dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus', '55687');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-03-09 19:18:40', 37, 'Noëlla', 'pdoig90@surveymonkey.com', 'imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor sit', '84');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-04-05 19:56:30', 80, 'Méthode', 'lbreddy91@pen.io', 'amet consectetuer adipiscing elit proin risus praesent lectus vestibulum quam sapien varius ut blandit', '8071');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-08-07 19:35:00', 86, 'Marie-josée', 'jstitson92@pcworld.com', 'tincidunt lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat', '3');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-05-01 08:37:39', 86, 'Séréna', 'rhaggish93@amazon.com', 'tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in est risus auctor', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-05-09 06:13:37', 88, 'Noémie', 'cgarbutt94@barnesandnoble.com', 'at nibh in hac habitasse platea dictumst aliquam augue quam sollicitudin vitae', '865');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-19 20:02:19', 8, 'Clémence', 'htyson95@edublogs.org', 'vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla', '16030');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-12-23 15:51:47', 55, 'Solène', 'tkehri96@google.cn', 'auctor sed tristique in tempus sit amet sem fusce consequat', '5807');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-02-23 17:38:29', 86, 'Alizée', 'akears97@smugmug.com', 'congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui proin', '421');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-04-12 07:04:42', 60, 'Bérénice', 'nbuchan98@thetimes.co.uk', 'nisl venenatis lacinia aenean sit amet justo morbi ut odio cras mi', '78');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-09-27 18:53:55', 43, 'Yénora', 'farro99@odnoklassniki.ru', 'non pretium quis lectus suspendisse potenti in eleifend quam a odio in hac habitasse', '661');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-02-03 04:53:03', 76, 'Vérane', 'rfreckelton9a@yandex.ru', 'elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-03-09 07:51:57', 24, 'Félicie', 'htaverner9b@desdev.cn', 'sapien quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh', '83');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-05-10 17:17:34', 53, 'Mélissandre', 'hlejeune9c@artisteer.com', 'ullamcorper purus sit amet nulla quisque arcu libero rutrum ac lobortis vel dapibus at diam nam tristique', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-01-20 11:10:54', 32, 'Lèi', 'lgamlyn9d@ow.ly', 'eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum', '8');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-05-01 20:18:16', 26, 'Loïs', 'bfader9e@cdc.gov', 'lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in', '68524');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-07-24 22:49:28', 82, 'Garçon', 'cbenyon9f@usda.gov', 'donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin mi sit amet lobortis', '2564');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-27 16:54:27', 92, 'Zoé', 'ccroy9g@nhs.uk', 'semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh in', '1124');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-09-16 10:00:46', 51, 'Marylène', 'vsellman9h@blogspot.com', 'odio odio elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus', '3');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-12-19 15:06:24', 56, 'Styrbjörn', 'tlacroce9i@ameblo.jp', 'praesent lectus vestibulum quam sapien varius ut blandit non interdum in ante vestibulum ante ipsum', '61');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-08-11 02:55:36', 46, 'Lài', 'cyezafovich9j@google.ru', 'venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien arcu', '3219');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-27 01:57:02', 47, 'Eloïse', 'ddandy9k@arizona.edu', 'eget nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut massa', '131');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-01-19 02:00:01', 60, 'Bérangère', 'agrishkov9l@sohu.com', 'blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere', '1');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-01-17 00:34:02', 13, 'Gwenaëlle', 'ffeeley9m@google.ca', 'integer ac neque duis bibendum morbi non quam nec dui', '02452');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-07-13 05:23:08', 66, 'Judicaël', 'eluffman9n@google.de', 'ipsum integer a nibh in quis justo maecenas rhoncus aliquam lacus morbi quis tortor', '664');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-01-28 02:38:56', 23, 'Angélique', 'clintott9o@example.com', 'in sapien iaculis congue vivamus metus arcu adipiscing molestie hendrerit', '847');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-04-07 23:59:06', 28, 'Judicaël', 'rpoat9p@yale.edu', 'tempus vel pede morbi porttitor lorem id ligula suspendisse ornare', '352');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-03-06 22:57:07', 10, 'Sélène', 'sbracci9q@hubpages.com', 'ipsum praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat praesent blandit nam nulla integer', '766');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-09-25 19:43:03', 36, 'Méline', 'btatters9r@youku.com', 'ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae donec', '15674');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-08-31 14:06:43', 43, 'Aloïs', 'ltuson9s@sakura.ne.jp', 'eros elementum pellentesque quisque porta volutpat erat quisque erat eros viverra eget congue eget semper rutrum', '84898');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-09-18 21:57:34', 10, 'Wá', 'brubega9t@hubpages.com', 'phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus', '0119');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-02-28 03:19:44', 82, 'Gisèle', 'lbayldon9u@sitemeter.com', 'curabitur at ipsum ac tellus semper interdum mauris ullamcorper purus sit amet nulla quisque arcu libero rutrum ac', '59156');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-01-25 04:24:35', 100, 'Anaëlle', 'nbonnet9v@networkadvertising.org', 'nulla integer pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem', '14646');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-07-01 18:57:32', 33, 'Adèle', 'vklimochkin9w@ameblo.jp', 'eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante', '93');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-08-21 11:47:13', 5, 'Maëlys', 'fperigeaux9x@ustream.tv', 'faucibus cursus urna ut tellus nulla ut erat id mauris', '1');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-04-12 07:46:13', 14, 'Adélie', 'hludgate9y@slideshare.net', 'sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus', '84514');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-27 09:08:35', 48, 'Åke', 'lwyse9z@yahoo.co.jp', 'nulla justo aliquam quis turpis eget elit sodales scelerisque mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante', '3970');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-02-24 08:47:09', 7, 'Maéna', 'slapwooda0@t-online.de', 'venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus duis', '31207');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-10-29 17:08:16', 42, 'Géraldine', 'ivaldesa1@clickbank.net', 'turpis sed ante vivamus tortor duis mattis egestas metus aenean fermentum donec ut mauris eget', '9312');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-12-27 23:06:34', 40, 'Adèle', 'anigha2@tinyurl.com', 'platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat', '363');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-03-01 01:08:43', 80, 'Magdalène', 'lmorysona3@bigcartel.com', 'praesent blandit lacinia erat vestibulum sed magna at nunc commodo placerat', '115');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-10-30 10:12:16', 58, 'Mélia', 'rgoronia4@de.vu', 'non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-11-23 07:34:32', 59, 'Océane', 'fpurya5@princeton.edu', 'orci luctus et ultrices posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat', '0260');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-10-20 21:37:17', 67, 'Lauréna', 'dmarrilla6@accuweather.com', 'ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae duis faucibus accumsan odio curabitur convallis', '07461');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-10-15 07:59:45', 96, 'Lài', 'mlinskilla7@nps.gov', 'neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia', '389');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-08-07 03:02:24', 33, 'Maï', 'jferraresea8@pictureshack.us', 'pellentesque at nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis parturient', '2');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-08-06 13:23:27', 75, 'Véronique', 'tmclachlana9@homestead.com', 'in quis justo maecenas rhoncus aliquam lacus morbi quis tortor id nulla', '4581');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-09-06 05:04:39', 55, 'Gösta', 'tkeeleraa@indiegogo.com', 'tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque duis bibendum', '2');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-04-07 18:26:37', 60, 'Maïwenn', 'lmelledyab@goodreads.com', 'quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam', '44');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-11-29 22:29:39', 88, 'Salomé', 'obardwellac@wunderground.com', 'donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum sit amet', '9316');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-02-14 22:04:30', 37, 'Judicaël', 'aheartad@sohu.com', 'pede justo lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat', '4306');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-08-12 23:50:52', 3, 'Yáo', 'aajamae@umich.edu', 'curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi vel', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-10-31 13:31:35', 73, 'Léonore', 'lmeashamaf@over-blog.com', 'donec vitae nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper augue a', '031');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-12-07 20:29:00', 77, 'Gaïa', 'gextenceag@webnode.com', 'lacus purus aliquet at feugiat non pretium quis lectus suspendisse potenti', '8978');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-17 01:25:25', 91, 'Eléonore', 'lcobainah@statcounter.com', 'lorem ipsum dolor sit amet consectetuer adipiscing elit proin risus', '00552');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-25 17:12:55', 78, 'Esbjörn', 'ifaringtonai@nbcnews.com', 'imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor sit amet consectetuer adipiscing elit', '54498');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-04-09 01:18:33', 66, 'Pål', 'vhupkaaj@qq.com', 'a libero nam dui proin leo odio porttitor id consequat', '27906');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-09-08 06:47:29', 79, 'Maï', 'agiottiniak@cmu.edu', 'habitasse platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id mauris vulputate elementum nullam varius nulla', '31349');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-08-17 12:36:22', 86, 'Dà', 'jamdohral@ebay.com', 'ultricies eu nibh quisque id justo sit amet sapien dignissim', '66');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-09-19 20:20:22', 52, 'Miléna', 'mcapitanoam@thetimes.co.uk', 'ut blandit non interdum in ante vestibulum ante ipsum primis in faucibus orci luctus et ultrices', '701');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-08-11 13:13:37', 20, 'Marie-hélène', 'hmussolinian@gmpg.org', 'vel enim sit amet nunc viverra dapibus nulla suscipit ligula in lacus curabitur at ipsum ac tellus', '76');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-07-30 19:17:48', 40, 'Stévina', 'prenfieldao@digg.com', 'in quam fringilla rhoncus mauris enim leo rhoncus sed vestibulum', '55');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-03 08:19:15', 67, 'Aí', 'cvoglap@unc.edu', 'phasellus sit amet erat nulla tempus vivamus in felis eu sapien cursus vestibulum proin', '729');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-03-22 07:13:36', 13, 'Pélagie', 'mmacconnechieaq@sohu.com', 'odio donec vitae nisi nam ultrices libero non mattis pulvinar nulla pede ullamcorper', '24');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-06-17 06:17:36', 76, 'Gisèle', 'ikitchenar@123-reg.co.uk', 'eget rutrum at lorem integer tincidunt ante vel ipsum praesent blandit lacinia erat vestibulum sed magna', '36674');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-07-17 12:54:32', 72, 'Gérald', 'schristofidesas@ehow.com', 'accumsan felis ut at dolor quis odio consequat varius integer ac leo pellentesque ultrices mattis odio', '8904');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-01-17 03:37:37', 93, 'Björn', 'cbaldrickat@berkeley.edu', 'platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat', '87518');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-08-18 19:08:02', 80, 'Marie-josée', 'sdymickau@whitehouse.gov', 'ipsum ac tellus semper interdum mauris ullamcorper purus sit amet nulla quisque arcu libero rutrum ac', '6190');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-09-05 18:16:55', 28, 'Aurélie', 'gfitzsymonsav@ifeng.com', 'habitasse platea dictumst aliquam augue quam sollicitudin vitae consectetuer eget rutrum at lorem integer tincidunt ante vel ipsum praesent', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-08-01 16:30:49', 100, 'Séverine', 'rcumberlandaw@godaddy.com', 'ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue', '51091');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-10-30 20:21:42', 86, 'Märta', 'scollumbineax@about.me', 'quis odio consequat varius integer ac leo pellentesque ultrices mattis odio donec vitae nisi nam ultrices libero', '9857');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-08-25 12:17:12', 73, 'Börje', 'tburnsallay@wsj.com', 'neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis', '18');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-11-15 13:24:29', 70, 'Annotée', 'hphillpottsaz@free.fr', 'et magnis dis parturient montes nascetur ridiculus mus vivamus vestibulum sagittis sapien cum sociis natoque penatibus et magnis dis parturient', '161');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-03-27 17:47:27', 78, 'Lén', 'mbigmoreb0@time.com', 'at nunc commodo placerat praesent blandit nam nulla integer pede justo lacinia eget', '86292');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-03-27 18:05:06', 67, 'Aurélie', 'nprysb1@china.com.cn', 'posuere cubilia curae donec pharetra magna vestibulum aliquet ultrices erat tortor sollicitudin', '39299');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-02-09 11:49:31', 55, 'Aí', 'aspeereb2@typepad.com', 'non lectus aliquam sit amet diam in magna bibendum imperdiet nullam orci pede venenatis non', '63670');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-03-08 06:04:49', 50, 'Régine', 'dtuveyb3@tamu.edu', 'risus dapibus augue vel accumsan tellus nisi eu orci mauris lacinia sapien quis libero nullam sit amet turpis', '302');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-05-30 15:12:19', 83, 'Görel', 'cchiplenb4@flavors.me', 'amet consectetuer adipiscing elit proin interdum mauris non ligula pellentesque ultrices', '1');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-09-25 06:31:11', 4, 'Frédérique', 'jsandercockb5@reference.com', 'cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis dis', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-08 05:32:41', 97, 'Magdalène', 'mronaghanb6@telegraph.co.uk', 'aliquet ultrices erat tortor sollicitudin mi sit amet lobortis sapien sapien non mi integer ac neque duis bibendum morbi', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-06-04 12:03:13', 82, 'Maëline', 'cmattiussib7@naver.com', 'diam erat fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis', '351');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-03-14 01:19:01', 92, 'Göran', 'ndiggensb8@addthis.com', 'donec odio justo sollicitudin ut suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis', '621');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-05-05 19:40:25', 35, 'Magdalène', 'revisonb9@stumbleupon.com', 'luctus rutrum nulla tellus in sagittis dui vel nisl duis ac nibh fusce', '8');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-09-24 05:38:17', 93, 'Frédérique', 'phabertba@home.pl', 'nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut volutpat sapien', '806');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-03-29 04:31:43', 21, 'Marie-josée', 'ptwydellbb@myspace.com', 'elementum eu interdum eu tincidunt in leo maecenas pulvinar lobortis est phasellus', '49');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-28 10:23:51', 26, 'Yè', 'fhalladaybc@newsvine.com', 'in blandit ultrices enim lorem ipsum dolor sit amet consectetuer', '8');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-11-19 09:31:00', 51, 'Geneviève', 'lmathewsonbd@last.fm', 'in faucibus orci luctus et ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse potenti', '8258');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-06-15 19:33:52', 31, 'Mélodie', 'dstruanbe@sciencedirect.com', 'libero non mattis pulvinar nulla pede ullamcorper augue a suscipit nulla elit ac', '06');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-11-30 13:34:22', 62, 'Solène', 'fhaydneybf@mysql.com', 'nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo', '52489');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-02-26 22:28:33', 88, 'Camélia', 'dlarderotbg@qq.com', 'magna ac consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci', '90499');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-02-18 06:59:10', 58, 'Clélia', 'dbraunebh@ftc.gov', 'sem sed sagittis nam congue risus semper porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis', '0481');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-16 06:22:34', 68, 'Marylène', 'mdoreybi@bloglovin.com', 'volutpat in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus cursus', '198');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-03-30 22:11:02', 52, 'Crééz', 'uknightbj@theglobeandmail.com', 'quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien', '0680');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-09-29 14:32:50', 42, 'Angélique', 'mbottrellbk@nyu.edu', 'eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in', '575');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-01-08 04:36:06', 48, 'Danièle', 'ssellorbl@elpais.com', 'aliquet at feugiat non pretium quis lectus suspendisse potenti in', '85079');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-25 22:22:37', 11, 'Yè', 'gduffynbm@360.cn', 'ullamcorper augue a suscipit nulla elit ac nulla sed vel enim sit amet nunc', '18');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-03-10 10:43:35', 96, 'Eléonore', 'dvanderveldebn@timesonline.co.uk', 'lacinia eget tincidunt eget tempus vel pede morbi porttitor lorem id ligula suspendisse ornare consequat lectus in', '56316');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-05-02 11:37:40', 41, 'Fèi', 'restcotbo@latimes.com', 'nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in congue etiam justo etiam pretium iaculis justo in hac', '3');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-07-27 05:41:48', 28, 'Léonore', 'sulrikbp@boston.com', 'adipiscing molestie hendrerit at vulputate vitae nisl aenean lectus pellentesque', '4816');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-08-20 16:04:08', 92, 'Hélèna', 'rmellodybq@tripadvisor.com', 'posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam', '72');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-06-23 23:50:06', 82, 'Hélène', 'fjeffcockbr@google.pl', 'eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien dignissim vestibulum vestibulum ante ipsum primis in', '95257');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-07-26 04:16:04', 85, 'Cécilia', 'fsimionatobs@goodreads.com', 'orci luctus et ultrices posuere cubilia curae mauris viverra diam', '9');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-10-31 19:29:09', 32, 'Örjan', 'efeatherstonhaughbt@google.fr', 'cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus mus etiam vel augue', '1');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-05-08 13:43:30', 45, 'Anaé', 'amarioneaubu@oaic.gov.au', 'et eros vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna pretium nisl ut', '368');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-06-02 22:29:28', 1, 'Clélia', 'lfrangobv@skyrock.com', 'eget eros elementum pellentesque quisque porta volutpat erat quisque erat', '5875');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-06-21 07:05:57', 33, 'Gösta', 'lhenighanbw@google.cn', 'nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa', '95343');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-03 04:26:26', 15, 'Aurélie', 'anuschkebx@scientificamerican.com', 'id luctus nec molestie sed justo pellentesque viverra pede ac diam cras pellentesque volutpat dui maecenas', '0');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-01-23 21:23:48', 30, 'Séverine', 'vcrimesby@washington.edu', 'nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-02-16 02:53:42', 16, 'Andréa', 'tjanovskybz@miitbeian.gov.cn', 'eget massa tempor convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque id justo', '6878');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-07-15 09:41:00', 97, 'Maëly', 'spabelc0@rediff.com', 'luctus tincidunt nulla mollis molestie lorem quisque ut erat curabitur gravida nisi at', '2');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-11-29 22:50:29', 48, 'Geneviève', 'elentonc1@artisteer.com', 'cubilia curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi volutpat eleifend', '85');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-10-14 08:28:18', 99, 'Intéressant', 'kdriolic2@microsoft.com', 'augue vestibulum rutrum rutrum neque aenean auctor gravida sem praesent', '9');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-07-04 13:54:53', 45, 'Mahélie', 'pbinderc3@unesco.org', 'cursus id turpis integer aliquet massa id lobortis convallis tortor risus dapibus augue vel accumsan tellus nisi eu orci', '1537');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-04-05 21:47:21', 10, 'Marie-thérèse', 'lsandarsc4@scribd.com', 'diam neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci', '84');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-12-17 07:54:21', 8, 'Séverine', 'rbarberc5@cisco.com', 'rhoncus sed vestibulum sit amet cursus id turpis integer aliquet', '967');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-11-09 20:12:15', 13, 'Célia', 'dcrakec6@dailymail.co.uk', 'quam sapien varius ut blandit non interdum in ante vestibulum ante ipsum primis', '8159');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-04-03 08:12:11', 37, 'Crééz', 'awynessc7@posterous.com', 'pede ac diam cras pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna ac consequat metus', '61');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-01-19 22:04:07', 82, 'Anaëlle', 'jortellsc8@friendfeed.com', 'dapibus duis at velit eu est congue elementum in hac habitasse platea dictumst morbi vestibulum velit id pretium iaculis', '12212');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-07-22 06:34:59', 31, 'Ruò', 'arantoulc9@e-recht24.de', 'ut massa quis augue luctus tincidunt nulla mollis molestie lorem quisque ut erat', '2');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-08-26 20:04:17', 83, 'Pål', 'dpearnca@spotify.com', 'eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui', '498');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-10-14 17:51:50', 64, 'Athéna', 'twarehamcb@princeton.edu', 'urna pretium nisl ut volutpat sapien arcu sed augue aliquam erat', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-03-12 18:17:44', 5, 'Mélia', 'bhaggathcc@diigo.com', 'volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus mauris enim leo rhoncus', '741');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-06-07 13:03:02', 14, 'Véronique', 'gjakoviljeviccd@macromedia.com', 'suscipit a feugiat et eros vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet', '7735');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-11-30 09:45:15', 73, 'Maïté', 'dnuttce@so-net.ne.jp', 'condimentum curabitur in libero ut massa volutpat convallis morbi odio odio elementum eu interdum', '90');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-04-12 15:31:38', 53, 'Maëlann', 'dgewercf@devhub.com', 'ac diam cras pellentesque volutpat dui maecenas tristique est et tempus', '94');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-04-16 21:24:03', 46, 'Adélaïde', 'dfarnallcg@rakuten.co.jp', 'neque vestibulum eget vulputate ut ultrices vel augue vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere', '71450');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-02-06 12:27:13', 13, 'Lyséa', 'mrahlofch@a8.net', 'quam sapien varius ut blandit non interdum in ante vestibulum ante ipsum', '992');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-01-09 20:07:32', 23, 'Mélanie', 'fmartineauci@hugedomains.com', 'molestie lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst aliquam augue', '7960');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-03-28 05:41:58', 2, 'Léa', 'bbroderickcj@list-manage.com', 'mauris sit amet eros suspendisse accumsan tortor quis turpis sed ante vivamus tortor duis mattis egestas metus aenean fermentum donec', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-02-05 19:17:24', 78, 'Médiamass', 'sbalogunck@about.com', 'odio odio elementum eu interdum eu tincidunt in leo maecenas', '476');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-12-28 02:05:44', 90, 'Esbjörn', 'hforseycl@studiopress.com', 'felis fusce posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet', '827');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-05-05 01:54:28', 57, 'Aurélie', 'lfairlawcm@github.com', 'in congue etiam justo etiam pretium iaculis justo in hac habitasse platea dictumst etiam faucibus', '870');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-12-03 18:33:00', 29, 'Andrée', 'ehousemancn@4shared.com', 'orci luctus et ultrices posuere cubilia curae mauris viverra diam vitae quam suspendisse potenti nullam porttitor lacus at turpis donec', '2857');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-09-13 16:24:27', 56, 'Laïla', 'tthomasonco@hp.com', 'lacus at velit vivamus vel nulla eget eros elementum pellentesque quisque porta volutpat erat', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-04-19 08:21:48', 94, 'Maëlyss', 'gpittsoncp@chicagotribune.com', 'eu massa donec dapibus duis at velit eu est congue elementum in', '497');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-03-22 21:34:04', 70, 'Geneviève', 'nridgedellcq@prlog.org', 'velit id pretium iaculis diam erat fermentum justo nec condimentum neque', '306');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-11-30 21:54:05', 19, 'Léana', 'gchildscr@admin.ch', 'ornare consequat lectus in est risus auctor sed tristique in', '77469');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-01-20 06:53:02', 54, 'Océanne', 'rhumphriscs@unblog.fr', 'id turpis integer aliquet massa id lobortis convallis tortor risus', '140');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-11-16 16:10:01', 80, 'Nuó', 'cnicholsonct@studiopress.com', 'quis lectus suspendisse potenti in eleifend quam a odio in hac', '8');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-12-21 08:07:19', 53, 'Méline', 'cmcmorlandcu@cornell.edu', 'diam cras pellentesque volutpat dui maecenas tristique est et tempus semper est quam pharetra magna', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-19 00:28:35', 11, 'Mélanie', 'ewinspearcv@xinhuanet.com', 'quis libero nullam sit amet turpis elementum ligula vehicula consequat morbi a ipsum integer a nibh', '9181');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-01-01 05:29:36', 94, 'Méryl', 'ckendallcw@time.com', 'sed vestibulum sit amet cursus id turpis integer aliquet massa', '46432');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-04-17 07:39:25', 7, 'Edmée', 'cmobbscx@tripadvisor.com', 'lorem quisque ut erat curabitur gravida nisi at nibh in hac habitasse platea dictumst', '2');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-12-24 19:27:16', 80, 'Laïla', 'mlabadinicy@npr.org', 'sed tristique in tempus sit amet sem fusce consequat nulla nisl nunc nisl', '8');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-10-10 02:25:27', 11, 'Liè', 'gprimocz@reuters.com', 'sed vel enim sit amet nunc viverra dapibus nulla suscipit', '2');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-12-09 15:57:08', 68, 'Maïlis', 'cpaulsend0@infoseek.co.jp', 'eros vestibulum ac est lacinia nisi venenatis tristique fusce congue diam', '83');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-02-04 15:12:39', 26, 'Almérinda', 'dfugglesd1@pagesperso-orange.fr', 'nulla suspendisse potenti cras in purus eu magna vulputate luctus cum sociis natoque penatibus et magnis', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2020-01-09 07:55:21', 48, 'Françoise', 'oryried2@hubpages.com', 'dui vel nisl duis ac nibh fusce lacus purus aliquet at feugiat', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-11-07 20:51:55', 31, 'Uò', 'fbumpusd3@miibeian.gov.cn', 'et tempus semper est quam pharetra magna ac consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci', '9493');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-10-11 12:22:53', 91, 'Miléna', 'cantoszczykd4@about.com', 'felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel sem', '62');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-04-14 05:53:42', 83, 'Inès', 'fbrodeurd5@nifty.com', 'id pretium iaculis diam erat fermentum justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis eget elit', '691');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-12-27 06:02:41', 13, 'Andréanne', 'qbooid6@wsj.com', 'blandit mi in porttitor pede justo eu massa donec dapibus duis at velit eu', '13');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-12-05 23:08:25', 37, 'Håkan', 'cglandond7@storify.com', 'justo nec condimentum neque sapien placerat ante nulla justo aliquam quis turpis eget elit sodales scelerisque mauris sit amet', '966');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-12-04 02:03:57', 77, 'Geneviève', 'tcommussod8@stumbleupon.com', 'curae duis faucibus accumsan odio curabitur convallis duis consequat dui nec nisi volutpat eleifend donec ut dolor morbi', '361');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-01-21 01:14:04', 12, 'Miléna', 'lferrid9@pen.io', 'platea dictumst etiam faucibus cursus urna ut tellus nulla ut erat id', '5');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-03-17 10:08:49', 32, 'Dù', 'nrollerda@altervista.org', 'metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci luctus', '654');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2018-01-25 12:59:37', 75, 'Miléna', 'aladondb@4shared.com', 'mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus', '108');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-11-06 19:55:18', 99, 'Aí', 'mkolesdc@netvibes.com', 'dui nec nisi volutpat eleifend donec ut dolor morbi vel lectus in quam fringilla rhoncus', '29');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-03-13 06:14:21', 80, 'Michèle', 'jmacrieriedd@shop-pro.jp', 'id luctus nec molestie sed justo pellentesque viverra pede ac', '993');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-05-03 06:16:41', 92, 'Nadège', 'mdillingerde@nymag.com', 'sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel sem sed sagittis nam congue risus semper', '9');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-19 06:58:01', 5, 'Athéna', 'jcoilsdf@alibaba.com', 'porttitor pede justo eu massa donec dapibus duis at velit eu est congue elementum', '58475');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-07-12 11:03:10', 21, 'Naéva', 'alittrelldg@gnu.org', 'elit ac nulla sed vel enim sit amet nunc viverra dapibus nulla suscipit ligula', '22518');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-10-25 01:52:27', 20, 'Eléonore', 'vmartindaledh@spotify.com', 'morbi ut odio cras mi pede malesuada in imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor', '4');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-10-17 13:00:54', 18, 'Maï', 'rtedderdi@toplist.cz', 'neque aenean auctor gravida sem praesent id massa id nisl venenatis lacinia aenean sit amet justo morbi ut odio cras', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-04-08 21:30:15', 4, 'Léonie', 'realamdj@mit.edu', 'tempor convallis nulla neque libero convallis eget eleifend luctus ultricies eu nibh quisque id justo sit amet sapien', '079');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-07-26 22:18:52', 18, 'Dorothée', 'dcurrodk@nyu.edu', 'risus auctor sed tristique in tempus sit amet sem fusce consequat nulla nisl nunc nisl duis bibendum felis sed interdum', '030');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-06-19 12:11:01', 29, 'Cloé', 'aabeladl@lycos.com', 'posuere felis sed lacus morbi sem mauris laoreet ut rhoncus aliquet pulvinar sed nisl nunc rhoncus dui vel sem', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-06-03 10:57:24', 17, 'Eléonore', 'drippingdm@businessweek.com', 'imperdiet et commodo vulputate justo in blandit ultrices enim lorem ipsum dolor sit amet', '54');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-01-18 12:02:02', 32, 'Médiamass', 'roffelldn@oakley.com', 'eget nunc donec quis orci eget orci vehicula condimentum curabitur in libero ut', '7');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2017-06-16 00:26:56', 16, 'Mylène', 'kwiddopdo@answers.com', 'eros vestibulum ac est lacinia nisi venenatis tristique fusce congue diam id ornare imperdiet sapien urna', '89257');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-07-03 12:50:04', 42, 'Vénus', 'moheaneydp@comsenz.com', 'sagittis sapien cum sociis natoque penatibus et magnis dis parturient montes nascetur ridiculus', '6');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-04-26 15:28:15', 60, 'Cléopatre', 'ibrindeddq@youtube.com', 'in lacus curabitur at ipsum ac tellus semper interdum mauris ullamcorper', '8668');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2015-09-02 20:30:05', 93, 'Méng', 'smartusovdr@yellowpages.com', 'mauris enim leo rhoncus sed vestibulum sit amet cursus id turpis integer', '983');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2019-01-17 05:07:36', 57, 'Almérinda', 'ffeedhamds@theguardian.com', 'magna ac consequat metus sapien ut nunc vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae', '253');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2014-03-11 21:49:54', 62, 'Félicie', 'dreignarddt@123-reg.co.uk', 'quam suspendisse potenti nullam porttitor lacus at turpis donec posuere metus vitae ipsum aliquam non mauris morbi non lectus aliquam', '9');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2016-03-25 05:25:18', 15, 'Léone', 'dkiltydu@wordpress.org', 'eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam turpis adipiscing lorem vitae mattis nibh ligula', '7323');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode)values ('2013-07-16 07:19:02', 35, 'Marie-thérèse', 'aknealedv@nps.gov', 'nunc rhoncus dui vel sem sed sagittis nam congue risus semper porta volutpat', '6');

INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1MF39tBHAtyZtvy9oBdTxe9TGSFJhuFSjW', 17.44, 82, 180);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1Jz6jirE2AoVMTK6jorBtjWme1XAo8EaAr', 85.0, 76, 54);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1NpTmLmEK6R1A9nSJJhkBc9YAm8p4nR5a2', 76.37, 89, 328);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1H9AGALeqJcWV8fqyhRfFbKtA55ynNkPeT', 68.95, 18, 264);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('12hnBAtrsRDzpXgsb1CBkcArcWQEbnJtmF', 92.7, 52, 208);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1DvqY42DoLYxxFjcdNB4nwp5NWzgUGTfrS', 43.07, 18, 301);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1Ed7YLJ4tDDsop3o1iBTg9NUQouMmQHERQ', 59.98, 79, 353);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('13ZwAgu5qza6GnN8JKS93ap9gUo85hZ2xY', 41.48, 64, 88);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1KaFRxEXeB98pRGsBenWPQSr4XAUT9LkqS', 70.11, 36, 166);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('19dLZN3Fx2qcZEAxjG1xK2vFJqu2CP9diU', 61.49, 87, 374);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1FvJyAeZA7TTLZ6EChwtJL2a66fHf2zthv', 96.4, 53, 267);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('121ddJozBHFrsDMriJm5gkbnT1MDZaijEc', 19.14, 61, 117);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1FdAdC8PcSd6F6r9BEcbCAT8BreY3tnS4F', 55.74, 46, 147);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('17MaMKaKNAjUqpUfiyC2U9UQjS2DD7hJwp', 45.71, 21, 204);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('18JK4A2s6FH49CkSYgDvcpsCJWwbPXUgRv', 41.29, 55, 201);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1JY2CQrjcyNeU4KM6g8CpSzn4cD3M1AkpJ', 2.85, 84, 439);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1HtECS6nwdpLqYVWiFUsTDXyqsB2ty6pL1', 7.23, 14, 49);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1Ggpg3Q949dPdtjsoCk97W9mrpbQnKoGbc', 23.16, 56, 242);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1KjGDJifz2bQnVEohwYzAmerPPdJpPfGCJ', 48.69, 87, 274);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1MMFVABJspK3gdWphDSqqziMG8NXVh4t6v', 48.68, 12, 111);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('18Hx6V2bwFAvJk8MRV1rrhr3z2HRMUbxYs', 83.59, 7, 463);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('13HTz4JgbHBDZDLCTwMyLNqZo681TQRZzA', 99.58, 14, 468);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('194rDoXhCyCzzievoFqtvev8evmAVXZWk4', 64.03, 18, 155);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1FiiKpAqfjpRzcWgLPkLiNQ4k5HqdkzQf6', 40.13, 31, 109);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1Fcv4T1zRBGGAo8e9JEW2taEDRkSa3tpn9', 35.59, 63, 66);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('18rV56wqkDbnycdZT5Vyv9UyiWXZxbPLHP', 64.51, 58, 40);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1HMAvcdYtnXVp76hTUKcLH85KfhPUeRYXd', 96.38, 22, 102);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('14WUrjhvPJzfZ2x3Qy6vUigrCJkSvMuT9S', 57.4, 23, 115);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('12yekfoegtkGJ6zmv5Ne38UgqGGviP4m5A', 55.11, 21, 214);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('13fFemG62yHH4fkicaCYqTvJ2hDt3V5Juv', 25.11, 68, 56);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1AWuLKPhA6jH1oxGocmnkhmsR72sAfHrad', 80.68, 10, 417);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1GF14gWnumFv2PTn63rxNmw61JC2uhRGk1', 49.45, 43, 305);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('14bsaE3Qgtspv9iHfTeShBkdmuJRHYFUvt', 94.24, 64, 331);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('16GAefTpXMDG3R5CuyR4TBLjwAj5j9dD6k', 29.21, 59, 328);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1GdmgEnRAMMY7rbjMS5Amp6Pb9CcWpBgPW', 19.62, 59, 475);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1MDw49uAoDrrWvnoXqShCqMmCu4bXviqr2', 25.53, 22, 6);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1DfqW9HKQwThNzQPMtWXNEqkmPy5pheaEv', 5.96, 50, 17);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1KcSkvjX4FAJFLNN6ra73LQnKshhd7iF2v', 81.35, 13, 304);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1CrGcojMb3YxmKHWn8nw2ULBESCq1XYftf', 44.51, 86, 57);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1HhdFUkEmhwFPLYDTo2xr9wwKPQFopKmwX', 18.28, 39, 414);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1AbmnDbffWYLR6gvFpCemzMB5Fv5JypxER', 47.75, 55, 309);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('163DUF5oKiasK5MAUdWrM8SWGPkF7scuUk', 46.8, 31, 478);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('12ZLdjb4o7HbeE3fRj2oJoQ6hLvW7u1Zw8', 51.66, 37, 359);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1PW1pjvmWG2EzLrvt7b75CorpCgt2QKg5Y', 41.58, 40, 184);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1AKetBwzvadd7FS1Pf1iBTy83jpzDGZwir', 39.32, 81, 500);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1Lraaj2QJmPi2pr5BqBU6QRP4aJeDecD3d', 30.13, 51, 147);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1CtGc6hjLeG13uqozGjpAiZYwd5fBimfiW', 2.18, 71, 188);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1HdxiqSZaUiX2T6Sy8yghNBrRq3v7T1Bsd', 73.78, 10, 261);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('15qpyuc4LkTBcugJpviGgvyVYatZNMMYq3', 83.66, 43, 347);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1JrxKcfaRqU26TmPfxexcW3dnR5op1cG81', 25.96, 31, 120);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1HDeweXAKiDSTEpNDkxGJyecUD1ogmrme2', 44.32, 82, 338);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('17dYSF17aw5pQACfgoTz5tVeprLU8eZKHK', 47.7, 66, 301);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1B5Hs8qmH6YDs6YYXgENLvHRZJkYNrsGgU', 33.75, 52, 270);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('19c16RS3XSBbEnEGjJsPEyhCR3V8DTsJoS', 73.91, 46, 75);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('15zHjaZTSQx7NCErnUcAXWQTK98STcjW6b', 74.53, 37, 98);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1DgjXAusheBwa7jKv89xU3LGJYQANMEbkm', 66.99, 35, 123);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1MPfufFo7j92vaZs8W2LPJMqmxRepeX55o', 19.0, 83, 57);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('16XcvPcmJhuDrcdNi6jAKYXm8bB6SK56Vz', 49.5, 49, 98);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('13KJYNs4p1iX3JurqnLBynCLRwRt7Ud4aL', 34.31, 86, 449);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('18wyNPAcVuCvJkJZgc4dX58bVuaun1bGxD', 20.22, 79, 287);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1GJWqqNPL9EmXn4WH1HLJpxQzLaDz1iw6A', 89.91, 17, 408);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1K91FTGUjppZG2Ju7B68KrRV3U79FDKHK8', 80.77, 68, 79);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('13oPXrFQzbpvVaKXvYSFh3mKRiPiMPfCpZ', 96.04, 74, 351);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1Dkz8Ko3JfcztNfK1hG4VdMzBwJxDh1qbT', 52.52, 27, 495);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('17o5X71vxCmRCrRqtG8Kg2fqbJnV9kdqgr', 2.64, 9, 170);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1Fu92E6D1uwVPpxUncnnhnazLA7CCexcW6', 30.67, 87, 24);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1Njr5TQbgQPw5Qe6r1UgrDAnXGJQ5KwVVm', 4.09, 84, 162);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1ABWTU9nycbKD3M3EPLvhWuVPUaYN9Hi6p', 63.59, 39, 453);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('11qpKG9GHE3CrgbgYdWRrdkJmQLgLKVzb', 43.24, 17, 214);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('177pvknWt54Xnt5gc9FFoHF8Z6g3YUjLcm', 23.94, 16, 236);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1AsMMuHbgQcTm4fKqQ8qzaHAZMy9woUwjk', 99.06, 42, 124);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1DVNaij8L9zSjQkwLpAfokokkKdfvDTXs2', 96.52, 32, 328);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1Cc8Q4jCgtaw4XgjsAWpUQsk3x2XsyXpuA', 48.6, 3, 344);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1CirAFCBJFDL3bZ29QJd4eVALRf85BaXfk', 76.83, 34, 132);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1DEkmm5P8ch89THDmi7eQ4mbz4uttDg99U', 38.61, 46, 371);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('12i9Wr4nxufuHZcuXzoHQy1K8NVZFXapTj', 96.8, 54, 139);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1FPM83YTbHnvp5fqKsZGZGhEBnsLKp3MvL', 39.45, 89, 20);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1AXwGQzLLa3wUanoAh6VSsvnEft4wu1QyR', 43.38, 79, 143);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1P58EZRQzaqBnRrRx6kf5VCawGQYfZguhf', 68.57, 72, 1);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('16VrFZnHQUZQZeiXEqP1LGcyUsaaxYVCMv', 28.24, 8, 199);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1QELq2cECg1kYX6H4cXRkFeadLe9AsqWK2', 38.81, 24, 357);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('121KFN5nQJHJJqSbwjhK9443ogHYhSETkn', 80.83, 25, 83);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('13Tu1eZo56PKSpg2hNK78NYvygetNmJmWA', 49.2, 57, 368);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1CpRk3ZqNgjemJTGRtY53xv46oTfMcXDDP', 87.02, 16, 139);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1PEE9Yat4TURTG2Scbz3n1ZspDSzunqR3z', 11.62, 17, 329);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1CNJ4LMkWbJyJh3JPB6XbeaqqTNHdogFC7', 53.07, 82, 127);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('16A9QJFnZdP7J3ihfyEt7jzbsZos7ZGc3F', 99.64, 21, 446);
INSERT INTO keys (key,price_sold, offer_id, order_id)values ('1rhSUAMJo9kkSYvRv7a3Fef1fhAZ6X5xo', 69.72, 10, 210);
INSERT INTO keys (key, offer_id)values ('1DcSStEQ1krb1zDRwpJHQ7YSTmrBi2XxSb', 26);
INSERT INTO keys (key, offer_id)values ('1QBHy95vSPxJNVG1YjMLcD9hoF354s3rHq', 12);
INSERT INTO keys (key, offer_id)values ('1Kwg46YrtUzSHa7aAmPLqutP3sLraZsoi5', 39);
INSERT INTO keys (key, offer_id)values ('14eZspUa8k8BJa26X6xeznfTmvkPQfcRjc', 42);
INSERT INTO keys (key, offer_id)values ('1NR3zsWi2N8DejAjyB3h9vwdyWzfuAjWcp', 30);
INSERT INTO keys (key, offer_id)values ('1BCb3vkvfBHsv3evn1Dp2nWjESjd7WyJTP', 27);
INSERT INTO keys (key, offer_id)values ('16PMra44krg9XYYKdnyo2gs7RTTJzn3cAt', 87);
INSERT INTO keys (key, offer_id)values ('1BPMAaqHa3FTN4rYiNbK73sA4qPWfFRu6L', 26);
INSERT INTO keys (key, offer_id)values ('1NAZUzdLSzgq6sRCimTvk7amoXgvsjh54x', 16);
INSERT INTO keys (key, offer_id)values ('1LgvEuyTVW1Laraamf3e4Q7ofpV9m8WR9E', 40);
INSERT INTO keys (key, offer_id)values ('1CSzPKfzc5SFjmPZHRUDf2jRouU5dQ9KjS', 62);
INSERT INTO keys (key, offer_id)values ('1KpvvEvCtbkPx3fDPiVVxqxcMv22J5Ng9i', 70);
INSERT INTO keys (key, offer_id)values ('1gXdNpKKh13yCAF5saaL48FQwCCDsBLNZ', 32);
INSERT INTO keys (key, offer_id)values ('16ggJEDU8sSMkeeTFWDgfEPRURimXp2bB3', 12);
INSERT INTO keys (key, offer_id)values ('16ZFatxG79WJK2hAKEmUEMxLv8kuzzHFVu', 13);
INSERT INTO keys (key, offer_id)values ('16rePfo2xotXVB499qsqCTFWz6ti24UGoH', 65);
INSERT INTO keys (key, offer_id)values ('1Er73VCQnx5QWSBfECyeMMt9azkXAFutsM', 26);
INSERT INTO keys (key, offer_id)values ('12SH13C6pEsoxBg25fBHVWMG9iuFoZwF8G', 30);
INSERT INTO keys (key, offer_id)values ('1KsuaqiZQmfFqKqHrcFBYhZX5DjSWKJw76', 37);
INSERT INTO keys (key, offer_id)values ('14yzcrYoA85GPV59J3dwezRME7bsf4jJc5', 21);
INSERT INTO keys (key, offer_id)values ('13sgztPvsPdJtwBW1wKPfBrwkfDujp5BFM', 84);
INSERT INTO keys (key, offer_id)values ('1BcmBA7jjT2eLJuNk7juCtysJtSx8E1gr4', 47);
INSERT INTO keys (key, offer_id)values ('14nZtH65SEtGBNG3pJWjr9nKLkrUgbwacC', 44);
INSERT INTO keys (key, offer_id)values ('15rodmJFzEFgeWaUEGkm3LjYstnXcLjd7z', 37);
INSERT INTO keys (key, offer_id)values ('1CPAsTQRKnCQypR4NCcKhwQwteRSy1wh48', 23);
INSERT INTO keys (key, offer_id)values ('16YinoyGjSSTxcrwYvsv7fm4oby4BKhpqn', 10);
INSERT INTO keys (key, offer_id)values ('1NqrZ9goTyAg9YJf86piwYeScgYD5toUUU', 2);
INSERT INTO keys (key, offer_id)values ('1QDLdhgep99zyqBkqvts3TxijimztXVjJz', 66);
INSERT INTO keys (key, offer_id)values ('16Bs84c8c9GvFogJ2wn9AadT13h4fefdpv', 46);
INSERT INTO keys (key, offer_id)values ('1NPZTdPSsJpx7A26aUBwE65BnUfF4S4Vis', 6);
INSERT INTO keys (key, offer_id)values ('196eTSQT7San2i7Uf5QVt9KdDd2ecd9GQ1', 39);
INSERT INTO keys (key, offer_id)values ('1HDFynzFpKt8n2h6xfD31G1NFJg5QHKqQh', 9);
INSERT INTO keys (key, offer_id)values ('12TkNjQH3PUtisi8Uzrfr4wMucLFVjwYc2', 45);
INSERT INTO keys (key, offer_id)values ('19T3CGHCMAsN6yar1jfNHpzLMXcyS7ECqa', 8);
INSERT INTO keys (key, offer_id)values ('15k54GtVthBxosNEx21RZVRGZ6yUk3sfWE', 17);
INSERT INTO keys (key, offer_id)values ('127yMCZz64juiUJdzjZoqWXgHzfpiGrYrH', 79);
INSERT INTO keys (key, offer_id)values ('12Q2LCbNjrRswqtNechuAx8T6orzTpXBAK', 36);
INSERT INTO keys (key, offer_id)values ('1LUJrQwLap23qQxfRUFraVTqYepS7yfhUZ', 11);
INSERT INTO keys (key, offer_id)values ('12inWwYjTo9LpmAFTykGkHarJrVX7tcB4M', 67);
INSERT INTO keys (key, offer_id)values ('17oRFhhREYuJxw4HWRvaj5VhbmFRXYh8NB', 68);
INSERT INTO keys (key, offer_id)values ('1GV78YGzLa8ALcFAufSG8uJmimHBGTHeKa', 84);
INSERT INTO keys (key, offer_id)values ('1GJ3FKz9G4Nub5nViS29NbawbK8JkeMV7B', 87);
INSERT INTO keys (key, offer_id)values ('1GpRMYXbtuFmDuffrnixbmWfY93h8vxCxy', 6);
INSERT INTO keys (key, offer_id)values ('1KU6gmjVAdH1jMwVseDogRwTDN4QQKmKRH', 49);
INSERT INTO keys (key, offer_id)values ('1BGJD366R4NAiGR3HVECh78eWLriuvmF7F', 85);
INSERT INTO keys (key, offer_id)values ('12SKuWq3ZeLPowVnkXakgGSEYDtPg3CvNw', 13);
INSERT INTO keys (key, offer_id)values ('1DufxcpBsvupD8f1678GrB9w6JB6tE9Ly4', 81);
INSERT INTO keys (key, offer_id)values ('1HkbsEyYHRzd8L4ux4jhM1k8TFtmtuCREZ', 74);
INSERT INTO keys (key, offer_id)values ('151LyqbzYbygSbfj9eiL3k2yGDriap7m84', 55);
INSERT INTO keys (key, offer_id)values ('19Hn15AvWSj1YUe7Gy2wYNnejT7XnjFaEj', 16);
INSERT INTO keys (key, offer_id)values ('1ya8CkhgKZHJXX3AD69NYHvW6o8buEbWE', 15);
INSERT INTO keys (key, offer_id)values ('12VKu8umgjgPH372B7PWBo6LqeJmjH8ork', 2);
INSERT INTO keys (key, offer_id)values ('17fhwfS7WSF6by1QkwBYgjU2WsjJgegcqg', 11);
INSERT INTO keys (key, offer_id)values ('16KCs6gtpmF26WP8LL8fi8z7m5NAwabc3V', 80);
INSERT INTO keys (key, offer_id)values ('1B2xxKqScrocaQW9W2kNUkc6SiLsXonRNC', 84);
INSERT INTO keys (key, offer_id)values ('18tF5MHXgioStzzd4xNGkmKijzLM5xiYtY', 79);
INSERT INTO keys (key, offer_id)values ('13ChUW4QgJ5pLhWnkUvrE9cLJ3uUTkaqaB', 12);
INSERT INTO keys (key, offer_id)values ('1J34PaooG1RkxYuBZQBWaLU6bEpLmBDsnu', 1);
INSERT INTO keys (key, offer_id)values ('186knf6c7i8uk9ixCG785XnsaASEEqCbFW', 81);
INSERT INTO keys (key, offer_id)values ('1HHXBg5H4b3k4e8EgTAJQLXS1ijzZw7yCD', 23);
INSERT INTO keys (key, offer_id)values ('1CM5jWaSbiEy28ecf42big8FKb9eKGQ1Gx', 29);
INSERT INTO keys (key, offer_id)values ('1GCuUziFNJ1ED76mKZVaFAbjS4b9weE6HQ', 24);
INSERT INTO keys (key, offer_id)values ('1NyUzNyBwadHp7X5iGvHuWPnkKRGTfpF6h', 76);
INSERT INTO keys (key, offer_id)values ('19FPHXJspUUeXqREHMTW52xPRf8dY4g8PT', 7);
INSERT INTO keys (key, offer_id)values ('1BEg6tz4oXf9SbXQsSQpSNuxuEktmrQJXj', 59);
INSERT INTO keys (key, offer_id)values ('1BamTqnEkswNeUuqKPNtBWYuAqdPeXR2Q9', 54);
INSERT INTO keys (key, offer_id)values ('14SYUzEfVDM3UQsaGbRZy67U9373AFwzEg', 73);
INSERT INTO keys (key, offer_id)values ('1McRiNftxBD12Kcz53vqB7ncnanQCixsk6', 83);
INSERT INTO keys (key, offer_id)values ('1C8ie4P4Exh4tdqRYp34TGVgBdV79qyXm', 84);
INSERT INTO keys (key, offer_id)values ('1MY72e59uR5hvD3irjS6bjhA3Btd74ferS', 10);
INSERT INTO keys (key, offer_id)values ('1GZFjctdsXPAWburw47BUBk4yReha7sa9B', 89);
INSERT INTO keys (key, offer_id)values ('1FG4iprtpu3WoSNQHQ9mrdbN4G2WpnZiut', 74);
INSERT INTO keys (key, offer_id)values ('13ENQAL9vytk79jHTgikttwHthtLoFD3hR', 32);
INSERT INTO keys (key, offer_id)values ('15PdGcbB2aYYK9PckKxzc2BGvCMgduXrx3', 12);
INSERT INTO keys (key, offer_id)values ('1C6NKSfShFgnCwpKxKHt6yVqGj1tpkMFSj', 68);
INSERT INTO keys (key, offer_id)values ('12hTLBvWPEptqunuaSGeGzvMot6EoQuYpY', 73);
INSERT INTO keys (key, offer_id)values ('1DSRRuC9dSWeMQctfPQSxnPfvUWkdDwQuK', 16);
INSERT INTO keys (key, offer_id)values ('1JSHikBryukYh6v4VCNg7sq6oN9yZJDwUj', 59);
INSERT INTO keys (key, offer_id)values ('16kDCmTVuqbdL3ZJR8J2AkcWedFV9hxXKp', 50);
INSERT INTO keys (key, offer_id)values ('1CNVqYixNhcmP3tGHTGnAcn993zsHDq43j', 14);


INSERT INTO keys (key, offer_id)values ('1KiQPzUmBtFiZvPGTWnsjCr6y2Ea17ESqu', 68);
INSERT INTO keys (key, offer_id)values ('1bUL6FQxpNovJSVBiBMED5EDFaGmXsyk4', 64);
INSERT INTO keys (key, offer_id)values ('13n8a2e4hV1mzSAP2KyKEdZ9gKudAjxtXA', 20);






-- SSN --
INSERT INTO users (username, email, description, password, rating, birth_date, paypal, picture_id, num_sells) VALUES ('ssn','up310021@g.uporto.pt','Professor de LBAW','$2y$10$PA30ELTzJN7HOUSZ./TyQOBAT6fUntWicXLQiXxWPFu/LKU456yn6',100,'1989-02-05',null,1, 0);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock) VALUES (17.63, '2019-10-17 09:37:43', '2020-12-02 12:43:32', 67.14, 3, 103, 1, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock) VALUES (17.63, '2019-10-17 09:37:43', '2020-12-02 12:43:32', 67.14, 4, 103, 2, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock) VALUES (17.63, '2019-10-17 09:37:43', null, 0, 2, 103, 19, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock) VALUES (17.63, '2019-10-17 09:37:43', null, 0, 3, 103, 19, 3);
INSERT INTO keys (key, offer_id)values ('1C6NKSfShFgnCwpKxKHt6yVqGj1tpkMFSa', 92);
INSERT INTO keys (key, offer_id)values ('1C6NKSfShFgnCwpKxKHt6yVqGj1tpkMFSb', 92);
INSERT INTO keys (key, offer_id)values ('1C6NKSfShFgnCwpKxKHt6yVqGj1tpkMFSc', 92);
INSERT INTO keys (key, offer_id)values ('1C6NKSfShFgnCwpKxKHt6yVqGj1tpkABSa', 93);
INSERT INTO keys (key, offer_id)values ('1C6NKSfShFgnCwpKxKHt6yVqGj1tpkABSb', 93);
INSERT INTO keys (key, offer_id)values ('1C6NKSfShFgnCwpKxKHt6yVqGj1tpkABSc', 93);
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode) VALUES ('2019-08-18 16:52:45', 103, 'Léonie', 'kfraschini0@furl.net', 'pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in', '06563');
INSERT INTO orders (date, user_id, order_info_name, order_info_email, order_info_address, order_info_zipcode) VALUES ('2019-08-18 16:52:45', 103, 'Léonie', 'kfraschini0@furl.net', 'pretium nisl ut volutpat sapien arcu sed augue aliquam erat volutpat in', '06563');
INSERT INTO keys (key,price_sold, offer_id, order_id) VALUES ('1MF39tBHAtyZtvy9oBdTxe9TGSFJhuFSjZ', 17.44, 82, 501);
INSERT INTO keys (key,price_sold, offer_id, order_id) VALUES ('1MF39tBHAtyZtvy9oBdTxe9TGSFJhuFSjZW', 17.44, 82, 502);


-- new offers --
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock) VALUES (17.63, '2019-10-17 09:37:43', '2020-12-02 12:43:32', 67.14, 3, 103, 1, 3);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (53.68, '2016-12-13 07:19:42', null, 0, 1, 68, 5, 5);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (63.68, '2019-12-13 07:19:42', null, 0, 2, 68, 8, 5);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (53.68, '2016-12-13 07:19:42', null, 0, 3, 4, 24, 12);
INSERT INTO offers (price, init_date, final_date, profit, platform_id, user_id, product_id, stock)values (63.68, '2019-12-13 07:19:42', null, 0, 4, 6, 15, 7);

