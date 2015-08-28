<?php
// Created: 2014
// Modified: 3 jan 2015

/**
 * This is the model class for table "tbl_event_names".
 *
 * The followings are the available columns in table 'tbl_event_names':
 * @property integer $event_ID
 * @property string $event_name
 * @property string $start_date
 * @property string $end_date
 * @property integer $status
 * @property integer $active_day
 * @property string $max_time
 * @property string $create_time
 * @property integer $create_user_ID
 * @property string $update_time
 * @property integer $update_user_ID
 *
 * The followings are the available model relations:
 * @property Bonuspunten[] $bonuspuntens
 * @property DeelnemersEvent[] $deelnemersEvents
 * @property Users $createUser
 * @property Users $updateUser
 * @property Groups[] $groups
 * @property NoodEnvelop[] $noodEnvelops
 * @property OpenNoodEnvelop[] $openNoodEnvelops
 * @property OpenVragen[] $openVragens
 * @property OpenVragenAntwoorden[] $openVragenAntwoordens
 * @property PostPassage[] $postPassages
 * @property Posten[] $postens
 * @property Qr[] $qrs
 * @property QrCheck[] $qrChecks
 * @property Route[] $routes
 */
class EventNames extends HikeActiveRecord
{
	const STATUS_opstart=1;
	const STATUS_introductie=2;
	const STATUS_gestart=3;
	const STATUS_beindigd=4;
	const STATUS_geannuleerd=5;

	public $changeStatusAllowed = false;
	public $changeDayAllowed = false;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EventNames the static model class
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
		return 'tbl_event_names';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_name, status', 'required'),
			array('event_name', 'unique'),
			//array('status, create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('status', 'numerical', 'integerOnly'=>true),
			array('event_name', 'length', 'max'=>255),
			//array('start_date, end_date, create_time, update_time', 'safe'),
			array('start_date, end_date, active_day, max_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('event_ID, event_name, start_date, end_date, status, active_day,
			      create_time, create_user_ID, update_time, update_user_ID',
			      'safe', 'on'=>'search'),
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
			'bonuspuntens' => array(self::HAS_MANY, 'Bonuspunten', 'event_ID'),
			'deelnemersEvents' => array(self::HAS_MANY, 'DeelnemersEvent', 'event_ID'),
			'createUser' => array(self::BELONGS_TO, 'Users', 'create_user_ID'),
			'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user_ID'),
			'groups' => array(self::HAS_MANY, 'Groups', 'event_ID'),
			'noodEnvelops' => array(self::HAS_MANY, 'NoodEnvelop', 'event_ID'),
			'openNoodEnvelops' => array(self::HAS_MANY, 'OpenNoodEnvelop', 'event_ID'),
			'openVragens' => array(self::HAS_MANY, 'OpenVragen', 'event_ID'),
			'openVragenAntwoordens' => array(self::HAS_MANY, 'OpenVragenAntwoorden', 'event_ID'),
			'postPassages' => array(self::HAS_MANY, 'PostPassage', 'event_ID'),
			'postens' => array(self::HAS_MANY, 'Posten', 'event_ID'),
			'qrs' => array(self::HAS_MANY, 'Qr', 'event_ID'),
			'qrChecks' => array(self::HAS_MANY, 'QrCheck', 'event_ID'),
			'routes' => array(self::HAS_MANY, 'Route', 'event_ID'),
		    );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'event_ID' => 'Event',
			'event_name' => 'Hike Naam',
			'start_date' => 'Start Datum',
			'end_date' => 'Eind Datum',
			'status' => 'Status',
			'active_day' => 'Active Day',
			'max_time' => 'Max time',
			'create_time' => 'Create Time',
			'create_user_ID' => 'Organisator',
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

		$criteria->join = 'JOIN tbl_deelnemers_event deelnemers ON deelnemers.event_ID = t.event_ID';
		$criteria->condition = 'deelnemers.user_ID = :currentuser';
		$criteria->params = array(':currentuser'=>Yii::app()->user->id);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('event_name',$this->event_name,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('active_day',$this->active_day);
		$criteria->compare('max_time',$this->max_time);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /* Only the actions specific to the model DeelnemersEvents and to the controller Game are here defined.
       Game does not have an model for itself.
    */
    function isActionAllowed($controller_id = null, $action_id = null, $event_id = null, $group_id = null)
    {
		$actionAllowed = parent::isActionAllowed($controller_id, $action_id, $event_id, $group_id);

		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = DeelnemersEvent::model()->getRolOfPlayer($event_id, Yii::app()->user->id);

		if ($action_id == 'changeStatus'){
            if (($hikeStatus == EventNames::STATUS_opstart or
                $hikeStatus == EventNames::STATUS_introductie or
                $hikeStatus == EventNames::STATUS_gestart) and
                $rolPlayer == DeelnemersEvent::ROL_organisatie) {
                $actionAllowed = true;
            }
        }
        if ($action_id == 'changeDay'){
            if ($hikeStatus == EventNames::STATUS_gestart and
                $rolPlayer == DeelnemersEvent::ROL_organisatie) {
                $actionAllowed = true;
            }
        }
		return $actionAllowed;
    }

    /**
	* Retrieves a list of statussen
	* @return array an array of available statussen.
	*/
	public function getStatusOptions()
	{
		return array(
			self::STATUS_opstart=>'Opstart',
			self::STATUS_introductie=>'Introductie',
			self::STATUS_gestart=>'Gestart',
			self::STATUS_beindigd=>'Beindigd',
			self::STATUS_geannuleerd=>'Geannuleerd',
			);
	}

	/**
	* @return string the status text display
	*/
	public function getStatusText()
	{
		$statusOptions=$this->statusOptions;
		if ( isset($statusOptions[$this->status]) ){
			return $statusOptions[$this->status];
		}
		return "unknown status ({$this->status})";
	}

    /**
	* @return string the status text display
	*/
	public function getStatusText2($status)
	{
		$statusOptions=$this->statusOptions;
		return isset($statusOptions[$status]) ?
			$statusOptions[$status] : "unknown status ({$status})";
	}

    /**
     * De het veld active day wordt gezet afhankelijk van de status.
     */
    protected function beforeSave()
    {
		if(parent::beforeSave())
		{
			if($this->status<>self::STATUS_gestart)
			{
				// Als de status anders dan 2 (opgestart) dan moet active day geleegd worden
				$this->active_day = "";
				$this->max_time = null;
			}

			if($this->status == self::STATUS_introductie)
			{
				// Als de status 1 (introductie) dan moet avtive day introductie worden
				$this->active_day = "0000-00-00";
			}
			return(true);
		}
		return(false);
    }

	/**
	* Retrieves a list of events
	* @return array an array of available events with status 'opstart'.
	*/
	public function getEventsWithStatusOpstart()
	{
		$data = EventNames::model()->findAll('status = 1');
		$list = CHtml::listData($data, 'event_ID', 'event_name');
		return $list;
	}

	/**
	* Retrieves a list of events
	* @return array an array of available events with status 'gestart'.
	*/
	public function getEventsWithStatusGestart()
	{
		$data = EventNames::model()->findAll('status = 3');
		$list = CHtml::listData($data, 'event_ID', 'event_name');
		return $list;
	}

	/**
	* Retrieves a list of events
	* @return array an array of all available events'.
	*/
	public function getEventNameOptions()
	{
		$data = EventNames::model()->findAll();
		$list = CHtml::listData($data, 'event_ID', 'event_name');
		return $list;
	}

	/**
	* Retrieves a event name
	*/
	public function getEventName($event_Id)
	{
		$data = EventNames::model()->find('event_ID =:event_Id', array(':event_Id' => $event_Id));
		if(isset($data->event_name))
			{return $data->event_name;}
		else
			{return;}
	}

	/**
	 * Returns de status of a hike.
	 */
	public function getStatusHike($event_Id)
	{
		$data = EventNames::model()->find('event_ID =:event_Id', array(':event_Id' => $event_Id));
		if(isset($data->status))
			{return $data->status;}
		else
			{return;}
	}

	/**
	 * Returns de status of a hike.
	 */
	public function getStartDate($event_Id)
	{
		$data = EventNames::model()->find('event_ID =:event_Id', array(':event_Id' => $event_Id));
		if(isset($data->status))
			{return $data->start_date;}
		else
			{return;}
	}
	/**
	 * Returns de status of a hike.
	 */
	public function getEndDate($event_Id)
	{
		$data = EventNames::model()->find('event_ID =:event_Id', array(':event_Id' => $event_Id));
		if(isset($data->status))
			{return $data->end_date;}
		else
			{return;}
	}

	public function maxTimeSet($event_Id){
		$data = EventNames::model()->find('event_ID =:event_Id', array(':event_Id' => $event_Id));
		if(isset($data->max_time))
			{return $data->max_time;}
		else
			{return false;}
	}

	/**
	 * Returns de actieve dag.
	 */
	public function getActiveDayOfHike($event_id)
	{
		$data = EventNames::model()->find('event_ID =:event_id', array(':event_id' => $event_id));
		if(isset($data->active_day))
			{return $data->active_day;}
		else
			{return;}
	}

    public function determineNewHikeId()
    {
		$criteria = new CDbCriteria();
		$criteria->order = "event_ID DESC";
		$criteria->limit = 1;

		if (EventNames::model()->exists($criteria))
		{	$data = EventNames::model()->findAll($criteria);
			$newHikeId = $data[0]->event_ID+1;
		} else {
			$newHikeId = 1;}

		$newHikeIdOk=EventNames::checkNewHikeId($newHikeId);

		if($newHikeIdOk)
		{
			return $newHikeId;
		} else {
			return NULL;
		}
    }

    public function checkNewHikeId($id)
    {
		$criteria = new CDbCriteria();
		$criteria->condition = "event_ID = $id";

		if(EventNames::model()->exists($criteria))
		{
			return false;
		}

		if(DeelnemersEvent::model()->exists($criteria))
		{
			return false;
		}
		return true;
    }

    public function getDatesAvailable($event_Id)
	{
		$StartDate = EventNames::model()->getStartDate($event_Id);
		$EndDate = EventNames::model()->getEndDate($event_Id);
		$mainarr = array();
		$date = $StartDate;
		$count = 0;
		while($date <= $EndDate)
		{
			$a = strptime($date, '%Y-%m-%d');
			$timestamp = mktime(0, 0, 0, $a['tm_mon']+1, $a['tm_mday'], $a['tm_year']+1900);
			//$timestamp = strtotime($date);
			$mainarr[$timestamp] = $date;
			$date++;
			$count++;
			// more then 10 days is unlikly, therefore break.
			if ($count == 10) {
				break;
			}
		}
		return $mainarr;
	}
}
