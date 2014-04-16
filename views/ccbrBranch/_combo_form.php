<?php
Yii::app()->clientScript->registerScript('add', "
    $('.add-button').click(function(){
        $('#branch-form-add').toggle();
        return false;
    });
   
    ");

?>
<div class="btn-toolbar">

<? $this->widget(
                   "bootstrap.widgets.TbButton",
                   array(
                       "label"=>Yii::t('D2companyModule.crud_static','Add'),
                "icon"=>"icon-plus",
                "htmlOptions"=>array("class"=>"add-button")
               )
           );

?>
</div>

<? $model4update = new CcbrBranch();
$model4update->ccbr_ccmp_id = $ccmp_id;

//form
?> <div id="branch-form-add" style="display:none;">    <?

 $this->renderPartial('/ccbrBranch/_form_horizontal_ajax', array(
               'model4update' => $model4update,
               'ccmp_id' => $ccmp_id     
        ));
 
 ?> </div>    <?
 


//grid
 

 
 $this->renderPartial('/ccbrBranch/_branch_grid', array(
            'ccmp_id' => $ccmp_id, 'model4grid' => $model4grid
            
        ));

?>


