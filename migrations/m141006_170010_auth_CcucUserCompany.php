<?php
 
class m141006_170010_auth_CcucUserCompany extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcucUserCompany.*','0','D2company.CcucUserCompany',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcucUserCompany.Create','0','D2company.CcucUserCompany module create',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcucUserCompany.View','0','D2company.CcucUserCompany module view',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcucUserCompany.Update','0','D2company.CcucUserCompany module update',NULL,'N;') on duplicate key update `data` = values(`data`);
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcucUserCompany.Delete','0','D2company.CcucUserCompany module delete',NULL,'N;') on duplicate key update `data` = values(`data`);
        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CcucUserCompany.*';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CcucUserCompany.Create';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CcucUserCompany.View';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CcucUserCompany.Update';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CcucUserCompany.Delete';
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


