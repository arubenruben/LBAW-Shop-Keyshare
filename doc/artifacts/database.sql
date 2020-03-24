CREATE TABLE active_product (
    id SERIAL,
    name TEXT NOT NULL UNIQUE,
    description TEXT,
    id_category INTEGER NOT NULL REFERENCES category (id),
    id_platform INTEGER NOT NULL REFERENCES platform (id),
    id_image INTEGER DEFAULT 1 NOT NULL REFERENCES "image" (id),

    PRIMARY KEY (id),
    FOREIGN KEY (id_category) REFERENCES category(id),,
    FOREIGN KEY (id_platform) REFERENCES platform(id),
    FOREIGN KEY (id_image) REFERENCES "image"(id),
);

CREATE TABLE delected_product (
    id SERIAL,
    name TEXT NOT NULL UNIQUE,
    description TEXT,
    id_category INTEGER NOT NULL,
    id_platform INTEGER NOT NULL,
    id_image INTEGER NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (id_category) REFERENCES category(id),,
    FOREIGN KEY (id_platform) REFERENCES platform(id),
    FOREIGN KEY (id_image) REFERENCES "image"(id),
);


CREATE TABLE category (
    id SERIAL,
    "name" TEXT NOT NULL UNIQUE,

    PRIMARY KEY (id)
);

CREATE TABLE genre (
    id SERIAL,
    "name" TEXT NOT NULL UNIQUE,

    PRIMARY KEY (id)
);


CREATE TABLE platform (
    id SERIAL,
    name TEXT NOT NULL UNIQUE,

    PRIMARY KEY (id)
);


CREATE TABLE active_product_has_genre (
    id_genre INTEGER NOT NULL,
    id_active_product INTEGER NOT NULL,
    
    PRIMARY KEY (id_genre, id_active_product),
    FOREIGN KEY (id_genre) REFERENCES genre(id),
    FOREIGN KEY (id_active_product) REFERENCES active_product(id)
);

CREATE TABLE deleted_product_has_genre (
    id_genre INTEGER,
    id_deleted_product INTEGER,
    
    PRIMARY KEY (id_genre, id_deleted_product),
    FOREIGN KEY (id_genre) REFERENCES genre(id),
    FOREIGN KEY (id_deleted_product) REFERENCES deleted_product(id)
);
 
CREATE TABLE offer_product (
    id SERIAL,
    price REAL NOT NULL,
    init_date date NOT NULL DEFAULT now(),
    final_date date,
    profit REAL DEFAULT 0,
    id_platform integer NOT NULL,
    id_regular_user integer NOT NULL,
    id_active_product integer,
    id_deleted_product integer,

    PRIMARY KEY (id),
    FOREIGN KEY (id_platform) REFERENCES platform(id),
    FOREIGN KEY (id_regular_user) REFERENCES regular_user(id),
    FOREIGN KEY (id_active_product) REFERENCES active_product(id),
    FOREIGN KEY (id_deleted_product) REFERENCES delected_product(id),
    CONSTRAINT price_ck CHECK (price > 0),
    CONSTRAINT init_date_ck CHECK (init_date <= now()),
    CONSTRAINT final_date_ck CHECK ((final_date is NULL) or (final_date >= init_date)),
    CONSTRAINT profit_ck CHECK (profit >= 0),
    CONSTRAINT product_type_ck CHECK((id_active_product is NULL and id_deleted_product is NOT NULL) or (id_active_product is NOT NULL and id_deleted_product is NULL))
);

CREATE TABLE discount (
    id SERIAL,
    rate INTEGER NOT NULL,
    start_date DATE NOT NULL, 
    end_date DATE NOT NULL, 
    id_active_offer INTEGER NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (id_active_offer) REFERENCES offer_active_product(id),
    CONSTRAINT start_date_ck CHECK (start_date >= CURRENT_DATE)
    CONSTRAINT end_date_ck CHECK (end_date > start_date)
    CONSTRAINT rate_ck CHECK (((rate => 0) OR (rate <= 100))),
);

CREATE TABLE "image" (
    id SERIAL,
    url TEXT NOT NULL UNIQUE,

    PRIMARY KEY (id),
);

CREATE TABLE regular_user (
    id SERIAL,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    description TEXT,
    "password" TEXT NOT NULL,
    rating INTEGER NOT NULL,
    birth_date DATE NOT NULL,
    paypal TEXT,
    id_image INTEGER NOT NULL DEFAULT 0,

    PRIMARY KEY (id),
    FOREIGN KEY (id_image) REFERENCES "image"(id),
    CONSTRAINT rating_ck CHECK (rating >= 0 AND rating <= 100),
    CONSTRAINT birthdate_ck CHECK (age(birth_date) >= "18 years")
);

CREATE TABLE banned_user (
    id_regular_user SERIAL,
    
    PRIMARY KEY (id_regular_user),
    FOREIGN KEY (id_regular_user) REFERENCES regular_user(id)
);

CREATE TABLE ban_appeal (
    id_banned_user INTEGER,
    id_admin INTEGER,
    ban_appeal TEXT NOT NULL,
    date DATE NOT NULL DEFAULT now(),

    PRIMARY KEY (id_banned_user),
    FOREIGN KEY (id_banned_user) REFERENCES banned_user(id_regular_user),
    FOREIGN KEY (id_admin) REFERENCES "admin"(id),
    CONSTRAINT date_ck CHECK(date <= now())
);

CREATE TABLE "admin" (
    id SERIAL,
    username TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    description TEXT,
    password TEXT NOT NULL,
    id_image INTEGER NOT NULL DEFAULT 0,

    PRIMARY KEY (id),
    FOREIGN KEY (id_image) REFERENCES "image"(id)
);

CREATE TABLE "order" (
    id SERIAL,
    order_number INTEGER NOT NULL UNIQUE,
    date DATE NOT NULL DEFAULT now(),
    id_regular_user INTEGER NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (id_regular_user) REFERENCES regular_user(id),
    CONSTRAINT date_ck CHECK(date <= now())
);

CREATE TABLE feedback (
    id SERIAL,
    evaluation INTEGER NOT NULL,
    "comment" TEXT,
    id_regular_user INTEGER NOT NULL,
    id_key INTEGER NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (id_regular_user) REFERENCES regular_user(id),
    FOREIGN KEY (id_key) REFERENCES "key"(id)
);

CREATE TABLE "message" (
    id SERIAL,
    date DATE NOT NULL DEFAULT now(),
    description TEXT NOT NULL,
    id_regular_user INTEGER,
    id_admin INTEGER,
    id_report INTEGER NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (id_regular_user) REFERENCES regular_user(id),
    FOREIGN KEY (id_admin) REFERENCES "admin"(id),
    FOREIGN KEY (id_report) REFERENCES report(id),
    CONSTRAINT date_ck CHECK(date <= now()),
    CONSTRAINT user_type_ck CHECK((id_regular_user is NULL and id_admin is NOT NULL) or (id_regular_user is NOT NULL and id_admin is NULL))
);

CREATE TABLE report (
    id SERIAL,
    date DATE NOT NULL DEFAULT now(),
    description TEXT NOT NULL,
    title TEXT NOT NULL,
    id_key INTEGER NOT NULL UNIQUE,
    reporter INTEGER NOT NULL,
    reportee INTEGER NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (id_key) REFERENCES "key"(id),
    FOREIGN KEY (reporter) REFERENCES regular_user(id),
    FOREIGN KEY (reportee) REFERENCES regular_user(id),
    CONSTRAINT user_ck CHECK(reporter <> reportee),
    CONSTRAINT date_ck CHECK(date <= now())
);

CREATE TABLE "key" (
    id SERIAL,
    key TEXT NOT NULL UNIQUE,
    id_offer INTEGER NOT NULL,

    PRIMARY KEY (id),
    FOREIGN KEY (id_offer) REFERENCES offer_active_product(id)
);

CREATE TABLE order_has_key (
    id_key INTEGER,
    id_order INTEGER NOT NULL,
    price REAL NOT NULL,

    PRIMARY KEY (id_key),
    FOREIGN KEY (id_key) REFERENCES "key"(id), 
    FOREIGN KEY (id_order) REFERENCES "order"(id),
    CONSTRAINT price_ck CHECK(price > 0)
);

CREATE TABLE cart (
    id SERIAL,
    id_regular_user INTEGER NOT NULL UNIQUE

    PRIMARY KEY (id),
    FOREIGN KEY (id_regular_user) REFERENCES regular_user(id)
);

CREATE TABLE cart_has_offer (
    id_cart INTEGER,
    id_offer INTEGER NOT NULL,

    PRIMARY KEY (id_cart),
    FOREIGN KEY (id_cart) REFERENCES cart(id),
    FOREIGN KEY (id_offer) REFERENCES "order"(id) 
);

CREATE TABLE about_us (
    id SERIAL,
    description TEXT NOT NULL,

    PRIMARY KEY (id),
);

CREATE TABLE faq (
    id SERIAL,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,

    PRIMARY KEY (id)
);