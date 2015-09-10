<?php
// Created: 2014
// Modified: 22 feb 2015

/**
 * This is the model class for table "tbl_users".
 *
 * The followings are the available columns in table 'tbl_users':
 * @property integer $user_ID
 * @property string $username
 * @property string $voornaam
 * @property string $achternaam
 * @property string $email
 * @property string $password
 * @property string $macadres
 * @property string $birthdate
 * @property string $last_login_time
 * @property string $create_time
 * @property integer $create_user_ID
 * @property string $update_time
 * @property integer $update_user_ID
 *
 * The followings are the available model relations:
 * @property Bonuspunten[] $bonuspuntens
 * @property Bonuspunten[] $bonuspuntens1
 * @property DeelnemersEvent[] $deelnemersEvents
 * @property DeelnemersEvent[] $deelnemersEvents1
 * @property DeelnemersEvent[] $deelnemersEvents2
 * @property EventNames[] $eventNames
 * @property EventNames[] $eventNames1
 * @property FriendList[] $friendLists
 * @property FriendList[] $friendLists1
 * @property FriendList[] $friendLists2
 * @property FriendList[] $friendLists3
 * @property Groups[] $groups
 * @property Groups[] $groups1
 * @property NoodEnvelop[] $noodEnvelops
 * @property NoodEnvelop[] $noodEnvelops1
 * @property OpenNoodEnvelop[] $openNoodEnvelops
 * @property OpenNoodEnvelop[] $openNoodEnvelops1
 * @property OpenVragen[] $openVragens
 * @property OpenVragen[] $openVragens1
 * @property OpenVragenAntwoorden[] $openVragenAntwoordens
 * @property OpenVragenAntwoorden[] $openVragenAntwoordens1
 * @property PostPassage[] $postPassages
 * @property PostPassage[] $postPassages1
 * @property Posten[] $postens
 * @property Posten[] $postens1
 * @property Qr[] $qrs
 * @property Qr[] $qrs1
 * @property QrCheck[] $qrChecks
 * @property QrCheck[] $qrChecks1
 * @property Route[] $routes
 * @property Route[] $routes1
 */
class Users extends HikeActiveRecord
{
	public $password_repeat;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'tbl_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			/*array('username, voornaam, achternaam, password, password_repeat',
			      'required',
			      'on' => 'create',   // Scenarios when the validation rule should be used
			      'message' => 'Niet alle velden zijn gevuld!!',  // Error message
			      ),*/
			/*array('password, password_repeat',
			      'required',
			      'on'=>'changePassword',   // Scenarios when the validation rule should be used
			      'message'=>'Niet alle velden zijn gevuld!!',  // Error message
			      ),*/
			//array('password','allowEmpty'=>false),
			array('username, voornaam, achternaam, email', 'required'),
			array('create_user_ID, update_user_ID', 'numerical', 'integerOnly'=>true),
			array('username, voornaam, achternaam, email, password, macadres', 'length', 'max'=>255),
			array('birthdate, last_login_time, create_time, update_time, password_repeat', 'safe'),
			array('email, username', 'unique'),
			array('email', 'email'),
			array('password', 'compare'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_ID, username, voornaam, achternaam, email,
			      password, macadres, birthdate, last_login_time,
			      create_time, create_user_ID, update_time,
			      update_user_ID', 'safe', 'on'=>'search'),
			array('user_ID, username, voornaam, achternaam, email,
			      password, macadres, birthdate, last_login_time,
			      create_time, create_user_ID, update_time,
			      update_user_ID', 'safe', 'on'=>'searchPending'),
			array('user_ID, username, voornaam, achternaam, email,
			      password, macadres, birthdate, last_login_time,
			      create_time, create_user_ID, update_time,
			      update_user_ID', 'safe', 'on'=>'searchFriends'),
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
			'bonuspuntens' => array(self::HAS_MANY, 'Bonuspunten', 'create_user_ID'),
			'bonuspuntens1' => array(self::HAS_MANY, 'Bonuspunten', 'update_user_ID'),
			'deelnemersEvents' => array(self::HAS_MANY, 'DeelnemersEvent', 'create_user_ID'),
			'deelnemersEvents1' => array(self::HAS_MANY, 'DeelnemersEvent', 'update_user_ID'),
			'deelnemersEvents2' => array(self::HAS_MANY, 'DeelnemersEvent', 'user_ID'),
			'eventNames' => array(self::HAS_MANY, 'EventNames', 'create_user_ID'),
			'eventNames1' => array(self::HAS_MANY, 'EventNames', 'update_user_ID'),
			'friendLists' => array(self::HAS_MANY, 'FriendList', 'create_user_ID'),
			'friendLists1' => array(self::HAS_MANY, 'FriendList', 'friends_with_user_ID'),
			'friendLists2' => array(self::HAS_MANY, 'FriendList', 'update_user_ID'),
			'friendLists3' => array(self::HAS_MANY, 'FriendList', 'user_ID'),
			'groups' => array(self::HAS_MANY, 'Groups', 'create_user_ID'),
			'groups1' => array(self::HAS_MANY, 'Groups', 'update_user_ID'),
			'noodEnvelops' => array(self::HAS_MANY, 'NoodEnvelop', 'create_user_ID'),
			'noodEnvelops1' => array(self::HAS_MANY, 'NoodEnvelop', 'update_user_ID'),
			'openNoodEnvelops' => array(self::HAS_MANY, 'OpenNoodEnvelop', 'create_user_ID'),
			'openNoodEnvelops1' => array(self::HAS_MANY, 'OpenNoodEnvelop', 'update_user_ID'),
			'openVragens' => array(self::HAS_MANY, 'OpenVragen', 'create_user_ID'),
			'openVragens1' => array(self::HAS_MANY, 'OpenVragen', 'update_user_ID'),
			'openVragenAntwoordens' => array(self::HAS_MANY, 'OpenVragenAntwoorden', 'create_user_ID'),
			'openVragenAntwoordens1' => array(self::HAS_MANY, 'OpenVragenAntwoorden', 'update_user_ID'),
			'postPassages' => array(self::HAS_MANY, 'PostPassage', 'create_user_ID'),
			'postPassages1' => array(self::HAS_MANY, 'PostPassage', 'update_user_ID'),
			'postens' => array(self::HAS_MANY, 'Posten', 'create_user_ID'),
			'postens1' => array(self::HAS_MANY, 'Posten', 'update_user_ID'),
			'qrs' => array(self::HAS_MANY, 'Qr', 'create_user_ID'),
			'qrs1' => array(self::HAS_MANY, 'Qr', 'update_user_ID'),
			'qrChecks' => array(self::HAS_MANY, 'QrCheck', 'create_user_ID'),
			'qrChecks1' => array(self::HAS_MANY, 'QrCheck', 'update_user_ID'),
			'routes' => array(self::HAS_MANY, 'Route', 'create_user_ID'),
			'routes1' => array(self::HAS_MANY, 'Route', 'update_user_ID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_ID' => 'User',
			'username' => 'Gebruikersnaam',
			'voornaam' => 'Voornaam',
			'achternaam' => 'Achternaam',
			'email' => 'Email',
			'password' => 'Password',
			'macadres' => 'Macadres',
			'birthdate' => 'Geboorte datum',
			'last_login_time' => 'Laatst gezien',
			'create_time' => 'Lid sinds',
			'create_user_ID' => 'Create User',
			'update_time' => 'Update Time',
			'update_user_ID' => 'Update User',
		);
	}

    /**
     * Only the actions specific to the model User are here defined.
     */
    function isActionAllowed($controller_id = null, $action_id = null, $event_id = null, $model_id = null, $group_id = null)
    {
		$actionAllowed = parent::isActionAllowed($controller_id, $action_id, $event_id, $model_id, $group_id);

        if ($controller_id == 'users'){
           if (in_array($action_id, array('decline', 'accept'))) {
					return true;
			}
        }
		return false;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria();
		//Bestaande vrienden worden uitgefilterd uit de user lijst.
		// de huidige gebruiker wordt er ook uitgefilterd.
		$criteria->addCondition("t.user_ID NOT IN ( SELECT friends_with_user_ID
								FROM `tbl_friend_list`
								WHERE user_ID =:currentuser)
								AND t.user_ID <>:currentuser");
		$criteria->params = array(':currentuser'=>Yii::app()->user->id);
		$criteria->compare('user_ID',$this->user_ID);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('voornaam',$this->voornaam,true);
		$criteria->compare('achternaam',$this->achternaam,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('macadres',$this->macadres,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
    }

    public function searchFriends()
    {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria();
		//Bestaande vrienden worden uitgefilterd uit de user lijst.
		// de huidige gebruiker wordt er ook uitgefilterd.
		//$criteria->select = 'tbl_FriendsList';
		$criteria->join = 'JOIN tbl_friend_list friends ON friends.user_ID = t.user_ID';
		$criteria->condition = 'friends.friend_list_ID IS NOT NULL
								AND friends.friends_with_user_ID = :currentuser
								AND friends.status = 2';
		$criteria->params = array(':currentuser'=>Yii::app()->user->id);
		$criteria->compare('user_ID',$this->user_ID);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('voornaam',$this->voornaam,true);
		$criteria->compare('achternaam',$this->achternaam,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('macadres',$this->macadres,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
    }

    public function searchPending()
    {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria();
		//Bestaande vrienden worden uitgefilterd uit de user lijst.
		// de huidige gebruiker wordt er ook uitgefilterd.
		$criteria->join = 'JOIN tbl_friend_list friends ON friends.friends_with_user_ID = t.user_ID';
		$criteria->condition = 'friends.friend_list_ID IS NOT NULL
								AND friends.user_ID = :currentuser
								AND friends.status = 0';
		$criteria->params = array(':currentuser'=>Yii::app()->user->id);
		$criteria->compare('user_ID',$this->user_ID);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('voornaam',$this->voornaam,true);
		$criteria->compare('achternaam',$this->achternaam,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('macadres',$this->macadres,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('create_user_ID',$this->create_user_ID);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('update_user_ID',$this->update_user_ID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
    }

	/**
	* apply a hash on the password before we store it in the database
	*/
	protected function afterValidate()
	{
		parent::afterValidate();
		if(!$this->hasErrors() && Yii::app()->controller->action->id != 'update'){
            $this->password = $this->hashPassword($this->password);
        }
	}

	/**
	* Generates the password hash.
	* @param string password
	* @return string hash
	*/
	public function hashPassword($password)
	{
		return md5($password);
	}

	/**
	* Checks if the given password is correct.
	* @param string the password to be validated
	* @return boolean whether the password is valid
	*/
	public function validatePassword($password)
	{
		return $this->hashPassword($password)===$this->password;
	}

   	/**
	* Retrieves a list of users
	* @return array an array of all available users'.
	*/
	public function getUserNameOptions()
	{
		$data	= Users::model()->findAll();
		$list = CHtml::listData($data, 'user_ID', 'username');
		return $list;
	}

   	/**
	* Retrieves username
	*/
	public function getUserName($user_Id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'user_ID =:id';
		$criteria->params=array(':id' => $user_Id);

		if (Users::model()->exists($criteria))
		{
            $data = Users::model()->find($criteria);
			return $data->username;
		} else {
			return "nvt";}
	}

   	/**
	* Retrieves username
	*/
	public function getUserEmail($user_Id)
	{
		$criteria = new CDbCriteria();
		$criteria->condition = 'user_ID =:id';
		$criteria->params=array(':id' => $user_Id);

		if (Users::model()->exists($criteria))
		{
            $data = Users::model()->find($criteria);
			return $data->email;
		} else {
			return "nvt";}
	}

	public function sendEmailWithNewPassword($model, $newWachtwoord)
	{
		$message = new YiiMailMessage();
		//this points to the file test.php inside the view path
		$message->view = "resendPassword";
		$params = array('newMailUsers'=>$model->username,
					     'newWachtwoord'=>$newWachtwoord);

		$message->subject    = 'Wachtwoord Hike-app';
		$message->from = 'noreply@biologenkantoor.nl';
		$message->setBody($params, 'text/html');
		$message->addTo($model->email);
		if(Yii::app()->mail->send($message)){
			return true;
		}
        throw new CHttpException(400,"Er is geen email verstuurd.");
	}
}