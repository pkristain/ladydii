INSERT INTO `page` (
	`page_id`, `page_parent`)
VALUES
	(1, NULL),
	(2, 1),
	(3, 1),
	(4, 3)
;

INSERT INTO `page_detail` (
	`page_detail_id`, `page_id`)
VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4)
;

INSERT INTO `page_sheet` (
	`page_detail_id`, `page_sheet_content`)
VALUES
	(1,'jedna jedna'),
	(1,'jedna dvě'),
	(2,'dvě jedna'),
	(2,'dvě dvě'),
	(3,'tři jedna'),
	(3,'tři dva'),
	(4,'čtyři jedna'),
	(4,'čtyři dva')
;