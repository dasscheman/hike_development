<?php
// Created: 2014
// Modified: 23 feb 2015

/**
 * This is the model class for table "tbl_qr".
 *
 * The followings are the available columns in table 'tbl_qr':
 * @property integer $qr_ID
 * @property string $qr_name
 * @property string $qr_code
 * @property integer $event_ID
 * @property integer $route_ID
 * @property integer $qr_volgorde
 * @property integer $score
 * @property string $create_time
 * @property integer $create_user_ID
 * @property string $update_time
 * @property integer $update_user_ID
 *
 * The followings are the available model relations:
 * @property Users $createUser
 * @property EventNames $event
 * @property Route $route
 * @property Users $updateUser
 * @property QrCheck[] $qrChecks
 */
class Qr extends HikeActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Qr the static model class
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
		return 'tbl_qr';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('qr_name, qr_code, event_ID, route_ID, score', 'required'),
			array('event_ID, route_ID, qr_volgorde, score, create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('qr_name, qr_code', 'length', 'max'=>255),
			array('create_time, update_time', 'safe'),
			array('qr_name', 'ext.UniqueAttributesValidator', 'with'=>'event_ID,route_ID'),
			array('qr_code', 'ext.UniqueAttributesValidator', 'with'=>'event_ID,route_ID'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('qr_ID, qr_name, qr_code, event_ID, route_ID, qr_volgorde, score, create_time, create_user_ID, update_time, update_user_ID', 'safe', 'on'=>'search'),
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
			'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user_ID'),
            'route' => array(self::BELONGS_TO, 'Route', 'route_ID'),
			'qrChecks' => array(self::HAS_MANY, 'QrCheck', 'qr_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'qr_ID' => 'Qr',
			'qr_name' => 'Stille Post Naam',
			'qr_code' => 'Qr Code',
			'event_ID' => 'Event',
            'route_ID' => 'Route',
			'qr_volgorde' => 'Volgorde',
			'score' => 'Score',
			'create_time' => 'Create Time',
			'create_user_ID' => 'Create User',
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

		$criteria->compare('qr_ID',$this->qr_ID);
		$criteria->compare('qr_name',$this->qr_name,true);
		$criteria->compare('qr_code',$this->qr_code,true);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('route_ID',$this->route_ID);
		$criteria->compare('qr_volgorde',$this->qr_volgorde);
		$criteria->compare('score',$this->score);
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
    function isActionAllowed($controller_id = null,
							 $action_id = null,
							 $event_id = null,
							 $model_id = null,
							 $group_id = null,
							 $date = null,
							 $order = null,
							 $move = null)
    {
		$actionAllowed = parent::isActionAllowed($controller_id, $action_id, $event_id, $model_id);

		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = DeelnemersEvent::model()->getRolOfPlayer($event_id, Yii::app()->user->id);
		$route_id = Qr::model()->getQrRouteID($model_id);

		if ($action_id == 'createIntroductie' and
			$hikeStatus == EventNames::STATUS_opstart and
			$rolPlayer == DeelnemersEvent::ROL_organisatie) {
				$actionAllowed = true;
		}

		if ($action_id == 'report' and
			$rolPlayer == DeelnemersEvent::ROL_organisatie) {
				$actionAllowed = true;
		}

		if ($action_id == 'moveUpDown'){
			if (!isset($order) || !isset($route_id)){
				return $actionAllowed;
			}
			if ($hikeStatus != EventNames::STATUS_opstart or
				$rolPlayer != DeelnemersEvent::ROL_organisatie) {
					return $actionAllowed;
			}

			if ($move == 'up'){
				$nextOrderExist = Qr::model()->higherOrderNumberExists($event_id,
																	   $model_id,
																	   $order,
																	   $route_id);
			}
			if ($move == 'down'){
				$nextOrderExist = Qr::model()->lowererOrderNumberExists($event_id,
																		$model_id,
																		$order,
																		$route_id);
			}
			if ($nextOrderExist) {
				$actionAllowed = true;
			}
		}

		return $actionAllowed;
	}


	public function getUniqueQrCode()
	{
		$UniqueQrCode = 99;
		$event_id = $_GET['event_id'];
		while($UniqueQrCode == 99)
		{
			$newqrcode = GeneralFunctions::randomString(22);

			$data = Qr::model()->find('event_ID = :event_Id AND qr_code=:qr_code',
						    array(':event_Id' => $event_id,
							  ':qr_code' => $newqrcode));
			// if QR code niet bestaat dan wordt de nieuwe gegenereede code gebruikt
			if(!isset($data))
			{
				$UniqueQrCode = $newqrcode;
			}
		}
		return($UniqueQrCode);
	}

	public function getQrCode($event_id, $qr_id)
	{
		$data = Qr::model()->find('event_ID = :event_Id AND qr_ID=:qr_id',
						    array(':event_Id' => $event_id,
							  ':qr_id' => $qr_id));
		return($data->qr_code);
	}

	public function getQrRouteID($qr_id)
	{
		$data = Qr::model()->find('qr_ID=:qr_id',
						    array(':qr_id' => $qr_id));
		if(isset($data->route_ID)){
			return $data->route_ID;
		} else {
			return false;
		}
	}

	public function getQrId($event_id, $qr_code)
	{
		$data = Qr::model()->find('event_ID = :event_Id AND qr_code=:qr_code',
						    array(':event_Id' => $event_id,
							  ':qr_code' => $qr_code));
		return($data->qr_ID);
	}


	public function getQrCodeNAme($event_id, $qr_id)
	{
		$data = Qr::model()->find('event_ID = :event_Id AND qr_ID=:qr_id',
						    array(':event_Id' => $event_id,
							  ':qr_id' => $qr_id));
		return($data->qr_name);
	}

	public function getNewOrderForIntroductieQr($event_id)
	{
        $route_id = Route::model()->getIntroductieRouteId($event_id);

		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND route_ID =:route_id';
		$criteria->params=array(':event_id' => $event_id, ':route_id' =>$route_id);
		$criteria->order = "qr_volgorde DESC";
		$criteria->limit = 1;

		if (Qr::model()->exists($criteria))
		{	$data = Qr::model()->findAll($criteria);
			$newOrder = $data[0]->qr_volgorde+1;
		} else {
			$newOrder = 1;}

		return $newOrder;
	}

	public function getNewOrderForQr($event_id, $route_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND route_ID =:route_id';
		$criteria->params=array(':event_id' => $event_id, ':route_id' =>$route_id);
		$criteria->order = "qr_volgorde DESC";
		$criteria->limit = 1;

		if (Qr::model()->exists($criteria))
		{	$data = Qr::model()->findAll($criteria);
			$newOrder = $data[0]->qr_volgorde+1;
		} else {
			$newOrder = 1;}

		return $newOrder;
	}

	public function getNumberQrRouteId($event_id, $route_id)
	{
        $criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND route_ID =:route_id';
		$criteria->params=array(':event_id' => $event_id, ':route_id' =>$route_id);

		return Qr::model()->count($criteria);
	}

	public function lowererOrderNumberExists($event_id, $id, $qr_order, $route_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND qr_ID !=:id AND route_ID=:route_id AND qr_volgorde >=:order';
		$criteria->params=array(':event_id' => $event_id,
								':id' => $id,
								':route_id' => $route_id ,
								':order' => $qr_order);

		if (Qr::model()->exists($criteria))
			return true;
		else
			return false;
	}

	public function higherOrderNumberExists($event_id, $id, $qr_order, $route_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND qr_ID !=:id AND route_ID =:route_id AND qr_volgorde <=:order';
		$criteria->params=array(':event_id' => $event_id,
								':id' => $id,
								':route_id' => $route_id,
								':order' => $qr_order);

		if (Qr::model()->exists($criteria))
			return true;
		else
			return false;
	}

	public function qrExistForRouteId($event_id, $route_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND route_ID =:route_id';
		$criteria->params=array(':event_id' => $event_id, ':route_id' => $route_id);

		if (Qr::model()->exists($criteria))
			return true;
		else
			return false;
	}

    /**
    * Retrieves the score of an post.
    */
    public function getQrScore($qr_Id)
    {
    	$data = Qr::model()->find('qr_ID =:qr_Id', array(':qr_Id' => $qr_Id));
        return isset($data->score) ?
            $data->score : 0;
    }

}