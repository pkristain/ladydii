SET FOREIGN_KEY_CHECKS = 0
;

DROP TABLE IF EXISTS `page`
;

CREATE TABLE IF NOT EXISTS `page` (
	`page_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`page_parent` INT(11) UNSIGNED DEFAULT NULL,
	`page_visibility` BIT(1) NOT NULL DEFAULT b'0',
	`page_priority` INT(11) NOT NULL DEFAULT '0',
	`page_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`page_level` INT(11) DEFAULT NULL
	COMMENT 'x',
	`page_order` INT(11) DEFAULT NULL
	COMMENT 'x',
	`page_general_visibility` BIT(1) DEFAULT NULL
	COMMENT 'x',
	PRIMARY KEY (`page_id`),
	UNIQUE KEY `page_order` (`page_order`),
	KEY `page_parent` (`page_parent`)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =`utf8`
	AUTO_INCREMENT = 1
;

DROP TABLE IF EXISTS `page_detail`
;

CREATE TABLE IF NOT EXISTS `page_detail` (
	`page_detail_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`page_id` INT(11) UNSIGNED NOT NULL,
	`page_detail_name` VARCHAR(255) DEFAULT NULL,
	`page_detail_alias` VARCHAR(255) DEFAULT NULL,
	`page_detail_route` VARCHAR(1024) DEFAULT NULL
	COMMENT 'x',
	PRIMARY KEY (`page_detail_id`),
	UNIQUE KEY `page_id` (`page_id`)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =`utf8`
	AUTO_INCREMENT = 1
;


DROP TABLE IF EXISTS `page_sheet`
;

CREATE TABLE IF NOT EXISTS `page_sheet` (
	`page_sheet_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`page_detail_id` INT(11) UNSIGNED NOT NULL,
 	`page_sheet_active` BIT(1) NOT NULL DEFAULT b'0',
	`page_sheet_name` VARCHAR(255) DEFAULT NULL,
	`page_sheet_changed` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`page_sheet_content` TEXT,
	PRIMARY KEY (`page_sheet_id`),
	KEY `page_detail_id` (`page_detail_id`)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =`utf8`
	AUTO_INCREMENT =1
;
# forein keys
ALTER TABLE `page`
ADD CONSTRAINT `page.page_parent-page.page_id`
FOREIGN KEY (`page_parent`)
REFERENCES `page` (`page_id`)
	ON DELETE CASCADE
	ON UPDATE CASCADE
;


ALTER TABLE `page_detail`
ADD CONSTRAINT `page_detail.page_id-page.page_id`
FOREIGN KEY (`page_id`)
REFERENCES `page` (`page_id`)
	ON DELETE CASCADE
	ON UPDATE CASCADE
;

ALTER TABLE `page_sheet`
ADD CONSTRAINT `page_sheet.page_detail_id-page_detail.page_detail_id`
FOREIGN KEY (`page_detail_id`)
REFERENCES `page_detail` (`page_detail_id`)
	ON DELETE CASCADE
	ON UPDATE CASCADE
;

SET FOREIGN_KEY_CHECKS = 1
;