<?php

class CcmpCompanyController extends Controller {
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
                'actions' => array('create', 'editableSaver', 'update', 'delete', 'admin'
                    , 'view', 'updateccbr', 'manageccbr', 'updateGroup', 'updatemanager', 'export',
                    'createccbr', 'updateExtended', 'updateCustom', 'AdminManagers',
                    'UpdateManagers', 'CreateManager', 'adminCars','adminCustomers'),
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

    public function actionView() {
        $ccmp_id = Yii::app()->userCompany->getActiveCompany();
        $model = $this->loadModel($ccmp_id);
        $this->render('view', array('model' => $model,));
    }

    public function actionCreate() {
        $model = new CcmpCompany;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ccmp-company-form');

        if (isset($_POST['CcmpCompany'])) {
            $model->attributes = $_POST['CcmpCompany'];

            try {

                if ($model->save()) {
                    
                    // new Custom Data
                    $custom = new BaseCccdCompanyData;
                    $custom->cccd_ccmp_id = $model->ccmp_id;
                    $custom->save();

                     
                    // user creation
                    if (!empty($_POST['username'])) {   
                        
                        try {
                             
                              $user = new User;
                              $user->username = $_POST['username'];
                              $user->email = $model->ccmp_office_email;
                              $user->superuser = 0;
                              $user->status = 1;
                              CcmpCompany::createCustomerUser($user ,$model->ccmp_id);
                             
                        } catch (Exception $e) {
                            
                              $user = Yii::app()->getComponent('user');
                              $user->setFlash('warning', $e->message); 
                            
                        }
                    
                }
                 if (isset($_GET['returnUrl'])) {
                    $this->redirect($_GET['returnUrl']);
                } else {
                    $this->redirect(array('updateExtended', 'ccmp_id' => $model->ccmp_id));
                }
                
                }



               
            } catch (Exception $e) {
                $model->addError('ccmp_id', $e->getMessage());
            }
        } elseif (isset($_GET['CcmpCompany'])) {
            $model->attributes = $_GET['CcmpCompany'];
        }

        $this->render('create', array('model' => $model));
    }
    
    public function actionCreateccbr($ccmp_id) {
        
         $model = new CcbrBranch;

         $this->performAjaxValidation($model, 'ccbr-branch-form');
        
        if (isset($_POST['CcbrBranch'])) {

            $model = new CcbrBranch;
            $model->attributes = $_POST['CcbrBranch'];
            $model->ccbr_ccmp_id = $ccmp_id;
            //var_dump($model->attributes);exit;
            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                          $this->redirect(array('manageccbr', 'ccmp_id' => $ccmp_id, 'ccbr_id' => $model->ccbr_id));     
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccbr_id', $e->getMessage());
            }
        } else {

        //company
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;

        //branch
        $mCcbr = new CcbrBranch();
        $this->render(
                'update_extended', array(
            'model' => $model,
            'active_tab' => 'createccbr',
            'mCcbr' => $mCcbr,
                )
        );
        }
    }

    public function actionManageccbr($ccmp_id, $ccbr_id = FALSE) {
        
        //company
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;

        //branch
        //$criteria = new CDbCriteria;
        //$criteria->addCondition('ccbr_ccmp_id = :ccmp_id');
        //$criteria->params = array(':ccmp_id' => $model->ccmp_id);
        $mCcbr = new CcbrBranch('search');
        //$mCcbr->findAll($criteria);
        $mCcbr->setAttribute('ccbr_ccmp_id', $ccmp_id);
        //$mCcbr->dbCriteria->order='ccbr_name ASC';
        $this->render(
                'update_extended', array(
            'model' => $model,
            'ccbr_id' => $ccbr_id,
            'active_tab' => 'company_branches',
            'mCcbr' => $mCcbr,
                )
        );
    }

    public function actionUpdateccbr($ccmp_id, $ccbr_id = FALSE) {

        //company
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;

        if (isset($_POST['CcbrBranch'])) {

            $m = CcbrBranch::model();
            $model = $m->findByPk($ccbr_id);
            $model->attributes = $_POST['CcbrBranch'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('manageccbr', 'ccmp_id' => $ccmp_id, 'ccbr_id' => $model->ccbr_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccbr_id', $e->getMessage());
            }
        }

        //branch
        $m = CcbrBranch::model();
        $mCcbr = $m->findByPk($ccbr_id);
        $this->render(
                'update_extended', array(
            'model' => $model,
            'ccbr_id' => $ccbr_id,
            'active_tab' => 'updateccbr',
            'mCcbr' => $mCcbr,
                )
        );
    }

    public function actionUpdateGroup($ccmp_id) {

        //company        
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;

        //update record
        if (isset($_POST['save_company_group'])) {
            $mCcxg = new CcxgCompanyXGroup();

            //get DB checked
            $aExistTypes = array();
            foreach ($model->ccxgCompanyXGroups as $modelCcxg) {
                $mCcxg = $modelCcxg;
                $aExistTypes[] = $mCcxg->ccxg_ccgr_id;
            }

            //get in form checked
            $aPostType = array();
            if (isset($_POST['ccxg_ccgr_id'])) {
                foreach ($_POST['ccxg_ccgr_id'] as $nPtypId) {
                    $aPostType[] = $nPtypId;
                }
            }

            $aDelType = array_diff($aExistTypes, $aPostType);
            $aNewType = array_diff($aPostType, $aExistTypes);

            foreach ($aNewType as $nType) {
                $postCcxg = new CcxgCompanyXGroup;
                $postCcxg->ccxg_ccmp_id = $model->ccmp_id;
                $postCcxg->ccxg_ccgr_id = $nType;
                if (!$postCcxg->save()) {
                    print_r($postCategory->errors);
                    exit;
                }
            }

            //criteria for deleting
            $criteria = new CDbCriteria;
            $criteria->condition = 'ccxg_ccmp_id=:ccxg_ccmp_id AND ccxg_ccgr_id=:ccxg_ccgr_id';

            foreach ($aDelType as $nType) {
                $criteria->params = array(
                    ':ccxg_ccmp_id' => $model->ccmp_id,
                    ':ccxg_ccgr_id' => $nType);
                $Ppxt = CcxgCompanyXGroup::model()->find($criteria);
                $Ppxt->delete();
            }
            //reload record, jo attēlos veco tipus
            $model = $this->loadModel($ccmp_id);
            $this->redirect(array('updategroup', 'ccmp_id' => $model->ccmp_id));
        }

        //branc
        $criteria = new CDbCriteria;
        $criteria->addCondition('ccbr_ccmp_id = :ccmp_id');
        $criteria->params = array(':ccmp_id' => $model->ccmp_id);
        $mCcbr = new CcbrBranch('search');
        $mCcbr->findAll($criteria);

        $this->render(
                'update_extended', array(
            'model' => $model,
            'active_tab' => 'company_group',
            'mCcbr' => $mCcbr,
                )
        );
    }

    public function actionUpdateManagers($ccmp_id) {

        //company        
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;
        
         

        //update record
        if (isset($_POST['save_company_manager'])) {
            $mCcuc = new CcucUserCompany();

            //get DB checked
            $aExistTypes = array();
            foreach ($model->ccucUserCompany as $modelCcuc) {
                $mCcuc = $modelCcuc;
                $aExistTypes[] = $mCcuc->ccuc_user_id;
            }

            //get in form checked
            $aPostType = array();
            if (isset($_POST['ccuc_user_id'])) {
                foreach ($_POST['ccuc_user_id'] as $nPtypId) {
                    $aPostType[] = $nPtypId;
                }
            }

            $aDelType = array_diff($aExistTypes, $aPostType);
            $aNewType = array_diff($aPostType, $aExistTypes);

            foreach ($aNewType as $nType) {
                $postCcuc = new CcucUserCompany;
                $postCcuc->ccuc_ccmp_id = $model->ccmp_id;
                $postCcuc->ccuc_user_id = $nType;
                if (!$postCcuc->save()) {
                    print_r($postCcuc->errors);
                    exit;
                }
            }

            //criteria for deleting
            $criteria = new CDbCriteria;
            $criteria->condition = 'ccuc_ccmp_id=:ccuc_ccmp_id AND ccuc_user_id=:ccuc_user_id';

            foreach ($aDelType as $nType) {
                $criteria->params = array(
                    ':ccuc_ccmp_id' => $model->ccmp_id,
                    ':ccuc_user_id' => $nType);
                $Ppxt = CcucUserCompany::model()->find($criteria);
                $Ppxt->delete();
            }
            //reload record, jo attēlos veco tipus
            $this->redirect(array('updatemanagers', 'ccmp_id' => $ccmp_id, 'active_tab' => 'company_managers'));
        }
       
        $this->render(
                'update_extended', array(
            'model' => $model,
            'active_tab' => 'company_managers',
                )
        );
    }

      public function actionAdminCars($ccmp_id) {
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;
      
        $this->render(
            'update_extended', array(
            'model' => $model,
            'active_tab' => 'company_car_list',
                )
        );
    }
    
     public function actionAdminCustomers($ccmp_id) {
        
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario; 
        $mCcuc = new CcucUserCompany('search');
        $mCcuc->setAttribute('ccuc_ccmp_id', $ccmp_id);
      
        
        $this->render(
                '/ccmpCompany/update_extended', array(
            'model' => $model,
            'modelCcuc' => $mCcuc,
            'active_tab' => 'company_customer_list',
                )
        );
    }
    
   
    
   
    public function actionUpdateCustomers($ccmp_id, $ccuc_id) {
        $m = new CcucUserCompany();
        $mCcuc = $m->findByPk($ccuc_id);

        $this->performAjaxValidation($mCcuc, 'ccuc-user-company-form');

        if (isset($_POST['CcucUserCompany'])) {
            $mCcuc->attributes = $_POST['CcucUserCompany'];


            try {
                if ($mCcuc->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array(
                            'adminManagers',
                            'ccmp_id' => $ccmp_id,
                        ));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccuc_id', $e->getMessage());
            }
        }

        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;

        $this->render('update_extended', array(
            'model' => $model,
            'mCcuc' => $mCcuc,
            'active_tab' => 'company_manager_update',
        ));
    }

    public function actionUpdateCustom($ccmp_id) {

        //company
        //update record
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;
        $custom = $model->cccdCustomData;
        
        if (isset($_POST['BaseCccdCompanyData'])) {

            $custom->attributes = $_POST['BaseCccdCompanyData'];
        //    if ($custom->validate()) {
                $custom->save();
//                $this->redirect(array(
//                    'actionUpdateCustom',
//                    'ccmp_id' => $ccmp_id,
//                    'active_tab' => 'company_custom',
//                ));
        //    }
        }
        
 
        $this->render(
                'update_extended', array(
            'model' => $model,
            'active_tab' => 'company_custom',
                )
        );
    }

    public function actionUpdate($ccmp_id) {
        //company group forma submitita
        if (isset($_POST['save_company_group'])) {
            $this->actionUpdategroup($ccmp_id);
            return;
        }

        //company manager forma submitita
        if (isset($_POST['save_company_manager'])) {
            $this->actionUpdatemanager($ccmp_id);
            return;
        }

        //company group forma submitita
//        if (isset($_POST['save_custom'])) {
//            $this->actionUpdateCustom($ccmp_id);
//            return;
//        }

        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;
        $custom = $model->cccdCustomData;

        

        $this->performAjaxValidation($model, 'ccmp-company-form');

        if (isset($_POST['CcmpCompany'])) {
            $model->attributes = $_POST['CcmpCompany'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array(
                            'update',
                            'ccmp_id' => $model->ccmp_id,
                            'active_tab' => 'main',
                        ));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccmp_id', $e->getMessage());
            }
        }
        //branc
        $criteria = new CDbCriteria;
        $criteria->addCondition('ccbr_ccmp_id = :ccmp_id');
        $criteria->params = array(':ccmp_id' => $model->ccmp_id);
        $mCcbr = new CcbrBranch('search');
        $mCcbr->findAll($criteria);

        $this->render(
                'update', array(
            'model' => $model,
            'active_tab' => 'main',
            'model_manage_ccbr' => $mCcbr,
                )
        );
    }

    public function actionUpdateExtended($ccmp_id) {

        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;
    //    $custom = $model->cccdCustomData;

        $this->performAjaxValidation($model, 'ccmp-company-form');

        if (isset($_POST['CcmpCompany'])) {
            $model->attributes = $_POST['CcmpCompany'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array(
                            'updateExtended',
                            'ccmp_id' => $model->ccmp_id,
                            'active_tab' => 'company_data',
                        ));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccmp_id', $e->getMessage());
            }
        }

        $this->render(
                'update_extended', array(
            'model' => $model,
            'active_tab' => 'company_data',
                )
        );
    }

    public function actionEditableSaver() {
        Yii::import('EditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new EditableSaver('CcmpCompany'); // classname of model to be updated
        $es->update();
    }

    public function actionDelete($ccmp_id) {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($ccmp_id)->delete();
            } catch (Exception $e) {
                throw new CHttpException(500, $e->getMessage());
            }

            if (!isset($_GET['ajax'])) {
                if (isset($_GET['returnUrl'])) {
                    $this->redirect($_GET['returnUrl']);
                } else {
                    $this->redirect(array('admin'));
                }
            }
        } else {
            throw new CHttpException(400, Yii::t('d2companyModule.crud_static', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    public function actionAdmin() {
        $model = new RememberCcmpCompany('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        
        // clear filters
      //  if (intval(Yii::app()->request->getParam('clearFilters'))==1) {
      //      EButtonColumnWithClearFilters::clearFilters($this,$model);//where $this is the controller
      //  }

        if (isset($_GET['CcmpCompany'])) {
            $model->attributes = $_GET['CcmpCompany'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function actionExport() {
        $model = new RememberCcmpCompany('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }


        if (isset($_GET['CcmpCompany'])) {
            $model->attributes = $_GET['CcmpCompany'];
        }

        $this->widget('EExcelView', array(
            'title' => 'Title',
            'dataProvider' => $model->search(),
            'autoWidth' => true,
            'grid_mode' => 'export',
            'title' => 'Title',
            'filename' => (isset($_POST['filename']) ? $_POST['filename'] : 'report'),
            'stream' => true,
            'exportType' => 'Excel2007',
        ));
    }

    private function _createUser($username, $email,$password) {
        $mUser = new User;
        $mUser->attributes = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'superuser' => 0,
            'status' => User::STATUS_ACTIVE,
        );
        $mUser->activkey = UserModule::encrypting(microtime() . $mUser->password);
        //if (!$mUser->validate()) {
        //    return FALSE;
        //}
        $mUser->password = UserModule::encrypting($mUser->password);
        if (!$mUser->save()) {
            return FALSE;
        }
        return $mUser->id;
    }
    
    

    public function loadModel($id) {
        $m = CcmpCompany::model();
        // apply scope, if available
        $scopes = $m->scopes();
        if (isset($scopes[$this->scope])) {
            $m->{$this->scope}();
        }
        $model = $m->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('d2companyModule.crud_static', 'The requested page does not exist.'));
        }
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ccmp-company-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    static function isMainTabActive() {
        return !self::isCompanyGroupTabActive() && !self::isBrancTabActive();
    }

    static function isCompanyGroupTabActive() {
        return isset($_POST['save_company_group']);
    }

    static function isBrancTabActive() {
        return self::isActionBrancEdit();
    }

    static function isActionBrancEdit() {
        return isset($_GET['ccbr_id']);
    }

}
