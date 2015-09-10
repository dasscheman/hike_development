<?php
// Created: 2014
// Modified: 23 feb 2015

/**
 * This is the model class for table "tbl_open_vragen".
 *
 * The followings are the available columns in table 'tbl_open_vragen':
 * @property integer $open_vragen_ID
 * @property string $open_vragen_name
 * @property integer $event_ID
 * @property integer $route_ID
 * @property integer $vraag_volgorde
 * @property string $omschrijving
 * @property string $vraag
 * @property integer $score
 * @property string $goede_antwoord
 * @property string $create_time
 * @property integer $create_user_ID
 * @property string $update_time
 * @property integer $update_user_ID
 *
 * The followings are the available model relations:
 * @property Users $updateUser
 * @property Users $createUser
 * @property EventNames $event
 * @property Route $route
 * @property OpenVragenAntwoorden[] $openVragenAntwoordens
 */
class OpenVragen extends HikeActiveRecord
{
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OpenVragen the static model class
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
		return 'tbl_open_vragen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
        return array(
			array('open_vragen_name, event_ID,
			      vraag, goede_antwoord, score, omschrijving', 'required'),
			array('event_ID, route_ID, vraag_volgorde,
			      create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('open_vragen_name, vraag, goede_antwoord', 'length', 'max'=>255),
			array('create_time, update_time', 'safe'),
			array('open_vragen_name', 'ext.UniqueAttributesValidator', 'with'=>'event_ID,route_ID'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('open_vragen_ID, open_vragen_name, event_ID,
			      route_ID, vraag_volgorde, vraag, goede_antwoord,
			      create_time, create_user_ID, update_time, update_user_ID, omschrijving',
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
			'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user_ID'),
			'createUser' => array(self::BELONGS_TO, 'Users', 'create_user_ID'),
			'event' => array(self::BELONGS_TO, 'EventNames', 'event_ID'),
			'route' => array(self::BELONGS_TO, 'Route', 'route_ID'),
			'openVragenAntwoordens' => array(self::HAS_MANY, 'OpenVragenAntwoorden', 'open_vragen_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'open_vragen_ID' => 'Open Vragen',
			'open_vragen_name' => 'Naam',
			'event_ID' => 'Event',
			'route_ID' => 'Route',
			'vraag_volgorde' => 'Vraag Volgorde',
			'omschrijving' => 'Omschrijving',
			'vraag' => 'Vraag',
			'goede_antwoord' => 'Goede Antwoord',
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

		$criteria->compare('open_vragen_ID',$this->open_vragen_ID);
		$criteria->compare('open_vragen_name',$this->open_vragen_name,true);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('route_ID',$this->route_ID);
		$criteria->compare('vraag_volgorde',$this->vraag_volgorde);
		$criteria->compare('omschrijving',$this->omschrijving,true);
		$criteria->compare('vraag',$this->vraag,true);
		$criteria->compare('goede_antwoord',$this->goede_antwoord,true);
		$criteria->compare('score',$this->score);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchOpenVragen($event_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('open_vragen_ID',$this->open_vragen_ID);
		$criteria->compare('open_vragen_name',$this->open_vragen_name,true);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->condition = 'event_ID=:event_id';
		$criteria->params=array(':event_id'=>$event_id);
		$criteria->order= 'route_ID ASC, vraag_volgorde ASC';
		$criteria->compare('route_ID',$this->route_ID);
		$criteria->compare('vraag_volgorde',$this->vraag_volgorde);
		$criteria->compare('omschrijving',$this->omschrijving,true);
		$criteria->compare('vraag',$this->vraag,true);
		$criteria->compare('goede_antwoord',$this->goede_antwoord,true);
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
		$route_id = OpenVragen::model()->getRouteIdVraag($model_id);

		if ($action_id == 'moveUpDownVraag' and
			$hikeStatus == EventNames::STATUS_opstart and
			$rolPlayer == DeelnemersEvent::ROL_organisatie) {
				$actionAllowed = true;
		}

		if ($action_id == 'createIntroductie' and
			$hikeStatus == EventNames::STATUS_opstart and
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
			if ($move == 'up') {
				$nextOrderExist = OpenVragen::model()->higherOrderNumberExists($event_id,
																			   $model_id,
																			   $order,
																			   $route_id);
			}
			if ($move == 'down') {
				$nextOrderExist = OpenVragen::model()->lowerOrderNumberExists($event_id,
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

	/**
	 * Returns list van alle beschikbare vragen.
	 */
	public function getOpenVragenIdOptions($event_Id)
	{
		$data = OpenVragen::model()->findAll('event_ID =:event_Id', array(':event_Id' => $event_Id));
			$list = CHtml::listData($data, 'open_vragen_ID', 'open_vragen_name');
		return $list;
	}

	/**
	 *TODO: check of dit de manier en de plek is voor deze dataprovider.
	 */
	public function openVragenAllDataProvider($event_id)
	{
	     $where = "event_ID = $event_id";

	     $dataProvider=new CActiveDataProvider('OpenVragen',
		 array(
		     'criteria'=>array(
			 'condition'=>$where,
			 //'order'=>'binnenkomst DESC',
			 ),
		     'pagination'=>array(
			 'pageSize'=>5,
		     ),
	     ));
	     return $dataProvider;

	 }


	/**
	 * Returns lijst met beschikbare vragenen.
	 */
	public function getOpenAvailableVragen($event_id)
	{
		$data = OpenVragen::model()->findAll('event_ID = $event_id');
		$list = CHtml::listData($data, '$open_vragen_ID', '$open_vragen_name');
		return $list;
	}

	 /**
	  * Returns omschrijving (naam) van een vraag.
	  * TODO: moet niet een list returnen.
	  */
	 public function getOpenVragenName($vraag_id)
	 {
		$data = OpenVragen::model()->find('open_vragen_ID =:vraag_id',
						  array(':vraag_id' => $vraag_id));
		return $data->open_vragen_name;
	 }

	public function getOpenVraag($vraag_id)
	{
		$data = OpenVragen::model()->find('open_vragen_ID =:vraag_id',
						  array(':vraag_id' => $vraag_id));
		return $data->vraag;
	}

	/**
	 * Zelfde als hierboven 1 van de twee moet weg.
	 */
	public function getOpenVraagAntwoord($vraag_id)
	{
		$data = OpenVragen::model()->find('open_vragen_ID =:vraag_id',
						  array(':vraag_id' => $vraag_id));
		//$list = CHtml::listData($data, 'open_vragen_ID', 'goede_antwoord');
		return $data->goede_antwoord;
	}

	/**
	 * Returns score voor een vraag.
	 */
	public function getOpenVraagScore($vraag_id)
	{
		$data = OpenVragen::model()->find('open_vragen_ID =:vraag_id',
						  array(':vraag_id' => $vraag_id));
        return isset($data->score) ?
            $data->score : 0;
	}

	/**
	 * Returns volgnummer van een vraag.
	 */
	public function	getVraagVolgorde($vraag_id)
	{
		$data = OpenVragen::model()->find('open_vragen_ID =:vraag_id',
						  array(':vraag_id' => $vraag_id));
		return $data->vraag_volgorde;
	}

	/**
	 * Returns Dag van een vraag.
	 */
	public function	getVraagDag($vraag_id)
	{
		$data = OpenVragen::model()->find('open_vragen_ID =:vraag_id',
						  array(':vraag_id' => $vraag_id));

		if(isset($data->route_ID))
		{
			$date = Route::model()->getDayOfRouteId($data->route_ID);
			return $date;
		}
		else
			{return;}
	}

	/**
	 * Returns Route onderdeel van vraag
	 */
	public function	getRouteOnderdeelVraag($vraag_id)
	{
		$data = OpenVragen::model()->find('open_vragen_ID =:vraag_id',
						  array(':vraag_id' => $vraag_id));
		$day = Route::model()->getRouteName($data->route_ID);
		return $day;
	}

	/**
	 * Returns Route ID van vraag
	 */
	public function	getRouteIdVraag($vraag_id)
	{
		$data = OpenVragen::model()->find('open_vragen_ID =:vraag_id',
						  array(':vraag_id' => $vraag_id));
		if(isset($data->route_ID)){
			return $data->route_ID;
		} else {
			return false;
		}
	}

	public function getNewOrderForIntroductieVragen($event_id)
	{
        $route_id = Route::model()->getIntroductieRouteId($event_id);

		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND route_ID =:route_id';
		$criteria->params=array(':event_id' => $event_id, ':route_id' =>$route_id);
		$criteria->order = "vraag_volgorde DESC";
		$criteria->limit = 1;

		if (OpenVragen::model()->exists($criteria))
		{	$data = OpenVragen::model()->findAll($criteria);
			$newOrder = $data[0]->vraag_volgorde+1;
		} else {
			$newOrder = 1;}

		return $newOrder;
	}


	public function getNewOrderForVragen($event_id, $route_id)
	{
        $criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND route_ID =:route_id';
		$criteria->params=array(':event_id' => $event_id, ':route_id' =>$route_id);
		$criteria->order = "vraag_volgorde DESC";
		$criteria->limit = 1;

		if (OpenVragen::model()->exists($criteria))
		{	$data = OpenVragen::model()->findAll($criteria);
			$newOrder = $data[0]->vraag_volgorde+1;
		} else {
			$newOrder = 1;}

		return $newOrder;
	}

	public function getNumberVragenRouteId($event_id, $route_id)
	{
        $criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND route_ID =:route_id';
		$criteria->params=array(':event_id' => $event_id, ':route_id' =>$route_id);

		return OpenVragen::model()->count($criteria);
	}

	public function lowerOrderNumberExists($event_id, $id, $vraag_order, $route_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND open_vragen_ID !=:id AND route_ID=:route_id AND vraag_volgorde >=:order';
		$criteria->params=array(':event_id' => $event_id,
								':id' => $id,
								':route_id' => $route_id,
								':order' => $vraag_order);

		if (OpenVragen::model()->exists($criteria)) {
			return true;
		} else {
			return false;
		}
	}

	public function higherOrderNumberExists($event_id, $id, $vraag_order, $route_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND open_vragen_ID !=:id AND route_ID =:route_id AND vraag_volgorde <=:order';
		$criteria->params=array(':event_id' => $event_id,
								':id' => $id,
								':route_id' => $route_id,
								':order' => $vraag_order);

		if (OpenVragen::model()->exists($criteria)) {
			return true;
		} else {
			return false;
		}
	}
}