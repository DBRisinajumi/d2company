<div class="crud-form">

    <?php $form=$this->beginWidget('CActiveForm'); ?>
        <div class="row">
            <div class="span7"> <!-- main inputs -->
                <div class="form-horizontal">            
            <?php 
            
            $aChecked = array();
            $mCcgr = new CcgrGroup();
            foreach($model->ccxgCompanyXGroups as $modelCcxg){
                $mCcgr = $modelCcxg;
                $aChecked[] = $mCcgr->ccxg_ccgr_id;
            }
            
            if (count($aChecked) == 1){
                //kaut kads gljuks, nedrikst padot masivu ar vienu elementu
                $aChecked = $aChecked[0];
            }
            //var_dump($aChecked);exit;
            
            echo CHtml::checkBoxList(
                    'ccxg_ccgr_id', 
                    $aChecked, 
                    CHtml::listData(
                        CcgrGroup::model()->findAll(), 'ccgr_id', 'ccgr_name')
                    );
             
             
            ?>
            <?php //echo $form->error($PxpModel, 'ppxt_id'); ?>
        </div>
    <?php
  //  }
    ?>

    <div class="form-actions">
        
    <?php
        echo CHtml::resetButton(Yii::t('d2companyModule.p3crud','Reset'), array(
			'class' => 'btn'
			));
        echo ' '.CHtml::submitButton(
                    Yii::t('d2companyModule.p3crud','Save'), 
                    array(
                        'class' => 'btn btn-primary',
                        'name'=>'save_company_group'
                    )
                );
    ?>
    </div>    
    </div>    
    </div>    
<?php $this->endWidget(); ?>
</div>
