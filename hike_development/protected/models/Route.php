<?php
// Created: 2014
// Modified: 23 feb 2015
/**
 * This is the model class for table "tbl_route".
 *
 * The followings are the available columns in table 'tbl_route':
 * @property integer $route_ID
 * @property string $route_name
 * @property integer $event_ID
 * @property string $day_date
 * @property integer $route_volgorde
 * @property string $create_time
 * @property integer $create_user_ID
 * @property string $update_time
 * @property integer $update_user_ID
 *
 * The followings are the available model relations:
 * @property EventNames $event
 * @property NoodEnvelop[] $noodEnvelops
 * @property OpenVragen[] $openVragens
 * @property Users $createUser
 * @property Users $updateUser
 */
class Route extends HikeActiveRecord
{
	public $routeMoveUpAllowed = false;
	public $routeMoveDownAllowed = false;
	private $_activeTab;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Route the static model class
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
		return 'tbl_route';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_ID, day_date, route_name', 'required'),
			array('event_ID, route_volgorde,
			      create_user_ID, update_user_ID', 'numerical',
			      'integerOnly'=>true),
			array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('route_ID, event_ID, day_date,
			      route_volgorde, create_time, create_user_ID, update_time,
			      update_user_ID', 'safe', 'on'=>'search'),
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
			'noodEnvelops' => array(self::BELONGS_TO, 'NoodEnvelop', 'route_ID'),
			'event' => array(self::BELONGS_TO, 'EventNames', 'event_ID'),
			'openVragens' => array(self::HAS_MANY, 'OpenVragen', 'route_ID'),
			'createUser' => array(self::BELONGS_TO, 'Users', 'create_user_ID'),
			'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'route_ID' => 'Route',
			'route_name' => 'Route Name',
			'event_ID' => 'Event',
			'day_date' => 'Day Date',
			'route_volgorde' => 'Route Volgorde',
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

		$criteria->compare('route_ID',$this->route_ID);
		$criteria->compare('route_name',$this->route_name,true);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('day_date',$this->day_date,true);
		$criteria->compare('route_volgorde',$this->route_volgorde);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
    public function searchRoute($event_id, $startDate)
    {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('route_ID',$this->route_ID);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('day_date',$this->day_date,true);
		$criteria->condition = 'event_ID=:event_id AND day_date=:date';
		$criteria->params=array(':event_id'=>$event_id,
							    ':date'=>$startDate);
		$criteria->order= 'route_volgorde ASC';
		$criteria->compare('route_volgorde',$this->route_volgorde);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>50)
		));
    }

    function isActionAllowed($controller_id = null, 
							 $action_id = null, 
							 $event_id = null,
							 $model_id = null,
							 $date = null, 
							 $order = null,
							 $move = null)
    {
		$actionAllowed = parent::isActionAllowed($controller_id, $action_id, $event_id, $model_id);
		
        $hikeStatus = EventNames::model()->getStatusHike($_GET['event_id']); 
        $rolPlayer = DeelnemersEvent::model()->getRolOfPlayer($_GET['event_id'], Yii::app()->user->id);
		
		if ($action_id == 'moveUpDown'){
			if (!isset($date) || !isset($move)){
				return $actionAllowed;
			}				
			if ($hikeStatus != EventNames::STATUS_opstart or
				$rolPlayer != DeelnemersEvent::ROL_organisatie) {
					return $actionAllowed;
			}	
			if ($move == 'up'){
				$nextOrderExist = Route::model()->higherOrderNumberExists($event_id, 
																		  $date,
																		  $order);
			}
			if ($move == 'down'){
				$nextOrderExist = Route::model()->lowererOrderNumberExists($event_id, 
																		   $date,
																		   $order);
			}
			if ($nextOrderExist) {
				$actionAllowed = true;
			}
		}
		
		if ($action_id == 'viewIntroductie'){
            if ($rolPlayer == DeelnemersEvent::ROL_organisatie ){
                $actionAllowed = true;
            }
        }		
		return $actionAllowed;
	}

	public function getDayOfRouteId($id)
	{
		$data = Route::model()->find('route_ID =:route_id', array(':route_id' => $id));
		return $data->day_date; 
	}

	public function getRouteName($id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'route_ID =:id';
		$criteria->params=array(':id' => $id);
		
		if (Route::model()->exists($criteria))
		{	$data = Route::model()->find($criteria);
			return $data->route_name;
		} else {
			return "nvt";}
	}
			
	public function getIntroductieRouteId($event_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND route_name =:route_name';
		$criteria->params=array(':event_id' => $event_id, ':route_name' =>'Introductie');
		$criteria->order = "route_volgorde DESC";
		$criteria->limit = 1;
		
		if (Route::model()->exists($criteria))
		{
			$data = Route::model()->findAll($criteria);
			$introductieID = $data[0]->route_ID;
		} else {
			$introductieID = 1;}
		
		return $introductieID;
	}

	public function routeIdIntroduction($route_id)
	{
		$data = Route::model()->findByPk($route_id);
		if ($data->route_name == "Introductie")
		{
			return true;
		}	
		return false;
	}	

	public function getNewOrderForIntroductieRoute($event_id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND route_name =:route_name';
		$criteria->params=array(':event_id' => $event_id, ':route_name' =>'introductie');
		$criteria->order = "route_volgorde DESC";
		$criteria->limit = 1;
		
		if (Route::model()->exists($criteria))
		{	$data = Route::model()->findAll($criteria);
			$newOrder = $data[0]->route_volgorde+1;
		}
		else
		{
				$newOrder = 1;
		}
		return $newOrder;
	}

	public function getNewOrderForDateRoute($event_id, $date)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND day_date =:date AND route_name !=:route_name';
		$criteria->params=array(':event_id' => $event_id, ':date' => $date, ':route_name' =>'introductie');
		$criteria->order = "route_volgorde DESC";
		$criteria->limit = 1;
		
		if (Route::model()->exists($criteria))
		{	$data = Route::model()->findAll($criteria);
			$newOrder = $data[0]->route_volgorde+1;
		}
		else
		{
				$newOrder = 1;
		}
		return $newOrder;
	}

	public function lowererOrderNumberExists($event_id,
                                        $date,
                                        $route_order)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND day_date =:date AND route_volgorde >:order';
		$criteria->params=array(':event_id' => $event_id, ':date' => $date, ':order' => $route_order);
		
		if (Route::model()->exists($criteria))
			return true;
		else
			return false;
	}

	public function higherOrderNumberExists($event_id,
                                        $date,
                                        $route_order)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND day_date =:date AND route_volgorde <:order';
		$criteria->params=array(':event_id' => $event_id, ':date' => $date, ':order' => $route_order);
		
		if (Route::model()->exists($criteria))
			return true;
		else
			return false;
	}

	public function setActiveTab($date)
	{
		$this->_activeTab = $date;
	}
	
	public function getActiveTab()
	{
		return $this->_activeTab;
	}

	public function getDefaultActiveTab($date)
	{
		if (isset($this->_activeTab))
			return $this->_activeTab;
		else
			return $date;
	}
}