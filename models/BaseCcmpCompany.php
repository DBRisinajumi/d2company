<?php

/**
 * This is the model base class for the table "ccmp_company".
 *
 * Columns in table "ccmp_company" available as properties of the model:
 * @property string $ccmp_id
 * @property string $ccmp_name
 * @property integer $ccmp_ccnt_id
 * @property string $ccmp_registrtion_no
 * @property string $ccmp_vat_registrtion_no
 * @property string $ccmp_registration_date
 * @property string $ccmp_registration_address
 * @property string $ccmp_official_ccit_id
 * @property string $ccmp_official_address
 * @property string $ccmp_official_zip_code
 * @property string $ccmp_office_ccit_id
 * @property string $ccmp_office_address
 * @property string $ccmp_office_zip_code
 * @property string $ccmp_statuss
 * @property string $ccmp_description
 * @property string $ccmp_office_phone
 * @property string $ccmp_office_email
 * @property string $ccmp_agreement_nr
 * @property string $ccmp_agreement_date
 * @property string $ccmp_sys_ccmp_id
 *
 * Relations of table "ccmp_company" available as properties of the model:
 * @property CcbrBranch[] $ccbrBranches
 * @property CccdCustomData $cccdCustomData
 * @property CcdpDepartment[] $ccdpDepartments
 * @property CcntCountry $ccmpCcnt
 * @property CcitCity $ccmpOfficialCcit
 * @property CcitCity $ccmpOfficeCcit
 * @property CcucUserCompany[] $ccucUserCompanies
 * @property CcxgCompanyXGroup[] $ccxgCompanyXGroups
 */
abstract class BaseCcmpCompany extends CActiveRecord
{
    /**
    * ENUM field values
    */
    const CCMP_STATUSS_ACTIVE = 'ACTIVE';
    const CCMP_STATUSS_CLOSED = 'CLOSED';
    const CCMP_STATUSS_POTENTIAL = 'POTENTIAL';
    
    var $enum_labels = false;  

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ccmp_company';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ccmp_name', 'required'),
                array('ccmp_ccnt_id,ccmp_registrtion_no,ccmp_registration_date ccmp_vat_registrtion_no, ccmp_registration_address, ccmp_official_ccit_id, ccmp_official_address, ccmp_official_zip_code, ccmp_office_ccit_id, ccmp_office_address, ccmp_office_zip_code, ccmp_statuss, ccmp_description, ccmp_agreement_nr, ccmp_agreement_date, ccmp_sys_ccmp_id', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ccmp_ccnt_id', 'numerical', 'integerOnly' => true),
                array('ccmp_name, ccmp_registration_address, ccmp_official_address, ccmp_office_address', 'length', 'max' => 200),
                array('ccmp_registrtion_no, ccmp_vat_registrtion_no, ccmp_official_zip_code, ccmp_office_zip_code', 'length', 'max' => 20),
                array('ccmp_official_ccit_id, ccmp_office_ccit_id, ccmp_sys_ccmp_id', 'length', 'max' => 10),
                array('ccmp_office_phone, ccmp_agreement_nr', 'length', 'max' => 45),
                array('ccmp_office_email', 'length', 'max' => 100),
                array('ccmp_description, ccmp_agreement_date,ccmp_registration_date', 'safe'),
                array('ccmp_statuss', 'in', 'range' => array(self::CCMP_STATUSS_ACTIVE, self::CCMP_STATUSS_CLOSED, self::CCMP_STATUSS_POTENTIAL)),
                array('ccmp_id, ccmp_name, ccmp_ccnt_id, ccmp_registrtion_no, ccmp_vat_registrtion_no, ccmp_registration_date,ccmp_registration_address, ccmp_official_ccit_id, ccmp_official_address, ccmp_official_zip_code, ccmp_office_ccit_id, ccmp_office_address, ccmp_office_zip_code, ccmp_statuss, ccmp_description, ccmp_office_phone, ccmp_office_email, ccmp_agreement_nr, ccmp_agreement_date, ccmp_sys_ccmp_id', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ccmp_name;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'savedRelated' => array(
                    'class' => '\GtcSaveRelationsBehavior'
                )
            )
        );
    }

    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                'ccbrBranches' => array(self::HAS_MANY, 'CcbrBranch', 'ccbr_ccmp_id'),
                'ccdpDepartments' => array(self::HAS_MANY, 'CcdpDepartment', 'ccdp_ccmp_id'),
                'ccmpCcnt' => array(self::BELONGS_TO, 'CcntCountry', 'ccmp_ccnt_id'),
                'ccmpOfficialCcit' => array(self::BELONGS_TO, 'CcitCity', 'ccmp_official_ccit_id'),
                'ccmpOfficeCcit' => array(self::BELONGS_TO, 'CcitCity', 'ccmp_office_ccit_id'),
                'ccucUserCompany' => array(self::HAS_MANY, 'CcucUserCompany', 'ccuc_ccmp_id'),
                'ccxgCompanyXGroups' => array(self::HAS_MANY, 'CcxgCompanyXGroup', 'ccxg_ccmp_id'),
			)
        );
    }

    public function attributeLabels()
    {
        return array(
            'ccmp_id' => Yii::t('D2companyModule.crud', 'CcmpId'),
            'ccmp_name' => Yii::t('D2companyModule.crud', 'Name'),
            'ccmp_ccnt_id' => Yii::t('D2companyModule.crud', 'Country'),
            'ccmp_registrtion_no' => Yii::t('D2companyModule.crud', 'Registration No'),
            'ccmp_vat_registrtion_no' => Yii::t('D2companyModule.crud', 'Vat Registrtion No'),
            'ccmp_registration_date' => Yii::t('D2companyModule.crud', 'Ccmp Registration Date'),            
            'ccmp_registration_address' => Yii::t('D2companyModule.crud', 'Ccmp Registration Address'),
            'ccmp_official_ccit_id' => Yii::t('D2companyModule.crud', 'Legal address city'),
            'ccmp_official_address' => Yii::t('D2companyModule.crud', 'Legal address'),
            'ccmp_official_zip_code' => Yii::t('D2companyModule.crud', 'Legal address Zip code'),
            'ccmp_office_ccit_id' => Yii::t('D2companyModule.crud', 'Office City'),
            'ccmp_office_address' => Yii::t('D2companyModule.crud', 'Office address'),
            'ccmp_office_zip_code' => Yii::t('D2companyModule.crud', 'Office Zip code'),
            'ccmp_statuss' => Yii::t('D2companyModule.crud', 'State'),
            'ccmp_description' => Yii::t('D2companyModule.crud', 'Description'),
            'ccmp_office_email' => Yii::t('D2companyModule.crud', 'Office email'),
            'ccmp_office_phone' => Yii::t('D2companyModule.crud', 'Office phone'),
            'ccmp_sys_ccmp_id' => Yii::t('D2companyModule.crud', 'Sys company'),
        );
    }

    public function enumLabels()
    {
        if($this->enum_labels){
            return $this->enum_labels;
        }    
        $this->enum_labels =  array(
           'ccmp_statuss' => array(
               self::CCMP_STATUSS_ACTIVE => Yii::t('D2companyModule.crud', 'CCMP_STATUSS_ACTIVE'),
               self::CCMP_STATUSS_CLOSED => Yii::t('D2companyModule.crud', 'CCMP_STATUSS_CLOSED'),
               self::CCMP_STATUSS_POTENTIAL => Yii::t('D2companyModule.crud', 'CCMP_STATUSS_POTENTIAL'),
           ),
            );
         return $this->enum_labels;
    }

    public function getEnumFieldLabels($column){

        $aLabels = $this->enumLabels();
        return $aLabels[$column];
    }

    public function getEnumLabel($column,$value){

        $aLabels = $this->enumLabels();

        if(!isset($aLabels[$column])){
            return $value;
        }

        if(!isset($aLabels[$column][$value])){
            return $value;
        }

        return $aLabels[$column][$value];
    }

    public function getEnumColumnLabel($column){
        return $this->getEnumLabel($column,$this->$column);
    }
    
    
    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }
        $criteria->compare('t.ccmp_id', $this->ccmp_id);
        $criteria->compare('t.ccmp_name', $this->ccmp_name, true);
        $criteria->compare('t.ccmp_ccnt_id', $this->ccmp_ccnt_id);
        $criteria->compare('t.ccmp_registrtion_no', $this->ccmp_registrtion_no, true);
        $criteria->compare('t.ccmp_vat_registrtion_no', $this->ccmp_vat_registrtion_no, true);
        $criteria->compare('t.ccmp_registration_date', $this->ccmp_registration_date, true);
        $criteria->compare('t.ccmp_registration_address', $this->ccmp_registration_address, true);
        $criteria->compare('t.ccmp_official_ccit_id', $this->ccmp_official_ccit_id);
        $criteria->compare('t.ccmp_official_address', $this->ccmp_official_address, true);
        $criteria->compare('t.ccmp_official_zip_code', $this->ccmp_official_zip_code, true);
        $criteria->compare('t.ccmp_office_ccit_id', $this->ccmp_office_ccit_id);
        $criteria->compare('t.ccmp_office_address', $this->ccmp_office_address, true);
        $criteria->compare('t.ccmp_office_zip_code', $this->ccmp_office_zip_code, true);
        $criteria->compare('t.ccmp_statuss', $this->ccmp_statuss);
        $criteria->compare('t.ccmp_description', $this->ccmp_description, true);
        $criteria->compare('t.ccmp_office_phone', $this->ccmp_office_phone, true);
        $criteria->compare('t.ccmp_office_email', $this->ccmp_office_email, true);
        $criteria->compare('t.ccmp_agreement_nr', $this->ccmp_agreement_nr, true);
        $criteria->compare('t.ccmp_agreement_date', $this->ccmp_agreement_date, true);
        $criteria->compare('t.ccmp_sys_ccmp_id', $this->ccmp_sys_ccmp_id, true);
        
        return $criteria;

    }

}
