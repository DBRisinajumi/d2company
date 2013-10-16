<?php
$this->setPageTitle(
    Yii::t('d2companyModule.crud', 'Ccuc User Companies')
    . ' - '
    . Yii::t('d2companyModule.crud_static', 'Manage')
);

$this->breadcrumbs[] = Yii::t('d2companyModule.crud', 'Ccuc User Companies');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'ccuc-user-company-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>
    <h1>

        <?php echo Yii::t('d2companyModule.crud', 'Ccuc User Companies'); ?>
        <small><?php echo Yii::t('d2companyModule.crud_static', 'Manage'); ?></small>

    </h1>

<?php $this->renderPartial("_toolbar", array("model" => $model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id' => 'ccuc-user-company-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'template' => '{pager}{summary}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns' => array(
            array(
                'class' => 'CLinkColumn',
                'header' => '',
                'labelExpression' => '$data->itemLabel',
                'urlExpression' => 'Yii::app()->controller->createUrl("view", array("ccuc_id" => $data["ccuc_id"]))'
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccuc_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'name' => 'ccuc_ccmp_id',
                'value' => 'CHtml::value($data, \'ccucCcmp.itemLabel\')',
                'filter' => CHtml::listData(CcmpCompany::model()->findAll(array('limit' => 1000)), 'ccmp_id', 'itemLabel'),
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccuc_user_id',
                'editable' => array(
                    'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccuc_first_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'cucc_last_name',
                'editable' => array(
                    'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccuc_status',
                'editable' => array(
                    'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                    //'placement' => 'right',
                )
            ),

            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcucUserCompany.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcucUserCompany.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcucUserCompany.Delete")'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("ccuc_id" => $data->ccuc_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ccuc_id" => $data->ccuc_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ccuc_id" => $data->ccuc_id))',
            ),
        )
    )
);
?>