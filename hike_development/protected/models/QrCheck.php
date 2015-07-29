<?php
// Created: 2014
// Modified: 19 jan 2015

/**
 * This is the model class for table "tbl_qr_check".
 *
 * The followings are the available columns in table 'tbl_qr_check':
 * @property integer $qr_check_ID
 * @property integer $qr_ID
 * @property integer $event_ID
 * @property integer $group_ID
 * @property string $create_time
 * @property integer $create_user_ID
 * @property string $update_time
 * @property integer $update_user_ID
 *
 * The followings are the available model relations:
 * @property Users $updateUser
 * @property Users $createUser
 * @property EventNames $event
 * @property Groups $group
 * @property Qr $qr
 */

class QrCheck extends HikeActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QrCheck the static model class
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
		return 'tbl_qr_check';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('qr_ID, event_ID, group_ID', 'required'),
			array('qr_ID, event_ID, group_ID, create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('qr_check_ID, qr_ID, event_ID, group_ID, create_time, create_user_ID, update_time, update_user_ID', 'safe', 'on'=>'search'),
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
			'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user_ID'),
			'createUser' => array(self::BELONGS_TO, 'Users', 'create_user_ID'),
			'event' => array(self::BELONGS_TO, 'EventNames', 'event_ID'),
			'group' => array(self::BELONGS_TO, 'Groups', 'group_ID'),
			'qr' => array(self::BELONGS_TO, 'Qr', 'qr_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'qr_check_ID' => 'Qr Check',
			'qr_ID' => 'Qr',
			'event_ID' => 'Event',
			'group_ID' => 'Group',
			'create_time' => 'Incheck Tijd',
			'create_user_ID' => 'Ingecheckt door',
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

		$criteria->compare('qr_check_ID',$this->qr_check_ID);
		$criteria->compare('qr_ID',$this->qr_ID);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('group_ID',$this->group_ID);
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

    /**
     * Checks if qr id is used by any group.
     */
    public function isQrUsed($qr_id)
	{              
		$criteria = new CDbCriteria;
		$criteria->condition="qr_ID =$qr_id";
		return QrCheck::model()->exists($criteria);
	}

	public function existQrCodeForGroup($event_id, $qr_id, $groupPlayer)
	{              
		$criteria = new CDbCriteria;
		$criteria->select='qr_check_ID as qr_check_ID';
		//$criteria->select='score as score';                           //Aangepast voor hike
		$criteria->condition="event_ID = $event_id AND
                              qr_ID =$qr_id AND
                              group_ID = $groupPlayer";
		$data = QrCheck::model()->find($criteria);
		if(isset($data->qr_check_ID))
			{ return(true);}
		else
			{ return(false);}
	}
	
	/**
	 * Returns de score voor het checken van de stillen posten voor een groep
	 */
	public function getQrScore($event_id, $group_id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition="event_ID = $event_id AND
				      group_ID = $group_id";
		$data = QrCheck::model()->findAll($criteria);

        $score = 0;
    	foreach($data as $obj)
        {
            $score = $score + Qr::model()->getQrScore($obj->qr_ID);
        }
        return $score;
	}
}