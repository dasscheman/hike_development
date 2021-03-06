<?php
// Created: 2014
// Modified: 3 jan 2015

/**
 * This is the model class for table "tbl_bonuspunten".
 *
 * The followings are the available columns in table 'tbl_bonuspunten':
 * @property integer $bouspunten_ID
 * @property integer $event_ID
 * @property string $date
 * @property integer $post_ID
 * @property integer $group_ID
 * @property string $omschrijving
 * @property integer $score
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
class Bonuspunten extends HikeActiveRecord
{   
	public $group_name;
	public $post_name;
	public $route_name;
	public $username;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bonuspunten the static model class
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
		return 'tbl_bonuspunten';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_ID, group_ID, omschrijving', 'required'),
			//array('event_ID, day_ID, post_ID, group_ID, score, create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('event_ID, post_ID, group_ID, score', 'numerical',
			      'integerOnly'=>true),
			array('omschrijving', 'length', 'max'=>255),
			//array('create_time, update_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bouspunten_ID, event_ID, date, post_ID, group_ID,
				omschrijving, score, create_time, create_user_ID,
				update_time, update_user_ID, username,
				group_name, post_name, route_name;', 'safe', 'on'=>'search'),
		    array('omschrijving',
			      'ext.UniqueAttributesValidator',
			      'with'=>'group_ID,event_ID,date,post_ID'),
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
			'bouspunten_ID' => 'Bouspunten',
			'event_ID' => 'Event',
			'date' => 'Date',
			'post_ID' => 'Post',
			'group_ID' => 'Group',
			'omschrijving' => 'Omschrijving',
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
	public function search($event_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->with=array('post', 'group', 'createUser');
		$criteria->select = array(
			't.event_ID',
			'group_ID',
			'date',
			'omschrijving',
			'score',
			'create_time',
			'post.post_name AS post_name');
		$criteria->compare('bouspunten_ID',$this->bouspunten_ID);
		$criteria->compare('t.event_ID',$event_id);
		$criteria->compare('t.date',$this->date);
		$criteria->compare('post.post_name',$this->post_name);
		$criteria->compare('group_ID',$this->group_ID);
		$criteria->compare('omschrijving',$this->omschrijving,true);
		$criteria->compare('t.score',$this->score);
		$criteria->compare('t.create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		$criteria->compare('group.group_name', $this->group_name,true);
		$criteria->compare('post.post_name', $this->post_name,true);
		$criteria->compare('createUser.username', $this->username,true);
		
		$sort = new CSort();
		$sort->attributes = array(
			//'defaultOrder'=>'t.create_time ASC',
			'group_name'=>array(
				'asc'=>'group.group_name',
				'desc'=>'group.group_name desc',
			),
			'date'=>array(
				'asc'=>'t.date',
				'desc'=>'t.date desc',
			),
			'post_name'=>array(
				'asc'=>'post_name',
				'desc'=>'post_name desc',
			),
			'omschrijving'=>array(
				'asc'=>'omschrijving',
				'desc'=>'omschrijving desc',
			),
			'score'=>array(
				'asc'=>'t.score',
				'desc'=>'t.score desc',
			),
			'username'=>array(
				'asc'=>'createUser.username',
				'desc'=>'createUser.username desc',
			),
			'create_time'=>array(
				'asc'=>'t.create_time',
				'desc'=>'t.create_time asc',
			),
		);

	    return new CActiveDataProvider($this, array(
		    'criteria'=>$criteria,
			'sort'=>$sort
	    ));
	}

	/**
	 * Returns de totale score die een groep heeft gehaald met bnuspunten. 
	 */	
	public function getBonuspuntenScore($event_id, $group_id)
	{
		$criteria = new CDbCriteria;
		$criteria->select='SUM(score) as score';
		$criteria->condition="event_ID = $event_id AND
				      group_ID = $group_id";
		$data = Bonuspunten::model()->find($criteria);
	    if(isset($data->score))
			{return (int) $data->score;}
		else
			{return 0;}	
	}
}