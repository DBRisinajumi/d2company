<div class="crud-form">
    <?php

        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'ccuc-user-company-form',
            //'enableAjaxValidation' => true,
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
                <h3><?php echo Yii::t('d2companyModule.crud_static','Add new person')?></h3>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('d2companyModule.crud', 'tooltip.ccuc_id')) != 'tooltip.ccuc_id')?$t:'' ?>'>
                                <?php
                            ;
                            echo $form->error($model,'ccuc_id')
                            ?>                            </span>
                        </div>
                    </div>

                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ccuc_person_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('d2companyModule.crud', 'tooltip.ccuc_person_id')) != 'tooltip.ccuc_person_id')?$t:'' ?>'>
                                <?php
                            $this->widget(
                                '\GtcRelation',
                                array(
                                    'model' => $model,
                                    //'criteria' => new CDBCriteria(array('condition' => 'not id ???')),
                                    'relation' => 'ccucPerson',
                                    'fields' => array('first_name','last_name','email'),
                                    'allowEmpty' => true,
                                    'style' => 'dropdownlist',
                                    'delimiter'=> ' ',
                                    'htmlOptions' => array(
                                        'checkAll' => 'all',
                                        'style' => 'width: 300px;'
                                    ),
                                )
                                );
                            echo $form->error($model,'ccuc_person_id')
                            ?>                            </span>
                        </div>
                    </div>
            </div>
        </div>
        <!-- sub inputs -->
    </div>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
                Yii::t('d2companyModule.crud_static', 'Cancel'), 
                array(
                    'class' => 'btn cancel'
                )
            );
            echo ' '.CHtml::Button(Yii::t('PersonModule.crud', 'Save'), array(
                'class' => 'btn btn-primary',
                'onclick'=>'send_form("ccuc-user-company-form");',
            ));
        ?>
    </div>

    <?php $this->endWidget() ?>
</div> <!-- form -->