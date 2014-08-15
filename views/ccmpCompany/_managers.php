<div class="crud-form">

    <?php $form=$this->beginWidget('CActiveForm'); ?>
        <div class="row">
            <div class="span7"> <!-- main inputs -->
                <div class="form-horizontal">            
            <?php 
            
            $aChecked = array();
     //       $mCcuc = new CcgrGroup();
            foreach($model->ccucUserCompany as $modelCcuc){
             //   $mCcgr = $modelCcxg;
                $aChecked[] = $modelCcuc->ccuc_person_id;
            }
            
            if (count($aChecked) == 1){
                //kaut kads gljuks, nedrikst padot masivu ar vienu elementu
                $aChecked = $aChecked[0];
            }
            //var_dump($aChecked);exit;
            
            echo CHtml::checkBoxList(
                    'ccuc_person_id', 
                    $aChecked, 
                    CHtml::listData(
                        PprsPerson::model()->findAll(), 'id', 'fullnameusernameroles')
                    );
             
             
            ?>
            <?php //echo $form->error($PxpModel, 'ppxt_id'); ?>
        </div>
    <?php
  //  }
    ?>

    <div class="form-actions">
        
    <?php
        echo CHtml::resetButton(Yii::t('D2companyModule.crud_static','Reset'), array(
			'class' => 'btn'
			));
        echo ' '.CHtml::submitButton(
                    Yii::t('D2companyModule.crud_static','Save'), 
                    array(
                        'class' => 'btn btn-primary',
                        'name'=>'save_company_manager'
                    )
                );
    ?>
    </div>    
    </div>    
    </div>    
<?php $this->endWidget(); ?>
</div>
