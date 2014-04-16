<?php


class CcntCountryController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";
    public $menu_route = "d2company/ccntCountry";    

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

    public function actionView($ccnt_id)
    {
        $model = $this->loadModel($ccnt_id);
        $this->render('view', array('model' => $model,));
    }

    public function actionCreate()
    {
        $model = new CcntCountry;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ccnt-country-form');

        if (isset($_POST['CcntCountry'])) {
            $model->attributes = $_POST['CcntCountry'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ccnt_id' => $model->ccnt_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccnt_id', $e->getMessage());
            }
        } elseif (isset($_GET['CcntCountry'])) {
            $model->attributes = $_GET['CcntCountry'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($ccnt_id)
    {
        $model = $this->loadModel($ccnt_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'ccnt-country-form');

        if (isset($_POST['CcntCountry'])) {
            $model->attributes = $_POST['CcntCountry'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'ccnt_id' => $model->ccnt_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('ccnt_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model,));
    }

    public function actionEditableSaver()
    {
        Yii::import('EditableSaver'); //or you can add import 'ext.editable.*' to config
        $es = new EditableSaver('CcntCountry'); // classname of model to be updated
        $es->update();
    }

    public function actionDelete($ccnt_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($ccnt_id)->delete();
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
        $model = new CcntCountry('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['CcntCountry'])) {
            $model->attributes = $_GET['CcntCountry'];
        }

        $this->render('admin', array('model' => $model,));
    }

    public function loadModel($id)
    {
        $m = CcntCountry::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ccnt-country-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
