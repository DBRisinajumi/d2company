<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id'=>'ccgr-group-form',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
        ));

        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span7"> <!-- main inputs -->
            <h2>
                <?php echo Yii::t('d2companyModule.crud','Data')?>                <small>
                    <?php echo $model->itemLabel ?>
                </small>

            </h2>


            <div class="form-horizontal">

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <?php
                            ;
                            echo $form->error($model,'ccgr_id')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('d2companyModule.crud', 'CcgrGroup.ccgr_id') != 'CcgrGroup.ccgr_id')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccgr_name') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccgr_name',array('size'=>20,'maxlength'=>20));
                            echo $form->error($model,'ccgr_name')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('d2companyModule.crud', 'CcgrGroup.ccgr_name') != 'CcgrGroup.ccgr_name')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccgr_notes') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textArea($model,'ccgr_notes',array('rows'=>6, 'cols'=>50));
                            echo $form->error($model,'ccgr_notes')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('d2companyModule.crud', 'CcgrGroup.ccgr_notes') != 'CcgrGroup.ccgr_notes')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model,'ccgr_hide') ?>
                        </div>
                        <div class='controls'>
                            <?php
                            echo $form->textField($model,'ccgr_hide');
                            echo $form->error($model,'ccgr_hide')
                            ?>
                            <span class="help-block">
                                
                                <?php
                                echo ($t = Yii::t('d2companyModule.crud', 'CcgrGroup.ccgr_hide') != 'CcgrGroup.ccgr_hide')?$t:''
                                ?>
                                                            </span>
                        </div>
                    </div>

                            </div>
        </div>
        <!-- main inputs -->

        <div class="span5"> <!-- sub inputs -->
            <h2>
                <?php echo Yii::t('d2companyModule.crud','Relations')?>
            </h2>
            
                
                
                <h3>
                    <?php echo Yii::t('d2companyModule.crud', 'CcxgCompanyXGroups'); ?>
                </h3>
                <?php echo '<i>Switch to view mode to edit related records.</i>' ?>
                
            

        </div>
        <!-- sub inputs -->
    </div>

    <p class="alert">

        
        <?php echo Yii::t('d2companyModule.crud','Fields with <span class="required">*</span> are required.');?>
        
    </p>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
            Yii::t('d2companyModule.crud', 'Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ccgrGroup/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('d2companyModule.crud', 'Save'), array(
                'class' => 'btn btn-primary'
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->