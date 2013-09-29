
<?php

$this->setPageTitle(
        Yii::t('d2companyModule.crud', 'Companies')
        . ' - '
        . Yii::t('d2companyModule.p3crud', 'List')
);
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update(
            'ccmp-company-grid',
            {data: $(this).serialize()}
        );
        return false;
    });
    ");
?>

<h1>
    
    <?php echo Yii::t('d2companyModule.crud', 'Companies'); ?>
    <small><?php echo Yii::t('d2companyModule.p3crud','List'); ?></small>
    
</h1>

<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>



<?php
$this->widget('TbGridView',
    array(
        'id'=>'ccmp-company-grid',
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
//                'urlExpression'=> 'Yii::app()->controller->createUrl("view", array("ccmp_id" => $data["ccmp_id"]))'
//            ),
//                    array(
//            'class' => 'editable.EditableColumn',
//            'name' => 'ccmp_id',
//            'editable' => array(
//                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                //'placement' => 'right',
//            )
//        ),
        array(
      //      'class' => 'editable.EditableColumn',
            'name' => 'ccmp_name',
            'header' =>  Yii::t('d2companyModule.crud', 'Name'),
    //        'editable' => array(
    //            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                //'placement' => 'right',
          //  )
        ),
        array(
                    'name'=>'ccmp_ccnt_id',
                    'header' =>  Yii::t('d2companyModule.crud', 'Country'),
                    'value'=>'CHtml::value($data,\'ccmpCcnt.itemLabel\')',
                            'filter'=>CHtml::listData(CcntCountry::model()->findAll(array('limit'=>1000)), 'ccnt_id', 'itemLabel'),
                            ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccmp_registrtion_no',
            'header' =>  Yii::t('d2companyModule.crud', 'Registration Nr'),
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                //'placement' => 'right',
            )
        ),
//        array(
//            'class' => 'editable.EditableColumn',
//            'name' => 'ccmp_vat_registrtion_no',
//            'editable' => array(
//                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                //'placement' => 'right',
//            )
//        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccmp_registration_address',
            'header' =>  Yii::t('d2companyModule.crud', 'Registration Address'),
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                //'placement' => 'right',
            )
        ),
//        array(
//            'class' => 'editable.EditableColumn',
//            'name' => 'ccmp_official_address',
//            'editable' => array(
//                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                //'placement' => 'right',
//            )
//        ),
        array(
            'class' => 'editable.EditableColumn',
            'name' => 'ccmp_statuss',
            'header' =>  Yii::t('d2companyModule.crud', 'State'),
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                //'placement' => 'right',
            )
        ),
        
        #'ccmp_description',

            array(
                'class'=>'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'FALSE'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("D2company.CcmpCompany.Update")'),
                    'delete' => array('visible' => 'FALSE'),
                ),
                'viewButtonUrl'   => null,
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("ccmp_id" => $data->ccmp_id))',
                'deleteButtonUrl' => null,
            ),
        )
    )
);
?>