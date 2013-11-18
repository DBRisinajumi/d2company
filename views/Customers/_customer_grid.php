<?php


$ajaxUpdateUrl = Yii::app()->controller->createUrl("/d2company/Customers/adminAjax", array("ccmp_id" => $ccmp_id));

$this->widget('TbGridView',
    array(
        'id' => 'customer-grid',
        'type' => 'bordered condensed striped',
        'dataProvider' => $model4grid->searchCustomers(),
        'filter' => $model4grid,
        'ajaxUrl' => $ajaxUpdateUrl,
        'template' => '{items}{summary}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
       'columns' => array(
           
//         array(
//            
//            'name' => 'ccuc_user_id',
//            'filter' => false,
//            ),
//          
     
        array(
       //     'class' => 'editable.EditableColumn',
            'header' => 'username',
            'name' => 'ccucUsers.username',
         //   'value' =>  'CHtml::value($data, \'ccucUsers.username\')',  
       //     'editable' => array(
      //          'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
      //      )
        ),
        array(
          //  'class' => 'editable.EditableColumn',
            'header' => 'email',
             'name' => 'ccucUsers.email',
            //'value' =>  'CHtml::value($data, \'ccucUsers.email\')',  
          //  'editable' => array(
         //       'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
         //   )
        ),
          array(
         //   'class' => 'editable.EditableColumn',
            'header' => 'Name',
             'name' => 'ccucUsers.profile.first_name',
            //'value' =>  'CHtml::value($data, \'ccucUsers.email\')',  
          //  'editable' => array(
          //      'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
          //  )
        ),  
          array(
            'class' => 'editable.EditableColumn',
            'header' => 'Surname',
             'name' => 'ccucUsers.profile.last_name',
            //'value' =>  'CHtml::value($data, \'ccucUsers.email\')',  
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
            )
        ),    
         array(
            'class' => 'editable.EditableColumn',
            'header' => 'Phone',
             'name' => 'ccucUsers.profile.phone',
            //'value' =>  'CHtml::value($data, \'ccucUsers.email\')',  
            'editable' => array(
                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
            )
        ),
           
        array(
            'class' => 'TbButtonColumn',
            'buttons' => array(
                'view' => array('visible' => 'FALSE'),
                'delete' => array('visible' => 'FALSE'),
            ),
             'updateButtonUrl' => 'Yii::app()->controller->createUrl("updateccbr")',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl("ccbrBranch/delete")',
      
            ),
    )
  )
);
?>

