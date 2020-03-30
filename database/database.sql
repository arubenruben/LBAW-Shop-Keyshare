
DROP TABLE IF EXISTS faq CASCADE;
DROP TABLE IF EXISTS about_us CASCADE;
DROP TABLE IF EXISTS cart_has_offer CASCADE;
DROP TABLE IF EXISTS cart CASCADE;
DROP TABLE IF EXISTS order_has_key CASCADE;
DROP TABLE IF EXISTS message CASCADE;
DROP TABLE IF EXISTS report CASCADE;
DROP TABLE IF EXISTS feedback CASCADE;
DROP TABLE IF EXISTS keys CASCADE;
DROP TABLE IF EXISTS "admin" CASCADE;
DROP TABLE IF EXISTS ban_appeal CASCADE;
DROP TABLE IF EXISTS banned_user CASCADE;
DROP TABLE IF EXISTS discount CASCADE;
DROP TABLE IF EXISTS offer CASCADE;
DROP TABLE IF EXISTS regular_user CASCADE;
DROP TABLE IF EXISTS deleted_product_has_genre CASCADE;
DROP TABLE IF EXISTS active_product_has_genre CASCADE;
DROP TABLE IF EXISTS deleted_product_has_platform CASCADE;
DROP TABLE IF EXISTS active_product_has_platform CASCADE;
DROP TABLE IF EXISTS deleted_product CASCADE;
DROP TABLE IF EXISTS active_product CASCADE;
DROP TABLE IF EXISTS image CASCADE;
DROP TABLE IF EXISTS platform CASCADE;
DROP TABLE IF EXISTS genre CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS orders CASCADE;

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

CREATE TABLE active_product (
  id serial PRIMARY KEY,
  name TEXT NOT NULL UNIQUE,
  description TEXT,
  category integer REFERENCES category (id) ON DELETE SET NULL ON UPDATE CASCADE,
  image integer DEFAULT 1 NOT NULL REFERENCES image (id) ON DELETE SET DEFAULT ON UPDATE CASCADE
);

CREATE TABLE deleted_product (
  id serial PRIMARY KEY,
  name TEXT NOT NULL UNIQUE,
  description TEXT,
  category integer REFERENCES category(id) ON DELETE SET NULL ON UPDATE CASCADE, 
  image integer DEFAULT 1 NOT NULL REFERENCES image(id) ON DELETE SET DEFAULT ON UPDATE CASCADE
);

CREATE TABLE active_product_has_genre (
  genre integer NOT NULL REFERENCES genre(id) ON DELETE CASCADE ON UPDATE CASCADE,
  active_product integer NOT NULL REFERENCES active_product(id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (genre, active_product)
);

CREATE TABLE deleted_product_has_genre (
  genre integer REFERENCES genre(id) ON DELETE CASCADE ON UPDATE CASCADE,
  deleted_product integer REFERENCES deleted_product(id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (genre, deleted_product)
);

CREATE TABLE active_product_has_platform(
  platform integer REFERENCES platform(id) ON DELETE CASCADE ON UPDATE CASCADE,
  active_product integer REFERENCES active_product(id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (platform,active_product)
);

CREATE TABLE deleted_product_has_platform(
  platform integer REFERENCES platform(id) ON DELETE CASCADE ON UPDATE CASCADE,
  deleted_product integer REFERENCES deleted_product(id) ON DELETE CASCADE ON UPDATE CASCADE ,
  PRIMARY KEY (platform,deleted_product)
);

CREATE TABLE regular_user (
  id serial PRIMARY KEY,
  username TEXT NOT NULL UNIQUE,
  email TEXT NOT NULL UNIQUE,
  description TEXT,
  "password" TEXT NOT NULL,
  rating integer NOT NULL,
  birth_date date NOT NULL,
  paypal TEXT,
  image integer NOT NULL DEFAULT 0 REFERENCES image(id) ON DELETE SET DEFAULT ON UPDATE CASCADE,
  
  CONSTRAINT rating_ck CHECK (
    rating >= 0
    AND rating <= 100
  ),
  CONSTRAINT birthdate_ck CHECK (date_part('year',age(birth_date)) >= 18)
);

CREATE TABLE offer (
  id serial PRIMARY KEY,
  price REAL NOT NULL,
  init_date date NOT NULL DEFAULT now(),
  final_date date,
  profit REAL DEFAULT 0,
  
  platform integer NOT NULL REFERENCES platform(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  seller integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  active_product integer REFERENCES active_product(id) ON DELETE SET NULL ON UPDATE CASCADE, 
  deleted_product integer REFERENCES deleted_product(id) ON DELETE SET NULL ON UPDATE CASCADE, 
  
  CONSTRAINT price_ck CHECK (price > 0),
  CONSTRAINT init_date_ck CHECK (init_date <= now()),
  CONSTRAINT final_date_ck CHECK (
    (final_date is NULL)
    or (final_date >= init_date)
  ),
  CONSTRAINT profit_ck CHECK (profit >= 0),
  CONSTRAINT product_type_ck CHECK(
    (
      active_product is NULL
      and deleted_product is NOT NULL
    )
    or (
      active_product is NOT NULL
      and deleted_product is NULL
    )
  )
);

CREATE TABLE discount (
  id serial PRIMARY KEY,
  rate integer NOT NULL,
  start_date date NOT NULL,
  end_date date NOT NULL,
  offer integer NOT NULL REFERENCES offer(id) ON DELETE CASCADE ON UPDATE CASCADE,
  
  CONSTRAINT start_date_ck CHECK (start_date >= now()),
  CONSTRAINT end_date_ck CHECK (end_date > start_date),
  CONSTRAINT rate_ck CHECK (
    (
      (rate >= 0)
      AND (rate <= 100)
    )
  )
);

CREATE TABLE banned_user (
  regular_user integer PRIMARY KEY REFERENCES regular_user(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE "admin" (
  id serial PRIMARY KEY,
  username TEXT NOT NULL UNIQUE,
  email TEXT NOT NULL UNIQUE,
  description TEXT,
  password TEXT NOT NULL,
  image integer NOT NULL DEFAULT 0 REFERENCES image(id) ON DELETE SET DEFAULT ON UPDATE CASCADE
);

CREATE TABLE ban_appeal (
  banned_user integer PRIMARY KEY REFERENCES banned_user(regular_user) ON DELETE CASCADE ON UPDATE CASCADE,
  "admin" integer REFERENCES "admin"(id) ON DELETE SET NULL ON UPDATE CASCADE,
  ban_appeal TEXT NOT NULL,
  date date NOT NULL DEFAULT now(),

  CONSTRAINT date_ck CHECK(date <= now())
);

CREATE TABLE orders (
  id serial PRIMARY KEY,
  order_number integer NOT NULL UNIQUE,
  date date NOT NULL DEFAULT now(),
  regular_user integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,

  CONSTRAINT date_ck CHECK(date <= now())
);

CREATE TABLE keys (
  id serial PRIMARY KEY,
  keys TEXT NOT NULL UNIQUE,
  offer integer REFERENCES offer(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE feedback (
  id serial PRIMARY KEY,
  evaluation boolean NOT NULL,
  comment TEXT,
  regular_user integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  keys integer NOT NULL REFERENCES keys(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE report (
  id serial PRIMARY KEY,
  date date NOT NULL DEFAULT now(),
  description TEXT NOT NULL,
  title TEXT NOT NULL,
  keys integer NOT NULL UNIQUE REFERENCES keys(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  reporter integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  reportee integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT user_ck CHECK(reporter <> reportee),
  CONSTRAINT date_ck CHECK(date <= now())
);

CREATE TABLE message (
  id serial PRIMARY KEY,
  date date NOT NULL DEFAULT now(),
  description TEXT NOT NULL,
  regular_user integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  "admin" integer REFERENCES "admin"(id) ON DELETE SET NULL ON UPDATE CASCADE,
  report integer NOT NULL REFERENCES report(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT date_ck CHECK(date <= now()),
  CONSTRAINT user_type_ck CHECK(
    (
      regular_user is NULL
      and "admin" is NOT NULL
    )
    or (
      regular_user is NOT NULL
      and "admin" is NULL
    )
  )
);

CREATE TABLE order_has_key (
  keys integer PRIMARY KEY REFERENCES keys(id) ON DELETE RESTRICT ON UPDATE CASCADE ,
  orders integer NOT NULL REFERENCES orders(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  price REAL NOT NULL,
  CONSTRAINT price_ck CHECK(price > 0)
);

CREATE TABLE cart (
  id serial PRIMARY KEY,
  regular_user integer NOT NULL REFERENCES regular_user ON DELETE CASCADE ON UPDATE CASCADE,
  offer integer NOT NULL REFERENCES offer ON DELETE CASCADE ON UPDATE CASCADE
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