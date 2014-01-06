<?php Yii::beginProfile('Person.view.grid'); ?>


<?php
$this->widget('TbGridView',
    array(
        'id' => 'person-grid',
        'dataProvider' => $model->search(),
        //'filter' => $model,
        //'responsiveTable' => true,
        'template' => '{pager}{items}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),        
        'columns' => array(

            array(
                'class' => 'TbEditableColumn',
                'name' => 'ccucPerson.first_name',
                'editable' => array(
                    'url' => $this->createUrl('/person/person/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'TbEditableColumn',
                'name' => 'ccucPerson.last_name',
                'editable' => array(
                    'url' => $this->createUrl('/person/person/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            
            array(
                'class' => 'TbEditableColumn',
                'name' => 'ccucPerson.email',
                'editable' => array(
                    'url' => $this->createUrl('/person/person/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'TbEditableColumn',
                'name' => 'ccucPerson.phone',
                'editable' => array(
                    'url' => $this->createUrl('/person/person/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'ccuc_status',
                'value' => '$data->getEnumLabel(\'ccuc_status\',$data->ccuc_status)',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                    'source' => $model->getEnumFieldLabels('ccuc_status'),
                    //'placement' => 'right',
                ),
            ),            
//            array(
//                'name' => 'user_id',
//                'value' => 'CHtml::value($data, \'user.username\')',
//                'filter' => '',//CHtml::listData(User::model()->findAll(array('limit' => 1000)), 'id', 'itemLabel'),
//            ),

//            array(
//                'class' => 'TbButtonColumn',
//                'buttons' => array(
//                    'view' => array('visible' => 'Yii::app()->user->checkAccess("Person.Person.View")'),
//                    'update' => array('visible' => 'Yii::app()->user->checkAccess("Person.Person.Update")'),
//                    'delete' => array('visible' => 'Yii::app()->user->checkAccess("Person.Person.Delete")'),
//                ),
//                'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("id" => $data->id))',
//                'updateButtonUrl' => 'Yii::app()->controller->createUrl("update", array("id" => $data->id))',
//                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("id" => $data->id))',
//            ),
        )
    )
);
?>
<?php Yii::endProfile('Person.view.grid'); ?>