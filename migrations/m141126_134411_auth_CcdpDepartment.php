<?php
 
class m141126_134411_auth_CcdpDepartment extends CDbMigration
{

    public function up()
    {
        $this->execute("
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcdpDepartment.*','0','D2company.CcdpDepartment',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcdpDepartment.Create','0','D2company.CcdpDepartment module create',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcdpDepartment.View','0','D2company.CcdpDepartment module view',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcdpDepartment.Update','0','D2company.CcdpDepartment module update',NULL,'N;');
            INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES('D2company.CcdpDepartment.Delete','0','D2company.CcdpDepartment module delete',NULL,'N;');
        ");
    }

    public function down()
    {
        $this->execute("
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CcdpDepartment.*';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CcdpDepartment.Create';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CcdpDepartment.View';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CcdpDepartment.Update';
            DELETE FROM `AuthItem` WHERE `name`= 'D2company.CcdpDepartment.Delete';
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


