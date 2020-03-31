DROP FUNCTION IF EXISTS update_product_stock() CASCADE;
CREATE FUNCTION update_product_stock()
RETURNS TRIGGER AS $$
BEGIN
	UPDATE offer
	SET stock = stock - (SELECT COUNT(*) FROM key WHERE orders = NEW.id)
    WHERE offer IN (SELECT offer FROM key WHERE orders = NEW.id);
	return NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER update_product_stock_tg AFTER INSERT OR UPDATE 
ON orders
FOR EACH ROW 
EXECUTE PROCEDURE update_product_stock();

INSERT INTO orders (id, order_number, date, regular_user) values (200, 1000, '2017-05-16 14:27:19', 1);
insert into key (id, key, price, offer, orders) values (139, '1MF39tBHAtyZtvy9oBdTxe9TGSFJhuFSjW', 17.44, 100, 200);
insert into offer (id, price, init_date, final_date, platform, seller, product) values (100, 17.44, '2016-05-16 14:27:19', '2020-07-10 18:11:40', 3, 53, 5);


???