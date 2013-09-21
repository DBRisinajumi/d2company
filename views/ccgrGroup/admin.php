
<?php
$this->breadcrumbs[] = Yii::t('d2companyModule.crud','Ccgr Groups');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'ccgr-group-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    
    <?php echo Yii::t('d2companyModule.crud', 'Ccgr Groups'); ?>
    <small><?php echo Yii::t('d2companyModule.p3crud', 'Manage'); ?></small>
    
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id'=>'ccgr-group-grid',
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
                'urlExpression'=> 'Yii::app()->controller->createUrl("view", array("ccgr_id" => $data["ccgr_id"]))'
            ),
                    array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccgr_id',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccgrGroup/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccgr_name',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccgrGroup/editableSaver'),
                //'placement' => 'right',
            )
        ),
        #'ccgr_notes',
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccgr_hide',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccgrGroup/editableSaver'),
                //'placement' => 'right',
            )
        ),

            array(
                'class'=>'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcgrGroup.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcgrGroup.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcgrGroup.Delete")'),
                ),
                'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("ccgr_id" => $data->ccgr_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ccgr_id" => $data->ccgr_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ccgr_id" => $data->ccgr_id))',
            ),
        )
    )
);
?>