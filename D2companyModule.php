<?php

class D2companyModule extends CWebModule
{
    /**
     * visible tab list. If in config no defined, show all tabs. See init()
     * @var type 
     */
    public $tabs = array(
                'company_data',
                'company_custom_data',
                'company_group',
                'company_branches',
                'company_managers',
                'company_customers',
                'company_cars',
                'company_files',
            );
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'd2company.models.*',
			'd2company.components.*',
                        'user.components',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
