# SQL Dump for service module
# PhpMyAdmin Version: 4.0.4
# http://www.phpmyadmin.net
#
# Host: erenyumak.com
# Generated on: Thu Jun 25, 2020 to 09:49:06
# Server version: 5.5.5-10.1.45-MariaDB
# PHP Version: 7.3.19

#
# Structure table for `service_categories` 5
#

CREATE TABLE `service_categories` (
  `cat_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` VARCHAR(255) NOT NULL DEFAULT '',
  `cat_logo` VARCHAR(255) NOT NULL DEFAULT '',
  `cat_created` INT(10) NOT NULL DEFAULT '0',
  `cat_submitter` INT(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB;

#
# Structure table for `service_services` 5
#

CREATE TABLE `service_services` (
  `ser_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ser_cat` INT(8) NOT NULL DEFAULT '0',
  `ser_title` VARCHAR(200) NOT NULL DEFAULT '',
  `ser_desc` MEDIUMTEXT NOT NULL ,
  `ser_img` VARCHAR(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`ser_id`)
) ENGINE=InnoDB;

#
# Structure table for `service_ratings` 6
#

CREATE TABLE `service_ratings` (
  `rate_id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rate_itemid` INT(8) NOT NULL DEFAULT '0',
  `rate_source` INT(8) NOT NULL DEFAULT '0',
  `rate_value` INT(1) NOT NULL DEFAULT '0',
  `rate_uid` INT(8) NOT NULL DEFAULT '0',
  `rate_ip` VARCHAR(60) NOT NULL DEFAULT '',
  `rate_date` INT(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rate_id`)
) ENGINE=InnoDB;

