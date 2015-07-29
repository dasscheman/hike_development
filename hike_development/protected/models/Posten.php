<?php
// Created: 2014
// Modified: 23 feb 2015

/**
 * This is the model class for table "tbl_posten".
 *
 * The followings are the available columns in table 'tbl_posten':
 * @property integer $post_ID
 * @property string $post_name
 * @property integer $event_ID
 * @property string $date
 * @property integer $post_volgorde
 * @property integer $score
 * @property string $create_time
 * @property integer $create_user_ID
 * @property string $update_time
 * @property integer $update_user_ID
 *
 * The followings are the available model relations:
 * @property Bonuspunten[] $bonuspuntens
 * @property PostPassage[] $postPassages
 * @property Users $updateUser
 * @property Users $createUser
 * @property EventNames $event
 */
class Posten extends HikeActiveRecord
{
	private $_activeTab;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Posten the static model class
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
		return 'tbl_posten';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_name, event_ID, date', 'required'),
			//array('event_ID, day_ID, post_volgorde, score, create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('event_ID, post_volgorde, score', 'numerical', 'integerOnly'=>true),
			array('post_name', 'length', 'max'=>255),
			array('post_name', 'ext.UniqueAttributesValidator', 'with'=>'event_ID,date'),
			//array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('post_ID, post_name, event_ID, date,
			      post_volgorde, score, create_time, create_user_ID,
			      update_time, update_user_ID', 'safe', 'on'=>'search'),
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
			'bonuspuntens' => array(self::HAS_MANY, 'Bonuspunten', 'post_ID'),
			'postPassages' => array(self::HAS_MANY, 'PostPassage', 'post_ID'),
			'createUser' => array(self::BELONGS_TO, 'Users', 'create_user_ID'),
			'event' => array(self::BELONGS_TO, 'EventNames', 'event_ID'),
			'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'post_ID' => 'Post',
			'post_name' => 'Post Name',
			'event_ID' => 'Event',
			'date' => 'Date',
			'post_volgorde' => 'Post Volgorde',
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

		$criteria->compare('post_ID',$this->post_ID);
		$criteria->compare('post_name',$this->post_name,true);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('post_volgorde',$this->post_volgorde);
		$criteria->compare('score',$this->score);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}   

	public function searchPosten($event_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('post_ID',$this->post_ID);
		$criteria->compare('post_name',$this->post_name,true);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->condition = 'event_ID=:event_id';
		$criteria->params=array(':event_id'=>$event_id);
		$criteria->order= 'date ASC, post_volgorde ASC';
		$criteria->compare('date',$this->date,true);
		$criteria->compare('post_volgorde',$this->post_volgorde);
		$criteria->compare('score',$this->score);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		
    public function searchPostDate($event_id, $startDate)
    {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
	
		$criteria=new CDbCriteria;
	
		$criteria->compare('post_ID',$this->post_ID);
		$criteria->compare('post_name',$this->post_name,true);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->condition = 'event_ID=:event_id AND date=:date';
		$criteria->params=array(':event_id'=>$event_id,
							    ':date'=>$startDate);
		$criteria->order= 'date ASC, post_volgorde ASC';
		$criteria->compare('date',$this->date,true);
		$criteria->compare('post_volgorde',$this->post_volgorde);
		$criteria->compare('score',$this->score);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array('pageSize'=>50)
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
							 $date = null, 
							 $order = null,
							 $move = null)
    {
		$actionAllowed = parent::isActionAllowed($controller_id, $action_id, $event_id, $model_id);
  
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = DeelnemersEvent::model()->getRolOfPlayer($event_id, Yii::app()->user->id);  

		if ($action_id == 'moveUpDown'){
			if (!isset($date)){
				return $actionAllowed;
			}		
			if ($hikeStatus != EventNames::STATUS_opstart or
				$rolPlayer != DeelnemersEvent::ROL_organisatie) {
					return $actionAllowed;
			}	
			if ($move == 'up'){
				$nextOrderExist = Posten::model()->higherOrderNumberExists($event_id,
																		   $date,
																		   $order);
			}
			if ($move == 'down'){
				$nextOrderExist = Posten::model()->lowererOrderNumberExists($event_id,
																		   $date,
																		   $order);
			}
			if ($nextOrderExist) {
				$actionAllowed = true;
			}
		}
		
		return $actionAllowed;
	}

    /**
    * Retrieves a list of post namen
    * @return array an array of all available posten'.
    */
    public function getPostNameOptions($event_Id)
    {
    	$data = Posten::model()->findAll('event_ID =:event_Id', array(':event_Id' => $event_Id)); 
        $list = CHtml::listData($data, 'post_ID', 'post_name');
        return $list;        
    }
	
    public function getPostNameOptionsToday($event_id)
    {	
		$active_day = EventNames::model()->getActiveDayOfHike($event_id);
			
    	$data = Posten::model()->findAll('event_ID =:event_id AND
										  date =:active_day', array(':event_id' => $event_id, 
																    ':active_day' => $active_day)); 
        $list = CHtml::listData($data, 'post_ID', 'post_name');
        return $list;        
    }
   	
    /**
    * Retrieves the score of an post.
    */
    public function getPostScore($post_Id)
    {
    	$data = Posten::model()->find('post_ID =:post_Id', array(':post_Id' => $post_Id));   
        return isset($data->score) ?
            $data->score : 0;
    }
   	
    /**
    * Haald de post naam op aan de hand van een post ID.
    */
    public function getPostName($post_Id)
    {
    	$data = Posten::model()->find('post_ID =:post_Id', array(':post_Id' => $post_Id));   
        return isset($data->post_name) ?
            $data->post_name : "nvt";
    }

    public function getDatePost($post_Id)
    {
    	$data = Posten::model()->find('post_ID =:post_Id', array(':post_Id' => $post_Id));   
        return isset($data->date) ?
            $data->post_name : "nvt";
    }


	public function getNewOrderForPosten($event_id, $date)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND date =:date';
		$criteria->params=array(':event_id' => $event_id, ':date' =>$date);
		$criteria->order = "post_volgorde DESC";
		$criteria->limit = 1;
		
		if (Posten::model()->exists($criteria))
		{	$data = Posten::model()->findAll($criteria);
			$newOrder = $data[0]->post_volgorde+1;
		} else {
			$newOrder = 1;}
		
		return $newOrder;
	}

	public function lowererOrderNumberExists(   $event_id,
                                                $date,
                                                $post_order)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND date =:date AND post_volgorde >:order';
		$criteria->params=array(':event_id' => $event_id, ':date' => $date, ':order' => $post_order);
		
		if (Posten::model()->exists($criteria)){
			return true;
		} else {
			return false;
		}
	}
 
	public function higherOrderNumberExists($event_id,
											$date,
											$post_order)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND date =:date AND post_volgorde <:order';
		$criteria->params=array(':event_id' => $event_id, ':date' => $date, ':order' => $post_order);
		
		if (Posten::model()->exists($criteria)){
			return true;
		} else {
			return false;
		}
	}
	
	public function startPostExist($event_id, $date)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'event_ID =:event_id AND date =:date';
		$criteria->params=array(':event_id' => $event_id, ':date' => $date);
		
		if (Posten::model()->exists($criteria))
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