# A6: Indexes, triggers, user functions, transactions and population

The project consists in developing a global marketplace which specializes in the sale of gaming related digital products using redemption keys.

By the end of this sixth artefact we have a clear definiton of every aspect releated with the data base and the date workload expected by the platform and their effects:

* There is a definition of indexes in order to power the performance of the database,
* Triggers to enforce business rules are defined,
* The main queries are already defined by the definition of adequate of stored procedures in the Postgres system.  

# Acabar as queries com funcoes usadas nos triggers para vistas materializaveis
# Meter restricao para n permitir overlap de datas de sale
# Fazer trigger para atualizar as vistas materializaveis
# Acabar full text search
# Verificar pertinencia dos updates
# Verificar indexs
# Fazer transactions



## 1. Database Workload
 
### 1.1. Tuple Estimation
 
| **Relation reference** | **Relation Name** | **Order of magnitude** | **Estimated growth** |
| ---------------------- | ----------------- | ---------------------- | -------------------- |
| R01                    | product           | hundreds               | dozens per month     |
| R02                    | category          | units                  | units per year       |
| R03                    | genre             | dozens                 | units per year       |
| R04                    | platform          | units                  | units per year       |
| R05                    | product_has_genre | thousands              | hundreds per month   |
| R06                    | offer             | thousands              | dozens per day       |
| R07                    | discount          | hundreds               | dozens per month     |
| R08                    | image             | thousands              | hundreds per day       |
| R09                    | regular_user      | thousands              | dozens per day       |
| R010                   | banned_user       | dozens                 | units per month      |
| R011                   | admin             | units                  | units per year            |
| R012                   | user_order        | thousands              | hundreds per day       |
| R013                   | feedback          | thousands              | hundreds per day       |
| R014                   | message           | thousands              | dozens per day      |
| R015                   | report            | hundreds               | dozens per month     |
| R016                   | key               | dozens of thousands    | hundreds per day       |
| R017                   | ban_appeal        | dozens                 | units per month      |
| R019                   | about_us          | units                  |  no growth           |
| R020                   | faq               | dozens                 | units per year       |

### 1.2. Frequent Queries
 

| **Query reference**       | SELECT01                    |
| --------------- | --------------------------- |
| **Query description** | User Login  |
| **Query frequency**   | hundreds per day           |
```sql
SELECT id 
FROM regular_user 
WHERE username = $username AND password = $hashedPassword;
```
# Falta fazer o trigger para lhe dar refresh
---
| **Query reference**       | SELECT02                    |
| --------------- | --------------------------- |
| **Query description** | get active products |
| **Query frequency**   | thousands per day           |
```sql
DROP MATERIALIZED VIEW active_products;
CREATE MATERIALIZED VIEW active_products AS 
    SELECT product.id AS product_id
	FROM product
WHERE product.deleted=FALSE
```
---
| **Query reference**         | SELECT03           |
|-------------------|--------------------|
| **Query description** | Get most popular products and the best avaiable offer for it |
| **Query frequency**   | thousands per day     |

```sql
SELECT product.name AS product_name,platform.name, min(offer.price) AS min_price, max(num_sells) AS num_sells, max(discount.rate) AS discount_rate 
FROM active_products NATURAL JOIN product
	JOIN offer ON offer.product=product.id
	LEFT OUTER JOIN discount ON discount.offer=offer.id
	JOIN product_has_platform pf ON pf.product=product.id
	JOIN platform ON platform.id=pf.platform
WHERE (discount.start_date IS NULL OR (discount.start_date<now() AND discount.end_date > now()))
		AND offer.final_date IS NULL	
GROUP BY product_name,platform.name
ORDER BY num_sells DESC
LIMIT $number_results
```
---
| **Query reference**         | SELECT04           |
|-------------------|--------------------|
| **Query description** | Get most recent products |
| **Query frequency**   | thousands per day     |
```sql
SELECT product.name AS product_name, platform.name, min(offer.price) AS min_price, max(num_sells) AS num_sells, max(discount.rate) AS discount_rate, max(product.launch_date)  AS launch_date
FROM active_products NATURAL JOIN product
	JOIN offer ON offer.product=product.id
	LEFT OUTER JOIN discount ON discount.offer=offer.id
    JOIN product_has_platform pf ON pf.product=product.id
	JOIN platform ON platform.id=pf.platform
WHERE (discount.start_date IS NULL OR (discount.start_date<now() AND discount.end_date > now()))
		AND offer.final_date IS NULL
GROUP BY product_name,platform.name
ORDER BY launch_date DESC
LIMIT $number_results
```
---
| **Query reference**         | SELECT05           |
|-------------------|--------------------|
| **Query description** | Get all products that have certain categories, genres and platforms |
| **Query frequency**   | thousands per day    |
```sql
SELECT product.name AS product_name, min(offer.price) AS min_price, max(num_sells) AS num_sells, max(discount.rate) AS discount_rate, max(product.launch_date)  AS launch_date
FROM active_products NATURAL JOIN product
	JOIN offer ON offer.product=product.id
	LEFT OUTER JOIN discount ON discount.offer=offer.id
	JOIN product_has_genre pg ON pg.product=product.id
	JOIN genre ON pg.genre=genre.id
	JOIN product_has_platform pf ON pf.product=product.id
	JOIN platform ON platform.id=pf.platform
	JOIN category ON category.id=product.category
WHERE (discount.start_date IS NULL OR (discount.start_date<now() AND discount.end_date > now()))AND
		category.name=$category AND 
        platform.name=$platform AND 
        genre.name=$genre
GROUP BY product_name
ORDER BY launch_date DESC
```
---
| **Query reference**         | SELECT06           |
|-------------------|--------------------|
| **Query description** | Sort product's offers by lowest price |
| **Query frequency**   | hundreds per day   |

<!--
```sql
CREATE OR REPLACE FUNCTION offer_price(offer_id INTEGER) RETURNS FLOAT AS $price$
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

SELECT 
    offer.id,
    offer.platform,
    offer.product,
    offer.stock,
    offer.price,
    seller.id,
    seller.username,
    seller.image,
    seller.rating,
    seller.number_sells_done,
    offer_price(offer.id) AS updated_price
FROM 
    offer, 
    regular_user AS seller
WHERE
    offer.seller = seller.id
GROUP BY
    offer.id,
    offer.platform,
    offer.product,
    offer.stock,
    offer.price,
    seller.id,
    seller.username,
    seller.image,
    seller.rating,
    seller.number_sells_done
ORDER BY 
    updated_price, 
    seller.rating DESC,
    seller.number_sells_done DESC;
```
-->

```sql
SELECT seller.username, seller.rating AS seller_rating, seller.num_sells, offer.stock, min(offer.price) AS offer_price, max(discount.rate) AS discount_rate
FROM active_products NATURAL JOIN product
	JOIN offer ON offer.product=product.id
	LEFT OUTER JOIN discount ON discount.offer=offer.id
	JOIN regular_user AS seller ON seller.id=offer.seller
	JOIN platform ON platform.id=offer.platform
WHERE (discount.start_date IS NULL OR (discount.start_date<now() AND discount.end_date > now()))AND
		product.id=$product_id AND platform.id=$platform_id
GROUP BY seller.username, seller.rating, seller.num_sells, offer.stock
ORDER BY offer_price ASC

```

---
| **Query reference**         | SELECT07           |
|-------------------|--------------------|
| **Query description** | Sort  product's offers by seller feedback rating  |
| **Query frequency**   | hundreds per day   |
<!--

```sql
SELECT 
    offer.id,
    offer.platform,
    offer.product,
    offer.stock,
    offer.price,
    seller.id,
    seller.username,
    seller.image,
    seller.rating,
    seller.number_sells_done,
    offer_price(offer.id) AS updated_price
FROM 
    offer,
    regular_user AS seller
WHERE 
    offer.seller = seller.id
GROUP BY
    offer.id,
    offer.platform,
    offer.product,
    offer.stock,
    offer.price,
    seller.id,
    seller.username,
    seller.image,
    seller.rating,
    seller.number_sells_done
ORDER BY 
    seller.rating DESC, 
    seller.number_sells_done DESC, 
    updated_price;
```
-->

```sql
SELECT seller.username, seller.rating AS seller_rating, seller.num_sells, offer.stock, min(offer.price) AS offer_price, max(discount.rate) AS discount_rate
FROM active_products NATURAL JOIN product
	JOIN offer ON offer.product=product.id
	LEFT OUTER JOIN discount ON discount.offer=offer.id
	JOIN regular_user AS seller ON seller.id=offer.seller
	JOIN platform ON platform.id=offer.platform
WHERE (discount.start_date IS NULL OR (discount.start_date<now() AND discount.end_date > now()))AND
		product.id=$product_id AND platform.id=$platform_id
GROUP BY seller.username, seller.rating, seller.num_sells, offer.stock
ORDER BY seller_rating DESC
```
---
| **Query reference**         | SELECT08           |
|-------------------|--------------------|
| **Query description** | Sort seller's feedback by date |
| **Query frequency**   | hundreds per day   |
```sql
SELECT 
    ru.username AS buyer,
    fb.evaluation AS evaluation, 
    fb.comment AS comment, 
    fb.evaluation_date AS feedback_date
FROM 
    feedback AS fb,
    key, 
    offer, 
    regular_user AS ru
WHERE 
    fb.key = key.id 
    AND key.offer = offer.id 
    AND offer.seller = $id
    AND ru.id = fb.buyer
ORDER BY feedback_date DESC;
```
---
| **Query reference**         | SELECT09           |
|-------------------|--------------------|
| **Query description** | Order a list of products by the highest price of the cheapest avaiable offer for that product  |
| **Query frequency**   | magnitude per time   |
```sql
SELECT product.name AS product_name, platform.name, min(offer.price) AS min_price, max(num_sells) AS num_sells, max(discount.rate) AS discount_rate, max(product.launch_date) AS launch_date,image.url AS img_path
FROM active_products NATURAL JOIN product
	JOIN offer ON offer.product=product.id
	LEFT OUTER JOIN discount ON discount.offer=offer.id
	JOIN platform ON platform.id=offer.platform
	JOIN image ON image.id=product.image
WHERE (discount.start_date IS NULL OR (discount.start_date<now() AND discount.end_date > now()))
		AND offer.final_date IS NULL
GROUP BY product_name,platform.name,img_path
ORDER BY min_price DESC
```
---
| **Query reference**         | SELECT10           |
|-------------------|--------------------|
| **Query description** | Select products by lowest price (in relation to the lowest offer)  |
| **Query frequency**   | hundreds per day   |
```sql
SELECT product.name AS product_name, platform.name, min(offer.price) AS min_price, max(num_sells) AS num_sells, max(discount.rate) AS discount_rate, max(product.launch_date) AS launch_date,image.url AS img_path
FROM active_products NATURAL JOIN product
	JOIN offer ON offer.product=product.id
	LEFT OUTER JOIN discount ON discount.offer=offer.id
	JOIN platform ON platform.id=offer.platform
	JOIN image ON image.id=product.image
WHERE (discount.start_date IS NULL OR (discount.start_date<now() AND discount.end_date > now()))
		AND offer.final_date IS NULL
GROUP BY product_name,platform.name,img_path
ORDER BY min_price ASC
```
---
| **Query reference**         | SELECT11           |
|-------------------|--------------------|
| **Query description**   | Select products whose cheapest offer is in a range of prices smaller than a max value defined by the user |
| **Query frequency**   | hundreds per day   |
```sql
SELECT product.name AS product_name, platform.name, min(offer.price) AS min_price, max(num_sells) AS num_sells, max(discount.rate) AS discount_rate, max(product.launch_date) AS launch_date,image.url AS img_path
FROM active_products NATURAL JOIN product
	JOIN offer ON offer.product=product.id
	LEFT OUTER JOIN discount ON discount.offer=offer.id
    JOIN product_has_platform pf ON pf.product=product.id
	JOIN platform ON platform.id=pf.platform
	JOIN image ON image.id=product.image
WHERE (discount.start_date IS NULL OR (discount.start_date<now() AND discount.end_date > now()))
		AND offer.final_date IS NULL
        AND offer.price < $max_price
GROUP BY product_name,platform.name,product.num_sells,img_path
ORDER BY product.num_sells DESC
```
---
| **Query reference**         | SELECT012           |
|-------------------|--------------------|
| **Query description** | search products |
| **Query frequency**   | hundreds per day     |
```sql
SELECT id, name, category, platform, image  
FROM active_products 
WHERE name_tsvector @@ plainto_tsquery($searched);
```

<!--

DUPLICADO COM SELECT 6 e 7

---
| **Query reference**         | SELECT013           |
|-------------------|--------------------|
| **Query description** | return offers for a certain product |
| **Query frequency**   | hundreds per day     |
```sql
SELECT offer.id, seller.username AS username, seller.rating AS rating, seller.number_sales AS number_sales,offer.stock AS stock, image.url AS image_path, discount.rate AS discount_rate
FROM product JOIN offer ON product.id=offer.product 
    LEFT OUTER JOIN discount ON offer.id=discount.offer 
    JOIN platform ON offer.platform=platform.id 
    JOIN regular_user AS seller ON seller.id=offer.seller
    JOIN key ON offer.id=key.offer
    JOIN image ON product.image=image.id
    
WHERE final_date IS NULL AND product.id=$product_id AND platform.name=$platform
```
-->
<!--

DEIXA DE SER PRECISO
---
| **Query reference**         | SELECT014           |
|-------------------|--------------------|
| **Query description** | Check if the available offers for a product are on sale by the time consulted |
| **Query frequency**   | hundreds per day     |
```sql
SELECT offer.id, discount.rate, discount.end_date
FROM product JOIN offer ON product.id=offer.product 
    JOIN discount ON offer.id=discount.offer 
    JOIN platform ON offer.platform=platform.id     
where product.name= $product AND platform.name=$platform AND now()>=discount.start_date AND now()<=discount.end_date
```
-->

---
| **Query reference**         | SELECT015           |
|-------------------|--------------------|
| **Query description** | Get the past purchase history of an user order by date  |
| **Query frequency**   | hundreds per day     |
<!--
```sql
select distinct product.name as product_name,key.key,key.priceSold ,seller_table.username as seller, orders.date, orders.id as order_number, feedback.id, image.url as image_path
from regular_user as buyer_table join orders on buyer_table.id=orders.regular_user  
	join key on key.orders=orders.id
	join offer on key.offer=offer.id 
	join product on offer.product = product.id
	join regular_user as seller_table on seller_table.id=offer.seller
	left outer join feedback on feedback.regular_user=buyer_table.id
	left outer join report on report.reporter=buyer_table.id
    join image on product.image=image.id
	
where buyer_table.id=$user_id
order by date desc
```
-->
```sql
SELECT product.name AS product_name, seller.username AS seller_username, orders.date AS buying_date, key.price_sold AS price, seller.id AS seller_id, key.id AS key_id, feedback.id AS feedback_id
FROM orders JOIN key ON key.orders=orders.id
	JOIN offer ON key.offer=offer.id
	JOIN product ON product.id=offer.product
	JOIN platform ON platform.id=offer.platform
	JOIN image ON product.image=image.id
	JOIN regular_user AS seller ON seller.id=offer.seller
	LEFT OUTER JOIN feedback ON feedback.key=key.id
WHERE orders.buyer=$user_id
ORDER BY buying_date DESC
```

---
| **Query reference**         | SELECT016           |
|-------------------|--------------------|
| **Query description** | Get the user current offers order by date  |
| **Query frequency**   | hundreds per day     |

<!--

```sql
SELECT offer.id AS offer_id, product.name, platform.name, offer.init_date, key.priceSold , image.url AS image_path
FROM product JOIN image ON product.image=image.id 
	JOIN offer ON product.id=offer.product
	JOIN regular_user AS seller ON seller.id=offer.seller
	JOIN product_has_platform as p_h_ptf ON product.id=p_h_ptf.product
	JOIN platform ON platform.id=p_h_ptf.platform
	JOIN key ON key.offer=offer.id

WHERE seller.id=$seller_id AND offer.final_date IS NULL
ORDER BY init_date DESC
```
-->

```sql
SELECT offer.id AS offer_id, product.name AS product_name, offer.stock, platform.name AS platform, offer.init_date AS start_date, offer.price AS offer_price,discount.rate AS discount_rate
FROM offer JOIN platform ON platform.id=offer.platform
	JOIN product ON product.id=offer.product
	LEFT OUTER JOIN discount ON discount.offer=offer.id
WHERE offer.seller=$user_id AND offer.final_date IS NULL AND
		(start_date IS NULL OR (start_date<now() AND offer.final_date >now()))
ORDER BY start_date DESC
```
---
| **Query reference**         | SELECT017           |
|-------------------|--------------------|
| **Query description** | Get the user past offers order by date  |
| **Query frequency**   | hundreds per day     |
<!--
```sql
SELECT offer.id AS offer_id, product.name, platform.name, offer.init_date, key.priceSold , image.url AS image_path
FROM product JOIN image ON product.image=image.id 
	JOIN offer ON product.id=offer.product
	JOIN regular_user AS seller ON seller.id=offer.seller
	JOIN product_has_platform AS p_h_ptf ON product.id=p_h_ptf.product
	JOIN platform ON platform.id=p_h_ptf.platform
	JOIN key ON key.offer=offer.id
    
WHERE seller.id=$seller_id AND offer.final_date IS NOT NULL
ORDER BY init_date DESC
```
-->
```sql
SELECT offer.id AS offer_id, product.name AS product_name, offer.stock, platform.name AS platform, offer.init_date AS start_date, offer.price AS offer_price,discount.rate AS discount_rate
FROM offer JOIN platform ON platform.id=offer.platform
	JOIN product ON product.id=offer.product
	LEFT OUTER JOIN discount ON discount.offer=offer.id
WHERE offer.seller=$user_id AND offer.final_date IS NOT NULL AND
		(start_date IS NULL OR (start_date<now() AND offer.final_date >now()))
ORDER BY start_date DESC

```
# ESTA QUERY TEM UM PROBLEMA QUE RESOLVI AO RETURNAR O COUNT AS N_KEYS PQ NOS TAMOS A PERMITIR DISCONTOS EM OVERLAP. DEPOIS DE RESOLVIDO POSSO VOLTAR ATAS E COLOCARA SEGUNDA QUERY
---
| **Query reference**         | SELECT018           |
|-------------------|--------------------|
| **Query description** | Get the cart content  |
| **Query frequency**   | hundreds per day     |
<!--
```sql
SELECT offer.id as offer_id, product.name , seller.username, key.priceSold,image.url as img_path
FROM regular_user as buyer join cart on buyer.id=cart.regular_user
    JOIN offer on offer.id=cart.offer
	JOIN product on product.id=offer.product
	JOIN regular_user as seller on seller.id=offer.seller
	JOIN key on key.offer=offer.id
	JOIN image on product.image=image.id
WHERE buyer.id=1
```
-->

```sql

SELECT offer.id AS offer_id, product.name AS product_name, platform.name AS platform, seller.username AS seller, offer.price AS price, image.url AS image_path, max(discount.rate) AS discount_rate,count(*) AS number_keys_buying
FROM 
	cart JOIN offer ON offer.id=cart.offer
	JOIN product ON offer.product=product.id
	JOIN platform ON platform.id=offer.platform
	JOIN image ON image.id=product.image
	LEFT OUTER JOIN discount ON discount.offer=offer.id
	JOIN regular_user AS seller ON seller.id=offer.seller
	JOIN regular_user AS buyer ON buyer.id=cart.buyer	
WHERE cart.buyer=$user_id AND (discount.rate IS NULL OR (discount.start_date <now() AND discount.end_date >now()))AND
		offer.final_date IS NULL
GROUP BY offer_id,product_name,platform.name,seller.username,image.url
ORDER BY product_name ASC
```

<!--
QUERY PARA QUANDO TIRARMOS O OVERLAP DE SALES
SELECT offer.id AS offer_id, product.name AS product_name, platform.name AS platform, seller.username AS seller, offer.price AS price, image.url AS image_path, discount.rate AS discount_rate,
FROM 
	cart JOIN offer ON offer.id=cart.offer
	JOIN product ON offer.product=product.id
	JOIN platform ON platform.id=offer.platform
	JOIN image ON image.id=product.image
	LEFT OUTER JOIN discount ON discount.offer=offer.id
	JOIN regular_user AS seller ON seller.id=offer.seller
	JOIN regular_user AS buyer ON buyer.id=cart.buyer	
WHERE cart.buyer=16 AND (discount.rate IS NULL OR (discount.start_date <now() AND discount.end_date >now()))AND
		offer.final_date IS NULL
ORDER BY product_name ASC
-->

---
| **Query reference**         | SELECT019           |
|-------------------|--------------------|
| **Query description** | Returns the number of sells a user has done.  |
| **Query frequency**   | hundreds per day     |
```sql
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
```
---
| **Query reference**         | SELECT020           |
|-------------------|--------------------|
| **Query description** | Get the number of sells for a product. This query will be used by a trigger after a sell is made  |
| **Query frequency**   | hundreds per day     |
```sql
DROP FUNCTION IF EXISTS count_number_sales_product(key_offer INTEGER);
CREATE OR REPLACE FUNCTION count_number_sales_product(key_offer INTEGER)
RETURNS INTEGER AS $counter$
DECLARE 
    counter INTEGER;
BEGIN
    counter:= (SELECT count(*)
                FROM key JOIN offer ON key.offer=offer.id 
                JOIN product ON product.id=offer.product
                WHERE product.id IN 
                (SELECT product.id
                    FROM key JOIN offer ON key.offer=offer.id 
                    JOIN product ON product.id=offer.product		  
                    WHERE key.offer=key_offer	
			    )
             );
    RETURN counter;
END; $counter$ LANGUAGE plpgsql;
```
---
| **Query reference**         | SELECT021           |
|-------------------|--------------------|
| **Query description** | Returns the number of reviews a seller has received  |
| **Query frequency**   | ?     |

## testada pelo martim -> funciona
```sql
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
```
---
| **Query reference**         | SELECT022           |
|-------------------|--------------------|
| **Query description** | Returns the number of positive reviews a seller has received  |
| **Query frequency**   | ?     |

## testada pelo martim -> funciona

```sql
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
```
---
| **Query reference**         | SELECT023           |
|-------------------|--------------------|
| **Query description** | Returns the seller through the id of a key  |
| **Query frequency**   | ?     |

## testada pelo martim -> funciona

```sql
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
```

### 1.3.  Most frequent modifications

| **Query reference**         | UPDATE01          |
|-------------------|--------------------|
| **Query description** | Delete a  product |
| **Query frequency**   |   dozens per month    |

```sql
UPDATE product SET deleted = true WHERE id = $product_id
```
<br>


| **Query reference**         | UPDATE02          |
|-------------------|--------------------|
| **Query description** | After adding an order (a user buying the items in his cart) it is necessary to update the keys to associate them with that order and to update the price at which they were sold  |
| **Query frequency**   |   thousands a day    |

```sql
UPDATE key SET orders = $order_id, price_sold = $price_sold WHERE id = $id
```
<br>

| **Query reference**         | UPDATE03          |
|-------------------|--------------------|
| **Query description** | Delete a offer when a user deletes it or the stock of keys for that offer reaches 0  |
| **Query frequency**   |   hundreds a day    |

```sql
UPDATE offer 
SET finalDate = NOW(), stock = 0
WHERE id = $offer_id_deleted


UPDATE offer 
SET final_date = NOW()
WHERE stock = 0
```
<br>


| **Query reference**         | UPDATE04          |
|-------------------|--------------------|
| **Query description** | User updating personal information  |
| **Query frequency**   |   thousands a day    |

```sql
UPDATE regular_user 
SET email = $email, description = $description, password = $hashed_password, paypal = $paypal_email, image = $image
WHERE id = $userId
```
<br>

| **Query reference**         | UPDATE05          |
|-------------------|--------------------|
| **Query description** | Updating a user number of sells  |
| **Query frequency**   |   thousands a day    |

```sql
UPDATE regular_user 
SET num_sells = $num_sells
WHERE id = $user_id
```
<br>

| **Query reference**         | UPDATE06          |
|-------------------|--------------------|
| **Query description** | Updating a user rating  |
| **Query frequency**   |   thousands a day    |

```sql
UPDATE regular_user 
SET rating = $new_rating
WHERE id = $user_id
```
<br>


| **Query reference**         | UPDATE07          |
|-------------------|--------------------|
| **Query description** | Change products values |
| **Query frequency**   |   units per month|

```sql
UPDATE product
SET name = $new_name, description = $new_description, category = $new_category, launch_date = $new_lauch_date
WHERE id = $product_id

UPDATE image
SET url = $new_image_path
WHERE id = $id_image_product_changed
```
<br>

| **Query reference**         | UPDATE08          |
|-------------------|--------------------|
| **Query description** | Change products image |
| **Query frequency**   |   units per month|

```sql
UPDATE product
SET image=$new_image_id
WHERE id = $product_id

UPDATE image
SET url = $new_image_path
WHERE id = $id_image_product_changed
```
<br>


| **Query reference**         | INSERT01          |
|-------------------|--------------------|
| **Query description** | Sign up  |
| **Query frequency**   | dozens per day     |

```sql
INSERT INTO regular_user (username, email, password, birth_date) VALUES ($username, $email, $hashed_password, $birth_date)
```
<br>


| **Query reference**         | INSERT02          |
|-------------------|--------------------|
| **Query description** | Add offer and keys of that offer  |
| **Query frequency**   | dozens per day      |

```sql
INSERT INTO offer (price, init_date, platform, seller, product, stock) VALUES ($price, $init_date, $platform, $seller, $product, $stock)

INSERT INTO key (key, price, offer)
VALUES ($key, $price, $offer_id)
```
<br>


| **Query reference**         | INSERT03          |
|-------------------|--------------------|
| **Query description** | Add aditional keys for a specific offer  |
| **Query frequency**   | dozens per day      |

```sql
INSERT INTO key (key, price, offer)
VALUES ($key, $price, $offer_id)
```
<br>



| **Query reference**         | INSERT04          |
|-------------------|--------------------|
| **Query description** | Insert product   |
| **Query frequency**   |   dozens per month    |

```sql
INSERT INTO product (name, description, category, image, launch_date) VALUES ($name, $description, $category_id, $image_id, $launch_date)

INSERT INTO product_has_genre(genre, product) VALUES ($genre_id, $product_id)

INSERT INTO product_has_platform(platform, product) VALUES ($platform_id, $product_id)

INSERT INTO image(url) values ($url)
```
<br>

| **Query reference**         | INSERT05          |
|-------------------|--------------------|
| **Query description** | Add platform |
| **Query frequency**   |   units per year    |

```sql
INSERT INTO platform (name) VALUES ($name)
```
<br>

| **Query reference**         | INSERT06          |
|-------------------|--------------------|
| **Query description** | Add genre |
| **Query frequency**   |   units per year   |

```sql
INSERT INTO genres (name) VALUES ($name)
```
<br>

| **Query reference**         | INSERT07          |
|-------------------|--------------------|
| **Query description** | Add category  |
| **Query frequency**   |   units per year    |

```sql
INSERT INTO category (name) VALUES ($name)
```
<br>



| **Query reference**         | INSERT08          |
|-------------------|--------------------|
| **Query description** | Ban a user   |
| **Query frequency**   |  units per month    |

```sql
INSERT INTO banned_user (regular_user) VALUES ($user_id)
```
<br>


| **Query reference**         | INSERT09          |
|-------------------|--------------------|
| **Query description** | Give feedback to seller   |
| **Query frequency**   |   hundreds a day     |

```sql
INSERT INTO feedback (evaluation, comment, regular_user, key) VALUES ($evaluation, $comment, $regular_user_id, $key_id)
```
<br>

| **Query reference**         | INSERT10          |
|-------------------|--------------------|
| **Query description** | Report a seller   |
| **Query frequency**   |   dozens per month    |

```sql
INSERT INTO report (date, description, title, key, reported, reportee) VALUES ($date, $description, $title, $keyId, $reportedId, $reportee)


INSERT INTO message(date, description, regular_user) VALUES ($date, $description, $reporter_id)
```
<br>

| **Query reference**         | INSERT11          |
|-------------------|--------------------|
| **Query description** | Write message |
| **Query frequency**   |   hundreds per week   |

```sql
INSERT INTO message (date, description, regular_user) VALUES ($date, $description, $regular_user_id)
```
<br>

| **Query reference**         | INSERT12          |
|-------------------|--------------------|
| **Query description** | Request a ban appeal   |
| **Query frequency**   |   dozens per week   |

```sql
INSERT INTO ban_appeal(banned_user, admin, ban_appeal, date) VALUES($banned_user_id, $admin_id, $ban_appeal, $date)
```
<br>

| **Query reference**         | INSERT13          |
|-------------------|--------------------|
| **Query description** | Add an order |
| **Query frequency**   |   hundreds a day    |

```sql
INSERT INTO orders (order_number, date, regular_user) VALUES ($order_number, $date, $regular_user)
```
<br>

| **Query reference**         | INSERT14          |
|-------------------|--------------------|
| **Query description** | Add an item to the cart
| **Query frequency**   |  thousands a day    |

```sql
INSERT INTO cart (buyer, offer) VALUES ($buyer_id, $offer_id)
```
<br>

| **Query reference**         | DELETE01          |
|-------------------|--------------------|
| **Query description** | Remove an item to the cart
| **Query frequency**   |  thousands a day    |

```sql
DELETE FROM cart WHERE id = $id AND buyer = $buyer_id;
```
<br>

| **Query reference**         | DELETE02 |
|-------------------|--------------------|
| **Query description** | User deleting his account |
| **Query frequency**   |   units per month    |

```sql
DELETE FROM user WHERE id=$userId 

DELETE FROM image WHERE id=$user_image_id
```
<br>

| **Query reference**         | DELETE03 |
|-------------------|--------------------|
| **Query description** | Unbanned a user  |
| **Query frequency**   |   units per month    |

```sql
DELETE FROM banned_user WHERE id=$user_id 
```
<br>


| **Query reference**         | DELETE04 |
|-------------------|--------------------|
| **Query description** | Delete a image   |
| **Query frequency**   |   units per month    |

```sql
DELETE FROM image WHERE id=$image_id 
```
<br>


## 2. Proposed Indices

### 2.1. Performance Indices

## TESTAR INDEXES COM WHERE INVES DE JOINS

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Related queries** | SELECT do search                          |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Cardinality**     | Attribute cardinality: low/medium/high |
| **Clustering**      | ?(yes/no)                |
| **Justification**   | Justification for the proposed index   |
| **SQL code**        |                                        |
```sql
DROP INDEX IF EXISTS
CREATE INDEX product_min_price_idx ON active_products (min_price); 
```
# NAO FAZ SENTIDO, MIN_PRICE NUNCA É PROCURADO

---
| **Index**           | IDX02                                  |
| ---                 | ---                                    |
| **Related queries** | Creation and refresh of active_products view |
| **Relation**        | offer    |
| **Attribute**       | product   |
| **Type**            | B-tree    |
| **Cardinality**     | Attribute cardinality: low/medium/high |
| **Clustering**      | ?(yes/no)                |
| **Justification**   | The product of an offer is an atribute that is constantly being used throughout many queries   |
```sql
DROP INDEX IF EXISTS
CREATE INDEX offer_product_idx ON offer (product);
```

---
| **Index**           | IDX03                                  |
| ---                 | ---                                    |
| **Related queries** | SELECT do search                          |
| **Relation**        | offer    |
| **Attribute**       | seller   |
| **Type**            | B-tree             |
| **Cardinality**     | Attribute cardinality: low/medium/high |
| **Clustering**      | ?(yes/no)                |
| **Justification**   | The seller of an offer is an atribute that is constantly being used throughout many queries   |
```sql
DROP INDEX IF EXISTS
CREATE INDEX offer_seller_idx ON offer (seller);
```

---
| **Index**           | IDX04                                  |
| ---                 | ---                                    |
| **Related queries** | Creation and refresh of active_products view |
| **Relation**        | discount    |
| **Attribute**       | offer   |
| **Type**            | B-tree    |
| **Cardinality**     | Attribute cardinality: low/medium/high |
| **Clustering**      | ?(yes/no)                |
| **Justification**   | The seller of an offer is an atribute that is constantly being used throughout many queries   |
```sql
DROP INDEX IF EXISTS
CREATE INDEX offer_product_idx ON discount (offer);
```

---
| **Index**           | IDX05                                  |
| ---                 | ---                                    |
| **Related queries** | SELECT do search                          |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Cardinality**     | Attribute cardinality: low/medium/high |
| **Clustering**      | ?(yes/no)                |
| **Justification**   | Justification for the proposed index   |
| **SQL code**        |                                        |
```sql
DROP INDEX IF EXISTS
CREATE INDEX key_offer_idx ON key (offer);
```

---
| **Index**           | IDX06                                  |
| ---                 | ---                                    |
| **Related queries** | SELECT do search                          |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree                                 |
| **Cardinality**     | medium                                 |
| **Clustering**      | ?(yes/no)                              |
| **Justification**   | All queries about products deal with discounts. Those discounts are everytime tested between dates to check if they are active   |
| **SQL code**        |                                        |
```sql
DROP INDEX IF EXISTS
CREATE INDEX key_offer_idx ON discount (start_date, end_date);
```


### 2.2. Full-text Search Indices 

> The system being developed must provide full-text search features supported by PostgreSQL. Thus, it is necessary to specify the fields where full-text search will be available and the associated setup, namely all necessary configurations, indexes definitions and other relevant details.

| **Index**           | IDX10                                  |
| ---                 | ---                                    |
| **Related queries** | SELECT do search                          |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | GIN              |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
```sql
DROP INDEX IF EXISTS product_name_idx;
CREATE INDEX product_name_idx 
ON product
USING GIN(name_tsvector);
```

## 3. Triggers
 
# TESTADO E FUNCIONA => NAO MEXER
| **Trigger**      | TRIGGER01                              |
| ---              | ---                                    |
| **Query description**  | Updates the compute value for the product column that vectorizes its name|
```sql
DROP FUNCTION IF EXISTS update_product_name_tsvector() CASCADE;
CREATE OR REPLACE FUNCTION update_product_name_tsvector()
RETURNS TRIGGER AS $$
BEGIN
    IF NEW.name <> OLD.name THEN
        NEW.name_tsvector := to_tsvector('english', NEW.name);
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_product_name_tsvector_tg ON product;
CREATE TRIGGER update_product_name_tsvector_tg 
BEFORE INSERT OR UPDATE 
ON product
FOR EACH ROW 
EXECUTE PROCEDURE update_product_name_tsvector();
```
---
# TESTADO E FUNCIONA => NAO MEXER
| **Trigger**      | TRIGGER02                              |
| ---              | ---                                    |
| **Query description**  | Inserts the compute value for the product column that vectorizes its name|
```sql
DROP FUNCTION IF EXISTS insert_product_name_tsvector() CASCADE;
CREATE OR REPLACE FUNCTION insert_product_name_tsvector()
RETURNS TRIGGER AS $$
BEGIN
    NEW.name_tsvector := to_tsvector('english', NEW.name);
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS insert_product_name_tsvector_tg ON product;
CREATE TRIGGER insert_product_name_tsvector_tg 
BEFORE INSERT OR UPDATE 
ON product
FOR EACH ROW 
EXECUTE PROCEDURE insert_product_name_tsvector();
```
---
# TESTADO E FUNCIONA => NAO MEXER
| **Trigger**      | TRIGGER03                             |
| ---              | ---                                    |
| **Query description**  | After a order transaction, updates the number of sells  of a certain product |
```sql
DROP FUNCTION IF EXISTS product_num_sells() CASCADE;
CREATE OR REPLACE FUNCTION product_num_sells() 
RETURNS TRIGGER AS $$
DECLARE 
    sells INTEGER;
    product_id INTEGER;
BEGIN
    SELECT COUNT(p.id), product.id 
    INTO sells, product_id
    FROM offer JOIN product ON product.id = offer.product        
    WHERE offer.id = NEW.offer
    GROUP BY(product.id);

    UPDATE product 
    SET num_sells = sells
    WHERE id = product_id;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS product_num_sales_tg ON key CASCADE;
CREATE TRIGGER product_num_sales_tg
AFTER UPDATE of orders ON key
FOR EACH ROW 
EXECUTE PROCEDURE product_num_sells();
```
---
# TESTADO E FUNCIONA => NAO MEXER
| **Trigger**      | TRIGGER04                             |
| ---              | ---                                    |
| **Query description**  | After a order transaction, updates the total number of sells of a user|
```sql
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
```

# TESTADO E FUNCIONA => NAO MEXER
| **Trigger**      | TRIGGER05                             |
| ---              | ---                                    |
| **Query description**  | Updates the value for the rating column of the user after a new review is made|

```sql
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
    total_feedback := 100 * (positive_reviews / num_reviews); -- PROB DA COR E DAQUI
	
    UPDATE regular_user 
    SET rating = total_feedback
    WHERE regular_user.id = seller_id;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_seller_feedback_tg ON feedback CASCADE;
CREATE TRIGGER update_seller_feedback_tg 
AFTER INSERT
ON feedback
FOR EACH ROW 
EXECUTE PROCEDURE update_seller_feedback();
```
# TESTADO E FUNCIONA => NAO MEXER
| **Trigger**      | TRIGGER06                           |
| ---              | ---                                    |
| **Query description**  | Checks if a user that is trying to review a seller's offer did buy the offer from that seller|
```sql
DROP FUNCTION IF EXISTS check_user_bought_product() CASCADE;
CREATE OR REPLACE FUNCTION check_user_bought_product()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT *
        FROM orders o JOIN key k ON o.id = k.orders
        WHERE NEW.key = k.id
        AND o.regular_user = NEW.regular_user
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
```

ISTO NAO E TRIGGER E UM TRANSACTION
#  JUNTAR TRIGGER 6 E TRIGGER 3 -- TRIGGER 6 passará à transaction de compra
R: Nao juntas nada com o 3 ou levas uma calduço. Mas amanha confirmo 
<!--
| **Trigger**    | TRIGGER07                           |
| ---              | ---                                    |
| **Query description**  | Checks if a user can buy the quantity of product he is trying to buy|
```sql
DROP FUNCTION IF EXISTS check_purchase_quantity() CASCADE;
CREATE OR REPLACE FUNCTION check_purchase_quantity()
RETURNS TRIGGER AS $$
BEGIN
    IF NOT EXISTS (
        SELECT COUNT(*) as keys_bought FROM offer as o, key as k
        WHERE NEW.id = k.orders and k.offer = o.id
        GROUP BY k.id
        HAVING o.stock >= keys_bought
    )
    THEN RAISE EXCEPTION 'Tried to purchased a quantity of keys exceeds stock available';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;


DROP TRIGGER IF EXISTS check_purchase_quantity_tg ON orders CASCADE;
CREATE TRIGGER check_purchase_quantity_tg AFTER INSERT OR UPDATE 
ON orders
FOR EACH ROW 
EXECUTE PROCEDURE check_purchase_quantity(); 
```-->
---
# TESTADO E FUNCIONA => NAO MEXER
| **Trigger**      | TRIGGER07                            |
| ---              | ---                                    |
| **Query description**  | Deletes the cart of a user after the order is payed |
```sql
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
CREATE TRIGGER delete_cart_after_purchase_tg AFTER INSERT
ON orders
FOR EACH ROW 
EXECUTE PROCEDURE delete_cart_after_purchase();
```
---
# TESTADO E FUNCIONA => NAO MEXER
| **Trigger**      | TRIGGER08                            |
| ---              | ---                                    |
| **Query description**  | Reduces the stock from an offer when a seller sells a key |
```sql
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
```
---
# TESTADO E FUNCIONA => NAO MEXER
| **Trigger**      | TRIGGER09                            |
| ---              | ---                                    |
| **Query description**  | Removes a deleted product from all carts |
```sql
DROP FUNCTION IF EXISTS delete_from_cart() CASCADE;
CREATE OR REPLACE FUNCTION delete_from_cart()
RETURNS TRIGGER AS $$
DECLARE
    deleted_var BOOLEAN;
BEGIN
    IF NEW.deleted THEN
        DELETE FROM cart
        WHERE offer IN (
            SELECT offer.id 
            FROM offer 
            WHERE offer.product = NEW.id
        );
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS delete_from_cart_tg ON product CASCADE;
CREATE TRIGGER delete_from_cart_tg 
AFTER INSERT OR UPDATE 
OF deleted ON product
FOR EACH ROW 
EXECUTE PROCEDURE delete_from_cart();
```
# TESTADO E FUNCIONA => NAO MEXER
| **Trigger**      | TRIGGER10                            |
| ---              | ---                                    |
| **Query description**  | Confirm that an item sold by myself is not inserted on my cart |
```sql
DROP FUNCTION IF EXISTS check_not_self_buying() CASCADE;
CREATE OR REPLACE FUNCTION check_not_self_buying()
RETURNS TRIGGER AS $$
DECLARE
	seller_id INTEGER;    
BEGIN
    seller_id := (
        SELECT offer.seller
        FROM offer 
        WHERE offer.id=NEW.offer
    );
                
    IF seller_id=NEW.regular_user THEN
        RAISE EXCEPTION 'You cannot buy product that you are already selling!';
    END IF;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS check_not_self_buying_tg ON cart CASCADE;
CREATE TRIGGER check_not_self_buying_tg 
AFTER INSERT ON cart
FOR EACH ROW 
EXECUTE PROCEDURE check_not_self_buying();
```

## Fazer trigger que quando acrescente orders ele atualiza a key
# Isto nao pode ser um trigger nos temos de fazer isto em transaction. Nos temos de trancar a tabela. Para fazer a atribuicao da key a alguem. N sei se podemos trancar + usar triggers. Para alem disso temos de garantia de atomicidade o trigger n sabemos quando disparará. No intermedio pode alguem usurpar aquela key
<!--
| **Trigger**      | TRIGGER11                            |
| ---              | ---                                    |
| **Query description**  | Update the foreign key of key->order when a transaction is made. |
```sql
DROP FUNCTION IF EXISTS check_not_buying_from_myself() CASCADE;
CREATE OR REPLACE FUNCTION check_not_buying_from_myself()
RETURNS TRIGGER AS $$
DECLARE
seller_id INTEGER;    
BEGIN
    seller_id:=(
                SELECT offer.seller
                FROM offer 
                WHERE offer.id=NEW.offer
                );
                
    IF seller_id=NEW.regular_user THEN
        RAISE EXCEPTION 'YOU CANNOT BUY FROM YOURSELF';
    END IF;
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS check_not_buying_from_myself_tg ON cart CASCADE;
CREATE TRIGGER check_not_buying_from_myself_tg AFTER INSERT ON cart
FOR EACH ROW 
EXECUTE PROCEDURE check_not_buying_from_myself();
-->

| **Trigger**      | TRIGGER12                            |
| ---              | ---                                    |
| **Query description**  | Remove not sold keys from canceled offers |
```sql
DROP FUNCTION IF EXISTS deleted_offer_not_sold_keys () CASCADE;
CREATE OR REPLACE FUNCTION deleted_offer_not_sold_keys()
RETURNS TRIGGER AS $$
BEGIN

    DELETE FROM key
    WHERE key.offer=NEW.id AND key.order IS NULL
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS delete_not_sold_keys_from_canceled_offer_tg ON offer CASCADE;
CREATE TRIGGER delete_not_sold_keys_from_canceled_offer_tg AFTER UPDATE OF deleted ON offer
FOR EACH ROW 
WHEN(NEW.delted=TRUE)
EXECUTE PROCEDURE deleted_offer_not_sold_keys();
```

## trigger to update profit in offer
# E se tirar-se-mos o profit do offer n estamos a fazer nada com ele. Estamos. Meter no fim

# Discutir, isto nao pode ser feito com um trigger
## Trigger para os discountos ficarem ativos. Modificar o preco da offer 


| **Trigger**      | TRIGGER12                            |
| ---              | ---                                    |
| **Query description**  | Ensure I m not selling keys for a product that is deleted  |
```sql
DROP FUNCTION IF EXISTS ensures_no_sell_deleted_products () CASCADE;
CREATE OR REPLACE FUNCTION ensures_no_sell_deleted_products()
RETURNS TRIGGER AS $$
BEGIN
    IF EXISTS( SELECT product.id
                FROM product
                WHERE NEW.product=product.id AND product.deleted=TRUE
             );
        RAISE EXCEPTION 'YOU CANNOT SOLD DELETED PRODUCTS';
    END IF;
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS ensures_no_sell_deleted_products_tg ON offer CASCADE;
CREATE TRIGGER ensures_no_sell_deleted_products_tg BEFORE INSERT ON offer
FOR EACH ROW 
EXECUTE PROCEDURE ensures_no_sell_deleted_products();
```

| **Trigger**      | TRIGGER13                            |
| ---              | ---                                    |
| **Query description**  | Sets the end_date value when the offer is canceled or runs out of stock.  |
```sql
DROP FUNCTION IF EXISTS update_offer_date_end () CASCADE;
CREATE OR REPLACE FUNCTION update_offer_date_end()
RETURNS TRIGGER AS $$
BEGIN

    UPDATE offer
    SET offer.end_date=now()
    WHERE offer.id=NEW.id
    
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_offer_date_end_tg ON offer CASCADE;
CREATE TRIGGER update_offer_date_end_tg AFTER UPDATE OF deleted ON offer
FOR EACH ROW
WHEN(NEW.deleted=TRUE OR NEW.stock=0)
EXECUTE PROCEDURE update_offer_date_end();
```

## trigger para dar update na vista active products qunado damos update no product ou insert

## trigger para dar update na vista active products quando se mexe na table prodcuts has platform




## 4. Transactions

Transactions needed to assure the integrity of the data, with a proper justification.

| **TP01**        | Insert a new order, effectively buy the items on a user's cart                                  |
| ---                 | ---                  |
| **Justification**   | When a user buys the items on his shopping cart it is required that the adding of an order to that user and the association of keys to that order be isolated and atomic |
| **Isolation level**   |  |
```sql
BEGIN TRANSACTION;
SET TRANSCATION 









COMMIT;
```
 
 # Fazer a compra com a cart
 # Banned user muitas operacoes
 
 # Mudar o preco da key (atualizar o preco da key)
 
> Transactions needed to assure the integrity of the data.

| SQL Reference   | Transaction Name                    |
| --------------- | ----------------------------------- |
| Justification   | Justification for the transaction.  |
| Isolation level | Isolation level of the transaction. |
| `Complete SQL Code`                                   |

## 5. SQL Code

> The database script must also include the SQL to populate a database with test data with an amount of tuples suitable for testing and with plausible values for the fields of the database.
> This code should also be included in the group's git repository as an SQL script, and a link include here.

### 5.1. Database schema

Access the database schema sql script [on github](https://git.fe.up.pt/lbaw/lbaw1920/lbaw2043/-/blob/master/database/schema.sql)



### 5.2. Database population

In order to test and see the benefits of the indexes conceived the script created to populate the database ended up having a considerable size.

Access the database population sql script [on github](https://git.fe.up.pt/lbaw/lbaw1920/lbaw2043/-/blob/master/database/populate.sql)

<br>
<br>

## Revision history

Changes made to the first submission:

***

GROUP2043, 25/03/2020

* Luís Ramos, up201706253@fe.up.pt
* José Guerra, up201706421@fe.up.pt
* Martim Silva, up201705205@fe.up.pt
* Ruben Almeida, up201704618@fe.up.pt (Editor)