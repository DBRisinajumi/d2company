<?php

class CustomersController extends Controller {
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array('adminCustomers', 'createAjax' , 'adminAjax'),
                'roles' => array('Company.fullcontrol'),
            ),
            array(
                'allow',
                'actions' => array('editableSaver', 'update', 'admin'
                    , 'view', 'export',
                ),
                'roles' => array('Company.edit'),
            ),
            array(
                'allow',
                'actions' => array('admin', 'view', 'export',
                ),
                'roles' => array('Company.readonly'),
            ),
            
            array(
                'allow',
                'actions' => array( 'view', 'export','editableSaver'
                ),
                'roles' => array(DbrUser::RoleCustomerOffice),
            ),
            array(
                'allow',
                'actions' => array('view', 'editableSaver'),
                'roles' => array(DbrUser::RoleCustomerOffice),
            ),            
            array(
                'deny',
                'users' => array('*'),
            ),
        );
    }

    public function beforeAction($action) {
        parent::beforeAction($action);
        if ($this->module !== null) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }
        return true;
    }

  public function actionCreateAjax($ccmp_id) {
      
        $model4update = new User;
        $model4update->scenario = $this->scenario;

        if (isset($_POST['User'])) {

            //$this->performAjaxValidation($model4update, 'branch-form');            

            try {
                
                 $user = new User;
                 $user->username = $_POST['User']['username'];
                 $user->email =  $_POST['User']['email'];
                 $user->superuser = 0;
                 $user->status = 1;
                 $pass = CcmpCompany::createCustomerUser($user ,$ccmp_id);
                 
                       
                 $yiiuser = Yii::app()->getComponent('user');
                 $yiiuser->setFlash('success',"Customer user created with password ".$pass);
                 
                    
            } catch (Exception $e) {
                
                $this->renderPartial("/Customers/_form_horizontal_ajax", array('ccmp_id' => $ccmp_id, 'model4update' => $user)); 
                exit();
                
            }     
                             
            
            
          
         } 
        
         $model4new = new User;
         
         $this->renderPartial("/Customers/_form_horizontal_ajax", array('ccmp_id' => $ccmp_id, 'model4update' => $model4new)); 
        //$this->render('view', array('model' => $model, 'model4grid' => $model4grid, 'model4update' => $model4update));
    } 

  public function actionAdminAjax($ccmp_id)
    {
         $model4grid = new CcucUserCompany('search');
         $model4grid->setAttribute('ccuc_ccmp_id', $ccmp_id);
      
         $model4grid->ccuc_ccmp_id = $ccmp_id;

        if (isset($_GET['User'])) {
            $model4grid->attributes = $_GET['CcbrBranch'];
           
        }
           
        $this->renderPartial("/Customers/_customer_grid", array('model4grid' => $model4grid, 'ccmp_id' => $ccmp_id));
    } 
    
}    