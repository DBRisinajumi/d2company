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
                array('ccmp_name', 'required'),
                array('ccmp_ccnt_id, ccmp_registrtion_no, ccmp_vat_registrtion_no, ccmp_registration_address, ccmp_official_ccit_id, ccmp_official_address, ccmp_official_zip_code, ccmp_office_ccit_id, ccmp_office_address, ccmp_office_zip_code, ccmp_statuss, ccmp_description', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ccmp_ccnt_id', 'numerical', 'integerOnly' => true),
                array('ccmp_name, ccmp_registration_address, ccmp_official_address, ccmp_office_address', 'length', 'max' => 200),
                array('ccmp_registrtion_no, ccmp_vat_registrtion_no, ccmp_official_zip_code, ccmp_office_zip_code', 'length', 'max' => 20),
                array('ccmp_official_ccit_id, ccmp_office_ccit_id', 'length', 'max' => 10),
                array('ccmp_statuss', 'length', 'max' => 6),
                array('ccmp_description', 'safe'),
                array('ccmp_id, ccmp_name, ccmp_ccnt_id, ccmp_registrtion_no, ccmp_vat_registrtion_no, ccmp_registration_address, ccmp_official_ccit_id, ccmp_official_address, ccmp_official_zip_code, ccmp_office_ccit_id, ccmp_office_address, ccmp_office_zip_code, ccmp_statuss, ccmp_description', 'safe', 'on' => 'search'),
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
        );
    }

    public function attributeLabels()
    {
        return array(
            'ccmp_id' => Yii::t('d2companyModule.crud', 'Ccmp'),
            'ccmp_name' => Yii::t('d2companyModule.crud', 'Ccmp Name'),
            'ccmp_ccnt_id' => Yii::t('d2companyModule.crud', 'Ccmp Ccnt'),
            'ccmp_registrtion_no' => Yii::t('d2companyModule.crud', 'Ccmp Registrtion No'),
            'ccmp_vat_registrtion_no' => Yii::t('d2companyModule.crud', 'Ccmp Vat Registrtion No'),
            'ccmp_registration_address' => Yii::t('d2companyModule.crud', 'Ccmp Registration Address'),
            'ccmp_official_ccit_id' => Yii::t('d2companyModule.crud', 'Ccmp Official Ccit'),
            'ccmp_official_address' => Yii::t('d2companyModule.crud', 'Ccmp Official Address'),
            'ccmp_official_zip_code' => Yii::t('d2companyModule.crud', 'Ccmp Official Zip Code'),
            'ccmp_office_ccit_id' => Yii::t('d2companyModule.crud', 'Ccmp Office Ccit'),
            'ccmp_office_address' => Yii::t('d2companyModule.crud', 'Ccmp Office Address'),
            'ccmp_office_zip_code' => Yii::t('d2companyModule.crud', 'Ccmp Office Zip Code'),
            'ccmp_statuss' => Yii::t('d2companyModule.crud', 'Ccmp Statuss'),
            'ccmp_description' => Yii::t('d2companyModule.crud', 'Ccmp Description'),
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ccmp_id', $this->ccmp_id, true);
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
        $criteria->compare('t.ccmp_statuss', $this->ccmp_statuss, true);
        $criteria->compare('t.ccmp_description', $this->ccmp_description, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
