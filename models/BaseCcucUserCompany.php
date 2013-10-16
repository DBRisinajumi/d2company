<?php

/**
 * This is the model base class for the table "ccuc_user_company".
 *
 * Columns in table "ccuc_user_company" available as properties of the model:
 * @property integer $ccuc_id
 * @property string $ccuc_ccmp_id
 * @property integer $ccuc_user_id
 *
 * Relations of table "ccuc_user_company" available as properties of the model:
 * @property CcmpCompany $ccucCcmp
 */
abstract class BaseCcucUserCompany extends CActiveRecord
{

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
                array('ccuc_ccmp_id, ccuc_user_id', 'required'),
                array('ccuc_user_id', 'numerical', 'integerOnly' => true),
                array('ccuc_ccmp_id', 'length', 'max' => 10),
                array('ccuc_id, ccuc_ccmp_id, ccuc_user_id', 'safe', 'on' => 'search'),
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
        return array(
            'ccucCcmp' => array(self::BELONGS_TO, 'CcmpCompany', 'ccuc_ccmp_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'ccuc_id' => Yii::t('crud', 'Ccuc'),
            'ccuc_ccmp_id' => Yii::t('crud', 'Ccuc Ccmp'),
            'ccuc_user_id' => Yii::t('crud', 'Ccuc User'),
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ccuc_id', $this->ccuc_id);
        $criteria->compare('t.ccuc_ccmp_id', $this->ccuc_ccmp_id);
        $criteria->compare('t.ccuc_user_id', $this->ccuc_user_id);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
