<?php

/**
 * This is the model base class for the table "ccuc_user_company".
 *
 * Columns in table "ccuc_user_company" available as properties of the model:
 * @property integer $ccuc_id
 * @property string $ccuc_ccmp_id
 * @property integer $ccuc_person_id
 * @property string $ccuc_status
 * @property integer $ccuc_cucp_id
 *
 * Relations of table "ccuc_user_company" available as properties of the model:
 * @property CucpUserCompanyPosition $ccucCucp
 * @property CcmpCompany $ccucCcmp
 * @property PprsPerson $ccucPerson
 */
abstract class BaseCcucUserCompany extends CActiveRecord
{
    /**
    * ENUM field values
    */
    const CCUC_STATUS_USER = 'USER';
    const CCUC_STATUS_HIDDED = 'HIDDED';
    const CCUC_STATUS_PERSON = 'PERSON';
    const CCUC_STATUS_SYS = 'SYS';

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ccuc_user_company';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                //array('ccuc_person_id', 'required'),
                array('ccuc_ccmp_id, ccuc_status, ccuc_cucp_id', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ccuc_person_id, ccuc_cucp_id', 'numerical', 'integerOnly' => true),
                array('ccuc_ccmp_id', 'length', 'max' => 10),
                array('ccuc_status', 'length', 'max' => 6),
                array('ccuc_id, ccuc_ccmp_id, ccuc_person_id, ccuc_status, ccuc_cucp_id', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ccuc_ccmp_id;
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
                'ccucCucp' => array(self::BELONGS_TO, 'CucpUserCompanyPosition', 'ccuc_cucp_id'),
                'ccucCcmp' => array(self::BELONGS_TO, 'CcmpCompany', 'ccuc_ccmp_id'),
                'ccucPerson' => array(self::BELONGS_TO, 'PprsPerson', 'ccuc_person_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'ccuc_id' => Yii::t('D2companyModule.crud', 'Ccuc'),
            'ccuc_ccmp_id' => Yii::t('D2companyModule.crud', 'CompanyId'),
            'ccuc_person_id' => Yii::t('D2companyModule.crud', 'Person'),
            'ccuc_status' => Yii::t('D2companyModule.crud', 'Status'),
            'ccuc_cucp_id' => Yii::t('D2companyModule.model', 'Ccuc Cucp'),
        );
    }

    public function enumLabels()
    {
        return array(
           'ccuc_status' => array(
               self::CCUC_STATUS_USER => Yii::t('D2companyModule.crud', 'User'),
               self::CCUC_STATUS_HIDDED => Yii::t('D2companyModule.crud', 'Disabled user'),
               self::CCUC_STATUS_PERSON => Yii::t('D2companyModule.crud', 'No user'),
               self::CCUC_STATUS_SYS => Yii::t('D2companyModule.crud', 'System company'),
           ),
            );
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


    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ccuc_id', $this->ccuc_id);
        $criteria->compare('t.ccuc_ccmp_id', $this->ccuc_ccmp_id);
        $criteria->compare('t.ccuc_person_id', $this->ccuc_person_id);
        $criteria->compare('t.ccuc_status', $this->ccuc_status);
        $criteria->compare('t.ccuc_cucp_id', $this->ccuc_cucp_id);


        return $criteria;

    }

}
