DROP FUNCTION IF EXISTS get_seller_through_key(INTEGER) CASCADE;
CREATE OR REPLACE FUNCTION get_seller_through_key(key_id INTEGER)
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

DROP FUNCTION IF EXISTS seller_num_sells(INTEGER);
CREATE OR REPLACE FUNCTION seller_num_sells(seller_id INTEGER)
RETURNS INTEGER AS $num_sells$
DECLARE 
    num_sells INTEGER;
BEGIN
    num_sells := (
        SELECT COUNT(key.id)
        FROM key JOIN offer ON key.offer = offer.id 
        JOIN regular_user AS seller ON seller.id = offer.seller 
		WHERE seller.id = seller_id
		GROUP BY(seller.id)
    );
    RETURN num_sells;
END; 
$num_sells$ LANGUAGE plpgsql;

DROP FUNCTION IF EXISTS user_num_sells() CASCADE;
CREATE OR REPLACE FUNCTION user_num_sells()
RETURNS TRIGGER AS $$
DECLARE 
    sells INTEGER;
    user_id INTEGER;
BEGIN    
    user_id := get_seller_through_key(NEW.id);
    sells := seller_num_sells(user_id);
    
    UPDATE regular_user
    SET num_sells = sells
	WHERE id = user_id;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS user_num_sells_tg ON orders CASCADE;
CREATE TRIGGER user_num_sells_tg
AFTER UPDATE ON key
FOR EACH ROW 
EXECUTE PROCEDURE user_num_sells();

--select * from key join offer on key.offer = offer.id
--where key.id = 91;
-- user with id = 1 is selling the key 991

--INSERT INTO offer (id, price, init_date, final_date, profit, platform, seller, product) values (1111, 56.6, '2019-09-05 10:40:29', '2020-07-10 18:11:40', 52.3, 3, 1, 5);
--INSERT INTO key (id, key, price, offer, orders) values (11111, '1MF39tBHAtyZgtvy9oBdTxe9TGSFJhuFSjW', 17.44, 1111, NULL);
-- user with id places a offer for product
--INSERT INTO orders (id, order_number, date, regular_user) values (49655, 49655, '2015-12-23 22:46:05', 7);
--UPDATE key SET orders = 49655 WHERE id = 11111;

select * from regular_user where id = 1;











