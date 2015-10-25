<?php

class CcmpCompanyController extends Controller {
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";
    public $menu_route = "d2company/ccmpCompany";

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        $customer_user_role = array();
        if (isset(Yii::app()->getModule('user')->customerUser['role'])){
            $customer_user_role = array(Yii::app()->getModule('user')->customerUser['role']);
        }
        return array(
            array(
                'allow',
                'actions' => array('create', 'editableSaver', 'update', 'delete', 'admin'
                    , 'view', 'updateccbr', 'manageccbr', 'updateGroup', 'updatemanager', 'export',
                    'createccbr', 'updateExtended', 'updateCustom', 'AdminManagers',
                    'UpdateManagers', 'CreateManager', 'adminCars','adminCustomers','updateFiles',
                    'upload','deleteFile','downloadFile','resetPersonPassword', 'select2ajax'
                    ),
                'roles' => array('Company.fullcontrol','D2company.CcmpCompany.*'),
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
                'actions' => array('admin', 'view', 'export','downloadFile'
                ),
                'roles' => array('Company.readonly','D2company.CcmpCompany.View'),
            ),
            array(
                'allow',
                'actions' => array('create','ajaxCreate'),
                'roles' => array('D2company.CcmpCompany.Create'),
            ),
            array(
                'allow',
                'actions' => array('update', 'editableSaver'),
                'roles' => array('D2company.CcmpCompany.Update'),
            ),
            array(
                'allow',
                'actions' => array('delete'),
                'roles' => array('D2company.CcmpCompany.Delete'),
            ),            
            array(
                'allow',
                'actions' => array( 'view', 'view4CustomerOffice','export','editableSaver'
                ),
                'roles' => $customer_user_role,
            ),
            array(
                'allow',
                'actions' => array('view', 'editableSaver'),
                'roles' => $customer_user_role,
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

    /**
     * show user company
     */
    public function actionView($ccmp_id) {
        //$ccmp_id = Yii::app()->userCompany->getActiveCompany();
        $model = $this->loadModel($ccmp_id);
        $this->render('view', array('model' => $model,));
    }

    /**
     * customer office 
     */
    public function actionView4CustomerOffice() {

        $pprs_id = Yii::app()->getModule('user')->user()->profile->person_id;
        $customer_companies = ccucUserCompany::model()->getPersonCompnies($pprs_id, CcucUserCompany::CCUC_STATUS_PERSON);
        if(empty($customer_companies)){
            throw new CHttpException(404, Yii::t('D2companyModule.crud_static', 'The requested page does not exist.'));
        }

        $model = $this->loadModel($customer_companies[0]->ccuc_ccmp_id);
        $this->layout='//layouts/main';
        $this->render('view4CustomerOffice', array('model' => $model,));
    }

    public function actionCreate() {
        $model = new CcmpCompany;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ccmp-company-form');

        if (isset($_POST['CcmpCompany'])) {
            $model->attributes = $_POST['CcmpCompany'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        if(Yii::app()->user->checkAccess('Company.fullcontrol')
                                || Yii::app()->user->checkAccess('D2company.CcmpCompany.*')){
                            $this->redirect(array('updateExtended', 'ccmp_id' => $model->ccmp_id));
                        }else{
                            $this->redirect(array('view', 'ccmp_id' => $model->ccmp_id));
                        }
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
        
         $model = $this->loadModel($ccmp_id);
        
         $model_ccbr = new CcbrBranch;

         $this->performAjaxValidation($model_ccbr, 'ccbr-branch-form');
        
        if (isset($_POST['CcbrBranch'])) {

            $model_ccbr = new CcbrBranch;
            $model_ccbr->attributes = $_POST['CcbrBranch'];
            $model_ccbr->ccbr_ccmp_id = $ccmp_id;
            //var_dump($model->attributes);exit;
            try {
                if ($model_ccbr->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                          $this->redirect(array('manageccbr', 'ccmp_id' => $ccmp_id, 'ccbr_id' => $model_ccbr->ccbr_id));     
                    }
                }
            } catch (Exception $e) {
                $model_ccbr->addError('ccbr_id', $e->getMessage());
            }
        } else {

        //company
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
        $mCcbr = new CcbrBranch('search');

        $mCcbr->setAttribute('ccbr_ccmp_id', $ccmp_id);

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

            foreach ($aDelType as $ccgr_id) {
                //ja nav admins nedzesh sys comany
                if($ccgr_id == Yii::app()->params['ccgr_group_sys_company']
                        && !Yii::app()->user->checkAccess("Administrator")){
                    continue;
                }
                $criteria->params = array(
                    ':ccxg_ccmp_id' => $model->ccmp_id,
                    ':ccxg_ccgr_id' => $ccgr_id);
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
    
    public function actionUpdateFiles($ccmp_id) {

        //company        
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;
       
        $this->render(
            'update_extended', array(
            'model' => $model,
            'active_tab' => 'company_files',
                )
        );
    }
    
    public function actionUpload($model_id ) {

        Yii::import( "vendor.dbrisinajumi.d1files.compnents.*");
        $oUploadHandler = new UploadHandlerD1files(
                        array(
                            'model_name' => 'CcmpCompany',
                            'model_id' => $model_id,
                        )
        );

    }

    public function actionDeleteFile($id) {
        Yii::import( "vendor.dbrisinajumi.d1files.compnents.*");        
        UploadHandlerD1files::deleteFile($id);
    }

    public function actionDownloadFile($id) {
        
        $m = D1files::model();
        $model = $m->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested record in d1files does not exist.');
        }
        
        Yii::import( "vendor.dbrisinajumi.d1files.compnents.*");
        $oUploadHandler = new UploadHandlerD1files(
                        array(
                            'model_name' => 'CcmpCompany',
                            'model_id' => $id,
                            'download_via_php' => TRUE,
                            'file_name' => $model->file_name,
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
        
        yii::import('vendor.dbrisinajumi.person.PersonModule');


        if (isset($_POST['Person'])) {
            $model_person = new Person;
            $model_person->scenario = $this->scenario;

            $this->performAjaxValidation($model_person, 'person-form');

            $model_person->attributes = $_POST['Person'];

            try {
                $model_person->save();
                $mCcuc = new CcucUserCompany;
                $mCcuc->ccuc_ccmp_id = $ccmp_id;
                $mCcuc->ccuc_person_id = $model_person->primaryKey;
                $mCcuc->save();
            } catch (Exception $e) {
                $model_person->addError('id', $e->getMessage());
            }
        }

        if (isset($_POST['CcucUserCompany'])) {
            $model_uc = new CcucUserCompany;
            $model_uc->scenario = $this->scenario;

            $this->performAjaxValidation($model_uc, 'person-form');

            $model_uc->attributes = $_POST['CcucUserCompany'];
            $model_uc->ccuc_ccmp_id = $ccmp_id;
            try {
                $model_uc->save();
            } catch (Exception $e) {
                $model_person->addError('id', $e->getMessage());
            }
        }

        $model_person = new Person;
        $model_ccuc = new CcucUserCompany;
       
        $model->scenario = $this->scenario;
        $model_cucc_new = new CcucUserCompany();
        
        // perosn list
        $mCcuc = new CcucUserCompany('search');
        $mCcuc->unsetAttributes();
        $mCcuc->setAttribute('ccuc_ccmp_id', $ccmp_id);

        if (isset($_GET['isAjaxRequest'])) {
            $this->renderPartial(
                    '/ccmpCompany/update_extended', array(
                'model' => $model,
                'modelCcuc' => $mCcuc,
                'model_cucc_new' => $model_cucc_new,
                'model_person' => $model_person,
                'active_tab' => 'company_customer_list',
                    )
            );
        } else {
            $this->render(
                    '/ccmpCompany/update_extended', array(
                'model' => $model,
                'modelCcuc' => $mCcuc,
                'model_cucc_new' => $model_cucc_new,
                'model_person' => $model_person,
                'active_tab' => 'company_customer_list',
                    )
            );
        }
    }

    public function actionUpdateCustomers($ccmp_id, $ccuc_id) {
        
        $model = $this->loadModel($ccmp_id);
        
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


        $model->scenario = $this->scenario;

        $this->render('update_extended', array(
            'model' => $model,
            'mCcuc' => $mCcuc,
            'active_tab' => 'company_manager_update',
        ));
    }

    public function actionUpdateCustom($ccmp_id) {


        //update record
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;
        $custom = $model->cccdCustomData;
        
        if (isset($_POST['BaseCccdCompanyData'])) {

            $custom->attributes = $_POST['BaseCccdCompanyData'];
                $custom->save();
        }
 
        $this->render(
                'update_extended', array(
            'model' => $model,
            'active_tab' => 'company_custom',
                )
        );
    }

    public function actionUpdate($ccmp_id) {
        
        $model = $this->loadModel($ccmp_id);
        
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
            $model = $this->loadModel($ccmp_id);
            
            try {
                $model->delete();
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
            throw new CHttpException(400, Yii::t('D2companyModule.crud_static', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    public function actionAdmin() {
        Yii::import("vendor.pentium10.yii-clear-filters-gridview.components.*");
        $model = new RememberCcmpCompany('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }

        if (isset($_GET['CcmpCompany'])) {
            $model->attributes = $_GET['CcmpCompany'];
        }
        if (isset($_GET['RememberCcmpCompany'])) {
            $this->renderPartial('admin', array('model' => $model,));
        }else{
            $this->render('admin', array('model' => $model,));
        }
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

    /**
     * send to user new password
     * @return type
     */
    public function actionResetPersonPassword($ccmp_id,$person_id)
    {
        //only for validation acces
        $model = $this->loadModel($ccmp_id);
        
        yii::import('vendor.dbrisinajumi.person.PersonModule');
        //if do not have user, create
        $m = Person::model();
        $m->resetPassword($person_id);
        
        $this->redirect(array('adminCustomers', 'ccmp_id' => $ccmp_id));
        
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
            throw new CHttpException(404, Yii::t('D2companyModule.crud_static', 'The requested page does not exist.'));
        }
        
//		if (Yii::app()->sysCompany->getActiveCompany()){
//            if( !Yii::app()->sysCompany->isValidUserCompany($model->ccmp_sys_ccmp_id)){
//                throw new CHttpException(404, Yii::t('D2companyModule.crud_static', 'Requested closed data.'));
//            }    
//        }                
        
        return $model;
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ccmp-company-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    
    public function actionSelect2ajax(){
        
        if(isset($_GET['q'])){
            $queryterm  = $_GET['q'];


                       
            $data = Yii::app()->db->createCommand("SELECT ccit_id as id, ccit_name as text FROM ccit_city WHERE ccit_name LIKE '$queryterm%'")->queryAll();
            echo CJSON::encode($data);
        } else echo '{}';
    
        Yii::app()->end();
}

//    static function isMainTabActive() {
//        return !self::isCompanyGroupTabActive() && !self::isBrancTabActive();
//    }

//    static function isCompanyGroupTabActive() {
//        return isset($_POST['save_company_group']);
//    }

//    static function isBrancTabActive() {
//        return self::isActionBrancEdit();
//    }

//    static function isActionBrancEdit() {
//        return isset($_GET['ccbr_id']);
//    }

}
