<?php


$ajaxUpdateUrl = Yii::app()->controller->createUrl("/d2company/Customers/adminAjax", array("ccmp_id" => $ccmp_id));

$this->widget('TbGridView',
    array(
        'id' => 'customer-grid',
        'type' => 'bordered condensed striped',
        'dataProvider' => $modelCcuc->searchCustomers(),
        'filter' => $model4grid,
        'ajaxUrl' => $ajaxUpdateUrl,
        'template' => '{items}{summary}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
       'columns' => array(
        array(
            'header' => 'email',
             'name' => 'email',
        ),
          array(
            'header' => 'Name',
             'name' => 'first_name',
        ),  
          array(
            'class' => 'TbEditableColumn',
            'header' => 'Surname',
             'name' => 'last_name',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                'emptytext' => Yii::t('D2companyModule.crud_static', 'Empty'),
            )
        ),    
         array(
            'class' => 'TbEditableColumn',
            'header' => 'Phone',
             'name' => 'phone',
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                'emptytext' => Yii::t('D2companyModule.crud_static', 'Empty'),
            )
        ),
           
        array(
            'class' => 'TbButtonColumn',
            'buttons' => array(
                'view' => array('visible' => 'FALSE'),
                'delete' => array('visible' => 'TRUE'),
            ),
             'updateButtonUrl' => 'Yii::app()->controller->createUrl("updateccbr")',
           // 'deleteButtonUrl' => 'Yii::app()->controller->createUrl("Customers/delete",array("id" => $data->ccucUsers->id))',
      
            ),
    )
  )
);