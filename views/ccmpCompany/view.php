<?php



$this->setPageTitle(
        Yii::t('d2companyModule.crud', 'Ccmp Company')
        . ' - '
        . Yii::t('d2companyModule.p3crud', 'View')
);
$this->breadcrumbs[Yii::t('d2companyModule.crud','Ccmp Companies')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id'=>$model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('d2companyModule.p3crud','View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('crud','Ccmp Company')?>
    <small><?php echo Yii::t('d2companyModule.p3crud','View')?> #<?php echo $model->ccmp_id ?></small>
    </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('d2companyModule.p3crud','Data')?>            <small>
                <?php echo $model->itemLabel?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data'=>$model,
                'attributes'=>array(
                array(
                        'name'=>'ccmp_id',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccmp_id',
                                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccmp_name',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccmp_name',
                                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
        array(
            'name'=>'ccmp_ccnt_id',
            'value'=>($model->ccmpCcnt !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ccmpCcnt->itemLabel,
                            array('/d2company/ccntCountry/view','ccnt_id'=>$model->ccmpCcnt->ccnt_id),
                            array('class'=>'')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2company/ccntCountry/update','ccnt_id'=>$model->ccmpCcnt->ccnt_id),
                            array('class'=>'')):'n/a',
            'type'=>'html',
        ),
array(
                        'name'=>'ccmp_registrtion_no',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccmp_registrtion_no',
                                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccmp_vat_registrtion_no',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccmp_vat_registrtion_no',
                                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccmp_registration_address',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccmp_registration_address',
                                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccmp_official_address',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccmp_official_address',
                                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccmp_statuss',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccmp_statuss',
                                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccmp_description',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccmp_description',
                                'url' => $this->createUrl('/d2company/ccmpCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
           ),
        )); ?>
    </div>

    <div class="span5">
        <?php $this->renderPartial('_view-relations',array('model'=>$model)); ?>    </div>
</div>