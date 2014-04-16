
<?php
$this->breadcrumbs[] = Yii::t('crud','Ccbr Branches');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'ccbr-branch-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    
    <?php echo Yii::t('crud', 'Ccbr Branches'); ?>
    <small><?php echo Yii::t('D2companyModule.crud_static','Manage'); ?></small>
    
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id'=>'ccbr-branch-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'template'=>'{pager}{summary}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns'=> array(
            array(
                'class'=>'CLinkColumn',
                'header'=>'',
                'labelExpression'=> '$data->itemLabel',
                'urlExpression'=> 'Yii::app()->controller->createUrl("view", array("ccbr_id" => $data["ccbr_id"]))'
            ),
                    array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccbr_id',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
                    'name'=>'ccbr_ccmp_id',
                    'value'=>'CHtml::value($data,\'ccbrCcmp.itemLabel\')',
                            'filter'=>CHtml::listData(CcmpCompany::model()->findAll(array('limit'=>1000)), 'ccmp_id', 'itemLabel'),
                            ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccbr_name',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccrb_code',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                //'placement' => 'right',
            )
        ),
        #'ccbr_notes',
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccbr_hide',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                //'placement' => 'right',
            )
        ),

            array(
                'class'=>'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcbrBranch.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcbrBranch.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcbrBranch.Delete")'),
                ),
                'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("ccbr_id" => $data->ccbr_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ccbr_id" => $data->ccbr_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ccbr_id" => $data->ccbr_id))',
            ),
        )
    )
);
?>