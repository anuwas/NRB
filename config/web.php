<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'defaultRoute' => 'dbuser/login',
    'components' => [
    		'servicecomp'=>[
            	'class' => 'app\components\ServiceComponent',
            ],
    		'commentcomp'=>[
    				'class' => 'app\components\CommenthelperComponent',
    		],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Anupam',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','trace','info'],
                ],
            		[
            		'class' => 'yii\log\FileTarget',
            		'levels' => ['error','info'],
            		'categories' => ['service'],
            		'logFile' => '@app/runtime/logs/webservice/service.log',
            		'maxFileSize' => 1024*2,
            		'maxLogFiles' => 20,
            		],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            		'login' => 'dbuser/login',
            		'home' => 'index/home',
            		'profile'=>'index/profile',
            		'events'=>'index/events',
            		'comments'=>'index/comments',
            		'users'=>'index/users',
            		'netaji-gallery'=>'index/showgallery',
            		'fblogin'=>'index/fblogin',
            		'contact-us'=>'index/contactus',
            		'feature-gallery'=>'index/featuregallery',
            		'year-span'=>'index/yearspan',
            ],
        ],
       
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
