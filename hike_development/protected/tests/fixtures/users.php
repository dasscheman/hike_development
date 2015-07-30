<?php
return array(
    'sampleOrganisatie'=>array(
        'user_ID'=>1,
        'username'=>'organisatie',
        'voornaam'=>'Organisatie',
        'achternaam'=>'Organisatie',
        'email'=>'test@biologenkantoor.nl',
        'password'=>'098f6bcd4621d373cade4e832627b4f6',
        'create_time' => new CDbExpression('SYSDATE()'),
        'create_user_ID' => 1,
    ),
    'sampleDeelnemerA'=>array(
        'user_ID'=>2,
        'username'=>'deelnemera',
        'voornaam'=>'DeelnemerA',
        'achternaam'=>'DeelnemerA',
        'email'=>'test@biologenkantoor.nl',
        'password'=>'test',
        'create_time' => new CDbExpression('SYSDATE()'),
        'create_user_ID' => 1,
    ),
    'sampleDeelnemerB'=>array(
        'user_ID'=>3,
        'username'=>'deelnemerb',
        'voornaam'=>'DeelnemerB',
        'achternaam'=>'DeelnemerB',
        'email'=>'test@biologenkantoor.nl',
        'password'=>'test',
        'create_time' => new CDbExpression('SYSDATE()'),
        'create_user_ID' => 1,
    ),
);
