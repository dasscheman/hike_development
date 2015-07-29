<?php
// Created: 2014
// Modified: 23 feb 2015

/* @var $this UsersController */
/* @var $model Users */

    $this->menu=array(
	array('label'=>'
	    <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
            <i class="fa fa-users fa-stack-1x"></i>
            <i class="fa fa-blue fa-text-right fa-07x"> Vrienden Zoeken</i>
	    </span>',
	    'url'=>array('/users/searchFriends')),
	array('label'=>'
	    <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
            <i class="fa fa-tachometer fa-stack-1x"></i>
            <i class="fa fa-blue fa-text-right fa-07x"> Nieuwe hike beginnen</i>
	    </span>',
	    'url'=>array('/eventNames/create')),
    array('label'=>'
	   <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
            <i class="fa fa-cogs fa-stack-1x"></i>
            <i class="fa fa-blue fa-text-right fa-07x"> Bewerken '.Yii::app()->user->name.'</i>
	    </span>',
	    'url'=>array('users/update'), 'visible'=>!Yii::app()->user->isGuest),
	array('label'=>'
	    <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
            <i class="fa fa-child fa-stack-1x"></i>
            <i class="fa fa-blue fa-text-right fa-07x"> Uitloggen '.Yii::app()->user->name.'</i>
	    </span>',
	    'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
    array('label'=>'<span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x fa-green"></i>
            <i class="fa fa-unlock-alt fa-stack-1x"></i>
            <i class="fa fa-blue fa-text-right fa-07x"> Wachtwoord Wijzigen</i>
            <i class="fa fa-exchange fa-stack-11p fa-04x fa-blue"> </i>
        </span>',
        'url'=>array('/users/changePassword'))
);


    $this->widget('bootstrap.widgets.TbTabs', array(
        'tabs'=>array(
            array(
                'id'=>'tab1',
                'active'=>true,
                'label'=>'Thuis',
                'content'=>$this->renderPartial("/users/_view", array('data' => $userData),true),         
            ),
            array(
                'label' => 'Vrienden',
                'content' =>"Dit is een lijst met vrienden".$this->widget(
                    'bootstrap.widgets.TbGridView',
                    array(
                       // 'id'=>'tab2',
						'id'=>'users-grid',
                        'dataProvider'=>$friendsData->searchFriends(),
                        'filter'=>$friendsData,
                        'columns'=>array(
                            'username',
                            'voornaam',
                            'achternaam',
                            'email',),),
                    true
                ),
            ),
            array(
                'label' => 'Verzoeken',
                'content' =>"Dit is een lijst met mensen die jou een vriendschapsverzoek hebben gedaan".$this->widget(
                'bootstrap.widgets.TbGridView',
                    array(
                        'id'=>'tab3',
                        'dataProvider'=>$pendingFriendsData->searchPending(),
                        'filter'=>$pendingFriendsData,
                        'columns'=>array(
                            'username',
                            'voornaam',
                            'achternaam',
                            'email',
                            array(
                                'header'=>'accepteer',
                                'class'=>'CButtonColumn',
                                'template'=>'{accept} {decline}',
                                'buttons'=>array(
                                    'accept' => array(
                                        'label'=>'
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-check fa-stack-1x"></i>
                                        </span>',
                                        'url'=>'Yii::app()->createUrl("friendList/accept", array("user_id"=>$data->user_ID))',
                                        'visible'=>'FriendList::model()->isActionAllowed("friendList", "accept", "", $data->user_ID)',
                                    ),
                                    'decline' => array(
                                        'label'=>'
                                        <span class="fa-stack fa-lg">
                                            <i class="fa fa-ban fa-stack-1x"></i>
                                        </span>',
                                        'url'=>'Yii::app()->createUrl("friendList/decline", array("user_id"=>$data->user_ID))',
                                        'visible'=>'FriendList::model()->isActionAllowed("friendList", "decline", "", $data->user_ID )',                                    
                                    ),
                                ),
                            ),
                        ),
                    ),
                    true
                ),
            ),
            array(
                'label' => 'Hikes',
                'content' =>"Dit is een lijst met hikes die jij gestart bent".$this->widget(
                    'bootstrap.widgets.TbGridView',
                    array(
                        'id'=>'tab4',
                        'dataProvider'=>$hikeData->search(),
                        //'filter'=>$hikeData,
                        'columns'=>array(
                            //'event_ID',
                            'event_name',
                            'start_date',
                            'end_date',
                            'status'=>array(
                                'name'=>'status',
                                'value'=>'$data->getStatusText()'),
                            'create_user'=>array(
                                'name'=>'create_user_ID',
                                'value'=>'Users::model()->getUserName($data->create_user_ID)'),                          
                            array(
                                'header'=>'Bekijk',
                                'class'=>'CButtonColumn',
                                'template'=>'{game} {startup}',
                                'buttons'=>array(
									'game' => array(
                                        'label'=>'<span class="fa-stack fa-lg">
													<i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
													<i class="fa fa-compass fa-stack-1x"></i>
												</span>',
                                        'options'=>array('title'=>'Bekijk deze hike'),
                                        'url'=>'Yii::app()->createUrl("game/gameoverview", array("event_id"=>$data->event_ID))',
                                        'visible'=>'DeelnemersEvent::model()->isActionAllowed(
                                            "game",
                                            "gameoverview",
                                            $data->event_ID)'
									),        
                                    'startup' => array(
                                        'label'=>'<span class="fa-stack fa-lg">
													<i class="fa fa-circle fa-stack-1x fa-green fa-15x"></i>
													<i class="fa fa-tachometer fa-stack-1x"></i>
												</span>',
                                        'options'=>array('title'=>'Bekijk de settings van deze hike'),
                                        'url'=>'Yii::app()->createUrl("startup/startupOverview", array("event_id"=>$data->event_ID))',
                                        'visible'=>'DeelnemersEvent::model()->isActionAllowed(
                                            "startup",
                                            "startupOverview",
                                            $data->event_ID)'
                                    ),
                                ),
                            ),
                        ),
                    ),
                    true
                ),
            ),
        ),
    ));






?>




