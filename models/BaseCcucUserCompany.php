<?php

/**
 * This is the model class for table "ccuc_user_company".
 *
 * The followings are the available columns in table 'ccuc_user_company':
 * @property integer $ccuc_id
 * @property string $ccuc_ccmp_id
 * @property integer $ccuc_user_id
 * @property string $ccuc_type
 *
 * The followings are the available model relations:
 * @property CcmpCompany $ccucCcmp
 */
class BaseCcucUserCompany extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ccuc_user_company';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ccuc_ccmp_id, ccuc_user_id', 'required'),
			array('ccuc_user_id', 'numerical', 'integerOnly'=>true),
			array('ccuc_ccmp_id', 'length', 'max'=>10),
			array('ccuc_type', 'length', 'max'=>12),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ccuc_id, ccuc_ccmp_id, ccuc_user_id, ccuc_type', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ccucCcmp' => array(self::BELONGS_TO, 'CcmpCompany', 'ccuc_ccmp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ccuc_id' => 'Ccuc',
			'ccuc_ccmp_id' => 'Ccuc Ccmp',
			'ccuc_user_id' => 'Ccuc User',
			'ccuc_type' => 'Ccuc Type',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ccuc_id',$this->ccuc_id);
		$criteria->compare('ccuc_ccmp_id',$this->ccuc_ccmp_id,true);
		$criteria->compare('ccuc_user_id',$this->ccuc_user_id);
		$criteria->compare('ccuc_type',$this->ccuc_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BaseCcucUserCompany the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
