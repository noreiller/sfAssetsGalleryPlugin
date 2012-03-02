
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- sf_asset_gallery
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_asset_gallery`;

CREATE TABLE `sf_asset_gallery`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`is_published` TINYINT DEFAULT 1,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sf_asset_gallery_element
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_asset_gallery_element`;

CREATE TABLE `sf_asset_gallery_element`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT,
	`gallery_id` INTEGER NOT NULL,
	`asset_id` INTEGER NOT NULL,
	`thumb_id` INTEGER NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`sortable_rank` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `sf_asset_gallery_element_FI_1` (`gallery_id`),
	INDEX `sf_asset_gallery_element_FI_2` (`asset_id`),
	INDEX `sf_asset_gallery_element_FI_3` (`thumb_id`),
	CONSTRAINT `sf_asset_gallery_element_FK_1`
		FOREIGN KEY (`gallery_id`)
		REFERENCES `sf_asset_gallery` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `sf_asset_gallery_element_FK_2`
		FOREIGN KEY (`asset_id`)
		REFERENCES `sf_asset` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `sf_asset_gallery_element_FK_3`
		FOREIGN KEY (`thumb_id`)
		REFERENCES `sf_asset` (`id`)
		ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
