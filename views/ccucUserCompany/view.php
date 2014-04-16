<?php
    $this->setPageTitle(
        Yii::t('D2companyModule.crud', 'Ccuc User Company')
        . ' - '
        . Yii::t('D2companyModule.crud_static', 'View')
        . ': '   
        . $model->getItemLabel()            
);    
$this->breadcrumbs[Yii::t('D2companyModule.crud','Ccuc User Companies')] = array('admin');
$this->breadcrumbs[$model->{$model->tableSchema->primaryKey}] = array('view','id' => $model->{$model->tableSchema->primaryKey});
$this->breadcrumbs[] = Yii::t('D2companyModule.crud_static', 'View');
?>

<?php $this->widget("TbBreadcrumbs", array("links"=>$this->breadcrumbs)) ?>
<h1>
    <?php echo Yii::t('D2companyModule.crud','Ccuc User Company')?>
    <small><?php echo Yii::t('D2companyModule.crud_static','View')?> #<?php echo $model->ccuc_id ?></small>
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
                'data' => $model,
                'attributes' => array(
                array(
                        'name' => 'ccuc_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ccuc_id',
                                'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
        array(
            'name' => 'ccuc_ccmp_id',
            'value' => ($model->ccucCcmp !== null)?CHtml::link(
                            '<i class="icon icon-circle-arrow-left"></i> '.$model->ccucCcmp->itemLabel,
                            array('/d2company/ccmpCompany/view','ccmp_id' => $model->ccucCcmp->ccmp_id),
                            array('class' => '')).' '.CHtml::link(
                            '<i class="icon icon-pencil"></i> ',
                            array('/d2company/ccmpCompany/update','ccmp_id' => $model->ccucCcmp->ccmp_id),
                            array('class' => '')):'n/a',
            'type' => 'html',
        ),
array(
                        'name' => 'ccuc_user_id',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ccuc_user_id',
                                'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'ccuc_first_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ccuc_first_name',
                                'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'cucc_last_name',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'cucc_last_name',
                                'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
array(
                        'name' => 'ccuc_status',
                        'type' => 'raw',
                        'value' => $this->widget(
                            'EditableField',
                            array(
                                'model' => $model,
                                'attribute' => 'ccuc_status',
                                'url' => $this->createUrl('/d2company/ccucUserCompany/editableSaver'),
                            ),
                            true
                        )
                    ),
           ),
        )); ?>
    </div>

    <div class="span5">
        <?php $this->renderPartial('_view-relations',array('model' => $model)); ?>    </div>
</div>