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
                //izlaizj sys group, ja nav admins
                if($mCcgr->ccxg_ccgr_id == Yii::app()->params['ccgr_group_sys_company']
                        && !Yii::app()->user->checkAccess("Administrator")){
                    continue;
                }
                
                $aChecked[] = $mCcgr->ccxg_ccgr_id;
            }
            
            if (count($aChecked) == 1){
                //kaut kads gljuks, nedrikst padot masivu ar vienu elementu
                $aChecked = $aChecked[0];
            }
            
            $criteria = new CDbCriteria;
            if(!Yii::app()->user->checkAccess("Administrator")){
                $criteria->addCondition("ccgr_id !=  " . Yii::app()->params['ccgr_group_sys_company']);
            }
            echo CHtml::checkBoxList(
                    'ccxg_ccgr_id', 
                    $aChecked, 
                    CHtml::listData(
                        CcgrGroup::model()->findAll($criteria), 'ccgr_id', 'ccgr_name')
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
                        'name'=>'save_company_group'
                    )
                );
    ?>
    </div>    
    </div>    
    </div>    
<?php $this->endWidget(); ?>
</div>
