<div class="wide form">

    <?php
    $form = $this->beginWidget('TbActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>
    <div class="row">
        <?php echo $form->label($model, 'ccuc_id'); ?>
        <?php ; ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ccuc_ccmp_id'); ?>
        <?php echo $form->textField($model, 'ccuc_ccmp_id', array('size' => 10, 'maxlength' => 10)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ccuc_user_id'); ?>
        <?php echo $form->textField($model, 'ccuc_user_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ccuc_first_name'); ?>
        <?php echo $form->textField($model, 'ccuc_first_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'cucc_last_name'); ?>
        <?php echo $form->textField($model, 'cucc_last_name', array('size' => 60, 'maxlength' => 255)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'ccuc_status'); ?>
        <?php echo CHtml::activeDropDownList($model, 'ccuc_status', array(
            'ACTIVE' => 'ACTIVE',
            'DISABLED' => 'DISABLED',
)); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('d2companyModule.crud_static', 'Search')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
