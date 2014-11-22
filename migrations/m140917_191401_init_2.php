<?php
/**
 * full migration
 */

class m140917_191401_init_2 extends CDbMigration
{

    /**
	 * Creates all tebles, if no ccmp table
	 */
    public function up()
    {
        
        $table_ccmp = Yii::app()->db->schema->getTable('ccmp_company',true);
        if (!empty($table_ccmp)) {
            return;
        }        
        
        
        $this->execute("

            SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

           CREATE TABLE `ccbr_branch` (
             `ccbr_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             `ccbr_ccmp_id` int(10) unsigned NOT NULL,
             `ccbr_name` varchar(350) NOT NULL,
             `ccbr_code` varchar(50) DEFAULT NULL,
             `ccbr_notes` text,
             `ccbr_hide` tinyint(3) unsigned NOT NULL DEFAULT '0',
             PRIMARY KEY (`ccbr_id`),
             KEY `ccbr_ccmp_id` (`ccbr_ccmp_id`,`ccbr_hide`),
             CONSTRAINT `ccbr_branch_ibfk_1` FOREIGN KEY (`ccbr_ccmp_id`) REFERENCES `ccmp_company` (`ccmp_id`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


           CREATE TABLE `cccd_custom_data` (
             `cccd_ccmp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             PRIMARY KEY (`cccd_ccmp_id`),
             CONSTRAINT `fk_custom_data` FOREIGN KEY (`cccd_ccmp_id`) REFERENCES `ccmp_company` (`ccmp_id`) ON DELETE CASCADE
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


           CREATE TABLE `cccf_custom_fields` (
             `id` int(11) NOT NULL AUTO_INCREMENT,
             `varname` varchar(50) NOT NULL DEFAULT '',
             `title` varchar(255) NOT NULL DEFAULT '',
             `field_type` varchar(50) NOT NULL DEFAULT '',
             `field_size` int(3) NOT NULL DEFAULT '0',
             `field_size_min` int(3) NOT NULL DEFAULT '0',
             `required` int(1) NOT NULL DEFAULT '0',
             `match` varchar(255) NOT NULL DEFAULT '',
             `range` varchar(255) NOT NULL DEFAULT '',
             `error_message` varchar(255) NOT NULL DEFAULT '',
             `other_validator` text,
             `default` varchar(255) NOT NULL DEFAULT '',
             `widget` varchar(255) NOT NULL DEFAULT '',
             `widgetparams` text,
             `position` int(3) NOT NULL DEFAULT '0',
             `visible` int(1) NOT NULL DEFAULT '0',
             `test5` int(11) NOT NULL DEFAULT '0',
             `test6` int(11) NOT NULL DEFAULT '0',
             PRIMARY KEY (`id`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


           CREATE TABLE `ccgr_group` (
             `ccgr_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
             `ccgr_name` varchar(20) NOT NULL,
             `ccgr_notes` text,
             `ccgr_hide` tinyint(3) unsigned NOT NULL DEFAULT '0',
             PRIMARY KEY (`ccgr_id`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

           CREATE TABLE `ccit_city` (
             `ccit_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             `ccit_name` varchar(200) NOT NULL,
             `ccit_ccnt_id` smallint(6) unsigned NOT NULL,
             PRIMARY KEY (`ccit_id`),
             KEY `ccit_ccnt_id` (`ccit_ccnt_id`),
             CONSTRAINT `ccit_city_ibfk_1` FOREIGN KEY (`ccit_ccnt_id`) REFERENCES `ccnt_country` (`ccnt_id`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


           CREATE TABLE `ccmp_company` (
             `ccmp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             `ccmp_name` varchar(200) NOT NULL,
             `ccmp_ccnt_id` smallint(6) unsigned DEFAULT NULL COMMENT 'contry',
             `ccmp_registrtion_no` varchar(20) DEFAULT NULL,
             `ccmp_vat_registrtion_no` varchar(20) DEFAULT NULL,
             `ccmp_registration_address` varchar(200) DEFAULT NULL,
             `ccmp_official_ccit_id` int(10) unsigned DEFAULT NULL,
             `ccmp_official_address` varchar(200) DEFAULT NULL,
             `ccmp_official_zip_code` varchar(20) DEFAULT NULL,
             `ccmp_office_ccit_id` int(10) unsigned DEFAULT NULL,
             `ccmp_office_address` varchar(200) DEFAULT NULL,
             `ccmp_office_zip_code` varchar(20) DEFAULT NULL,
             `ccmp_statuss` enum('ACTIVE','CLOSED','POTENTIAL') DEFAULT 'ACTIVE',
             `ccmp_description` text,
             `ccmp_office_phone` varchar(45) NOT NULL,
             `ccmp_office_email` varchar(100) NOT NULL,
             `ccmp_agreement_nr` varchar(45) DEFAULT NULL,
             `ccmp_agreement_date` date DEFAULT NULL,
             `ccmp_sys_ccmp_id` int(10) unsigned DEFAULT NULL,
             PRIMARY KEY (`ccmp_id`),
             UNIQUE KEY `ccmp_name_UNIQUE` (`ccmp_name`),
             KEY `ccmp_ccnt_id` (`ccmp_ccnt_id`),
             KEY `ccmp_name` (`ccmp_name`(4)),
             KEY `ccmp_official_ccit_id` (`ccmp_official_ccit_id`),
             KEY `ccmp_office_ccit_id` (`ccmp_office_ccit_id`),
             CONSTRAINT `ccmp_company_ibfk_1` FOREIGN KEY (`ccmp_ccnt_id`) REFERENCES `ccnt_country` (`ccnt_id`),
             CONSTRAINT `ccmp_company_ibfk_2` FOREIGN KEY (`ccmp_official_ccit_id`) REFERENCES `ccit_city` (`ccit_id`),
             CONSTRAINT `ccmp_company_ibfk_3` FOREIGN KEY (`ccmp_office_ccit_id`) REFERENCES `ccit_city` (`ccit_id`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


           CREATE TABLE `ccnt_country` (
             `ccnt_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
             `ccnt_name` varchar(200) NOT NULL,
             `ccnt_code` char(3) CHARACTER SET ascii DEFAULT NULL,
             `ccnt_icao_a2` varchar(2) NOT NULL DEFAULT '',
             `ccnt_icao_a3` varchar(3) NOT NULL DEFAULT '',
             `ccnt_icao_n3` varchar(3) NOT NULL DEFAULT '',
             PRIMARY KEY (`ccnt_id`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


           CREATE TABLE `ccuc_user_company` (
             `ccuc_id` int(3) unsigned NOT NULL AUTO_INCREMENT,
             `ccuc_ccmp_id` int(10) unsigned DEFAULT NULL,
             `ccuc_person_id` smallint(11) unsigned NOT NULL,
             `ccuc_status` enum('USER','HIDDED','PERSON','SYS') CHARACTER SET ascii NOT NULL DEFAULT 'PERSON',
             PRIMARY KEY (`ccuc_id`),
             KEY `ccuc_ccmp_id` (`ccuc_ccmp_id`),
             KEY `ccuc_user_id` (`ccuc_person_id`),
             CONSTRAINT `ccuc_user_company_ibfk_1` FOREIGN KEY (`ccuc_ccmp_id`) REFERENCES `ccmp_company` (`ccmp_id`),
             CONSTRAINT `ccuc_user_company_ibfk_2` FOREIGN KEY (`ccuc_person_id`) REFERENCES `pprs_person` (`pprs_id`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


           CREATE TABLE `ccxg_company_x_group` (
             `ccxg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
             `ccxg_ccmp_id` int(10) unsigned NOT NULL,
             `ccxg_ccgr_id` tinyint(3) unsigned NOT NULL,
             PRIMARY KEY (`ccxg_id`),
             KEY `ccxg_ccmp_id` (`ccxg_ccmp_id`),
             KEY `ccxg_ccgr_id` (`ccxg_ccgr_id`),
             CONSTRAINT `ccxg_company_x_group_ibfk_1` FOREIGN KEY (`ccxg_ccmp_id`) REFERENCES `ccmp_company` (`ccmp_id`),
             CONSTRAINT `ccxg_company_x_group_ibfk_2` FOREIGN KEY (`ccxg_ccgr_id`) REFERENCES `ccgr_group` (`ccgr_id`)
           ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

           SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;

            insert into `authitem` (`name`, `type`, `description`, `bizrule`, `data`) values('Company.*','0','Company full access',NULL,'N;');
            insert into `authitem` (`name`, `type`, `description`, `bizrule`, `data`) values('Company.edit','0','Company module edit',NULL,'N;');
            insert into `authitem` (`name`, `type`, `description`, `bizrule`, `data`) values('Company.fullcontrol','0','Company module full control',NULL,'N;');
            insert into `authitem` (`name`, `type`, `description`, `bizrule`, `data`) values('Company.readonly','0','Company module readonly',NULL,'N;');
            insert into `authitem` (`name`, `type`, `description`, `bizrule`, `data`) values('Company.menu','0','Show company menu',NULL,'N;');
            
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcntCountry.*','0','D2company.CcntCountry',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcntCountry.Create','0','D2company.CcntCountry module create',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcntCountry.View','0','D2company.CcntCountry module view',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcntCountry.Update','0','D2company.CcntCountry module update',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcntCountry.Delete','0','D2company.CcntCountry module delete',NULL,'N;');
                

        ");
    }

    /**
	 * Drops the table
	 */
    public function down()
    {
        $this->execute("

        ");
    }

    /**
	 * Creates initial version of the table in a transaction-safe way.
	 * Uses $this->up to not duplicate code.
	 */
    public function safeUp()
    {
        $this->up();
    }

    /**
	 * Drops the table in a transaction-safe way.
	 * Uses $this->down to not duplicate code.
	 */
    public function safeDown()
    {
        $this->down();
    }
}
