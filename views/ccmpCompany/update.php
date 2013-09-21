<?php
//$this->breadcrumbs[Yii::t('crud', 'Ccmp Companies')] = array('admin');
//$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view', 'id' => $model->{$model->tableSchema->primaryKey});
//$this->breadcrumbs[] = Yii::t('crud', 'Update');
?>

<?php //$this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>

<?php
$this->renderPartial("_toolbar", array("model" => $model));
?>
<h2>
        <?php echo $model->itemLabel ?>

</h2>
<?php

//main update form
$this->beginClip('main');
$this->renderPartial('_form', array('model' => $model));
$this->endClip();

//company group checkboxes
$this->beginClip('company_group');
$this->renderPartial('_groups', array('model' => $model));
$this->endClip();

//tab
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs',
    'placement' => 'left', // 'above', 'right', 'below' or 'left'
    'tabs' => array(
        array('label' => Yii::t('crud', 'Main comapny data'),
            'content' => $this->clips['main'],
        'active'  => CcmpCompanyController::isMainTabActive(),
        ),
        array('label' => Yii::t('crud', 'Company groups'),
            'content' => $this->clips['company_group'],
            'active'  => CcmpCompanyController::isCompanyGroupTabActive(),
        ),
    )
    ));
?>
