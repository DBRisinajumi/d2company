<?php


class CcmpCompanyController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";

public function filters()
{
return array(
'accessControl',
);
}

public function accessRules()
{
return array(
array(
'allow',
'actions' => array('create', 'editableSaver', 'update', 'delete', 'admin', 'view'),
'roles' => array('DataCardEditor'),
),
array(
'deny',
'users' => array('*'),
),
);
}

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        if ($this->module !== null) {
            $this->breadcrumbs[$this->module->Id] = array('/' . $this->module->Id);
        }
        return true;
    }

    public function actionView($ccmp_id)
    {
        $model = $this->loadModel($ccmp_id);
        $this->render('view', array('model' => $model,));
    }

    public function actionCreate()
    {
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
                        $this->redirect(array('view', 'ccmp_id' => $model->ccmp_id));
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

    public function actionUpdate($ccmp_id)
    {
        $model = $this->loadModel($ccmp_id);
        $model->scenario = $this->scenario;
        
        if(self::isCompanyGroupTabActive()){
            // submited company group form
            $mCcxg = new CcxgCompanyXGroup();
            
            //get DB checked
            $aExistTypes = array();
            foreach($model->ccxgCompanyXGroups as $modelCcxg){
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
            
            $aDelType = array_diff($aExistTypes,$aPostType);
            $aNewType = array_diff($aPostType,$aExistTypes);
              
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
            $criteria->condition='ccxg_ccmp_id=:ccxg_ccmp_id AND ccxg_ccgr_id=:ccxg_ccgr_id';

            foreach ($aDelType as $nType){
                $criteria->params=array(
                    ':ccxg_ccmp_id'=>$model->ccmp_id, 
                    ':ccxg_ccgr_id'=>$nType);
                $Ppxt = CcxgCompanyXGroup::model()->find($criteria);
                $Ppxt->delete();
            }
            //reload record, jo attēlos veco tipus
            $model = $this->loadModel($ccmp_id);            
        }

        $this->performAjaxValidation($model, 'ccmp-company-form');

        if (isset($_POST['CcmpCompany'])) {
            $model->attributes = $_POST['CcmpCompany'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ccmp_id' => $model->ccmp_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccmp_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionEditableSaver()
    {
        Yii::import('EditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new EditableSaver('CcmpCompany'); // classname of model to be updated
        $es->update();
    }

    public function actionDelete($ccmp_id)
    {
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
            throw new CHttpException(400, Yii::t('crud', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    public function actionAdmin()
    {
        $model = new CcmpCompany('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['CcmpCompany'])) {
            $model->attributes = $_GET['CcmpCompany'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $m = CcmpCompany::model();
        // apply scope, if available
        $scopes = $m->scopes();
        if (isset($scopes[$this->scope])) {
            $m->{$this->scope}();
        }
        $model = $m->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('crud', 'The requested page does not exist.'));
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ccmp-company-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    static function isMainTabActive(){
        return !self::isCompanyGroupTabActive();
    }
    
    static function isCompanyGroupTabActive(){
        return isset($_POST['save_company_group']);
    }


}
