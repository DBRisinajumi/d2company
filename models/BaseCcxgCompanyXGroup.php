<?php

/**
 * This is the model base class for the table "ccxg_company_x_group".
 *
 * Columns in table "ccxg_company_x_group" available as properties of the model:
 * @property string $ccxg_id
 * @property string $ccxg_ccmp_id
 * @property integer $ccxg_ccgr_id
 *
 * Relations of table "ccxg_company_x_group" available as properties of the model:
 * @property CcgrGroup $ccxgCcgr
 * @property CcmpCompany $ccxgCcmp
 */
abstract class BaseCcxgCompanyXGroup extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ccxg_company_x_group';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ccxg_ccmp_id, ccxg_ccgr_id', 'required'),
                array('ccxg_ccgr_id', 'numerical', 'integerOnly' => true),
                array('ccxg_ccmp_id', 'length', 'max' => 10),
                array('ccxg_id, ccxg_ccmp_id, ccxg_ccgr_id', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ccxgCcgr->ccgr_name;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'savedRelated' => array(
                    'class' => 'vendor.schmunk42.relation.behaviors.GtcSaveRelationsBehavior'
                )
            )
        );
    }

    public function relations()
    {
        return array(
            'ccxgCcgr' => array(self::BELONGS_TO, 'CcgrGroup', 'ccxg_ccgr_id'),
            'ccxgCcmp' => array(self::BELONGS_TO, 'CcmpCompany', 'ccxg_ccmp_id'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'ccxg_id' => Yii::t('D2companyModule.crud', 'Ccxg'),
            'ccxg_ccmp_id' => Yii::t('D2companyModule.crud', 'Ccxg Ccmp'),
            'ccxg_ccgr_id' => Yii::t('D2companyModule.crud', 'Ccxg Ccgr'),
        );
    }

    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ccxg_id', $this->ccxg_id, true);
        $criteria->compare('t.ccxg_ccmp_id', $this->ccxg_ccmp_id);
        $criteria->compare('t.ccxg_ccgr_id', $this->ccxg_ccgr_id);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

}
