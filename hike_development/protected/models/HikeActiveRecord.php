<?php

abstract class HikeActiveRecord extends CActiveRecord
{
	public $actionAllowed;
	public $indexAllowed;
	public $updateAllowed;
	public $viewAllowed;
	public $viewPlayersAllowed;
	public $deleteAllowed;
	public $createAllowed;

	/**
	* Prepares create_user_name and update_user_name attributes before saving.
	*/
	protected function beforeSave()
	{
		if(null !== Yii::app()->user)
			$id=Yii::app()->user->id;
		else
			$id=1;
		if($this->isNewRecord)
			$this->create_user_ID=$id;
		$this->update_user_ID=$id;
		return parent::beforeSave();
	}

	/**
	* Attaches the timestamp behavior to update our create and update times
	*/
	public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'create_time',
				'updateAttribute' => 'update_time',
				'setUpdateOnCreate' => true,
			),
		);
	}

	// access it by Yii::app()->user->isActionAllowed($this->id, $this->action->id, $event_id)
	// $this->id is same as Yii::app()->controller->id)
	// $this->action->id is same as Yii::app()->controller->action->id)
	function isActionAllowed($controller_id = null, 
							 $action_id = null, 
							 $event_id = null, 
							 $model_id = null)
	{
		$actionAllowed = false;

		if ($controller_id == null) {
			$controller_id = Yii::app()->controller->id;
		}

		if ($action_id == null) {
			$action_id = Yii::app()->controller->action->id;
		}

		if ($event_id == null && isset($_GET['event_id'])) {
			$event_id = $_GET['event_id'];
		}
		
		switch ($action_id)
		{
			case 'index':
				$actionAllowed = HikeActiveRecord::setIndexAllowed($controller_id, $action_id, $event_id);
				break;
			case 'view':
				$actionAllowed = HikeActiveRecord::setViewAllowed($controller_id, $action_id, $event_id);
				break;
			case 'create':
				$actionAllowed = HikeActiveRecord::setCreateAllowed($controller_id, $action_id, $event_id, $model_id);
				break;
			case 'createIntroductie':
				$actionAllowed = HikeActiveRecord::setCreateIntroductieAllowed($controller_id, $action_id, $event_id);
				break;
			case 'update':
				$actionAllowed = HikeActiveRecord::setUpdateAllowed($controller_id, $action_id, $event_id, $model_id);
				break;
			case 'delete':
				$actionAllowed = HikeActiveRecord::setDeleteAllowed($controller_id, $action_id, $event_id, $model_id);
				break;
			case 'viewPlayers':
				$actionAllowed = HikeActiveRecord::setViewPlayersAllowed($controller_id, $action_id, $event_id, $model_id);
				break;
			default:
		}
		return $actionAllowed;
	}

	function setIndexAllowed($controller_id = null, $action_id = null, $event_id = null)
	{
		$indexAllowed = false;
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = Yii::app()->user->getRole($event_id);

		switch ($controller_id) {
			case 'noodEnvelop':
			case 'openVragen':
			case 'posten':
			case 'qr':
			case 'route':
			//case chart:
			case 'groups':
			case 'deelnemersEvent':
			case 'eventNames':
			//case friendList:
			case 'groups':
			case 'route':
			case 'startup':
				if ($rolPlayer == DeelnemersEvent::ROL_organisatie) {
					$indexAllowed = true;
				}				
				break;
			case 'openNoodEnvelop':
			case 'postPassage':
				if ($hikeStatus > EventNames::STATUS_introductie AND
					$rolPlayer == DeelnemersEvent::ROL_organisatie) {
						$indexAllowed = true;
				}			
				break;	
			case 'qrCheck':
			case 'bonuspunten':
			case 'openVragenAntwoorden':
				if ($hikeStatus <> EventNames::STATUS_opstart AND
					$rolPlayer == DeelnemersEvent::ROL_organisatie) {
						$indexAllowed = true;
				}		
			//case users:
			default:		
		}
		return $indexAllowed;
	}

	function setUpdateAllowed($controller_id = null, $action_id = null, $event_id = null, $model_id = null)
	{
		$updateAllowed = false;
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = Yii::app()->user->getRole($event_id);
		if ($rolPlayer == DeelnemersEvent::ROL_deelnemer) {
			$groupOfPlayer = DeelnemersEvent::model()->getGroupOfPlayer($event_id, Yii::app()->user->id);
		}

		switch ($controller_id) {
			case 'bonuspunten':
				if (($hikeStatus == EventNames::STATUS_introductie or
					 $hikeStatus == EventNames::STATUS_gestart) and
					$rolPlayer == DeelnemersEvent::ROL_organisatie) {
					$updateAllowed = true;
				}
				break;
			case 'noodEnvelop':
			case 'openVragen':
			case 'posten':
			case 'qr':
			case 'route':
				if ($hikeStatus == EventNames::STATUS_opstart and
					$rolPlayer == DeelnemersEvent::ROL_organisatie ){
					$updateAllowed = true;
				}
				break;
          // case 'chart':
			case 'groups':
			case 'deelnemersEvent':
			case "groups":
				if ($rolPlayer == DeelnemersEvent::ROL_organisatie) {
						$updateAllowed = true;
				}
				break;
			case 'eventNames':
				if ($hikeStatus == EventNames::STATUS_opstart and
					$rolPlayer == DeelnemersEvent::ROL_organisatie)	{
					$updateAllowed = true;
				}
          		break;
			case 'openNoodEnvelop':
          	case 'qrCheck':
          		break;
			case 'openVragenAntwoorden':
				if ($hikeStatus == EventNames::STATUS_introductie and
					$rolPlayer == DeelnemersEvent::ROL_deelnemer and
				    $groupOfPlayer == $model_id) {
						$updateAllowed = true;}
				if ($hikeStatus == EventNames::STATUS_gestart and
					$rolPlayer == DeelnemersEvent::ROL_deelnemer and
				    $groupOfPlayer == $model_id and
					PostPassage::model()->timeLeftToday($event_id, $model_id)) {
						$updateAllowed = true;}
				break;
			case 'postPassage':
				if ($hikeStatus == EventNames::STATUS_introductie and
					$rolPlayer == DeelnemersEvent::ROL_organisatie) {
					$updateAllowed = true;}
				break;
			case 'route';
				if ($hikeStatus == EventNames::STATUS_opstart and
					$rolPlayer == DeelnemersEvent::ROL_organisatie ){
					$updateAllowed = true;
				}
				break;
			//case friendList:
			//	break;
			case 'users':
				break;
			default:		
		}
		return $updateAllowed;	
	}

	function setCreateAllowed($controller_id = null, $action_id = null, $event_id = null, $model_id = null)
	{
		$createAllowed = false;
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = Yii::app()->user->getRole($event_id);
		if ($rolPlayer == DeelnemersEvent::ROL_deelnemer) {
			$groupOfPlayer = DeelnemersEvent::model()->getGroupOfPlayer($event_id, Yii::app()->user->id);
		}

		switch ($controller_id) {
			case 'bonuspunten':
				if ($hikeStatus == EventNames::STATUS_introductie and
					$rolPlayer == DeelnemersEvent::ROL_organisatie) {
					$createAllowed = true;}
			case 'postPassage':
				if ($hikeStatus == EventNames::STATUS_gestart and
					$rolPlayer <= DeelnemersEvent::ROL_post) {
					$createAllowed = true;}
				break;
			case 'noodEnvelop':
			case 'openVragen':
			case 'posten':
			case 'qr':
			case 'groups':
			case 'deelnemersEvent':
			case 'route':
				if( $hikeStatus == EventNames::STATUS_opstart and
					$rolPlayer == DeelnemersEvent::ROL_organisatie) {
					$createAllowed = true;
				}
				break;
			case 'eventNames':
			case 'users':
				$createAllowed = true;
				break;
			//case 'chart':
			//case friendList:
			case 'openVragenAntwoorden':
			case 'qrCheck':
				if ($hikeStatus == EventNames::STATUS_introductie and
					$rolPlayer == DeelnemersEvent::ROL_deelnemer and
				    $groupOfPlayer == $model_id) {
						$createAllowed = true;}
				// Hier geen break. OpenNoodenvelop en postPassage moeten uitgesloten worden voor de introductie.
			case 'openNoodEnvelop':
				if ($hikeStatus == EventNames::STATUS_gestart and
					$rolPlayer == DeelnemersEvent::ROL_deelnemer and
				    $groupOfPlayer == $model_id and
					PostPassage::model()->timeLeftToday($event_id, $model_id)) {
						$createAllowed = true;}
				break;
			default:
		}
		return $createAllowed;	
	}

	function setDeleteAllowed($controller_id = null, $action_id = null, $event_id = null, $model_id = null)
	{
		$deleteAllowed = false;
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = Yii::app()->user->getRole($event_id);

		switch ($controller_id) {
			case 'bonuspunten':
				if (($hikeStatus == EventNames::STATUS_introductie or
					 $hikeStatus == EventNames::STATUS_gestart) and
					$rolPlayer == DeelnemersEvent::ROL_organisatie) {
					$deleteAllowed = true;}
			case 'noodEnvelop':
			case 'openVragen':
			case 'posten':
			case 'qr':
			case 'chart':
			case 'groups':
			case 'deelnemersEvent':
			case 'eventNames':
			//case friendList:
			case 'groups':
			case 'openNoodEnvelop':
			case 'openVragenAntwoorden':
			case 'postPassage':
			case 'qrCheck':
			case 'route':
				if ($hikeStatus == EventNames::STATUS_opstart and
						$rolPlayer == DeelnemersEvent::ROL_organisatie ){
						$deleteAllowed = true;
					}
				break;
			case 'users':
				break;
			default:		
		}
		return $deleteAllowed;
	}

	function setViewAllowed($controller_id = null, $action_id = null, $event_id = null, $group_id = null)
	{
		$viewAllowed = false;
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = Yii::app()->user->getRole($event_id);
		if ($rolPlayer == DeelnemersEvent::ROL_deelnemer) {
			$groupOfPlayer = DeelnemersEvent::model()->getGroupOfPlayer($event_id, Yii::app()->user->id);}

		switch ($controller_id) {
			case 'noodEnvelop':
			case 'openVragen':
			case 'posten':
			case 'qr':
			case 'route':
			case 'chart':
			case 'groups':
			case 'deelnemersEvent':
			case 'eventNames':
			//case friendList:
			case 'groups':
			case 'openNoodEnvelop':
			case 'openVragenAntwoorden':
			case 'postPassage':
			case 'qrCheck':
				if ($rolPlayer == DeelnemersEvent::ROL_organisatie) {
					$viewAllowed = true;}				
				if (($hikeStatus == EventNames::STATUS_introductie or
					 $hikeStatus == EventNames::STATUS_gestart) and
					$rolPlayer == DeelnemersEvent::ROL_post) {
					$viewAllowed = true;}
				if ($hikeStatus == EventNames::STATUS_beindigd ) {
					$viewAllowed = true;}
			case 'users':
				break;
			default:		
		}
		return $viewAllowed;
	}

	function setViewPlayersAllowed($controller_id = null, $action_id = null, $event_id = null, $model_id = null)
	{
		$viewPlayersAllowed = false;
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = Yii::app()->user->getRole($event_id);
		if ($rolPlayer == DeelnemersEvent::ROL_deelnemer) {
			$groupOfPlayer = DeelnemersEvent::model()->getGroupOfPlayer($event_id, Yii::app()->user->id);}

		switch ($controller_id) {
			case 'bonuspunten':
			case 'qrCheck':
			case 'openVragen':
			case 'openVragenAntwoorden':
				if ($hikeStatus == EventNames::STATUS_introductie and
					$rolPlayer == DeelnemersEvent::ROL_deelnemer and
					$groupOfPlayer == $model_id) {
						$viewPlayersAllowed = true;
				}
			case 'noodEnvelop':
			case 'openNoodEnvelop':
			case 'postPassage':
				if ($hikeStatus <> EventNames::STATUS_opstart AND
					$rolPlayer == DeelnemersEvent::ROL_organisatie) {
						$viewPlayersAllowed = true;
				}
				if (($hikeStatus == EventNames::STATUS_introductie or
					 $hikeStatus == EventNames::STATUS_gestart) and
				   $rolPlayer == DeelnemersEvent::ROL_post) {
						$viewPlayersAllowed = true;
				} 
				if ($hikeStatus == EventNames::STATUS_beindigd) {
						$viewPlayersAllowed = true;
				}

				if ($hikeStatus == EventNames::STATUS_gestart and
					$rolPlayer == DeelnemersEvent::ROL_deelnemer and
					$groupOfPlayer == $model_id) {
						$viewPlayersAllowed = true;
				}
				break;
			default:
		}		
		return $viewPlayersAllowed;	
	}

	function setCreateIntroductieAllowed($controller_id = null, $action_id = null, $event_id = null)
	{
		$createInroductieAllowed = false;
		$hikeStatus = EventNames::model()->getStatusHike($event_id);
		$rolPlayer = Yii::app()->user->getRole($event_id);

		switch ($controller_id) {
			case 'openVragen':
			case 'qr':
				if ($hikeStatus == EventNames::STATUS_opstart and
					$rolPlayer == DeelnemersEvent::ROL_organisatie) {
					$createInroductieAllowed = true;
				}
				break;
		}
		return $createInroductieAllowed;
	}	
}
?>