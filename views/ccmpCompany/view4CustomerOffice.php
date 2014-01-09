<?php
$this->setPageTitle(Yii::t('d2companyModule.crud', 'My company'));    
?>
<div class="page-header position-relative">
<h1>
    <?php echo Yii::t('d2companyModule.crud','My company')?>
</h1>
</div>

<div class="row-fluid">
    <div class="span7">
        <?php
        $this->widget(
                'TbDetailView', array(
            'data' => $model,
            'attributes' => array(
                array(
                    'name' => 'ccmp_name',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_name',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_ccnt_id',
//                    'value' => ($model->ccmpCcnt !== null) ? CHtml::link(
//                                    '<i class="icon icon-circle-arrow-left"></i> ' . $model->ccmpCcnt->itemLabel, array('/d2company/ccntCountry/view', 'ccnt_id' => $model->ccmpCcnt->ccnt_id), array('class' => '')) . ' ' . CHtml::link(
//                                    '<i class="icon icon-pencil"></i> ', array('/d2company/ccntCountry/update', 'ccnt_id' => $model->ccmpCcnt->ccnt_id), array('class' => '')) : 'n/a',
//                    'type' => 'html',
                ),
                array(
                    'name' => 'ccmp_registrtion_no',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_registrtion_no',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_vat_registrtion_no',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_vat_registrtion_no',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_official_address',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_registration_address',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_official_ccit_id',
//                    'value' => ($model->ccmpOfficialCcit !== null) ? CHtml::link(
//                                    '<i class="icon icon-circle-arrow-left"></i> ' . $model->ccmpOfficialCcit->itemLabel, array('/d2company/ccitCity/view', 'ccit_id' => $model->ccmpOfficialCcit->ccit_id), array('class' => '')) . ' ' . CHtml::link(
//                                    '<i class="icon icon-pencil"></i> ', array('/d2company/ccitCity/update', 'ccit_id' => $model->ccmpOfficialCcit->ccit_id), array('class' => '')) : 'n/a',
                    'value' => ($model->ccmpOfficialCcit !== null) ? $model->ccmpOfficialCcit->itemLabel:'',
//                    'type' => 'html',
                ),
                array(
                    'name' => 'ccmp_official_address',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_official_address',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_official_zip_code',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_official_zip_code',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_office_ccit_id',
//                    'value' => ($model->ccmpOfficeCcit !== null) ? CHtml::link(
//                                    '<i class="icon icon-circle-arrow-left"></i> ' . $model->ccmpOfficeCcit->itemLabel, array('/d2company/ccitCity/view', 'ccit_id' => $model->ccmpOfficeCcit->ccit_id), array('class' => '')) . ' ' . CHtml::link(
//                                    '<i class="icon icon-pencil"></i> ', array('/d2company/ccitCity/update', 'ccit_id' => $model->ccmpOfficeCcit->ccit_id), array('class' => '')) : 'n/a',
//                    'type' => 'html',
                    'value' => ($model->ccmpOfficeCcit !== null) ? $model->ccmpOfficeCcit->itemLabel:'',                    
                ),
                array(
                    'name' => 'ccmp_office_address',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_office_address',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_office_zip_code',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_office_zip_code',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_statuss',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_statuss',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_description',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_description',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_office_phone',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_office_phone',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
                array(
                    'name' => 'ccmp_office_email',
//                    'type' => 'raw',
//                    'value' => $this->widget(
//                            'EditableField', array(
//                        'model' => $model,
//                        'attribute' => 'ccmp_office_email',
//                        'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
//                            ), true
//                    )
                ),
            ),
        ));
        ?>    </div>
</div>

