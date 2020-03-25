
DROP TABLE IF EXISTS category CASCADE;

CREATE TABLE category (
  id serial PRIMARY KEY,
  "name" TEXT NOT NULL UNIQUE
);

DROP TABLE IF EXISTS genre CASCADE;

CREATE TABLE genre (
  id serial PRIMARY KEY,
  "name" TEXT NOT NULL UNIQUE
);

DROP TABLE IF EXISTS platform CASCADE;

CREATE TABLE platform (
  id serial PRIMARY KEY,
  name TEXT NOT NULL UNIQUE
);

DROP TABLE IF EXISTS "image" CASCADE;

CREATE TABLE "image" (
  id serial PRIMARY KEY,
  url TEXT NOT NULL UNIQUE
);

DROP TABLE IF EXISTS active_product CASCADE;

CREATE TABLE active_product (
  id serial PRIMARY KEY,
  name TEXT NOT NULL UNIQUE,
  description TEXT,
  id_category integer REFERENCES category (id) ON DELETE SET NULL ON UPDATE CASCADE,
  id_platform integer NOT NULL REFERENCES platform (id) ON DELETE RESTRICT ON UPDATE CASCADE,
  id_image integer DEFAULT 1 NOT NULL REFERENCES "image" (id) ON DELETE SET DEFAULT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS deleted_product CASCADE;

CREATE TABLE deleted_product (
  id serial PRIMARY KEY,
  name TEXT NOT NULL UNIQUE,
  description TEXT,
  id_category integer REFERENCES category(id) ON DELETE SET NULL ON UPDATE CASCADE, 
  id_platform integer NOT NULL REFERENCES platform(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  id_image integer DEFAULT 1 NOT NULL REFERENCES "image"(id) ON DELETE SET DEFAULT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS active_product_has_genre CASCADE;

CREATE TABLE active_product_has_genre (
  id_genre integer NOT NULL REFERENCES genre(id) ON DELETE CASCADE ON UPDATE CASCADE,
  id_active_product integer NOT NULL REFERENCES active_product(id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (id_genre, id_active_product)
);

DROP TABLE IF EXISTS deleted_product_has_genre CASCADE;

CREATE TABLE deleted_product_has_genre (
  id_genre integer REFERENCES genre(id) ON DELETE CASCADE ON UPDATE CASCADE,
  id_deleted_product integer REFERENCES deleted_product(id) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (id_genre, id_deleted_product)
);

DROP TABLE IF EXISTS regular_user CASCADE;

CREATE TABLE regular_user (
  id serial PRIMARY KEY,
  username TEXT NOT NULL UNIQUE,
  email TEXT NOT NULL UNIQUE,
  description TEXT,
  "password" TEXT NOT NULL,
  rating integer NOT NULL,
  birth_date date NOT NULL,
  paypal TEXT,
  id_image integer NOT NULL DEFAULT 0 REFERENCES "image"(id) ON DELETE SET DEFAULT ON UPDATE CASCADE,
  
  CONSTRAINT rating_ck CHECK (
    rating >= 0
    AND rating <= 100
  ),
  CONSTRAINT birthdate_ck CHECK (date_part('year',age(birth_date)) >= 18)
);

DROP TABLE IF EXISTS offer CASCADE;

CREATE TABLE offer (
  id serial PRIMARY KEY,
  price REAL NOT NULL,
  init_date date NOT NULL DEFAULT now(),
  final_date date,
  profit REAL DEFAULT 0,
  
  id_platform integer NOT NULL REFERENCES platform(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  id_regular_user integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  id_active_product integer REFERENCES active_product(id) ON DELETE SET NULL ON UPDATE CASCADE, 
  id_deleted_product integer REFERENCES deleted_product(id) ON DELETE SET NULL ON UPDATE CASCADE, 
  
  CONSTRAINT price_ck CHECK (price > 0),
  CONSTRAINT init_date_ck CHECK (init_date <= now()),
  CONSTRAINT final_date_ck CHECK (
    (final_date is NULL)
    or (final_date >= init_date)
  ),
  CONSTRAINT profit_ck CHECK (profit >= 0),
  CONSTRAINT product_type_ck CHECK(
    (
      id_active_product is NULL
      and id_deleted_product is NOT NULL
    )
    or (
      id_active_product is NOT NULL
      and id_deleted_product is NULL
    )
  )
);

DROP TABLE IF EXISTS discount CASCADE;
CREATE TABLE discount (
  id serial PRIMARY KEY,
  rate integer NOT NULL,
  start_date date NOT NULL,
  end_date date NOT NULL,
  id_offer integer NOT NULL REFERENCES offer(id) ON DELETE CASCADE ON UPDATE CASCADE,
  
  CONSTRAINT start_date_ck CHECK (start_date >= now()),
  CONSTRAINT end_date_ck CHECK (end_date > start_date),
  CONSTRAINT rate_ck CHECK (
    (
      (rate >= 0)
      AND (rate <= 100)
    )
  )
);

DROP TABLE IF EXISTS banned_user CASCADE;

CREATE TABLE banned_user (
  id_regular_user serial PRIMARY KEY REFERENCES regular_user(id) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS "admin" CASCADE;

CREATE TABLE "admin" (
  id serial PRIMARY KEY,
  username TEXT NOT NULL UNIQUE,
  email TEXT NOT NULL UNIQUE,
  description TEXT,
  password TEXT NOT NULL,
  id_image integer NOT NULL DEFAULT 0 REFERENCES "image"(id) ON DELETE SET DEFAULT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS ban_appeal CASCADE;

CREATE TABLE ban_appeal (
  id_banned_user integer PRIMARY KEY REFERENCES banned_user(id_regular_user) ON DELETE CASCADE ON UPDATE CASCADE,
  id_admin integer REFERENCES "admin"(id) ON DELETE SET NULL ON UPDATE CASCADE,
  ban_appeal TEXT NOT NULL,
  date date NOT NULL DEFAULT now(),

  CONSTRAINT date_ck CHECK(date <= now())
);

DROP TABLE IF EXISTS "order" CASCADE;

CREATE TABLE "order" (
  id serial PRIMARY KEY,
  order_number integer NOT NULL UNIQUE,
  date date NOT NULL DEFAULT now(),
  id_regular_user integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,

  CONSTRAINT date_ck CHECK(date <= now())
);

DROP TABLE IF EXISTS "key" CASCADE;

CREATE TABLE "key" (
  id serial PRIMARY KEY,
  key TEXT NOT NULL UNIQUE,
  id_offer integer REFERENCES offer(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS feedback CASCADE;

CREATE TABLE feedback (
  id serial PRIMARY KEY,
  evaluation integer NOT NULL,
  "comment" TEXT,
  id_regular_user integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  id_key integer NOT NULL REFERENCES "key"(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS report CASCADE;

CREATE TABLE report (
  id serial PRIMARY KEY,
  date date NOT NULL DEFAULT now(),
  description TEXT NOT NULL,
  title TEXT NOT NULL,
  id_key integer NOT NULL UNIQUE REFERENCES "key"(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  reporter integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  reportee integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT user_ck CHECK(reporter <> reportee),
  CONSTRAINT date_ck CHECK(date <= now())
);

DROP TABLE IF EXISTS "message" CASCADE;

CREATE TABLE "message" (
  id serial PRIMARY KEY,
  date date NOT NULL DEFAULT now(),
  description TEXT NOT NULL,
  id_regular_user integer REFERENCES regular_user(id) ON DELETE SET NULL ON UPDATE CASCADE,
  id_admin integer REFERENCES "admin"(id) ON DELETE SET NULL ON UPDATE CASCADE,
  id_report integer NOT NULL REFERENCES report(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT date_ck CHECK(date <= now()),
  CONSTRAINT user_type_ck CHECK(
    (
      id_regular_user is NULL
      and id_admin is NOT NULL
    )
    or (
      id_regular_user is NOT NULL
      and id_admin is NULL
    )
  )
);

DROP TABLE IF EXISTS order_has_key CASCADE;

CREATE TABLE order_has_key (
  id_key integer PRIMARY KEY REFERENCES "key"(id) ON DELETE RESTRICT ON UPDATE CASCADE ,
  id_order integer NOT NULL REFERENCES "order"(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  price REAL NOT NULL,
  CONSTRAINT price_ck CHECK(price > 0)
);

DROP TABLE IF EXISTS cart CASCADE;

CREATE TABLE cart (
  id serial PRIMARY KEY,
  id_regular_user integer UNIQUE  REFERENCES regular_user(id) ON DELETE CASCADE ON UPDATE CASCADE
);

DROP TABLE IF EXISTS cart_has_offer CASCADE;

CREATE TABLE cart_has_offer (
  id_cart serial PRIMARY KEY,
  id_offer integer NOT NULL,
  FOREIGN KEY (id_cart) REFERENCES cart(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (id_offer) REFERENCES "offer"(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

DROP TABLE IF EXISTS about_us CASCADE;

CREATE TABLE about_us (
  id serial PRIMARY KEY,
  description TEXT NOT NULL
);

DROP TABLE IF EXISTS faq CASCADE;

CREATE TABLE faq (
  id serial PRIMARY KEY,
  question TEXT NOT NULL,
  answer TEXT NOT NULL
);