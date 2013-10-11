<div class="wide form">

    
    <?php
    $form=$this->beginWidget('TbActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>

    
    
        <div class="row">
            <?php echo $form->label($model,'ccxg_id'); ?>
            <?php ; ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccxg_ccmp_id'); ?>
            <?php echo $form->textField($model,'ccxg_ccmp_id',array('size'=>10,'maxlength'=>10)); ?>

        </div>

    
        <div class="row">
            <?php echo $form->label($model,'ccxg_ccgr_id'); ?>
            <?php echo $form->textField($model,'ccxg_ccgr_id'); ?>

        </div>

    
    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('d2companyModule.crud_static','Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
