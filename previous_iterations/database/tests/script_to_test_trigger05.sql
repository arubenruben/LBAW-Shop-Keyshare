DROP FUNCTION IF EXISTS seller_num_reviews(integer) CASCADE;
CREATE OR REPLACE FUNCTION seller_num_reviews(seller_id integer)
RETURNS INTEGER AS $num_reviews$
DECLARE
    num_reviews integer;
BEGIN
    SELECT COUNT(u.id) INTO num_reviews
    FROM feedback f JOIN key k ON f.key = k.id
	JOIN offer o ON k.offer = o.id
	JOIN regular_user u ON o.seller = u.id
    WHERE u.id = seller_id
    GROUP BY u.id;
	
	IF num_reviews IS NULL THEN
	 	num_reviews := 0;
	END IF;	
		
    RETURN num_reviews;
END;
$num_reviews$ LANGUAGE plpgsql;

DROP FUNCTION IF EXISTS seller_positive_reviews(integer) CASCADE;
CREATE OR REPLACE FUNCTION seller_positive_reviews(seller_id integer)
RETURNS INTEGER AS $positive_reviews$
DECLARE
    positive_reviews integer;
BEGIN
    SELECT COUNT(u.id) INTO positive_reviews
    FROM feedback f JOIN key k ON f.key = k.id
	JOIN offer o ON k.offer = o.id
	JOIN regular_user u ON o.seller = u.id
    WHERE f.evaluation = true and u.id = seller_id
    GROUP BY u.id;
	
	IF positive_reviews IS NULL THEN
	 	positive_reviews := 0;
	END IF;	
		
    RETURN positive_reviews;
END;
$positive_reviews$ LANGUAGE plpgsql;

DROP FUNCTION IF EXISTS get_seller_through_key(integer) CASCADE;
CREATE OR REPLACE FUNCTION get_seller_through_key(key_id integer)
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

DROP FUNCTION IF EXISTS update_seller_feedback() CASCADE;
CREATE OR REPLACE FUNCTION update_seller_feedback()
RETURNS TRIGGER AS $$
DECLARE
	seller_id integer;
	positive_reviews integer;
	num_reviews integer;
	total_feedback float;
BEGIN
	seller_id := get_seller_through_key(NEW.key);
	positive_reviews := seller_positive_reviews(seller_id);
    num_reviews := seller_num_reviews(seller_id);
	total_feedback := 100 * (positive_reviews / num_reviews);
	
    UPDATE regular_user 
    SET rating = total_feedback
    WHERE regular_user.id IN (
		SELECT u.id
		FROM key k JOIN offer o ON k.offer = o.id
		JOIN regular_user u ON o.seller = u.id
		WHERE k.id = NEW.key
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



--select * from key where offer = 72; -- offer do seller com id = 1
--select * from feedback where key = 91; -- feedback relativo a essa offer (stock = 1)
--INSERT INTO feedback (id, evaluation, comment, regular_user, key) values (9187, true, 'tempus vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam', 2, 91);
-- apagar -> INSERT INTO feedback (id, evaluation, comment, regular_user, key) values (91877, true, 'tempus vivamus in felis eu sapien cursus vestibulum proin eu mi nulla ac enim in tempor turpis nec euismod scelerisque quam', 2, 91);


select * from regular_user where id = 1;
--delete from feedback where id = 9187;

--select seller_num_reviews(1);
--select seller_positive_reviews(1);
--select get_seller_through_key(91);


-- meter feedback do user1 para ter feedback null para experimentar e dps
-- testar com o insert













