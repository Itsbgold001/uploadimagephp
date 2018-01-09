CREATE DATABASE test_upload;

use test_upload;

CREATE TABLE `images` (
	`id` int (30) NOT NULL AUTO_INCREMENT,
	`img` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
)