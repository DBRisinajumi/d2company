<?php
 
class m141006_130210_auth_CcmpCompany extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcmpCompany.*','0','D2company.CcmpCompany',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcmpCompany.Create','0','D2company.CcmpCompany module create',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcmpCompany.View','0','D2company.CcmpCompany module view',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcmpCompany.Update','0','D2company.CcmpCompany module update',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcmpCompany.Delete','0','D2company.CcmpCompany module delete',NULL,'N;');
            INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcmpCompany.Menu','0','D2company.CcmpCompany menu',NULL,'N;');
        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `authitem` WHERE `name` = 'D2company.CcmpCompany.*';
            DELETE FROM `authitem` WHERE `name` = 'D2company.CcmpCompany.Create';
            DELETE FROM `authitem` WHERE `name` = 'D2company.CcmpCompany.View';
            DELETE FROM `authitem` WHERE `name` = 'D2company.CcmpCompany.Update';
            DELETE FROM `authitem` WHERE `name` = 'D2company.CcmpCompany.Delete';
            DELETE FROM `authitem` WHERE `name` = 'D2company.CcmpCompany.Menu';
        ");
    }

    public function safeUp()
    {
        $this->up();
    }

    public function safeDown()
    {
        $this->down();
    }
}


