<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'HIKE-app',

         // path aliases
        'aliases' => array(
            'bootstrap' => realpath(__DIR__.'/../extensions/bootstrap'), // change this if necessary
         ),

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
            'application.models.*',
            'application.components.*',
            'application.components.CrudAllowed.*',
            'application.components.Messages.*',
            'ext.mail.*',
            'ext.tcpdf.*',
            'ext.highcharts.*',
            'bootstrap.helpers.TbHtml',
            'bootstrap.helpers.TbArray',
            'bootstrap.behaviors.TbWidget',
            'bootstrap.widgets.*',

	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool

		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'test',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths' => array('bootstrap.gii'),
		),

	),

	// application components
	'components'=>array(
        'mail' => array(
                'class' => 'ext.mail.YiiMail',
                'transportType'=>'smtp',
                'transportOptions'=>array(
                        'host'=>'biologenkantoor.nl',
                            ),
                'viewPath' => 'application.views.users',
                ),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                    'class' => 'WebUser',
                ),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database


		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
                ),
            ),
        'bootstrap' => array(
                'class' => 'bootstrap.components.TbApi',
            ),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
        	'adminEmail'=>'hike-app@biologenkantoor.nl',
	),
);