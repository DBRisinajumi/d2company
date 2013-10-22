
<?php

$this->setPageTitle(
        Yii::t('d2companyModule.crud', 'Companies')
        . ' - '
        . Yii::t('d2companyModule.crud_static', 'List')
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

Yii::app()->clientScript->registerScript('export', "
    $('.export-button').click(function(){
        $('.export-form').toggle();
        return false;
    });  
    ");
?>

<table class="toolbar">
    <tr>  
      <td>  
<h2>
    <?php echo Yii::t('d2companyModule.crud', 'Companies'); ?>
    <small><?php echo Yii::t('d2companyModule.crud_static','List'); ?></small>
</h2>    
      </td>  
<td>
<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>
</td>
</tr> 
</table>    

<div class="search-form" style="display:none">
        <?php $this->renderPartial('_search', array('model' => $model,)); ?>
    </div>
<div class="export-form" style="display:none">
        <?php $this->renderPartial('_export', array('model' => $model,)); ?>
    </div>


<?php
$this->widget('TbGridView',
    array(
        'id'=>'ccmp-company-grid',
        'type'=>'bordered condensed',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'template'=>'{items}{summary}{pager}',
        'rowCssClassExpression' => '$data->cssclass',
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
            'name' => 'managers',
            'header' =>  Yii::t('d2companyModule.crud', 'Managers'),
            

        ),
        array(
                    'name'=>'ccmp_ccnt_id',
                    'header' =>  Yii::t('d2companyModule.crud', 'Country'),
                    'value'=>'CHtml::value($data,\'ccmpCcnt.itemLabel\')',
                            'filter'=>CHtml::listData(CcntCountry::model()->findAll(array('limit'=>1000)), 'ccnt_id', 'itemLabel'),
                     'htmlOptions'=>array('style'=>'width:100px;'),

                            ),
         array(
                    'name'=>'ccmp_office_ccit_id',
                    'header' =>  Yii::t('d2companyModule.crud', 'City'),
                    'value'=>'CHtml::value($data,\'ccmpOfficeCcit.itemLabel\')',
                            'filter'=>CHtml::listData(CcitCity::model()->findAll(array('limit'=>1000)), 'ccit_id', 'itemLabel'),
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
        array(
            //'class' => 'editable.EditableColumn',
            'name' => 'cccdCustomData.number_cars',
            'header' => Yii::t('d2companyModule.crud', 'Trucks'),
           
        ),
        array(
            'name' => 'ccmp_statuss',
            'header' =>  Yii::t('d2companyModule.crud', 'State'),
            //'editable' => array(
            //    'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                //'placement' => 'right',
            
        ),
        
        #'ccmp_description',

            array(
                //'class'=>'TbButtonColumn',
                'class'=>'EButtonColumnWithClearFilters',
                'buttons' => array(
                    'view' => array('visible' => 'FALSE'),
                    'update' => array('visible' => 'Yii::app()->user->checkAccess("Company.fullcontrol")'),
                    'delete' => array('visible' => 'FALSE'),
                ),
                'viewButtonUrl'   => null,
                'updateButtonUrl' => 'Yii::app()->controller->createUrl("updateExtended", array("ccmp_id" => $data->ccmp_id))',
                'deleteButtonUrl' => null,
            ),
        )
    )
);



?>