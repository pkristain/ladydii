SET FOREIGN_KEY_CHECKS = 0
;

DROP TABLE IF EXISTS `page`
;

CREATE TABLE IF NOT EXISTS `page` (
	`page_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`page_parent` INT(11) UNSIGNED DEFAULT NULL,
	`page_created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`page_visibility` BIT(1) NOT NULL DEFAULT b'0',
	`page_priority` INT(11) NOT NULL DEFAULT '0',
	`page_name` VARCHAR(255) DEFAULT NULL,
	`page_alias` VARCHAR(255) DEFAULT NULL,
	`page_level` INT(11) DEFAULT NULL
	COMMENT 'x',
	`page_order` INT(11) DEFAULT NULL
	COMMENT 'x',
	`page_general_visibility` BIT(1) DEFAULT NULL
	COMMENT 'x',
	PRIMARY KEY (`page_id`),
	UNIQUE KEY `page_order` (`page_order`),
# 	UNIQUE KEY `page_parent+page_alias` (`page_parent`,`page_alias`),
	KEY `page_parent` (`page_parent`)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =`utf8`
	AUTO_INCREMENT = 1
;


DROP TABLE IF EXISTS `sheet`
;

CREATE TABLE IF NOT EXISTS `sheet` (
	`sheet_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`page_id` INT(11) UNSIGNED NOT NULL,
	`sheet_name` VARCHAR(255) DEFAULT NULL,
	`sheet_changed` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`sheet_content` TEXT,
	PRIMARY KEY (`sheet_id`),
	KEY `page_id` (`page_id`)
)
	ENGINE =InnoDB
	DEFAULT CHARSET =`utf8`
	AUTO_INCREMENT =1
;

# forein keys
ALTER TABLE `page`
ADD CONSTRAINT `page.page_parent - page.page_id`
FOREIGN KEY (`page_parent`)
REFERENCES `page` (`page_id`)
	ON DELETE CASCADE
	ON UPDATE CASCADE
;

ALTER TABLE `sheet`
ADD CONSTRAINT `sheet.page_id - page.page_id`
FOREIGN KEY (`page_id`)
REFERENCES `page` (`page_id`)
	ON DELETE CASCADE
	ON UPDATE CASCADE
;

SET FOREIGN_KEY_CHECKS = 1
;