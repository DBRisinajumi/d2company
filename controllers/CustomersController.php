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
                'actions' => array('adminCustomers', 'createAjax' , 'adminAjax', 'delete'),
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
    
  public function actionDelete($id){
      
      $profile =  Profile::model()->findByPk($id);
      $profile->delete();
      
      $user =  User::model()->findByPk($id);
      $user->delete();
      
      $ccuc = CcucUserCompany::model()->deleteAll('ccuc_user_id =:id', array(':id' => $id));     
      
  }   

  public function actionCreateAjax($ccmp_id) {
      

        if (isset($_POST['User'])) {

            //$this->performAjaxValidation($model4update, 'branch-form');            

            try {
                
                 $user = new User;
                 $user->username = $_POST['User']['username'];
                 $user->email =  $_POST['User']['email'];
                 $user->superuser = 0;
                 $user->status = 1;
                 
                 $profile = new Profile;
                 $profile->attributes = $_POST['Profile'];
                 
                 if (!$user->validate()  || !$profile->validate() ){
                     
                      $this->renderPartial("/Customers/_form_horizontal_ajax", array('ccmp_id' => $ccmp_id, 'model4updateuser' => $user ,'model4updateprofile' => $profile)); 
                      exit();
                 }
                     
                 
                 
                 $pass = CcmpCompany::createCustomerUser($user , $profile, $ccmp_id);
                
                 $yiiuser = Yii::app()->getComponent('user');
                 $yiiuser->setFlash('success',"Customer user created with password ".$pass);
                 
                 if (isset($_POST['email_pass'])){ 
                                      
                       $message = new YiiMailMessage;
                       $message->setSubject('New user created');
                       $message->setBody('New user created. <br />
                                   username: <b>'. $user->username.'</b>, password:<b> '.$pass.'</b>', 'text/html');
 
 
                       $message->addTo($_POST['email_pass']);
                       $message->from = 'noreply@parkoil.lt';
                       $sent = Yii::app()->mail->send($message);
                 } 
                 
                    
            } catch (Exception $e) {
                
                $this->renderPartial("/Customers/_form_horizontal_ajax", array('ccmp_id' => $ccmp_id, 'model4updateuser' => $user,'model4updateprofile' => $profile)); 
                exit();
                
            }     
                             
            
            
          
         } 
        
         $model4newuser = new User;
         $model4newprofile = new Profile;
         
         $this->renderPartial("/Customers/_form_horizontal_ajax", array('ccmp_id' => $ccmp_id, 'model4updateuser' => $model4newuser,'model4updateprofile' => $model4newprofile)); 
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