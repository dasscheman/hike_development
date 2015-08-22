<?php
// Created: 2014
// Modified: 21 feb 2015

/**
 * This is the model class for table "tbl_deelnemers_event".
 *
 * The followings are the available columns in table 'tbl_deelnemers_event':
 * @property integer $deelnemers_ID
 * @property integer $event_ID
 * @property integer $user_ID
 * @property integer $rol
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
 * @property Users $user
 */
class DeelnemersEvent extends HikeActiveRecord
{
    const ROL_organisatie=1;
    const ROL_post=2;
    const ROL_deelnemer=3;
    const ROL_toeschouwer=4;

	public $actionAllowed;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeelnemersEvent the static model class
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
		return 'tbl_deelnemers_event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_ID, user_ID', 'required'),
			//array('event_ID, user_ID, rol, group_ID, create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('event_ID, user_ID, rol, group_ID', 'numerical', 'integerOnly'=>true),
			//array('create_time, update_time', 'safe'),
			array('event_ID', 'ext.UniqueAttributesValidator', 'with'=>'user_ID'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('deelnemers_ID, event_ID, user_ID, rol, group_ID,
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
			'updateUser' => array(self::BELONGS_TO, 'Users', 'update_user_ID'),
			'createUser' => array(self::BELONGS_TO, 'Users', 'create_user_ID'),
			'event' => array(self::BELONGS_TO, 'EventNames', 'event_ID'),
			'group' => array(self::BELONGS_TO, 'Groups', 'group_ID'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'deelnemers_ID' => 'Deelnemers',
			'event_ID' => 'Event',
			'user_ID' => 'User',
			'rol' => 'Rol',
			'group_ID' => 'Group',
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

		$criteria->compare('deelnemers_ID',$this->deelnemers_ID);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('user_ID',$this->user_ID);
		$criteria->compare('rol',$this->rol);
		$criteria->compare('group_ID',$this->group_ID);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function searchUserHike()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$criteria->condition = 't.user_ID = Yii::app()->user->id';
		$criteria->compare('deelnemers_ID',$this->deelnemers_ID);
		$criteria->compare('event_ID',$this->event_ID);
		$criteria->compare('user_ID',$this->user_ID);
		$criteria->compare('rol',$this->rol);
		$criteria->compare('group_ID',$this->group_ID);
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
    function isActionAllowed($controller_id = null, $action_id = null, $event_id = null, $model_id = null)
    {
		$actionAllowed = parent::isActionAllowed($controller_id, $action_id, $event_id, $model_id);
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = DeelnemersEvent::model()->getRolOfPlayer($event_id, Yii::app()->user->id);
		if ($rolPlayer == DeelnemersEvent::ROL_deelnemer) {
			$group_id = DeelnemersEvent::model()->getGroupOfPlayer($event_id, Yii::app()->user->id);
		}

		if (isset($rolPlayer) && $controller_id == 'game'){
            if ($rolPlayer <= DeelnemersEvent::ROL_deelnemer &&
				$action_id == 'gameOverview') {
					$actionAllowed = true;
			}
			if ($action_id == 'groupOverview') {
				if ($rolPlayer <= DeelnemersEvent::ROL_post) {
					$actionAllowed = true;
				}
				if ($rolPlayer == DeelnemersEvent::ROL_deelnemer &&
					$model_id == $group_id) {
					$actionAllowed = true;
				}
			}
		}
		//Startup overview is only allowed when player is organisation
        if (isset($rolPlayer) && $controller_id === 'startup' && $rolPlayer == DeelnemersEvent::ROL_organisatie) {
            if (in_array($action_id, array('startupOverview'))) {
					$actionAllowed = true;
			}
        }

		return $actionAllowed;
    }

	/**
	* Retrieves een lijst met mogelijke rollen die een deelnemer tijdens een hike kan hebben
	* @return array an array of available rollen.
	*/
	public function getRolOptions()
	{
		return array(
			self::ROL_organisatie=>'Organisatie',
			self::ROL_post=>'Post',
			self::ROL_deelnemer=>'Deelnemer',
			self::ROL_toeschouwer=>'Toeschouwer',
		    );
	}

	/**
	* @return string de rol text display
	*/
	public function getRolText($rol)
	{
		$rolOptions=$this->getRolOptions();
		return isset($rolOptions[$rol]) ?
		    $rolOptions[$rol] : "Onbekende rol";
	}

	/**
	 * @return de rol van een speler tijdens een bepaalde hike
	 */
	public function getRolOfPlayer($event_Id,
				       $user_Id)
	{
		$data = DeelnemersEvent::model()->find('event_ID = :event_Id AND user_ID=:user_Id',
						    array(':event_Id' => $event_Id,
							  ':user_Id' => $user_Id));
		if(isset($data->rol))
		{
		    return $data->rol;
		}

		return;
	}

	/**
	 * @return de group van een speler tijdens een bepaalde hike
	 */
	public function getGroupOfPlayer(	$event_Id,
										$user_Id)
	{
		$data = DeelnemersEvent::model()->find('event_ID = :event_Id AND user_ID=:user_Id',
						    array(':event_Id' => $event_Id,
							  ':user_Id' => $user_Id));
		if(!isset($data->rol))
		{
		    return;
		}

		if($data->rol<>DeelnemersEvent::ROL_deelnemer or
		   !isset($data->group_ID))
		{
		    return;
		}

		return $data->group_ID;
	}

	/**
	 * @return de rol van een speler tijdens een bepaalde hike
	 */
	public function userSignedinInHike($event_Id,
										$user_Id)
	{
		$data = DeelnemersEvent::model()->exists('event_ID = :event_Id AND user_ID=:user_Id',
						    array(':event_Id' => $event_Id,
							  ':user_Id' => $user_Id));
		return $data;
	}
}