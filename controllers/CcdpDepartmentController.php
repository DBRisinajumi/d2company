<?php


class CcdpDepartmentController extends Controller
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
            'actions' => array('editableSaver', 'delete','ajaxCreate'),
            'roles' => array('D2company.CcdpDepartment.*'),
        ),
        array(
            'allow',
            'actions' => array('ajaxCreate'),
            'roles' => array('D2company.CcdpDepartment.Create'),
        ),
        array(
            'allow',
            'actions' => array('update', 'editableSaver'),
            'roles' => array('D2company.CcdpDepartment.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2company.CcdpDepartment.Delete'),
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


    public function actionEditableSaver()
    {
        $es = new EditableSaver('CcdpDepartment'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value) 
    {
        $model = new CcdpDepartment;
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
    
    public function actionDelete($ccdp_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($ccdp_id)->delete();
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
            throw new CHttpException(400, Yii::t('D2companyModule.crud', 'Invalid request. Please do not repeat this request again.'));
        }
    }

    public function loadModel($id)
    {
        $m = CcdpDepartment::model();
        // apply scope, if available
        $scopes = $m->scopes();
        if (isset($scopes[$this->scope])) {
            $m->{$this->scope}();
        }
        $model = $m->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yii::t('D2companyModule.crud', 'The requested page does not exist.'));
        }
        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ccdp-department-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
