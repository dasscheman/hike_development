<?php
// Created: 2014
// Modified: 3 jan 2015

/**
 * This is the model class for table "tbl_groups".
 *
 * The followings are the available columns in table 'tbl_groups':
 * @property integer $group_ID
 * @property integer $event_ID
 * @property string $group_name
 * @property string $create_time
 * @property integer $create_user_ID
 * @property string $update_time
 * @property integer $update_user_ID
 *
 * The followings are the available model relations:
 * @property Bonuspunten[] $bonuspuntens
 * @property DeelnemersEvent[] $deelnemersEvents
 * @property EventNames $event
 * @property Users $updateUser
 * @property Users $createUser
 * @property OpenNoodEnvelop[] $openNoodEnvelops
 * @property OpenVragenAntwoorden[] $openVragenAntwoordens
 * @property PostPassage[] $postPassages
 * @property QrCheck[] $qrChecks
 */
class Groups extends HikeActiveRecord
{
	public $group_members;
	public $bonus_score;
	public $post_score;
	public $qr_score;
	public $vragen_score;
	public $hint_score;
	public $totaal_score;
	public $rank;
	public $time_walking;
	public $time_left;
	public $last_post;
	public $last_post_time;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Groups the static model class
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
		return 'tbl_groups';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_ID, group_name', 'required'),
			//array('create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('group_name', 'length', 'max'=>255),
			//array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('group_ID, event_ID, group_name, create_time, create_user_ID,
			      update_time, update_user_ID', 'safe', 'on'=>'search'),
			array('group_ID, event_ID, group_name, create_time, create_user_ID,
			    update_time, update_user_ID, group_members,
				bonus_score, post_score, qr_score, vragen_score, hint_score,
				totaal_score, rank', 'safe', 'on'=>'searchScore'),
			array('group_ID, event_ID, group_name, create_time, create_user_ID,
			    update_time, update_user_ID, group_members,
				bonus_score, post_score, qr_score, vragen_score, hint_score,
				totaal_score, rank', 'safe', 'on'=>'searchPost'),
		    array('group_name',
			      'ext.UniqueAttributesValidator',
			      'with'=>'event_ID'),
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
			'bonuspuntens' => array(self::HAS_MANY, 'Bonuspunten', 'group_ID'),
			'deelnemersEvents' => array(self::HAS_MANY, 'DeelnemersEvent', 'group_ID'),
			'createUser' => array(self::BELONGS_TO, 'Users', 'create_user_ID'),
			'event' => array(self::BELONGS_TO, 'EventNames', 'event_ID'),
			'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user_ID'),
			'openNoodEnvelops' => array(self::HAS_MANY, 'OpenNoodEnvelop', 'group_ID'),
			'openVragenAntwoordens' => array(self::HAS_MANY, 'OpenVragenAntwoorden', 'group_ID'),
			'postPassages' => array(self::HAS_MANY, 'PostPassage', 'group_ID'),
			'qrChecks' => array(self::HAS_MANY, 'QrCheck', 'group_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'group_ID' => 'Group',
			'event_ID' => 'Event',
			'group_name' => 'Groep',
			'create_time' => 'Create Time',
			'create_user_ID' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_ID' => 'Groep',
			'group_members' => 'Leden',
			'bonus_score' => 'Bonus',
			'post_score' => 'Post',
			'qr_score' => 'S. Post',
			'vragen_score' => 'Vraag',
			'hint_score' => 'Hint',
			'totaal_score' => 'Totaal',
			'rank' => 'Plaats',
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

		$criteria->compare('group_ID',$this->group_ID);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function searchScore($event_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
			
		$criteria->with=array(
			'deelnemersEvents'=>array('together'=>true, 'joinType'=>'LEFT JOIN'), 
			'deelnemersEvents.user'=>array('select'=>'username', 'together'=>false, 'joinType'=>'LEFT JOIN'), 
		);

		$criteria->join =
			'LEFT JOIN tbl_hint_score ON tbl_hint_score.group_ID = t.group_ID
			LEFT JOIN tbl_qr_score ON tbl_qr_score.group_ID = t.group_ID
			LEFT JOIN tbl_posten_score ON tbl_posten_score.group_ID = t.group_ID
			LEFT JOIN tbl_vragen_score ON tbl_vragen_score.group_ID = t.group_ID
			LEFT JOIN tbl_bonus_score ON tbl_bonus_score.group_ID = t.group_ID
			LEFT JOIN tbl_totaal_score ON tbl_totaal_score.group_ID = t.group_ID';

		$criteria->select = array(
			'event_ID',
			'group_ID',
			'group_concat(DISTINCT user.username SEPARATOR " ") AS group_members',
			'tbl_bonus_score.bonus_score AS bonus_score',
			'tbl_hint_score.hint_score AS hint_score',
			'tbl_vragen_score.vragen_score AS vragen_score',
			'tbl_posten_score.post_score AS post_score',
			'tbl_qr_score.qr_score AS qr_score',
			'tbl_totaal_score.totaal_score AS totaal_score',
			'group_name');

		$criteria->group = 't.group_ID';
		$criteria->compare('t.event_ID',$event_id);
		$criteria->compare('group_name',$this->group_name, true);
		$criteria->compare('user.username',$this->group_members, true);
		$criteria->compare('bonus_score',$this->bonus_score, true);
		$criteria->compare('posten_score',$this->post_score, true);
		$criteria->compare('qr_score',$this->qr_score, true);
		$criteria->compare('vragen_score',$this->vragen_score, true);
		$criteria->compare('hint_score',$this->hint_score, true);
		$criteria->compare('totaal_score',$this->totaal_score, true);
		//$criteria->compare('rank',$this->totaal_score,true);

		$sort = new CSort();
		$sort->attributes = array(
			'group_name'=>array(
				'asc'=>'group_name',
				'desc'=>'group_name desc',
			),
			'group_members'=>array(
				'asc'=>'group_members',
				'desc'=>'group_members desc',
			),
			'bonus_score'=>array(
				'asc'=>'bonus_score',
				'desc'=>'bonus_score desc',
			),
			'post_score'=>array(
				'asc'=>'post_score',
				'desc'=>'post_score desc',
			),
			'qr_score'=>array(
				'asc'=>'qr_score',
				'desc'=>'qr_score desc',
			),
			'vragen_score'=>array(
				'asc'=>'vragen_score',
				'desc'=>'vragen_score desc',
			),
			'hint_score'=>array(
				'asc'=>'hint_score',
				'desc'=>'hint_score desc',
			),
			'totaal_score'=>array(
				'asc'=>'totaal_score',
				'desc'=>'totaal_score desc',
			),
		);

		$sort->defaultOrder = array('totaal_score'=>true);
	    return new CActiveDataProvider($this, array(
		    'criteria'=>$criteria,
			'pagination'=>array(
				 'pageSize'=>10
				 ),
			'sort'=>$sort
	    ));
	}

	public function searchPost($event_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
			
		$criteria->with=array(
			'deelnemersEvents'=>array('together'=>true, 'joinType'=>'LEFT JOIN'), 
			'deelnemersEvents.user'=>array('select'=>'username', 'together'=>false, 'joinType'=>'LEFT JOIN'), 
			'postPassages'=>array('together'=>true, 'joinType'=>'LEFT JOIN'), 
			'postPassages.post'=>array('together'=>false, 'joinType'=>'LEFT JOIN'), 
		);

		$criteria->select = array(
			'group_name',
			'group_ID',
			'event_ID',
			'group_concat(DISTINCT user.username SEPARATOR " ") AS group_members',
			'postPassages.binnenkomst AS last_post_time',
			'post.post_name AS last_post');  
		//$criteria->condition = 't.event_ID=:event_id AND t.group_ID=:group_id';
		//$criteria->condition = 't.event_ID=:event_id';
		$criteria->order =  'postPassages.binnenkomst ASC';
	//	$criteria->params=array(':event_id'=>$event_id);
		$criteria->group = 't.group_ID	, postPassages.group_ID';
	
		$criteria->compare('group_ID',$this->group_ID);
		$criteria->compare('t.event_ID',$event_id);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('user.username',$this->group_members,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		$sort = new CSort();
		$sort->attributes = array(
			//'defaultOrder'=>'t.create_time ASC',
			'group_name'=>array(
				'asc'=>'group_name',
				'desc'=>'group_name desc',
			),
			'group_members'=>array(
				'asc'=>'group_members',
				'desc'=>'group_members',
			),
		);

	    return new CActiveDataProvider($this, array(
		    'criteria'=>$criteria,
			'pagination'=>array(
				 'pageSize'=>10
				 ),
			'sort'=>$sort
	    ));
	}

	/**
	 * Get al available group name options
	 */
	public function getGroupOptions()
	{
		$data = Groups::model()->findAll();
		$groupsArray = CHtml::listData($data, 'group_ID', 'group_name');
		return $groupsArray;
	}
	
	/**
	 * Get al available group name options for a particular event.
	 */
	public function getGroupOptionsForEvent($event_ID)
	{
		$data = Groups::model()->findAll('event_ID =:event_ID', array(':event_ID' => $event_ID));
		$groupsArray = CHtml::listData($data, 'group_ID', 'group_name');
		return $groupsArray;
	}
       
	/**
	* Get group name.
	*/
	public function getGroupName($group_Id)
	{
	    $data = Groups::model()->find('group_ID =:group_Id', array(':group_Id' => $group_Id));
	   
	    return isset($data->group_name) ?
		$data->group_name : "";        
	}

	/**
	 * Returns total score van een group.
	 * TODO: deze functie moet naar een generieke plek.
	 */
	public function getTotalScoreGroup(	$event_id,
										$group_id)
	{
		$post_score = PostPassage::model()->getPostScore($event_id, $group_id);
		$qr_score = QrCheck::model()->getQrScore($event_id, $group_id);
		$vragen_score = OpenVragenAntwoorden::model()->getOpenVragenScore($event_id, $group_id); 
		$bonus_score = Bonuspunten::model()->getBonuspuntenScore($event_id, $group_id);
		$OpenEnvelopStrafpunten = OpenNoodEnvelop::model()->getOpenEnvelopScore($event_id, $group_id);

		$total_score = 	$post_score + $qr_score + $vragen_score + $bonus_score - $OpenEnvelopStrafpunten;

		if(isset($total_score))	{
			return($total_score);
		} else {
			return(0);
		}	
	}
		
	public function getRankGroup($event_id,
								 $group_id)
	{
		$counter = 0;
		$temp_score = 0;
		
		$data = Groups::model()->findAll('event_ID =:event_ID',
										 array(':event_ID' => $event_id));
	
		foreach($data as $obj)
		{
			$groupsArray[$obj->group_ID] = Groups::model()->getTotalScoreGroup(
				$event_id,
				$obj->group_ID);
		}
		
		arsort($groupsArray);
		foreach($groupsArray as $key=>$key_value)
		{			
			if($key == $group_id)
			{
				if($temp_score == $key_value)
				{
					return($counter);
				}
				$temp_score = $key_value;
				$counter++;
				return($counter);
			}
			if($temp_score != $key_value)
			{
				$counter++;
			}
			$temp_score = $key_value;
		}
	}
}