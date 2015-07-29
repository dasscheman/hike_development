<?php

// Support PHPUnit <=3.7 and >=3.8
//if (file_exists('PHPUnit/Framework/TestCase.php'))
//  require_once('PHPUnit/Framework/TestCase.php'); // <= 3.7
//else
//  require_once('src/Framework/TestCase.php'); // >= 3.8
// make sure non existing PHPUnit classes do not break with Yii autoloader

// change the following paths if necessary
//$yiit=dirname(__FILE__).'/../../../Yii/framework/yiit.php';
$yiit=realpath(__DIR__ . '/../../..').'/framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

//Yii::$enableIncludePath = false;
Yii::createWebApplication($config);
