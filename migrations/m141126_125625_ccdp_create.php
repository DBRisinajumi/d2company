<?php

class m141126_125625_ccdp_create extends EDbMigration
{
	public function up()
	{
        $this->execute("
            CREATE TABLE `ccdp_department` (
              `ccdp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `ccdp_ccmp_id` int(10) unsigned NOT NULL,
              `ccdp_name` varchar(50) DEFAULT NULL,
              PRIMARY KEY (`ccdp_id`),
              KEY `ccdp_ccmp_id` (`ccdp_ccmp_id`),
              CONSTRAINT `ccdp_department_ibfk_1` FOREIGN KEY (`ccdp_ccmp_id`) REFERENCES `ccmp_company` (`ccmp_id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

        ");
        
	}

	public function down()
	{
        $this->execute("
            DROP TABLE `ccdp_department`;
        ");

	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}