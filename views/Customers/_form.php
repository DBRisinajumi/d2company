<div class="crud-form">

    
    <?php
    
       
        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'person-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
            'htmlOptions' => array(
                'enctype' => ''
            )
        ));

        
        
        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
            <div class="span7">
                <div class="form-horizontal">
                    <h3><?php echo Yii::t('d2companyModule.crud','Add existing person')?></h3>                    
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2companyModule.crud', 'tooltip.id')) != 'tooltip.id')?$t:'' ?>'>
                                <?php
                            ;
                            echo $form->error($model,'id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'first_name') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2companyModule.crud', 'tooltip.first_name')) != 'tooltip.first_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'first_name', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'first_name')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'last_name') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2companyModule.crud', 'tooltip.last_name')) != 'tooltip.last_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'last_name', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'last_name')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'email') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2companyModule.crud', 'tooltip.email')) != 'tooltip.email')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255));
                            echo $form->error($model,'email')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'phone') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2companyModule.crud', 'tooltip.phone')) != 'tooltip.phone')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'phone', array('size' => 50, 'maxlength' => 50));
                            echo $form->error($model,'phone')
                            ?>                            </span>
                        </div>
                    </div>
                    </div>
            </div>
        </div> 
    <p class="alert">
        <?php echo Yii::t('PersonModule.crud_static','Fields with <span class="required">*</span> are required.');?>
    </p>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
                Yii::t('d2companyModule.crud_static', 'Cancel'), 
                array(
                    'class' => 'btn cancel'
                )
            );
            
            echo ' '.CHtml::submitButton(Yii::t('PersonModule.crud_static', 'Save'), array(
                'class' => 'btn btn-primary',
            ));
        ?>
    </div>

    <?php 
    $this->endWidget() 
     ?>
    
</div>