-- --------- ALREADY ON STAGING ---------

-- Wellbloud 2019-11-26 13:41
UPDATE eko87stat_product_lang
INNER JOIN w2018p_posts ON eko87stat_product_lang.id_product = w2018p_posts.id_new
SET eko87stat_product_lang.description = w2018p_posts.description,
eko87stat_product_lang.description_short = w2018p_posts.description_short

