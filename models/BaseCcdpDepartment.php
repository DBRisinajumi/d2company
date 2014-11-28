<?php

/**
 * This is the model base class for the table "ccdp_department".
 *
 * Columns in table "ccdp_department" available as properties of the model:
 * @property string $ccdp_id
 * @property string $ccdp_ccmp_id
 * @property string $ccdp_name
 *
 * Relations of table "ccdp_department" available as properties of the model:
 * @property CcmpCompany $ccdpCcmp
 */
abstract class BaseCcdpDepartment extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ccdp_department';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ccdp_ccmp_id', 'required'),
                array('ccdp_name', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ccdp_ccmp_id', 'length', 'max' => 10),
                array('ccdp_name', 'length', 'max' => 50),
                array('ccdp_id, ccdp_ccmp_id, ccdp_name', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ccdp_ccmp_id;
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
                'ccdpCcmp' => array(self::BELONGS_TO, 'CcmpCompany', 'ccdp_ccmp_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'ccdp_id' => Yii::t('D2companyModule.crud', 'Ccdp'),
            'ccdp_ccmp_id' => Yii::t('D2companyModule.crud', 'Ccdp Ccmp'),
            'ccdp_name' => Yii::t('D2companyModule.crud', 'Ccdp Name'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ccdp_id', $this->ccdp_id, true);
        $criteria->compare('t.ccdp_ccmp_id', $this->ccdp_ccmp_id);
        $criteria->compare('t.ccdp_name', $this->ccdp_name, true);


        return $criteria;

    }

}
