<?php
$this->breadcrumbs[Yii::t('d2companyModule.crud','Ccgr Groups')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id'=>$model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('d2companyModule.crud', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('d2companyModule.crud','Ccgr Group')?>
    <small><?php echo Yii::t('d2companyModule.crud','View')?> #<?php echo $model->ccgr_id ?></small>
    </h1>



<?php $this->renderPartial("_toolbar", array("model"=>$model)); ?>


<div class="row">
    <div class="span7">
        <h2>
            <?php echo Yii::t('d2companyModule.crud','Data')?>            <small>
                <?php echo $model->itemLabel?>            </small>
        </h2>

        <?php
        $this->widget(
            'TbDetailView',
            array(
                'data'=>$model,
                'attributes'=>array(
                array(
                        'name'=>'ccgr_id',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccgr_id',
                                'url' => $this->createUrl('/d2company/ccgrGroup/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccgr_name',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccgr_name',
                                'url' => $this->createUrl('/d2company/ccgrGroup/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccgr_notes',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccgr_notes',
                                'url' => $this->createUrl('/d2company/ccgrGroup/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name'=>'ccgr_hide',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccgr_hide',
                                'url' => $this->createUrl('/d2company/ccgrGroup/editableSaver'),
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