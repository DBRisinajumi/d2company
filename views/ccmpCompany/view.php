<?php

$can_edit = FALSE && (
        Yii::app()->user->checkAccess("Company.fullcontrol") 
        || Yii::app()->user->checkAccess("Company.edit") 
        || Yii::app()->user->checkAccess("D2person.PprsPerson.Update")
        );

$this->setPageTitle(Yii::t('D2companyModule.crud', 'Company Data'));    
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "htmlOptions"=>array(
                    "class"=>"search-button",
                    "data-toggle"=>"tooltip",
                    "title"=>Yii::t("D2companyModule.crud_static","Back"),
                )
 ),true);
    
?>

<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            <h1>
                <i class="icon-building"></i>
                <?php echo Yii::t('D2companyModule.crud','Company Data');?>
            </h1>
        </div>
        <div class="btn-group">
            <?php
               if(Yii::app()->user->checkAccess("audittrail") 
                    && isset(Yii::app()->getModule('d2company')->options['audittrail']) 
                    && Yii::app()->getModule('d2company')->options['audittrail'])
                {        
                    Yii::import('audittrail.*');
                    $this->widget("vendor.dbrisinajumi.audittrail.widgets.AudittrailViewTbButton",array(
                        'model_name' => get_class($model),
                        'model_id' => $model->getPrimaryKey(),
                    ));                       
                }                
            ?>
        </div>
    </div>
</div>



<div class="row">
    <div class="span5">

        <?php
        $this->widget(
            'TbAceDetailView',
            array(
                'data' => $model,
                'label_width' => 150,
                'attributes' => array(
                
                array(
                    'name' => 'ccmp_name',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_name',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    )
                ),

                array(
                    'name' => 'ccmp_ccnt_id',
                    'type' => 'raw',
                    'value' => $can_edit ? $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'source' => CHtml::listData(CcntCountry::model()->findAll(array('limit' => 1000)), 'ccnt_id', 'itemLabel'),
                            'attribute' => 'ccmp_ccnt_id',
                            'apply' => $can_edit,
                            //'placement' => 'right',
                        ),
                        true
                    ):(!empty($model->ccmp_ccnt_id)?$model->ccmpCcnt->itemLabel:''),
                ),

                array(
                    'name' => 'ccmp_registrtion_no',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_registrtion_no',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_registrtion_no),
                ),

                array(
                    'name' => 'ccmp_vat_registrtion_no',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_vat_registrtion_no',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_vat_registrtion_no),
                ),

                array(
                    'name' => 'ccmp_registration_date',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'type' => 'date',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'attribute' => 'ccmp_registration_date',
                            'apply' => $can_edit,
                            //'placement' => 'right',
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_registration_date),
                ),

                array(
                    'name' => 'ccmp_registration_address',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_registration_address',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_registration_address),
                ),

                array(
                    'name' => 'ccmp_official_ccit_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'source' => CHtml::listData(CcitCity::model()->findAll(array('limit' => 1000)), 'ccit_id', 'itemLabel'),
                            'attribute' => 'ccmp_official_ccit_id',
                            'apply' => $can_edit,
                            //'placement' => 'right',
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_official_ccit_id),
                ),

                array(
                    'name' => 'ccmp_official_address',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_official_address',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_official_address),
                ),

                array(
                    'name' => 'ccmp_official_zip_code',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_official_zip_code',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_official_zip_code),
                ),

                array(
                    'name' => 'ccmp_office_ccit_id',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'source' => CHtml::listData(CcitCity::model()->findAll(array('limit' => 1000)), 'ccit_id', 'itemLabel'),
                            'attribute' => 'ccmp_office_ccit_id',
                            'apply' => $can_edit,
                            //'placement' => 'right',
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_office_ccit_id),
                ),

                array(
                    'name' => 'ccmp_office_address',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_office_address',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_office_address),
                ),

                array(
                    'name' => 'ccmp_office_zip_code',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_office_zip_code',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_office_zip_code),
                ),

                array(
                    'name' => 'ccmp_statuss',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'type' => 'select',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'source' => $model->getEnumFieldLabels('ccmp_statuss'),
                            'attribute' => 'ccmp_statuss',
                            'apply' => $can_edit,
                            //'placement' => 'right',
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_statuss),
                ),

                array(
                    'name' => 'ccmp_description',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_description',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_description),
                ),

                array(
                    'name' => 'ccmp_office_phone',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_office_phone',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_office_phone),
                ),

                array(
                    'name' => 'ccmp_office_email',
                    'type' => 'raw',
                    'value' => $this->widget(
                        'EditableField',
                        array(
                            'model' => $model,
                            'attribute' => 'ccmp_office_email',
                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            'apply' => $can_edit,
                        ),
                        true
                    ),
                    'visible' => $can_edit || !empty($model->ccmp_office_email),
                ),

//                array(
//                    'name' => 'ccmp_agreement_nr',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                        'EditableField',
//                        array(
//                            'model' => $model,
//                            'attribute' => 'ccmp_agreement_nr',
//                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                        ),
//                        true
//                    )
//                ),

//                array(
//                    'name' => 'ccmp_agreement_date',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                        'EditableField',
//                        array(
//                            'model' => $model,
//                            'type' => 'date',
//                            'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            'attribute' => 'ccmp_agreement_date',
//                            //'placement' => 'right',
//                        ),
//                        true
//                    )
//                ),

           ),
        )); 
        $ccd = $model->cccdCustomData;
        
        $rows = array();
        foreach($ccd->attributes as $attribute_name => $attribute_value){
            if($attribute_name == 'cccd_ccmp_id'){
                continue;
            }
            $rows[] = array(
                'name' => $attribute_name,
            );
            
        }
        
        $this->widget(
            'TbAceDetailView',
            array(
                'data' => $ccd,
                'label_width' => 150,
                'attributes' => $rows,
                )
            );    
        
        ?>
    </div>


    <div class="span7">
        <?php $this->renderPartial(
                '_view-relations_grids',
                array(
                    'modelMain' => $model, 
                    'ajax' => false,
                    'can_edit' => $can_edit,
                    )); ?>    </div>
</div>
<?php
 if (Yii::app()->hasModule('d2messages')) {
    $this->widget('D2Mail', array(
        'model_name' => get_class($model), //optional - filter messages by model name
        'model_id' => $model->primaryKey, 
        'write_mail' => array(
            'label' => Yii::t('D2companyModule.crud', 'Write message'),
        ),
        'left_tabs' => array(
            array(
                'label' => Yii::t('D2companyModule.crud', 'Messages'),
                'tab_code' => 'messages',
                'icon' => 'icon-inbox',
                'icon_color' => 'blue',
                'active' => true,
                'url' => array('d2messages/ajax/List'),
            ),
        ),
        'messages_format' => array(
            //show columns in messages list
            'columns' => array(
                'unread',
                'sender',
                'subject',
                'summary',
                'time',
                //'model_label',
                //'model_name',
            ),
        ),
        //mesage list title big
        'title_big' => Yii::t('D2companyModule.crud', 'Messages'),
            )
    );
}
?>

<br />
<?php 
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "htmlOptions"=>array(
                    "class"=>"search-button",
                    "data-toggle"=>"tooltip",
                    "title"=>Yii::t("D2companyModule.crud_static","Back"),
                )
 ),true);

echo $cancel_buton;