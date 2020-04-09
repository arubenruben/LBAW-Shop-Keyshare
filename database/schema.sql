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
  
  CONSTRAINT price_ck CHECK(price_sold > 0),
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
  status BOOLEAN NOT NULL,
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


-----------------------------------------
-- INDEXES
-----------------------------------------

-- Performance Indices


-- Full-text Search Indices


-----------------------------------------
-- UDFs and TRIGGERS
-----------------------------------------
