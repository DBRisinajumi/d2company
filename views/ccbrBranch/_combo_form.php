<?php

$model4update = new CcbrBranch();
$model4update->ccbr_ccmp_id = $ccmp_id;

//form


 $this->renderPartial('/ccbrBranch/_form_horizontal_ajax', array(
               'model4update' => $model4update,
               'ccmp_id' => $ccmp_id     
        ));
 


//grid
 

 
 $this->renderPartial('/ccbrBranch/_branch_grid', array(
            'ccmp_id' => $ccmp_id, 'model4grid' => $model4grid
            
        ));

?>


