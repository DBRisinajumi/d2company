<?php
$this->breadcrumbs[Yii::t('crud','Ccbr Branches')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id'=>$model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2companyModule.crud_static','View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('crud','Ccbr Branch')?>
    <small><?php echo Yii::t('D2companyModule.crud_static','View')?> #<?php echo $model->ccbr_id ?></small>
    </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('D2companyModule.crud_static','Data')?>            <small>
                <?php echo $model->itemLabel?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data'=>$model,
                'attributes'=>array(
                array(
                        'name'=>'ccbr_id',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccbr_id',
                                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                            ),
                            true
                        )
                    ),
        array(
            'name'=>'ccbr_ccmp_id',
            'value'=>($model->ccbrCcmp !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ccbrCcmp->itemLabel,
                            array('/d2company/ccmpCompany/view','ccmp_id'=>$model->ccbrCcmp->ccmp_id),
                            array('class'=>'')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2company/ccmpCompany/update','ccmp_id'=>$model->ccbrCcmp->ccmp_id),
                            array('class'=>'')):'n/a',
            'type'=>'html',
        ),
array(
                        'name'=>'ccbr_name',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccbr_name',
                                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccrb_code',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccrb_code',
                                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccbr_notes',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccbr_notes',
                                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccbr_hide',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccbr_hide',
                                'url' => $this->createUrl('/d2company/ccbrBranch/editableSaver'),
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