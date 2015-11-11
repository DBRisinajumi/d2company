<?php


class CucpUserCompanyPositionController extends Controller
{
    #public $layout='//layouts/column2';

    public $defaultAction = "admin";
    public $scenario = "crud";
    public $scope = "crud";

    public $menu_route = "d2company/cucpUserCompanyPosition";    

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
            'actions' => array('create', 'admin', 'view', 'update', 'editableSaver', 'delete','ajaxCreate'),
            'roles' => array('D2company.CucpUserCompanyPosition.*'),
        ),
        array(
            'allow',
            'actions' => array('create','ajaxCreate'),
            'roles' => array('D2company.CucpUserCompanyPosition.Create'),
        ),
        array(
            'allow',
            'actions' => array('view', 'admin'), // let the user view the grid
            'roles' => array('D2company.CucpUserCompanyPosition.View'),
        ),
        array(
            'allow',
            'actions' => array('update', 'editableSaver'),
            'roles' => array('D2company.CucpUserCompanyPosition.Update'),
        ),
        array(
            'allow',
            'actions' => array('delete'),
            'roles' => array('D2company.CucpUserCompanyPosition.Delete'),
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

    public function actionView($cucp_id, $ajax = false)
    {
        $model = $this->loadModel($cucp_id);
        if($ajax){
            $this->renderPartial('_view-relations_grids', 
                    array(
                        'modelMain' => $model,
                        'ajax' => $ajax,
                        )
                    );
        }else{
            $this->render('view', array('model' => $model,));
        }
    }

    public function actionCreate()
    {
        $model = new CucpUserCompanyPosition;
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'cucp-user-company-position-form');

        if (isset($_POST['CucpUserCompanyPosition'])) {
            $model->attributes = $_POST['CucpUserCompanyPosition'];

            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('admin'));
                    }
                }
            } catch (Exception $e) {
                $model->addError('cucp_id', $e->getMessage());
            }
        } elseif (isset($_GET['CucpUserCompanyPosition'])) {
            $model->attributes = $_GET['CucpUserCompanyPosition'];
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($cucp_id)
    {
        $model = $this->loadModel($cucp_id);
        $model->scenario = $this->scenario;

        $this->performAjaxValidation($model, 'cucp-user-company-position-form');

        if (isset($_POST['CucpUserCompanyPosition'])) {
            $model->attributes = $_POST['CucpUserCompanyPosition'];


            try {
                if ($model->save()) {
                    if (isset($_GET['returnUrl'])) {
                        $this->redirect($_GET['returnUrl']);
                    } else {
                        $this->redirect(array('view', 'cucp_id' => $model->cucp_id));
                    }
                }
            } catch (Exception $e) {
                $model->addError('cucp_id', $e->getMessage());
            }
        }

        $this->render('update', array('model' => $model));
    }

    public function actionEditableSaver()
    {
        $es = new EditableSaver('CucpUserCompanyPosition'); // classname of model to be updated
        $es->update();
    }

    public function actionAjaxCreate($field, $value) 
    {
        $model = new CucpUserCompanyPosition;
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
    
    public function actionDelete($cucp_id)
    {
        if (Yii::app()->request->isPostRequest) {
            try {
                $this->loadModel($cucp_id)->delete();
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

    public function actionAdmin()
    {
        $model = new CucpUserCompanyPosition('search');
        $scopes = $model->scopes();
        if (isset($scopes[$this->scope])) {
            $model->{$this->scope}();
        }
        $model->unsetAttributes();

        if (isset($_GET['CucpUserCompanyPosition'])) {
            $model->attributes = $_GET['CucpUserCompanyPosition'];
        }

        $this->render('admin', array('model' => $model));
    }

    /**
     * load controller model
     * @param int $id
     * @return PfOrderItemNotes
     * @throws CHttpException|
     */
    public function loadModel($id)
    {
        $m = CucpUserCompanyPosition::model();
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cucp-user-company-position-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
