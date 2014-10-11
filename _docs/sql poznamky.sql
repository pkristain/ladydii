
SET SESSION SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";# MySQL vrátil prázdný výsledek (tj. nulový počet řádků).

INSERT INTO `ladydii_page_page`(`page_id`, `page_parent`) VALUES (0,NULL);# Ovlivněn 1 řádek.




CREATE OR REPLACE VIEW ladydii_page_all AS

SELECT
p.page_id AS page_id,
k.kind_id AS kind_id,
u.unit_id AS unit_id,
'-',
p.page_parent AS page_parent,
p.page_visibility AS page_visibility,
p.page_created AS page_created,
p.page_level AS page_level,
p.page_order AS page_order,
p.page_general_visibility AS page_general_visibility,
'-',
l.lang_code AS lang_code,
l.lang_name AS lang_name,
l.lang_visibility AS lang_visibility,
'-',
k.kind_name AS kind_name,
k.kind_alias AS kind_alias,
k.kind_route AS kind_route,
'-',
u.unit_active AS unit_active,
u.unit_name AS unit_name,
u.unit_changed AS unit_changed,
u.unit_content AS unit_content

FROM
ladydii_page_page p,
ladydii_page_kind k,
ladydii_page_unit u,
ladydii_lang l
WHERE
p.page_id = k.page_id
AND
u.kind_id = k.kind_id
AND
k.kind_lang = l.lang_id
ORDER BY
page_id ASC;