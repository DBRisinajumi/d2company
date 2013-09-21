<?php


class CcbrBranchController extends Controller
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
'roles' => array('D2company.CcbrBranch.*'),
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

    public function actionView($ccbr_id)
    {
        $model = $this->loadModel($ccbr_id);
        $this->render('view', array('model' => $model,));
    }

    public function actionCreate()
    {
        $model = new CcbrBranch;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ccbr-branch-form');

        if (isset($_POST['CcbrBranch'])) {
            $model->attributes = $_POST['CcbrBranch'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ccbr_id' => $model->ccbr_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccbr_id', $e->getMessage());
            }
        } elseif (isset($_GET['CcbrBranch'])) {
            $model->attributes = $_GET['CcbrBranch'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($ccbr_id)
    {
        $model = $this->loadModel($ccbr_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ccbr-branch-form');

        if (isset($_POST['CcbrBranch'])) {
            $model->attributes = $_POST['CcbrBranch'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ccbr_id' => $model->ccbr_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccbr_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionEditableSaver()
    {
        Yii::import('EditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new EditableSaver('CcbrBranch'); // classname of model to be updated
        $es->update();
    }

    public function actionDelete($ccbr_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($ccbr_id)->delete();
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
        $model = new CcbrBranch('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['CcbrBranch'])) {
            $model->attributes = $_GET['CcbrBranch'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $m = CcbrBranch::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ccbr-branch-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
