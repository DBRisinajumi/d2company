<?php
$this->setPageTitle(
        Yii::t('d2companyModule.crud', 'Ccmp Company')
        . ' - '
        . Yii::t('d2companyModule.crud_static', 'Update')
        . ': '
        . $model->getItemLabel()
);
?>

<table class="toolbar">
    <tr>  
        <td>
            <h2>
                <?php echo $model->itemLabel ?>
            </h2>
        </td>
        <td>
            <?php $this->renderPartial("_toolbar", array("model" => $model)); ?>
        </td>
    </tr>
</table> 

<?php
/**
 * @see http://www.cniska.net/yii-bootstrap/#tbMenu
 */
$this->widget(
        'TbMenu', array(
    'type' => 'tabs',
    'items' => array(
        array(
            'label' => Yii::t('d2companyModule.crud', 'Main comapny data'),
            'url' => Yii::app()->controller->createUrl(
                    'updateExtended', array('ccmp_id' => $model->ccmp_id)),
            'active' => ($active_tab == 'company_data')
        ),
        array(
            'label' => Yii::t('d2companyModule.crud', 'Custom data'),
            'url' => Yii::app()->controller->createUrl(
                    'updateCustom', array('ccmp_id' => $model->ccmp_id)),
            'active' => ($active_tab == 'company_custom')
        ),
        array('label' => Yii::t('d2companyModule.crud', 'Company groups'),
            'url' => Yii::app()->controller->createUrl(
                    'updateGroup', array('ccmp_id' => $model->ccmp_id)),
            'active' => ($active_tab == 'company_group'),
        ),
        array('label' => Yii::t('d2companyModule.crud', 'Company branches'),
            'url' => Yii::app()->controller->createUrl(
                    'manageccbr', array('ccmp_id' => $model->ccmp_id)),
            'active' => ($active_tab == 'company_branches')
            || ($active_tab == 'createccbr')
            || ($active_tab == 'updateccbr')
        ,
        ),
          array('label' => Yii::t('d2companyModule.crud', 'Company managers'),
            'url' => Yii::app()->controller->createUrl(
                    'updateManagers', array('ccmp_id' => $model->ccmp_id)),
            'active' => 
                    ($active_tab == 'company_managers')
                   
              ,
        ),
         array('label' => Yii::t('d2companyModule.crud', 'Company customers'),
            'url' => Yii::app()->controller->createUrl(
                    'adminCustomers', array('ccmp_id' => $model->ccmp_id)),
            'active' => 
                    ($active_tab == 'company_manager_create')
                    || ($active_tab == 'company_manager_list')
                    || ($active_tab == 'company_manager_update')
              ,
        ),
        
         array('label' => Yii::t('d2companyModule.crud', 'Cars'),
            'url' => Yii::app()->controller->createUrl(
                    'adminCars', array('ccmp_id' => $model->ccmp_id)),
            'active' => 
                    ($active_tab == 'company_car_admin')
                    || ($active_tab == 'company_car_list')
                    || ($active_tab == 'company_car_update')
              ,
        ),
    )
));

switch ($active_tab) {
    case 'company_data':
        $this->renderPartial('_form', array('model' => $model));
        break;

    case 'company_custom':
        $this->renderPartial('_form_custom', array('model' => $model->cccdCustomData));
        break;

    case 'company_group':
        $this->renderPartial('_groups', array(
            'model' => $model,
            'mCcbr' => $mCcbr,
        ));
        break;
    case 'company_branches':
        $this->renderPartial('_branch_list', array(
            'ccmp_id' => $model->ccmp_id,
            'model' => $mCcbr,
        ));
        break;
    case 'createccbr':
        $this->renderPartial('_branch_form', array(
            'ccmp_id' => $model->ccmp_id,
            'model' => $mCcbr,
        ));
        break;

    case 'updateccbr':
        $this->renderPartial('_branch_form', array(
            'ccmp_id' => $model->ccmp_id,
            'model' => $mCcbr,
        ));
        break;
    case 'company_customer_list':
        $this->renderPartial('_customers_list', array(
            'ccmp_id' => $model->ccmp_id,
            'model' => $mCcuc,
        ));
        break;
    case 'company_customer_update':
        $this->renderPartial('_form_customers', array(
            'ccmp_id' => $model->ccmp_id,
            'model' => $mCcuc,
        ));
        break;
    case 'company_customer_create':
        $this->renderPartial('_form_customers', array(
            'ccmp_id' => $model->ccmp_id,
            'model' => $mCcuc,
        ));
        break;
    case 'company_managers':
        $this->renderPartial('_managers', array(
            'ccmp_id' => $model->ccmp_id,
            'model' => $model,
        ));
        break;
     case 'company_car_list':
         
        $model4grid = new BcarId("search");
        $model4grid->bcar_ccmp_id =  $model->ccmp_id; 
        $this->renderPartial('fueling.views.bcarId._combo_form', array(
            'ccmp_id' => $model->ccmp_id, 'model4grid' => $model4grid,
            
        ));
        break;
    
    default:
        break;
}