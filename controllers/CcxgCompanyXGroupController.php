<?php


class CcxgCompanyXGroupController extends Controller
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

    public function accessRules() {
        return array(
            array(
                'allow',
                'actions' => array('create', 'editableSaver', 'update', 'delete', 'admin', 'view','AjaxCreate'),
                'roles' => array('Company.fullcontrol'),
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

    public function actionView($ccxg_id)
    {
        $model = $this->loadModel($ccxg_id);
        $this->render('view', array('model' => $model,));
    }

    public function actionCreate()
    {
        $model = new CcxgCompanyXGroup;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ccxg-company-xgroup-form');

        if (isset($_POST['CcxgCompanyXGroup'])) {
            $model->attributes = $_POST['CcxgCompanyXGroup'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ccxg_id' => $model->ccxg_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccxg_id', $e->getMessage());
            }
        } elseif (isset($_GET['CcxgCompanyXGroup'])) {
            $model->attributes = $_GET['CcxgCompanyXGroup'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($ccxg_id)
    {
        $model = $this->loadModel($ccxg_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ccxg-company-xgroup-form');

        if (isset($_POST['CcxgCompanyXGroup'])) {
            $model->attributes = $_POST['CcxgCompanyXGroup'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ccxg_id' => $model->ccxg_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccxg_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionEditableSaver()
    {
        Yii::import('EditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new EditableSaver('CcxgCompanyXGroup'); // classname of model to be updated
        $es->update();
    }
    
    public function actionAjaxCreate($field, $value) 
    {
        $model = new CcxgCompanyXGroup;
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

    public function actionDelete($ccxg_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($ccxg_id)->delete();
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
        $model = new CcxgCompanyXGroup('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['CcxgCompanyXGroup'])) {
            $model->attributes = $_GET['CcxgCompanyXGroup'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $m = CcxgCompanyXGroup::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ccxg-company-xgroup-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
