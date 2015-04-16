<div class="crud-form">

    
    <?php
        Yii::app()->bootstrap->registerAssetCss('../select2/select2.css');
        Yii::app()->bootstrap->registerAssetJs('../select2/select2.js');
        Yii::app()->clientScript->registerScript('crud/variant/update','$(".crud-form select").select2();');

        $form=$this->beginWidget('TbActiveForm', array(
            'id'=>'ccmp-company-custom-form',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
        ));

        //echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span7"> <!-- main inputs -->
            <div class="form-horizontal">

                
                  
                        
                
                   <?php 
		$customFields=BaseCccdCompanyData::getFields();
		if ($customFields) {
			foreach($customFields as $field) {
			?>
          <div class="control-group">        
	
            <div class="control-label">
		<?php echo $form->labelEx($model,$field->varname); ?>
            </div> 
            <div class="controls">  
		<?php 
		if ($widgetEdit = $field->widgetEdit($model)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($model,$field->varname,BaseCccdCompanyData::range($field->range));
                } elseif ($field->field_type =="BOOL") {
			echo $form->checkBox($model,$field->varname);        
		} elseif ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($model,$field->varname,array('rows'=>6, 'cols'=>50));
		} elseif ($field->field_type=="ListBox") {
            $list_data   = json_decode($field->widgetparams, true);
            echo $form->listBox($model,$field->varname, $list_data);
		} else {
			echo $form->textField($model,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		  echo $form->error($model,$field->varname); ?>
	</div>
          </div>            
		<?php
			}
		}
?>

                  
         

        <!-- sub inputs -->

    <p class="alert">

        
        <?php echo Yii::t('D2companyModule.crud_static','Fields with <span class="required">*</span> are required.');?>
        
    </p>

    <div class="form-actions">
        
        <?php
            echo CHtml::Button(
            Yii::t('D2companyModule.crud_static','Cancel'), array(
                'submit' => (isset($_GET['returnUrl']))?$_GET['returnUrl']:array('ccmpCompany/admin'),
                'class' => 'btn'
            ));
            echo ' '.CHtml::submitButton(Yii::t('D2companyModule.crud_static','Save'), array(
                'class' => 'btn btn-primary',
                'name'=>'save_custom'
            ));
        ?>
    </div>
            </div>
    </div>


    <?php $this->endWidget() ?>
       </div> 
                   
</div> <!-- form -->