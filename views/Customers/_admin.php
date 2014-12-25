<?php 

Yii::beginProfile('Person.view.grid'); 

//$this->widget('EFancyboxWidget',array(
//    'selector'=>'a[href*=\'audittrail/show/fancybox\']',
//    'options'=>array(
//    ),
//));    

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
                    'placement' => 'right',
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
                'class' => 'TbEditableColumn',
                'name' => 'ccuc_status',
                'value' => '$data->getEnumLabel(\'ccuc_status\',$data->ccuc_status)',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                    'source' => $model->getEnumFieldLabels('ccuc_status'),
                    //'placement' => 'right',
                ),
            ),            
            array(
                'name' => 'create_at',
                'value'  => '$data->ccucPerson->create_at',
            ),
            array(
                'name' => 'lastvisit_at',
                'value'  => '$data->ccucPerson->lastvisit_at',
            ),
        array(
                'template' => '{reset_password}',
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'reset_password' => array(
                        'label' => Yii::t('D2companyModule.crud', 'Reset password'),
                        'url' => 'Yii::app()->controller->createUrl("resetPersonPassword", array("ccmp_id"=>$data->ccuc_ccmp_id,"person_id"=>$data->ccucPerson->id))',
                        'visible' => '($data->ccuc_status == CcucUserCompany::CCUC_STATUS_USER)',
                        'options' =>  array(
                            'title' => Yii::t('D2companyModule.crud', 'Send new password by email'),
                         ),
                        ),
                ),

            ),
//        array(
//                'template' => '{info}',
//                'class' => 'TbButtonColumn',
//                'buttons' => array(
//                    'info' => array(
//                        'label' => '<i class="icon-info-sign"></i>',
//                        //'imageUrl' => false,
//                        'url'=>"array(
//                                '/audittrail/show/fancybox',
//                                'model_name' => 'Person',
//                                'model_id' => \$data->ccuc_person_id,
//                            )",
//                        'options' =>  array(
//                            'title' => Yii::t('D2companyModule.crud', 'Show record history'),
//                         ),                        
//                        //'visible' => '(isset($data->bfrf_fiit_id))'
//                    ),                                
//                ),
//
//            ),
        )
    )
);

Yii::endProfile('Person.view.grid');