DROP FUNCTION IF EXISTS product_name_tsvector() CASCADE;
CREATE OR REPLACE FUNCTION product_name_tsvector()
RETURNS TRIGGER AS $$
BEGIN
    IF (TG_OP = 'INSERT') THEN
        NEW.name_tsvector = to_tsvector('english', NEW.name);
    ELSIF (TG_OP = 'UPDATE') THEN
        IF NEW.name <> OLD.name THEN
            NEW.name_tsvector = to_tsvector('english', NEW.name);
        END IF;
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS product_name_tsvector_tg ON product;
CREATE TRIGGER product_name_tsvector_tg 
AFTER INSERT OR UPDATE 
ON product
FOR EACH ROW 
EXECUTE PROCEDURE product_name_tsvector();

DROP FUNCTION IF EXISTS active_products();
CREATE OR REPLACE FUNCTION active_products()
RETURNS TABLE(
    id INTEGER,
    name TEXT, 
    name_tsvector TSVECTOR,
    description TEXT, 
    launch_date DATE, 
    category INT, 
    platform INT, 
    image INTEGER
) AS $$
 BEGIN
  RETURN query 
     SELECT DISTINCT 
        p.id, 
        p.name,
        p.name_tsvector,
        p.description, 
        p.launch_date, 
        p.category, 
        pf.platform, 
        p.image
    FROM 
        product AS p, 
        product_has_platform AS pf 
    WHERE 
        p.deleted = FALSE
        AND p.id = pf.product;
 END $$
 LANGUAGE plpgsql;

DROP INDEX IF EXISTS product_name_idx;
CREATE INDEX product_name_idx 
ON product
USING GIN(name_tsvector);

DELETE FROM product WHERE id = 1;
INSERT INTO product(id,name,description,category,image,deleted, launch_date)VALUES(1,'Red Dead Redemption 2','America, 1899. The end of the wild west era has begun as lawmen hunt down the last remaining outlaw gangs. Those who will not surrender or succumb are killed. After a robbery goes badly wrong in the western town of Blackwater, Arthur Morgan and the Van der Linde gang are forced to flee. With federal agents and the best bounty hunters in the nation massing on their heels, the gang must rob, steal and fight their way across the rugged heartland of America in order to survive. As deepening internal divisions threaten to tear the gang apart, Arthur must make a choice between his own ideals and loyalty to the gang who raised him.From the creators of Grand Theft Auto V and Red Dead Redemption, Red Dead Redemption 2 is an epic tale of life in America at the dawn of the modern age.',0,1,FALSE,'2018-12-15 06:42:26');
INSERT INTO product_has_genre(genre,product)VALUES(0,1);
INSERT INTO product_has_genre(genre,product)VALUES(6,1);
INSERT INTO product_has_platform(platform,product)VALUES(0,1);
INSERT INTO product_has_platform(platform,product)VALUES(1,1);
INSERT INTO product_has_platform(platform,product)VALUES(4,1);
INSERT INTO product_has_platform(platform,product)VALUES(3,1);

SELECT *
FROM product
WHERE name ILIKE 'Red Dead Redemption 2'