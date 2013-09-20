
<?php
$this->breadcrumbs[] = Yii::t('crud','Ccxg Company Xgroups');
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'ccxg-company-xgroup-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    
    <?php echo Yii::t('crud', 'Ccxg Company Xgroups'); ?>
    <small><?php echo Yii::t('crud', 'Manage'); ?></small>
    
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id'=>'ccxg-company-xgroup-grid',
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
                'urlExpression'=> 'Yii::app()->controller->createUrl("view", array("ccxg_id" => $data["ccxg_id"]))'
            ),
                    array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccxg_id',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccxgCompanyXGroup/editableSaver'),
                //'placement' => 'right',
            )
        ),
        array(
                    'name'=>'ccxg_ccmp_id',
                    'value'=>'CHtml::value($data,\'ccxgCcmp.itemLabel\')',
                            'filter'=>CHtml::listData(CcmpCompany::model()->findAll(array('limit'=>1000)), 'ccmp_id', 'itemLabel'),
                            ),
        array(
                    'name'=>'ccxg_ccgr_id',
                    'value'=>'CHtml::value($data,\'ccxgCcgr.itemLabel\')',
                            'filter'=>CHtml::listData(CcgrGroup::model()->findAll(array('limit'=>1000)), 'ccgr_id', 'itemLabel'),
                            ),

            array(
                'class'=>'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcxgCompanyXGroup.View")'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcxgCompanyXGroup.Update")'),
                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcxgCompanyXGroup.Delete")'),
                ),
                'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("ccxg_id" => $data->ccxg_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ccxg_id" => $data->ccxg_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ccxg_id" => $data->ccxg_id))',
            ),
        )
    )
);
?>