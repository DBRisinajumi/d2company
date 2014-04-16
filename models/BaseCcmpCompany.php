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
 * @property string $ccmp_registration_address
 * @property string $ccmp_official_ccit_id
 * @property string $ccmp_official_address
 * @property string $ccmp_official_zip_code
 * @property string $ccmp_office_ccit_id
 * @property string $ccmp_office_address
 * @property string $ccmp_office_zip_code
 * @property string $ccmp_statuss
 * @property string $ccmp_description
 * @property string $ccmp_sys_ccmp_id
 *
 * Relations of table "ccmp_company" available as properties of the model:
 * @property BcarId[] $bcars
 * @property BcbdCompanyBranchDay[] $bcbdCompanyBranchDays
 * @property CcbrBranch[] $ccbrBranches
 * @property CcitCity $ccmpOfficeCcit
 * @property CcntCountry $ccmpCcnt
 * @property CcitCity $ccmpOfficialCcit
 * @property CcxgCompanyXGroup[] $ccxgCompanyXGroups
 */
abstract class BaseCcmpCompany extends CActiveRecord
{

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
                array('ccmp_name, ccmp_ccnt_id,ccmp_office_ccit_id , ccmp_office_phone, ccmp_office_email', 'required'),
                array('ccmp_ccnt_id, ccmp_registrtion_no, ccmp_vat_registrtion_no, ccmp_registration_address, ccmp_official_ccit_id, ccmp_official_address, ccmp_official_zip_code, ccmp_office_ccit_id, ccmp_office_address, ccmp_office_zip_code, ccmp_statuss, ccmp_description,ccmp_sys_ccmp_id', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ccmp_ccnt_id', 'numerical', 'integerOnly' => true),
                array('ccmp_name, ccmp_registration_address, ccmp_official_address, ccmp_office_address', 'length', 'max' => 200),
                array('ccmp_registrtion_no, ccmp_vat_registrtion_no, ccmp_official_zip_code, ccmp_office_zip_code', 'length', 'max' => 20),
                array('ccmp_official_ccit_id, ccmp_office_ccit_id', 'length', 'max' => 10),
                array('ccmp_statuss', 'length', 'max' => 10),
                array('ccmp_description', 'safe'),
                array('ccmp_office_email', 'email'),
                array('ccmp_office_phone', 'length', 'max' => 15),
                array('ccmp_id, ccmp_name, ccmp_ccnt_id, ccmp_registrtion_no, ccmp_vat_registrtion_no, ccmp_registration_address, ccmp_official_ccit_id, ccmp_official_address, ccmp_official_zip_code, ccmp_office_ccit_id, ccmp_office_address, ccmp_office_zip_code, ccmp_statuss, ccmp_description,ccmp_sys_ccmp_id', 'safe', 'on' => 'search'),
                array('ccmp_name', 'unique'),
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
        return array(
            'bcars' => array(self::HAS_MANY, 'BcarId', 'bcar_ccmp_id'),
            'bcbdCompanyBranchDays' => array(self::HAS_MANY, 'BcbdCompanyBranchDay', 'bcbd_client_ccmp_id'),
            'ccbrBranches' => array(self::HAS_MANY, 'CcbrBranch', 'ccbr_ccmp_id'),
            'ccmpOfficeCcit' => array(self::BELONGS_TO, 'CcitCity', 'ccmp_office_ccit_id'),
            'ccmpCcnt' => array(self::BELONGS_TO, 'CcntCountry', 'ccmp_ccnt_id'),
            'ccmpOfficialCcit' => array(self::BELONGS_TO, 'CcitCity', 'ccmp_official_ccit_id'),
            'ccxgCompanyXGroups' => array(self::HAS_MANY, 'CcxgCompanyXGroup', 'ccxg_ccmp_id'),
            'ccucUserCompany' => array(self::HAS_MANY, 'CcucUserCompany', 'ccuc_ccmp_id'),
            'cccdCustomData' => array(self::HAS_ONE, 'BaseCccdCompanyData', 'cccd_ccmp_id')
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

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ccmp_id', $this->ccmp_id);
        $criteria->compare('t.ccmp_name', $this->ccmp_name, true);
        $criteria->compare('t.ccmp_ccnt_id', $this->ccmp_ccnt_id);
        $criteria->compare('t.ccmp_registrtion_no', $this->ccmp_registrtion_no, true);
        $criteria->compare('t.ccmp_vat_registrtion_no', $this->ccmp_vat_registrtion_no, true);
        $criteria->compare('t.ccmp_registration_address', $this->ccmp_registration_address, true);
        $criteria->compare('t.ccmp_official_ccit_id', $this->ccmp_official_ccit_id);
        $criteria->compare('t.ccmp_official_address', $this->ccmp_official_address, true);
        $criteria->compare('t.ccmp_official_zip_code', $this->ccmp_official_zip_code, true);
        $criteria->compare('t.ccmp_office_ccit_id', $this->ccmp_office_ccit_id);
        $criteria->compare('t.ccmp_office_address', $this->ccmp_office_address, true);
        $criteria->compare('t.ccmp_office_zip_code', $this->ccmp_office_zip_code, true);
        $criteria->compare('t.ccmp_statuss', $this->ccmp_statuss);
        $criteria->compare('t.ccmp_description', $this->ccmp_description, true);
        $criteria->compare('t.ccmp_office_email', $this->ccmp_office_email, true);
        $criteria->compare('t.ccmp_office_phone', $this->ccmp_office_phone, true);

        if(Yii::app()->sysCompany->getActiveCompany()){
            $criteria->compare('t.ccmp_sys_ccmp_id', Yii::app()->sysCompany->getActiveCompany());
        }     
        
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria, 
             'sort'=>array('defaultOrder'=>'ccmp_name'),
             'pagination'=>array('pageSize'=>50),

        ));
    }
    


}
