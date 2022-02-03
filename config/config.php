<?php

require_once(__DIR__ . '/env.php');

$config = [
    'id' => 'api',
    'basePath' => dirname(__DIR__ ),

    'components' => [

        'urlManager' => [
            'enablePrettyUrl'     => true,
            'showScriptName'      => false,
        ],

        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => env('DB_DSN'),
            'username' => env('DB_USER'),
            'password' => env('DB_PASSWORD'),
            'charset' => env('DB_CHARSET'),
        ],
    ],

];


return $config;

