
<?php
$this->setPageTitle(
        Yii::t('D2companyModule.crud', 'Ccnt Countries')
        . ' - '
        . Yii::t('D2companyModule.crud_static', 'Manage')
);

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'ccnt-country-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>
<h1>
    <?php echo Yii::t('D2companyModule.crud', 'Ccnt Countries'); ?>
    <small><?php echo Yii::t('D2companyModule.crud_static','Manage'); ?></small>
</h1>

<?php 
$this->renderPartial("_toolbar", array("model"=>$model));

$this->widget('TbGridView',
    array(
        'id'=>'ccnt-country-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'template'=>'{pager}{summary}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'columns'=> array(
//            array(
//                'class'=>'CLinkColumn',
//                'header'=>'',
//                'labelExpression'=> '$data->itemLabel',
//                'urlExpression'=> 'Yii::app()->controller->createUrl("view", array("ccnt_id" => $data["ccnt_id"]))'
//            ),
//                    array(
//            'class' => 'editable.EditableColumn',
//            'name' => 'ccnt_id',
//            'editable' => array(
//                'url' => $this->createUrl('/d2company/ccntCountry/editableSaver'),
//                //'placement' => 'right',
//            )
//        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccnt_name',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccntCountry/editableSaver'),
                'placement' => 'right',
            )
        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccnt_code',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccntCountry/editableSaver'),
                //'placement' => 'right',
            )
        ),

            array(
                'class'=>'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'FALSE'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcntCountry.Update")'),
                    'delete' => array('visible' => 'FALSE'),
                ),
                'viewButtonUrl'   => 'Yii::app()->controller->createUrl("view", array("ccnt_id" => $data->ccnt_id))',
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ccnt_id" => $data->ccnt_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ccnt_id" => $data->ccnt_id))',
            ),
        )
    )
);
?>