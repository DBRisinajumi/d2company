<div class="crud-form">
    <?php  ?>    
    <?php
        Yii::app()->bootstrap->registerPackage('select2');
        Yii::app()->clientScript->registerScript('crud/variant/update','$("#cucp-user-company-position-form select").select2();');


        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'cucp-user-company-position-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'htmlOptions' => array(
                'enctype' => ''
            )
        ));

        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span12">
            <div class="form-horizontal">

                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2companyModule.model', 'tooltip.cucp_id')) != 'tooltip.cucp_id')?$t:'' ?>'>
                                <?php
                            ;
                            echo $form->error($model,'cucp_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'cucp_name') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2companyModule.model', 'tooltip.cucp_name')) != 'tooltip.cucp_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'cucp_name', array('size' => 60, 'maxlength' => 100));
                            echo $form->error($model,'cucp_name')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'cucp_role') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2companyModule.model', 'tooltip.cucp_role')) != 'tooltip.cucp_role')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'cucp_role', array('size' => 20, 'maxlength' => 20));
                            echo $form->error($model,'cucp_role')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                
            </div>
        </div>
        <!-- main inputs -->

            </div>
    <div class="row">
        
    </div>

    <div class="alert">
        
        <?php 
            echo Yii::t('D2companyModule.crud','Fields with <span class="required">*</span> are required.');
                
            /**
             * @todo: We need the buttons inside the form, when a user hits <enter>
             */                
            echo ' '.CHtml::submitButton(Yii::t('D2companyModule.crud', 'Save'), array(
                'class' => 'btn btn-primary',
                'style'=>'visibility: hidden;'                
            ));
                
        ?>
    </div>


    <?php $this->endWidget() ?>    <?php  ?></div> <!-- form -->
