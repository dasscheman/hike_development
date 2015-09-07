<?php
// Created: 2014
// Modified: 19 jan 2015

/**
 * This is the model class for table "tbl_post_passage".
 *
 * The followings are the available columns in table 'tbl_post_passage':
 * @property integer $posten_passage_ID
 * @property integer $post_ID
 * @property integer $event_ID
 * @property integer $group_ID
 * @property integer $gepasseerd
 * @property string $binnenkomst
 * @property string $vertrek
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
 * @property Posten $post
 */
class PostPassage extends HikeActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PostPassage the static model class
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
		return 'tbl_post_passage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('post_ID, event_ID, group_ID', 'required'),
			//array('post_ID, event_ID, day_ID, group_ID, gepasseerd, score, create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('post_ID, event_ID, group_ID, gepasseerd',
			      'numerical', 'integerOnly'=>true),
			//array('binnenkomst, vertrek, create_time, update_time', 'safe'),
			array('binnenkomst, vertrek', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('posten_passage_ID, post_ID, event_ID, group_ID,
			      gepasseerd, binnenkomst, vertrek, create_time,
			      create_user_ID, update_time, update_user_ID', 'safe',
			      'on'=>'search'),
		        array('post_ID',
			      'ext.UniqueAttributesValidator',
			      'with'=>'group_ID'),
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
			'post' => array(self::BELONGS_TO, 'Posten', 'post_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'posten_passage_ID' => 'Posten Passage',
			'post_ID' => 'Postnaam',
			'event_ID' => 'Event',
			'group_ID' => 'Group',
			'gepasseerd' => 'Gepasseerd',
			'binnenkomst' => 'Binnenkomst',
			'vertrek' => 'Vertrek',
			'create_time' => 'Create Time',
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

		$criteria->compare('posten_passage_ID',$this->posten_passage_ID);
		$criteria->compare('post_ID',$this->post_ID);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('group_ID',$this->group_ID);
		$criteria->compare('gepasseerd',$this->gepasseerd);
		$criteria->compare('binnenkomst',$this->binnenkomst,true);
		$criteria->compare('vertrek',$this->vertrek,true);
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

		if ($action_id == 'updateVertrek' and
			$hikeStatus == EventNames::STATUS_gestart and
			$rolPlayer == DeelnemersEvent::ROL_organisatie) {
				$actionAllowed = true;
		}

		return $actionAllowed;
	}

	/**
	 * De velden score en gepasseerd worden gezet als er een nieuwe record aangemaakt wordt.
	 */
	protected function beforeSave()
    {
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->gepasseerd = 1;
			}
			return true;
		}
		else
			return false;
    }
	
	public function postPassageGroupDataProvider($event_id, $group_id)
	{
	    $where = "event_ID = $event_id AND group_ID = $group_id";
    
	    $dataProvider=new CActiveDataProvider('PostPassage',
		array(
		    'criteria'=>array(
			'condition'=>$where,
			'order'=>'post_ID DESC',
			),
		    'pagination'=>array(
			'pageSize'=>5,
		    ),
	    ));
	    return $dataProvider;
      
	}
      
	public function postPassageAllDataProvider($event_id)
	{
	    $where = "event_ID = $event_id";
    
	    $dataProvider=new CActiveDataProvider('PostPassage',
		array(
		    'criteria'=>array(
			'condition'=>$where,
			'order'=>'binnenkomst DESC',
			),
		    'pagination'=>array(
			'pageSize'=>5,
		    ),
	    ));
	    return $dataProvider;
      
	}
	
	/**
	 * Returns de tijd van de laatste post passage van een groep
	 * Als groep geen enkele post is gepasserd return = nvt
	 */
	public function getLaatstePostPassageTijd($event_id, $group_id)
	{
		if(!isset($group_id))
		{
			return('Geen groepsgegevens');
		};
		
		$criteria=new CDbCriteria;
		$criteria->select = 'binnenkomst';  
		$criteria->condition = 'event_ID=:event_id AND group_ID=:group_id';
		$criteria->order =  'binnenkomst DESC';
		$criteria->params=array(':event_id'=>$event_id, 
					':group_id' => $group_id);
		$data=PostPassage::model()->find($criteria); 
	
		if(isset($data->binnenkomst))
			{ return($data->binnenkomst);}
		else
			{ return('nvt');}
	}
	
	/**
	 * Returns de post naam van de laatste post passage van een groep
	 * Als groep geen enkele post is gepasserd return = nvt
	 */
	public function getLaatstePostPassageNaam($event_id, $group_id)
	{
		if(!isset($group_id))
		{
			return('Geen groepsgegevens');
		};
		
		$criteria=new CDbCriteria;
		$criteria->select = 'post_ID';  
		$criteria->condition = 'event_ID=:event_id AND group_ID=:group_id';
		$criteria->order =  'binnenkomst DESC';
		$criteria->params=array(':event_id'=>$event_id,
					':group_id' => $group_id);
		$data=PostPassage::model()->find($criteria); 
	
		if(isset($data->post_ID))
			{ return($data->post_ID);}
		else
			{ return('nvt');}
	}
	
	/**
	 * Returns de score voor het passeren van de posten voor een groep
	 */
	public function getPostScore($event_id, $group_id)
	{
		$criteria = new CDbCriteria;
		$criteria->condition="event_ID = $event_id AND
				      group_ID = $group_id AND
				      gepasseerd = 1";
		$data = PostPassage::model()->findAll($criteria);

        $score = 0;
    	foreach($data as $obj)
        {
            $score = $score + Posten::model()->getPostScore($obj->post_ID);
        }
        return $score;
	}
	
	public function isTimeLeftToday($event_id, $group_id)
	{
		if (is_string(PostPassage::model()->timeLeftToday($event_id, $group_id)))
			return true;

		if (PostPassage::model()->timeLeftToday($event_id, $group_id) > 0)
			return true;

		return false;
	}


	public function timeLeftToday($event_id, $group_id)
	{
		$criteriaEvent = new CDbCriteria;
		$criteriaEvent->condition = 'event_ID = :event_id';
		$criteriaEvent->params = array(':event_id'=>$event_id);
		$dataEvent = EventNames::model()->find($criteriaEvent);
	
		$criteriaPostenPassages = new CDbCriteria;
		$criteriaPostenPassages->with = array('post');

		$criteriaPostenPassages->condition = 'group_ID =:group_id AND
											  post.event_ID =:event_id AND
											  post.date =:active_date';
		$criteriaPostenPassages->order = 'binnenkomst ASC';
		$criteriaPostenPassages->params = array(':group_id'=>$group_id,
												':event_id'=>$event_id,
												':active_date'=>$dataEvent->active_day);
		$dataPostPassages = PostPassage::model()->findAll($criteriaPostenPassages);	
		$aantalPosten = PostPassage::model()->count($criteriaPostenPassages);	

		$totalTime = 0;
		$timeLastStint = 0;
		$timeLeftLastPost = 0;
		$atPost = false;
		$count = 1;
		if ($aantalPosten == 0){
			return 'nog niet gestart';
		}

		foreach($dataPostPassages as $obj)
		{
			if ($aantalPosten == 1 && (strtotime($obj->vertrek))) {
				// Als $aantalPosten 1 is dan is het de start post en moeten 
				// we alleen naar de vertrektijd gebruiken.
				// De deelnemers zijn niet op een post, dus ze zijn nog aan het lopen.
				// Daarom moet de huidige tijd min de laatste vertrektijd van elkaar 
				// afgetrokken worden en opgeteld worden bij totaltime.
				$timeLastStint = strtotime(date('Y-m-d H:i:s')) - strtotime($obj->vertrek);		
				$totalTime = $totalTime + $timeLastStint;
			}
			
			if ($count > 1) {
				$to_time = strtotime($obj->binnenkomst);
				$from_time = strtotime($timeLeftLastPost);
				$timeLastStint = $to_time-$from_time;
				$totalTime = $totalTime + $timeLastStint;

				if ($count == $aantalPosten && (strtotime($obj->vertrek))) {

					// Hier wordt de laatste post gecontroleerd.
					// De deelnemers zijn niet op een post, dus ze zijn nog aan het lopen.
					// Daarom moet de huidige tijd min de laatste vertrektijd van elkaar 
					// afgetrokken worden en opgeteld worden bij totaltime.
					$timeLastStint = strtotime(date('Y-m-d H:i:s')) - strtotime($obj->vertrek);		
					$totalTime = $totalTime + $timeLastStint;
				}
			}

			$timeLeftLastPost = $obj->vertrek;
			$count++;
        }
		return round((strtotime("1970-01-01 $dataEvent->max_time UTC") - $totalTime) / 60, 0);
	}
}