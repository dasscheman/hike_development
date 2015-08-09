<?php
// Created: 2014
// Modified: 3 jan 2015

/**
 * This is the model class for table "tbl_open_nood_envelop".
 *
 * The followings are the available columns in table 'tbl_open_nood_envelop':
 * @property integer $open_nood_envelop_ID
 * @property integer $event_ID
 * @property integer $nood_envelop_ID
 * @property integer $group_ID
 * @property integer $opened
 * @property string $create_time
 * @property integer $create_user_ID
 * @property string $update_time
 * @property integer $update_user_ID
 *
 * The followings are the available model relations:
 * @property Users $createUser
 * @property EventNames $event
 * @property Groups $group
 * @property Users $updateUser
 * @property NoodEnvelop $noodEnvelop
 */
class OpenNoodEnvelop extends HikeActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OpenNoodEnvelop the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_open_nood_envelop';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_ID, nood_envelop_ID, group_ID', 'required'),
			array('event_ID, nood_envelop_ID, group_ID, opened, create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('open_nood_envelop_ID, event_ID, nood_envelop_ID, group_ID, opened, create_time, create_user_ID, update_time, update_user_ID', 'safe', 'on'=>'search'),
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
			'createUser' => array(self::BELONGS_TO, 'Users', 'create_user_ID'),
			'event' => array(self::BELONGS_TO, 'EventNames', 'event_ID'),
			'group' => array(self::BELONGS_TO, 'Groups', 'group_ID'),
			'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user_ID'),
			'noodEnvelop' => array(self::BELONGS_TO, 'NoodEnvelop', 'nood_envelop_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'open_nood_envelop_ID' => 'Open Nood Envelop',
			'event_ID' => 'Event',
			'nood_envelop_ID' => 'Nood Envelop',
			'group_ID' => 'Group',
			'opened' => 'Opened',
			'create_time' => 'Create Time',
			'create_user_ID' => 'Geopend door',
			'update_time' => 'Update Time',
			'update_user_ID' => 'Update User',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('open_nood_envelop_ID',$this->open_nood_envelop_ID);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('nood_envelop_ID',$this->nood_envelop_ID);
		$criteria->compare('group_ID',$this->group_ID);
		$criteria->compare('opened',$this->opened);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Check if actions are allowed. These checks are not only use in the controllers,
	 * but also for the visability of the menu items. 
	 */
    function isActionAllowed($controller_id = null, $action_id = null, $event_id = null, $group_id = null)
    {
		$actionAllowed = parent::isActionAllowed($controller_id, $action_id, $event_id, $group_id);
  
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = DeelnemersEvent::model()->getRolOfPlayer($event_id, Yii::app()->user->id);    
		return $actionAllowed;
	}


	public function envelopIsOpenedByAnyGroup($nood_envelop_id,
					     $event_id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition="nood_envelop_ID = $nood_envelop_id AND
				      event_ID = $event_id AND
				      opened = 1";
		$data = OpenNoodEnvelop::model()->find($criteria);
		if(isset($data->open_nood_envelop_ID))
			{return(true);}
		else
			{return(false);}	
	}
	
	public function isEnvelopOpenByGroup($nood_envelop_id,
					     $event_id,
					     $group_id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition="nood_envelop_ID = $nood_envelop_id AND
				      event_ID = $event_id AND
				      group_ID = $group_id AND
				      opened = 1";
		$data = OpenNoodEnvelop::model()->find($criteria);
		if(isset($data->open_nood_envelop_ID))
			{return(true);}
		else
			{return(false);}	
	}
	
	public function getOpenEnvelopScore($event_id,
					    $group_id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition="event_ID = $event_id AND
				      group_ID = $group_id AND
				      opened = 1";
		$data = OpenNoodEnvelop::model()->findAll($criteria);

        $score = 0;
    	foreach($data as $obj)
        {
            $score = $score + NoodEnvelop::model()->getNoodEnvelopScore($obj->nood_envelop_ID);
        }
        return $score;
	}		
}