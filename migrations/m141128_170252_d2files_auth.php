<?php

class m141128_170252_d2files_auth extends EDbMigration
{
	public function up()
	{
        $this->execute("
            INSERT INTO `authitem` 
            (`name`, `type`, `description`, `bizrule`, `data`) 
            VALUES
            ('D2company.CcmpCompany.uploadD2File','0','D2company.CcmpCompany upolad D2Files',NULL,'N;'),
            ('D2company.CcmpCompany.downloadD2File','0','D2company.CcmpCompany downloas D2Files',NULL,'N;'),
            ('D2company.CcmpCompany.deleteD2File','0','D2company.CcmpCompany delete D2Files',NULL,'N;')
    ;
        ");
        
	}

	public function down()
	{
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