<?php
$this->setPageTitle(Yii::t('D2companyModule.crud', 'Company Data'));    
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "htmlOptions"=>array(
                    "class"=>"search-button",
                    "data-toggle"=>"tooltip",
                    "title"=>Yii::t("D2companyModule.crud_static","Back"),
                )
 ),true);

?>

<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            <h1>
                <i class="icon-building"></i>
                <?php echo Yii::t('D2companyModule.crud','Company Data');?>
            </h1>
        </div>
        <div class="btn-group">
            <?php
               if(Yii::app()->user->checkAccess("audittrail") 
                    && isset(Yii::app()->getModule('d2company')->options['audittrail']) 
                    && Yii::app()->getModule('d2company')->options['audittrail'])
                {        
                    Yii::import('audittrail.*');
                    $this->widget("vendor.dbrisinajumi.audittrail.widgets.AudittrailViewTbButton",array(
                        'model_name' => get_class($model),
                        'model_id' => $model->getPrimaryKey(),
                    ));                     
                }                
            ?>
        </div>
    </div>
</div>

<?php
$visible_tabs = Yii::app()->getModule('d2company')->tabs;

/**
 * @see http://www.cniska.net/yii-bootstrap/#tbMenu
 */
$this->widget(
        'TbMenu', array(
    'type' => 'tabs',
    'items' => array(
        array(
            'label' => Yii::t('D2companyModule.crud', 'Main comapny data'),
            'url' => Yii::app()->controller->createUrl(
                    'updateExtended', array('ccmp_id' => $model->ccmp_id)),
            'active' => ($active_tab == 'company_data'),
            'visible' => in_array('company_data',$visible_tabs),
        ),
        array(
            'label' => Yii::t('D2companyModule.crud', 'Custom data'),
            'url' => Yii::app()->controller->createUrl(
                    'updateCustom', array('ccmp_id' => $model->ccmp_id)),
            'active' => ($active_tab == 'company_custom'),
            'visible' => in_array('company_custom_data',$visible_tabs),            
        ),
        array('label' => Yii::t('D2companyModule.crud', 'Company groups'),
            'url' => Yii::app()->controller->createUrl(
                    'updateGroup', array('ccmp_id' => $model->ccmp_id)),
            'active' => ($active_tab == 'company_group'),
            'visible' => in_array('company_group',$visible_tabs),            
        ),
        array('label' => Yii::t('D2companyModule.crud', 'Company branches'),
            'url' => Yii::app()->controller->createUrl(
                    'manageccbr', array('ccmp_id' => $model->ccmp_id)),
            'active' => ($active_tab == 'company_branches')
                        || ($active_tab == 'createccbr')
                        || ($active_tab == 'updateccbr'),
            'visible' => in_array('company_branches',$visible_tabs),            
        ),
          array('label' => Yii::t('D2companyModule.crud', 'Company managers'),
            'url' => Yii::app()->controller->createUrl(
                    'updateManagers', array('ccmp_id' => $model->ccmp_id)),
            'active' => ($active_tab == 'company_managers'),
            'visible' => in_array('company_managers',$visible_tabs),
        ),
         array('label' => Yii::t('D2companyModule.crud', 'Company customers'),
            'url' => Yii::app()->controller->createUrl(
                    'adminCustomers', array('ccmp_id' => $model->ccmp_id)),
                    'active' => ($active_tab == 'company_customer_create')
                                || ($active_tab == 'company_customer_list')
                                || ($active_tab == 'company_customer_update'),
                    'visible' => in_array('company_customers',$visible_tabs),             
        ),
        
         array('label' => Yii::t('D2companyModule.crud', 'Cars'),
            'url' => Yii::app()->controller->createUrl(
                    'adminCars', array('ccmp_id' => $model->ccmp_id)),
                    'active' => 
                        ($active_tab == 'company_car_admin')
                        || ($active_tab == 'company_car_list')
                        || ($active_tab == 'company_car_update'),
                    'visible' => in_array('company_cars',$visible_tabs),             
        ),

        array(
            'label' => Yii::t('D2companyModule.crud', 'Files'),
            'url' => Yii::app()->controller->createUrl(
                        'updateFiles', array('ccmp_id' => $model->ccmp_id)),
            'active' => ($active_tab == 'company_files'),
            'visible' => in_array('company_files',$visible_tabs),
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
        $model4grid = new CcbrBranch("search");
        $model4grid->ccbr_ccmp_id =  $model->ccmp_id; 
        $this->renderPartial('/ccbrBranch/_combo_form', array(
            'ccmp_id' => $model->ccmp_id, 'model4grid' => $model4grid,
            
        ));
        break;
    case 'company_customer_list':
        $this->renderPartial('../Customers/_combo_form', array(
            'ccmp_id' => $model->ccmp_id,
            'modelCcuc' => $modelCcuc,
            'model_cucc_new' => $model_cucc_new,
            'model_person' => $model_person,            
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

    case 'company_files':
         
        $this->renderPartial('_files', array(
            'model' => $model, 
        ));
        break;
    
    default:
        break;
}