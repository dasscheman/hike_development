<?php
// Created: 2014
// Modified: 19 jan 2015

/**
 * This is the model class for table "tbl_open_vragen_antwoorden".
 *
 * The followings are the available columns in table 'tbl_open_vragen_antwoorden':
 * @property integer $open_vragen_antwoorden_ID
 * @property integer $event_ID
 * @property integer $open_vragen_ID
 * @property integer $group_ID
 * @property string $antwoord_spelers
 * @property integer $checked
 * @property integer $correct
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
 * @property OpenVragen $openVragen
 */
class OpenVragenAntwoorden extends HikeActiveRecord
{
	public $open_vragen_name;
	public $open_vraag;
	public $group_name;
	public $goede_antwoord;
	public $username;
	public $score;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return OpenVragenAntwoorden the static model class
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
	    return 'tbl_open_vragen_antwoorden';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
	    // NOTE: you should only define rules for those attributes that
	    // will receive user inputs.
	    return array(
		    array('open_vragen_ID, group_ID, event_ID, antwoord_spelers', 'required'),
		    //array('open_vragen_ID, group_ID, checked, correct, score, create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
		    array('open_vragen_ID, group_ID, event_ID, checked, correct', 'numerical',
			  'integerOnly'=>true),
		    array('antwoord_spelers', 'length', 'max'=>255),
		    array('create_time, update_time', 'safe'),
		    // The following rule is used by search().
		    // Please remove those attributes that should not be searched.
		    array('open_vragen_antwoorden_ID, event_ID, open_vragen_ID,
			  group_ID, antwoord_spelers, checked, correct,
			  create_time, create_user_ID, update_time,
			  update_user_ID, group_name', 'safe', 'on'=>'search'),
			array('event_ID, antwoord_spelers, checked, correct,
				create_time, create_user_ID, update_time, update_user_ID,
				group_name, open_vraag, open_vragen_name,
				goede_antwoord, username, score', 'safe', 'on'=>'searchAnswered'),
		    array('open_vragen_ID',
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
		    'event' => array(self::BELONGS_TO,'EventNames', 'event_ID'),
		    'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user_ID'),
		    'createUser' => array(self::BELONGS_TO, 'Users', 'create_user_ID'),
		    'group' => array(self::BELONGS_TO, 'Groups', 'group_ID'),
		    'openVragen' => array(self::BELONGS_TO, 'OpenVragen', 'open_vragen_ID'),
	    );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
	    return array(
		    'open_vragen_antwoorden_ID' => 'Open Vragen Antwoorden',
		    'event_ID' => 'Event',
		    'open_vragen_ID' => 'Open Vragen',
		    'group_ID' => 'Group',
		    'antwoord_spelers' => 'Antwoord Spelers',
		    'checked' => 'Checked',
		    'correct' => 'Correct',
		    'create_time' => 'Create Time',
		    'create_user_ID' => 'Beantwoord door',
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

	    $criteria->compare('open_vragen_antwoorden_ID',$this->open_vragen_antwoorden_ID);
	    $criteria->compare('event_ID',$this->event_ID);
	    $criteria->compare('open_vragen_ID',$this->open_vragen_ID, true );
	    $criteria->compare('group_ID',$this->group_ID, true );
	    $criteria->compare('antwoord_spelers',$this->antwoord_spelers,true);
	    $criteria->compare('checked',$this->checked);
	    $criteria->compare('correct',$this->correct);
	    $criteria->compare('create_time',$this->create_time,true);
	    $criteria->compare('create_user_ID',$this->create_user_ID);
	    $criteria->compare('update_time',$this->update_time,true);
	    $criteria->compare('update_user_ID',$this->update_user_ID);

	    return new CActiveDataProvider($this, array(
		    'criteria'=>$criteria,
	    ));
    }


    public function searchAnswered($event_id)
    {
	    // Warning: Please modify the following code to remove attributes that
	    // should not be searched.

	    $criteria=new CDbCriteria;

		$criteria->with=array('openVragen', 'group', 'createUser');
	    $criteria->compare('t.event_ID', $event_id);
	    $criteria->compare('antwoord_spelers',$this->antwoord_spelers);
	    $criteria->compare('checked',$this->checked);
	    $criteria->compare('correct',$this->correct);
	    $criteria->compare('t.create_time',$this->create_time,true);
	    $criteria->compare('create_user_ID',$this->create_user_ID);
	    $criteria->compare('update_time',$this->update_time,true);
	    $criteria->compare('update_user_ID',$this->update_user_ID);
		$criteria->compare('group.group_name', $this->group_name,true);

		$criteria->compare('openVragen.open_vragen_name', $this->open_vragen_name,true);
		$criteria->compare('openVragen.vraag', $this->open_vraag,true);
		$criteria->compare('openVragen.goede_antwoord', $this->goede_antwoord,true);
		$criteria->compare('openVragen.score', $this->score,true);
		$criteria->compare('createUser.username', $this->username,true);

		$sort = new CSort();
		$sort->attributes = array(
			//'defaultOrder'=>'t.create_time ASC',
			'create_time'=>array(
				'asc'=>'t.create_time',
				'desc'=>'t.create_time asc',
			),
			'group_name'=>array(
				'asc'=>'group.group_name',
				'desc'=>'group.group_name desc',
			),
			'open_vragen_name'=>array(
				'asc'=>'openVragen.open_vragen_name',
				'desc'=>'openVragen.open_vragen_name desc',
			),
			'open_vraag'=>array(
				'asc'=>'openVragen.vraag',
				'desc'=>'openVragen.vraag desc',
			),


			'antwoord_spelers'=>array(
				'asc'=>'t.antwoord_spelers',
				'desc'=>'t.antwoord_spelers desc',
			),
			'goede_antwoord'=>array(
				'asc'=>'openVragen.goede_antwoord',
				'desc'=>'openVragen.goede_antwoord desc',
			),
			'username'=>array(
				'asc'=>'createUser.username',
				'desc'=>'createUser.username desc',
			),
			'score'=>array(
				'asc'=>'openVragen.score',
				'desc'=>'openVragen.score desc',
			),
		);

	    return new CActiveDataProvider($this, array(
		    'criteria'=>$criteria,
			'sort'=>$sort
	    ));
    }

    /**
     * Check if actions are allowed. These checks are not only use in the controllers,
     * but also for the visability of the menu items.
     */
    function isActionAllowed($controller_id = null, $action_id = null, $event_id = null, $model_id = null, $group_id = null)
    {
		$actionAllowed = parent::isActionAllowed($controller_id, $action_id, $event_id, $model_id, $group_id);
	
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = DeelnemersEvent::model()->getRolOfPlayer($event_id, Yii::app()->user->id);

		switch ($action_id) {
			case 'antwoordGoedOfFout':
				if (($hikeStatus == EventNames::STATUS_introductie OR
						$hikeStatus == EventNames::STATUS_gestart) AND
						$rolPlayer == DeelnemersEvent::ROL_organisatie AND
				!OpenVragenAntwoorden::model()->isAntwoordGecontroleerd($event_id, $model_id)) {
				$actionAllowed = true;
					}
			break;
			case 'viewControle':
					if (($hikeStatus == EventNames::STATUS_introductie OR
						$hikeStatus == EventNames::STATUS_gestart) AND
						$rolPlayer == DeelnemersEvent::ROL_organisatie) {
				$actionAllowed = true;
					}
			break;
			case 'updateOrganisatie':
					if (($hikeStatus == EventNames::STATUS_introductie OR
						$hikeStatus == EventNames::STATUS_gestart) AND
						$rolPlayer == DeelnemersEvent::ROL_organisatie) {
				$actionAllowed = true;
					}
			break;
		}
		return $actionAllowed;
    }

    /**
     * Als een nieuwe record aangemaakt wordt dan moeten deze waarden gezet worden.
     * Ook bedenken wat er met het score veld moet gebeuren... Als deze toch gezet wordt moet
     * de score anders opgehaald worden.
     */
    protected function beforeSave()
    {
	    if(!parent::beforeSave())
	    {
		    return false;
	    }

	    if($this->isNewRecord)
	    {
		    $this->correct = 0;
		    $this->checked = 0;
	    }
	    return true;

    }

    /**
     * Score ophalen voor een group.
     */
    public function getOpenVragenScore($event_id, $group_id)
    {
	    $criteria = new CDbCriteria;
	    $criteria->condition= "group_ID = $group_id AND
								event_ID = $event_id AND
								checked  = 1 AND
								correct  = 1";
	    $data = OpenVragenAntwoorden::model()->findAll($criteria);
		$score = 0;
		foreach($data as $obj)
		{
			$score = $score + OpenVragen::model()->getOpenVraagScore($obj->open_vragen_ID);
		}
		return $score;
    }

    /**
     * Check of een bepaalde vraag is beantwoord door een group, Retruns true of false
     */
    public function isQuestionUsed($vragen_id)
    {
	    $criteria = new CDbCriteria;
	    $criteria->condition="open_vragen_ID = $vragen_id";
	    $data = OpenVragenAntwoorden::model()->find($criteria);
	    if(isset($data->antwoord_spelers))
		    {return true;}
	    else
		    {return(false);}
    }

    /**
     * Check of een bepaalde vraag is beantwoord door een gegeven group, Retruns JA of NEE
     */
    public function isVraagBeantwoord($event_id,
				      $group_id,
				      $vragen_id)
    {
	    $criteria = new CDbCriteria;
	    $criteria->condition="event_ID = $event_id AND
				  group_ID = $group_id AND
				  open_vragen_ID = $vragen_id";
	    $data = OpenVragenAntwoorden::model()->find($criteria);
	    if(isset($data->antwoord_spelers))
		    {return('Ja');}
	    else
		    {return('Nee');}
    }

    /**
     * Check of een bepaalde vraag is gecontroleerd, Retruns JA of NEE
     * Als JA dan moet het niet meer mogelijk zijn om die vraag te
     * beantwoorden door een groep.
     */
    public function isVraagGecontroleerd($event_id,
									     $group_id,
									     $vragen_id)
    {
		$criteria = new CDbCriteria;
	    $criteria->condition="event_ID = $event_id AND
				  group_ID = $group_id AND
				  open_vragen_ID = $vragen_id";
	    $data = OpenVragenAntwoorden::model()->find($criteria);

	    if(isset($data->checked) AND $data->checked == 1)
		    {return('Ja');}
	    else
		    {return('Nee');}
    }

    public function isAntwoordGecontroleerd($event_id, $id)
    {
	    $criteria = new CDbCriteria;
	    $criteria->condition="event_ID = $event_id AND
				  open_vragen_antwoorden_ID = $id";
	    $data = OpenVragenAntwoorden::model()->findAll($criteria);
	    if(isset($data->checked) AND $data->checked == 1)
		    return true;
	    else
		    return false;
    }

    /**
     * Check of een bepaald antwoord goed is. Retruns JA of NEE
     */
    public function isVraagGoed($event_id,
				$group_id,
				$vragen_id)
    {
	    $criteria = new CDbCriteria;
	    $criteria->condition="event_ID = $event_id AND
				  group_ID = $group_id AND
				  open_vragen_ID = $vragen_id";
	    $data = OpenVragenAntwoorden::model()->find($criteria);
	    if(isset($data->correct) AND $data->correct == 1)
		    {return('Ja');}
	    else
		    {return('Nee');}
    }
}
