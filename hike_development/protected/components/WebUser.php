<?php
 
class WebUser extends CWebUser 
{
	private $_deelnemerModel;

	public function getRole($event_id = null)
	{
		if($event_id!==null)
		{
			$deelnemer = $this->loadDeelnemer(Yii::app()->user->id, $event_id);
		}

		if (isset($deelnemer)) {
			return $deelnemer->rol;
		}
		return false;
	}

	/* 
	 *	This is a function that checks the field 'role'
	 *	in the User model to be equal to 1, that means it's admin
	 *  access it by Yii::app()->user->isOrganisationForEvent($event_id)
	 */
	public function isOrganisationForEvent($event_id = null)
	{
		if($event_id!==null)
		{
			$deelnemer = $this->loadDeelnemer(Yii::app()->user->id, $event_id);
		}
		if (isset($deelnemer) && $deelnemer->rol == 1)
		{
			return true;
		}
		return false;
	}

	// access it by Yii::app()->user->isPostForEvent($event_id)
	public function isPostForEvent($event_id = null)
	{
		if($event_id!==null)
		{
			$deelnemer = $this->loadDeelnemer(Yii::app()->user->id, $event_id);
		}
		if (isset($deelnemer) && $deelnemer->rol == 2)
		{
			return true;
		}
		return false;
	}

	// access it by Yii::app()->user->isDeelnemerForEvent($event_id)
	public function isDeelnemerForEvent($event_id = null){
		if($event_id!==null){
			$deelnemer = $this->loadDeelnemer(Yii::app()->user->id, $event_id);
		}
		if (isset($deelnemer) && $deelnemer->rol == 3) {
			return true;
		}
		return false;
	}

	// Load user model.
	protected function loadDeelnemer($user_id=null, $event_id=null)
	{
		if($this->_deelnemerModel===null)
		{
			if($user_id!==null && $event_id!==null){
				$this->_deelnemerModel=DeelnemersEvent::model()->find('event_ID = :event_id AND user_ID=:user_id', 
					array(':event_id' => $event_id, 
						  ':user_id' => $user_id)); 
			}
		}
		return $this->_deelnemerModel;
	}
}
?>