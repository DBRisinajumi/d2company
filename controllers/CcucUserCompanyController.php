<?php


class CcucUserCompanyController extends Controller
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
                'actions' => array('create', 'editableSaver', 'update', 'delete', 'admin', 'view', 'resetPassword', 'ajaxCreate'),
                'roles' => array('D2company.CcucUserCompany.*'),
            ),
            array(
                'allow',
                'actions' => array('create', 'ajaxCreate'),
                'roles' => array('D2company.CcucUserCompany.Create'),
            ),
            array(
                'allow',
                'actions' => array('update', 'editableSaver'),
                'roles' => array('D2company.CcucUserCompany.Update'),
            ),
            array(
                'allow',
                'actions' => array('delete'),
                'roles' => array('D2company.CcucUserCompany.Delete'),
            ),
            array(
                'allow',
                'actions' => array('admin'),
                'roles' => array('D2company.CcucUserCompany.View'),
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

    public function actionView($ccuc_id)
    {
        $model = $this->loadModel($ccuc_id);
        $this->render('view', array('model' => $model,));
    }

    public function actionCreate()
    {
        $model = new CcucUserCompany;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ccuc-user-company-form');

        if (isset($_POST['CcucUserCompany'])) {
            $model->attributes = $_POST['CcucUserCompany'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ccuc_id' => $model->ccuc_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccuc_id', $e->getMessage());
            }
        } elseif (isset($_GET['CcucUserCompany'])) {
            $model->attributes = $_GET['CcucUserCompany'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($ccuc_id)
    {
        $model = $this->loadModel($ccuc_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ccuc-user-company-form');

        if (isset($_POST['CcucUserCompany'])) {
            $model->attributes = $_POST['CcucUserCompany'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ccuc_id' => $model->ccuc_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccuc_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model,));
    }

    /**
     * for company ccuc on change status to USER create customer office uses
     * @return type
     */
    public function actionEditableSaver()
    {
        Yii::import('EditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new EditableSaver('CcucUserCompany'); // classname of model to be updated
        $es->update();
        
        //verify if change statuss 
        if($es->attribute != 'ccuc_status'){
            return;
        }
        
        //verify if status changet to USER
        if($es->value != CcucUserCompany::CCUC_STATUS_USER){
            return;
        }
        
        //if do not have user, create
        $m = Person::model();
        return $m->createUser($es->model->ccucPerson->id);
        
    }

    public function actionAjaxCreate($field, $value) 
    {
        $model = new CcucUserCompany;
        $model->$field = $value;
        try {
            if ($model->save()) {
                return TRUE;
            }else{
                return var_export($model->getErrors());
            }            
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
        }
    }     
    
    public function actionDelete($ccuc_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($ccuc_id)->delete();
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

    public function actionAdmin()
    {
        $model = new CcucUserCompany('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['CcucUserCompany'])) {
            $model->attributes = $_GET['CcucUserCompany'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $m = CcucUserCompany::model();
        // apply scope, if available
        $scopes = $m->scopes();
        if (isset($scopes[$this->scope])) {
            $m->{$this->scope}();
        }
        $model = $m->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('D2companyModule.crud_static', 'The requested page does not exist.'));
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ccuc-user-company-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
