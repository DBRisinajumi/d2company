<?php
$this->breadcrumbs[Yii::t('crud','Ccnt Countries')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id'=>$model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('d2companyModule.crud_static','View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('crud','Ccnt Country')?>
    <small><?php echo Yii::t('d2companyModule.crud_static','View')?> #<?php echo $model->ccnt_id ?></small>
    </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('d2companyModule.crud_static','Data')?>            <small>
                <?php echo $model->itemLabel?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data'=>$model,
                'attributes'=>array(
                array(
                        'name'=>'ccnt_id',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccnt_id',
                                'url' => $this->createUrl('/d2company/ccntCountry/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccnt_name',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccnt_name',
                                'url' => $this->createUrl('/d2company/ccntCountry/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccnt_code',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccnt_code',
                                'url' => $this->createUrl('/d2company/ccntCountry/editableSaver'),
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