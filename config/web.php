<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4gcSzNNPHp4WRzc8PQkSY4xwlbU_gMUX',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
            //'class' => 'yii\caching\DummyCache',
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
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                /**
                 * @see \app\controllers\api\ApiController
                 */
                'GET,HEAD api' => 'api/api/index',
                'GET api/docs' => 'api/api/docs',
                'GET api/json-schema' => 'api/api/json-schema',

                'GET api/course' => 'api/api/course/index',
                'POST api/course/create' => 'api/course/create',
                'PUT api/course/update/<courseId:\d+>'=> '/api/course/update',
                'DELETE api/course/delete/<courseId:\d+>'=> '/api/course/delete',

                'GET api/lesson' => 'api/api/lesson/index',
                'POST api/lesson/create' => 'api/lesson/create',
                'PUT api/lesson/update/<lessonId:\d+>'=> '/api/lesson/update',
                'DELETE api/course/delete/<lessonId:\d+>'=> '/api/lesson/delete',

                'GET api/student' => 'api/api/student/index',
                'POST api/student/create' => 'api/student/create',
                'PUT api/student/update/<studentId:\d+>'=> '/api/student/update',
                'DELETE api/student/delete/<studentId:\d+>'=> '/api/student/delete',

                "lesson-student" => "lesson-student/index",

                "home" => "site/index",
                "about-us" => "site/about",
                "contact-us" => "site/contact",

            ],
        ],
    ],
    'params' => $params,

    'modules' => [
        'menu' => [
            'class' => '\pceuropa\menu\Menu',
        ],
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];
}

return $config;
