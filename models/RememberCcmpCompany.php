<?php
/**
 * extended model CcmpCompany
 * use only in grids, where necessery remember filter setings
 */
class RememberCcmpCompany extends CcmpCompany {
    public function behaviors() {
        return array_merge(
                parent::behaviors(), array(
                    
             // remember grid filter       
            'ERememberFiltersBehavior' => array(
               'class' => 'ERememberFiltersBehavior',
               'defaults'=>array(),           /* optional line */
               'defaultStickOnClear'=>false   /* optional line */
           ),        
        ));
    }
}
