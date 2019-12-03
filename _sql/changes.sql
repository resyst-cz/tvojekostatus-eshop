-- Wellbloud 2019-12-03 10:15
-- find old images
SELECT id_product, id_shop, id_lang, substr(description, locate("cms/old_wp", description)) as img
FROM eko87stat_product_lang
WHERE description LIKE '%cms/old_wp%';

-- --------- ALREADY ON STAGING ---------

-- Wellbloud 2019-12-03 09:28
-- replaces path from old site in product description with new relative path
UPDATE eko87stat_product_lang
SET description = REPLACE(description, 'https://www.tvojekostatus.sk/wp-content/uploads/', 'cms/old_wp/')
WHERE description LIKE '%https://www.tvojekostatus.sk/wp-content/uploads/%';

-- Wellbloud 2019-11-26 13:41
UPDATE eko87stat_product_lang
INNER JOIN w2018p_posts ON eko87stat_product_lang.id_product = w2018p_posts.id_new
SET eko87stat_product_lang.description = w2018p_posts.description,
eko87stat_product_lang.description_short = w2018p_posts.description_short;

