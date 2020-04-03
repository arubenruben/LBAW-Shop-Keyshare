-----------------------------------------
-- Drop old schmema
-----------------------------------------

DROP SCHEMA public CASCADE;
CREATE SCHEMA public;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO public;

-----------------------------------------
-- Tables
-----------------------------------------

CREATE TABLE category (
  id serial PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

CREATE TABLE genre (
  id serial PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

CREATE TABLE platform (
  id serial PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

CREATE TABLE image (
  id serial PRIMARY KEY,
  url TEXT NOT NULL UNIQUE
);

CREATE TABLE product (
  id serial PRIMARY KEY,
  name TEXT NOT NULL UNIQUE,
  name_tsvector tsvector,
  description TEXT,
  category INTEGER REFERENCES category (id) ON DELETE SET NULL ON UPDATE CASCADE,
  image INTEGER DEFAULT 1 NOT NULL REFERENCES image (id) ON DELETE SET DEFAULT ON UPDATE CASCADE,
  deleted BOOLEAN NOT NULL DEFAULT FALSE,
  launch_date DATE NOT NULL,
  num_sells INTEGER NOT NULL DEFAULT 0
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
  id serial PRIMARY KEY,
  username TEXT NOT NULL UNIQUE,
  email TEXT NOT NULL UNIQUE,
  description TEXT DEFAULT NULL,
  password TEXT NOT NULL,
  rating INTEGER DEFAULT NULL,
  birth_date date NOT NULL,
  paypal TEXT,
  image INTEGER NOT NULL DEFAULT 0 REFERENCES image(id) ON DELETE SET DEFAULT ON UPDATE CASCADE,
  number_sells_done INTEGER NOT NULL DEFAULT 0,

  CONSTRAINT rating_ck CHECK (rating >= 0 AND rating <= 100),
  CONSTRAINT birthdate_ck CHECK (date_part('year', age(birth_date)) >= 18)
);

CREATE TABLE offer (
  id serial PRIMARY KEY,
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
  id serial PRIMARY KEY,
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
  id serial PRIMARY KEY,
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
  number serial PRIMARY KEY,
  date DATE NOT NULL DEFAULT NOW(),
  buyer INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
    
  CONSTRAINT date_ck CHECK(date <= NOW())
);

CREATE TABLE key (
  id serial PRIMARY KEY,
  key TEXT NOT NULL UNIQUE,
  priceSold REAL NOT NULL,
  offer integer NOT NULL REFERENCES offer(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  orders integer REFERENCES orders(number) ON DELETE RESTRICT ON UPDATE CASCADE,
  
  CONSTRAINT price_ck CHECK(priceSold > 0)
);

CREATE TABLE feedback (
  id serial PRIMARY KEY,
  evaluation BOOLEAN NOT NULL,
  comment TEXT,
  evaluation_date DATE NOT NULL DEFAULT NOW() CONSTRAINT fb_date_ck CHECK(evaluation_date <= NOW()),
  buyer INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  key INTEGER NOT NULL REFERENCES key(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE report (
  id serial PRIMARY KEY,
  date date NOT NULL DEFAULT NOW(),
  description TEXT NOT NULL,
  title TEXT NOT NULL,
  key INTEGER NOT NULL UNIQUE REFERENCES key(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  reporter INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  reportee INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  
  CONSTRAINT user_ck CHECK(reporter <> reportee),
  CONSTRAINT date_ck CHECK(date <= NOW())
);

CREATE TABLE message (
  id serial PRIMARY KEY,
  date date NOT NULL DEFAULT NOW(),
  description TEXT NOT NULL,
  regular_user INTEGER REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,

  admin INTEGER REFERENCES admin(id) ON DELETE SET NULL ON UPDATE CASCADE,
  report INTEGER NOT NULL REFERENCES report(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT date_ck CHECK(date <= NOW()),
  CONSTRAINT user_type_ck CHECK((regular_user IS NULL AND admin IS NOT NULL ) OR (regular_user IS NOT NULL AND admin IS NULL))
);

CREATE TABLE cart (
  id serial PRIMARY KEY,
  buyer INTEGER NOT NULL REFERENCES regular_user(id) ON DELETE CASCADE ON UPDATE CASCADE,
  offer INTEGER NOT NULL REFERENCES offer(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE about_us (
  id serial PRIMARY KEY,
  description TEXT NOT NULL
);

CREATE TABLE faq (
  id serial PRIMARY KEY,
  question TEXT NOT NULL,
  answer TEXT NOT NULL
);

-----------------------------------------
-- INDEXES
-----------------------------------------

-- Performance Indices
CREATE INDEX product_deleted_idx ON product (deleted);
CREATE INDEX product_date_idx ON product (launch_date); 

-- Full-text Search Indices
CREATE INDEX product_name_idx 
ON product
USING GIN(name_tsvector);

-----------------------------------------
-- UDFs and TRIGGERS
-----------------------------------------
CREATE FUNCTION products_categories(list TEXT[]) 
RETURNS TABLE (
    id INTEGER,
    name TEXT, 
	name_tsvector tsvector,
    description TEXT, 
    launch_date DATE, 
    category INT, 
    image INTEGER
) 
AS $$
BEGIN
    RETURN QUERY 
    SELECT DISTINCT 
        p.id, 
        p.name,
        p.name_tsvector,
        p.description, 
        p.launch_date, 
        p.category,  
        p.image
    FROM 
        product AS p, 
        category c
    WHERE 
        p.category = c.id 
        AND c.name = any(list);
END $$ LANGUAGE plpgsql;

CREATE FUNCTION products_genres(list TEXT[]) RETURNS TABLE (
    id INTEGER,
    name TEXT, 
    description TEXT, 
    launch_date DATE, 
    category INT, 
    image INTEGER
) 
AS $$
BEGIN
    RETURN QUERY 
    SELECT DISTINCT product.* 
    FROM 
        product, 
        product_has_genre, 
        genre
    WHERE 
        product.id = product_has_genre.product 
        AND genre.id = product_has_genre.genre
        AND list[i] = categories.name;
END $$ LANGUAGE plpgsql;


CREATE FUNCTION products_platforms(list TEXT[]) RETURNS TABLE (
    id INTEGER,
    name TEXT, 
    description TEXT, 
    launch_date DATE, 
    category INT, 
    image INTEGER
) 
AS $$
BEGIN
    RETURN QUERY 
    SELECT DISTINCT product.* 
    FROM 
        product, 
        platform
    WHERE 
        product.id_platform = platform.id 
        AND list[i] = platform.name;
END $$ LANGUAGE plpgsql;


CREATE FUNCTION offer_price(offer_id INTEGER) RETURNS FLOAT AS $price$
DECLARE 
    price REAL;
BEGIN
    price := (
            SELECT offer.price 
            FROM offer
            WHERE offer.id = offer_id
        ) * ( 100 - (
                SELECT discount.rate 
                FROM discount
                WHERE discount.offer = id 
                    AND start_date <= NOW()
                    AND end_date >= NOW()
                LIMIT 1
            )
        ) / 100;
    RETURN price;
END; $price$ LANGUAGE plpgsql;


--TRIGGER 2
DROP FUNCTION IF EXISTS product_num_sales() CASCADE;
CREATE OR REPLACE FUNCTION product_num_sales() 
RETURNS TRIGGER AS $$
   BEGIN
   UPDATE product 
   SET number_sales = number_sales + 1
   WHERE product.id IN (
        SELECT DISTINCT p.id
        FROM offer o, product p
        WHERE NEW.offer=o.id and o.product = p.id
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS product_num_sales_tg ON key CASCADE;
CREATE TRIGGER product_num_sales_tg
AFTER UPDATE OF orders ON key
FOR EACH ROW 
EXECUTE PROCEDURE product_num_sales();


--TRIGGER 3
DROP FUNCTION IF EXISTS user_num_sales() CASCADE;
CREATE OR REPLACE FUNCTION user_num_sales() RETURNS TRIGGER AS $example_table$
    BEGIN
        UPDATE regular_user
        SET number_sales = number_sales + 1
        WHERE regular_user.id in (select distinct seller.id
                                  FROM offer join regular_user as seller                                     on seller.id=offer.seller 
                                  WHERE NEW.offer = offer.id
                                  );     
      RETURN NEW;
   END;
$example_table$ LANGUAGE plpgsql;

CREATE TRIGGER user_num_sales_tg
AFTER UPDATE OF orders ON key
FOR EACH ROW 
EXECUTE PROCEDURE user_num_sales();

--TRIGGER 4
DROP FUNCTION IF EXISTS seller_num_reviews(INTEGER) CASCADE;
CREATE OR REPLACE FUNCTION seller_num_reviews(key_var INTEGER)
RETURNS INTEGER AS $num_reviews$
DECLARE
    num_reviews INTEGER;
BEGIN
    SELECT COUNT(u.id) into num_reviews
    FROM key k, offer o, regular_user u
    WHERE key_var = k.id and k.offer = o.id and o.seller = u.id
    GROUP BY k.id
    LIMIT 1;
    RETURN num_reviews;
END;
$num_reviews$ LANGUAGE plpgsql;

DROP FUNCTION IF EXISTS update_seller_feedback() CASCADE;
CREATE OR REPLACE FUNCTION update_seller_feedback()
RETURNS TRIGGER AS $$
DECLARE
    num_reviews INTEGER;
    total_feedback float;
    bool_aux BOOLEAN;
BEGIN
    num_reviews := seller_num_reviews(NEW.key);

    SELECT u.rating into total_feedback
    FROM key k, offer o, regular_user u
    WHERE NEW.key = k.id and k.offer = o.id and o.seller = u.id;

    total_feedback := total_feedback * num_reviews;

    bool_aux:=NEW.evaluation;

    IF bool_aux THEN 
        total_feedback := (total_feedback + 1) / (num_reviews + 1);
    ELSE 
        total_feedback := total_feedback / (num_reviews + 1);
    END IF;
	
    UPDATE regular_user 
    SET rating = total_feedback
    WHERE regular_user.id in (
        SELECT distinct seller.id
        FROM key k, offer o, regular_user seller
        WHERE NEW.key = k.id and k.offer = o.id and 
            o.seller= seller.id
    );
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_seller_feedback_tg ON feedback CASCADE;
CREATE TRIGGER update_seller_feedback_tg 
AFTER INSERT
ON feedback
FOR EACH ROW 
EXECUTE PROCEDURE update_seller_feedback();

--TRIGGER 5
DROP FUNCTION IF EXISTS check_user_bought_product() CASCADE;
CREATE OR REPLACE FUNCTION check_user_bought_product()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT *
        FROM orders o, key k
        WHERE NEW.key = k.id and k.orders = o.id 
            and o.regular_user = NEW.regular_user
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


--TRIGGER 7
DROP FUNCTION IF EXISTS delete_cart_after_purchase() CASCADE;
CREATE OR REPLACE FUNCTION delete_cart_after_purchase()
RETURNS TRIGGER AS $$
BEGIN
    DELETE FROM cart
    WHERE buyer = NEW.buyer;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS delete_cart_after_purchase_tg ON orders CASCADE;
CREATE TRIGGER delete_cart_after_purchase_tg AFTER INSERT OR UPDATE 
ON orders
FOR EACH ROW 
EXECUTE PROCEDURE delete_cart_after_purchase();

--TRIGGER 8
DROP FUNCTION IF EXISTS update_product_stock() CASCADE;
CREATE OR REPLACE FUNCTION update_product_stock()
RETURNS TRIGGER AS $$
DECLARE
    stock_var INTEGER;
BEGIN
    UPDATE offer
    SET offer.stock = stock - 1
    WHERE offer.id IN (SELECT distinct offer FROM key WHERE orders = NEW.id);        
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_product_stock_tg ON orders CASCADE;
CREATE TRIGGER update_product_stock_tg AFTER INSERT OR UPDATE 
ON orders
FOR EACH ROW 
EXECUTE PROCEDURE update_product_stock();

--TRIGGER 9
DROP FUNCTION IF EXISTS delete_from_cart() CASCADE;
CREATE OR REPLACE FUNCTION delete_from_cart()
RETURNS TRIGGER AS $$
DECLARE
    deleted_var BOOLEAN;
BEGIN
    deleted_var:=NEW.deleted;
    IF deleted_var THEN
        DELETE FROM cart
        WHERE offer in (SELECT offer.id FROM offer where                                         offer.product=NEW.id
                        );
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS delete_from_cart_tg ON product CASCADE;
CREATE TRIGGER delete_from_cart_tg AFTER INSERT OR UPDATE 
ON product
FOR EACH ROW 
EXECUTE PROCEDURE delete_from_cart();


--TRIGGER 1
DROP FUNCTION IF EXISTS product_name_tsvector() CASCADE;
CREATE OR REPLACE FUNCTION product_name_tsvector()
RETURNS TRIGGER AS $$
BEGIN
    IF TG_OP = 'INSERT' THEN
        NEW.name_tsvector := to_tsvector('english', NEW.name);
    END IF;
    IF TG_OP = 'UPDATE' AND NEW.name <> OLD.name THEN
       NEW.name_tsvector := to_tsvector('english', NEW.name); 
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS product_name_tsvector_tg ON product;
CREATE TRIGGER product_name_tsvector_tg 
BEFORE INSERT OR UPDATE 
ON product
FOR EACH ROW 
EXECUTE PROCEDURE product_name_tsvector();