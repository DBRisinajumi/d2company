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

//company branches
$this->beginClip('company_branches');
if (isset($model_update_ccbr)) {
    $this->renderPartial('_branch_form', array('model' => $model_update_ccbr));
} elseif (isset($model_manage_ccbr)) {
    $this->renderPartial('_branch_list', array('model' => $model_manage_ccbr,'ccmp_id'=>$model->ccmp_id));
} elseif (isset($model_create_ccbr)) {
    $this->renderPartial('_branch_form', array('model' => $model_create_ccbr));
}
$this->endClip();

//tab
$this->widget('bootstrap.widgets.TbTabs', array(
    'type' => 'tabs',
    'placement' => 'left', // 'above', 'right', 'below' or 'left'
    'tabs' => array(
        array('label' => Yii::t('d2companyModule.crud', 'Main comapny data'),
            'content' => $this->clips['main'],
            'active' => ($active_tab == 'main'),
        ),
        array('label' => Yii::t('d2companyModule.crud', 'Company groups'),
            'content' => $this->clips['company_group'],
            'active' => ($active_tab == 'company_group'),
        ),
        array('label' => Yii::t('d2companyModule.crud', 'Company branches'),
            'content' => $this->clips['company_branches'],
            'active' => ($active_tab == 'company_branches'),
        ),
    )
));
?>
