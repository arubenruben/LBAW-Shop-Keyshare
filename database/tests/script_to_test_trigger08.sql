DROP FUNCTION IF EXISTS update_product_stock() CASCADE;
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


-- delete from orders where id = 49657;
-- delete from key where id = 11113;
-- delete from offer where id = 1113;
--INSERT INTO offer (id, price, init_date, final_date, profit, platform, seller, product, stock) values (1114, 56.6, '2019-09-05 10:40:29', '2020-07-10 18:11:40', 52.3, 3, 1, 5, 1);
--INSERT INTO key (id, key, price, offer, orders) values (11114, '1MF3y9tyqBHAtyZgtvy9oBdTxe9TGSFJhuFSjW', 17.44, 1114, NULL);
--INSERT INTO orders (id, order_number, date, regular_user) values (49658, 49658, '2015-12-23 22:46:05', 7);

select * from offer where id = 1114;