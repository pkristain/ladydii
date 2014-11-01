INSERT INTO `page` (
	`page_id`, `page_parent`, `page_name`, `page_alias`, `page_visibility`)
VALUES
	(1, NULL, 'první super strana', null, 1),
	(2, 1, 'druha ještě suprovější strana','second', 1),
	(3, 1, 'třetí strana už ne tak kůl','third', 1),
	(4, 3, 'čtvrtá už jen tak do počtu','forth', 0),
	(5, 3, 'pátá jen tak', 'fifth', 1),
	(6, 2, 'parchant','tak-torchu', 1),
	(7, 4, 'aby to byla legrace','trochu-vice', 1)
;

INSERT INTO `sheet` (
	`sheet_id`, `page_id`, `sheet_content`)
VALUES
	(1, 1,'jedna jedna'),
	(2, 1,'jedna dvě'),
	(3, 2,'dvě jedna'),
	(4, 2,'dvě dvě'),
	(5, 3,'tři jedna'),
	(6, 3,'tři dva'),
	(7, 4,'čtyři jedna'),
	(8, 4,'čtyři dva')
;
