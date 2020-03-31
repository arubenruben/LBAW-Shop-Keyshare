CREATE OR REPLACE FUNCTION active_products()
RETURNS TABLE(
    id integer,
    name text, 
    description text, 
    launch_date date, 
    id_category int, 
    id_platform int, 
    id_image integer,
    deleted boolean 
) AS 
$$
 BEGIN
  RETURN query select distinct p.id, p.name, p.description , launch_date, id_category, id_platform, id_image, p.deleted 
    from product p join product_has_genre g ON p.id=g.product  join product_has_platform pf on p.id=pf.product
    where p.deleted = false;
 END; $$ 
 LANGUAGE plpgsql;
 ---------------------



select *
from product join offer on product.id=offer.product join discount on offer.id=discount.offer join platform on offer.platform=platform.id join regular_user as seller on seller.id=offer.seller
where final_date IS NULL
group by product.name, seller.id
