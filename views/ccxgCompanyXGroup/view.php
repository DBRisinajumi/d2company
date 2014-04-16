<?php
$this->breadcrumbs[Yii::t('crud','Ccxg Company Xgroups')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id'=>$model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2companyModule.crud_static','View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('crud','Ccxg Company Xgroup')?>
    <small><?php echo Yii::t('D2companyModule.crud_static','View')?> #<?php echo $model->ccxg_id ?></small>
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
                        'name'=>'ccxg_id',
                        'type' => 'raw',
                        'value' =>$this->widget(
                            'EditableField',
                            array(
                                'model'=>$model,
                                'attribute'=>'ccxg_id',
                                'url' => $this->createUrl('/d2company/ccxgCompanyXGroup/editableSaver'),
                            ),
                            true
                        )
                    ),
        array(
            'name'=>'ccxg_ccmp_id',
            'value'=>($model->ccxgCcmp !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ccxgCcmp->itemLabel,
                            array('/d2company/ccmpCompany/view','ccmp_id'=>$model->ccxgCcmp->ccmp_id),
                            array('class'=>'')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2company/ccmpCompany/update','ccmp_id'=>$model->ccxgCcmp->ccmp_id),
                            array('class'=>'')):'n/a',
            'type'=>'html',
        ),
        array(
            'name'=>'ccxg_ccgr_id',
            'value'=>($model->ccxgCcgr !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ccxgCcgr->itemLabel,
                            array('/d2company/ccgrGroup/view','ccgr_id'=>$model->ccxgCcgr->ccgr_id),
                            array('class'=>'')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2company/ccgrGroup/update','ccgr_id'=>$model->ccxgCcgr->ccgr_id),
                            array('class'=>'')):'n/a',
            'type'=>'html',
        ),
           ),
        )); ?>
    </div>

    <div class="span5">
        <?php $this->renderPartial('_view-relations',array('model'=>$model)); ?>    </div>
</div>