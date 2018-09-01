<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name'=>'MEMECOINS',
    'language' => 'zh-TW',
    // 设置源语言为英语
    'sourceLanguage' => 'en-US',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','admin'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        "@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
        '@uploads' => dirname(dirname(__DIR__)) . '/memecoinsapi/public/upload',
        '@meme_public' => dirname(dirname(__DIR__)) . '/memecoinsapi/public',
    ],
    "modules" => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            //'layout' => 'left-menu',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\models\User',
                    'idField' => 'id'
                ],
                'other' => [

                ],
            ],
        ],
        'redactor' => [ 
            'class' => 'yii\redactor\RedactorModule', 
            'uploadDir' => '@meme_public/uploads', 
            'uploadUrl' => 'https://localhost:8082/memecoinsapi/public/uploads', 
            'imageAllowExtensions'=>['jpg','png','gif'] 
        ], 
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvtree/messages',
                'forceTranslation' => true
            ]
            // other module settings, refer detailed documentation
        ]
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //这里是允许访问的action
            //controller/action
            // * 表示允许所有，后期会介绍这个
            //'site/login',
            'admin/*',
            'site/logout',
            // '*',
            'image-sign/remove-image',
            'image-sign/download',
            'store/region-direct',
            'store/imagesign',
            'store/download',
            'activity/copy',
            'redactor/*',
            // 'gii/*',
            // 'debug/*'
            'store/charge',
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'd0y0auE-JRMBehOJOoeu3DbmXKn6pE64',
        ],
        'response' => [
            'class' => 'yii\web\Response',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'cache' => [
//            'class' => 'app\cacheing\RedisCache',
//            'redis' => [
//                'hostname' => 'localhost',
//                'port' => 6379,
//                'database' => 0,
//            ]
//        ],
//        'redis' => [
//            'class' => 'yii\redis\Connection',
//            'hostname' => 'localhost',
//            'port' => 6379,
//            'database' => 0,
//        ],
        'user' => [
            'identityClass' => 'mdm\admin\models\User',
            'loginUrl' => ['admin/user/login']
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
                // [
                //     'class' => 'yii\log\FileTarget',
                //     'levels' => ['error', 'warning'],
                // ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                // [
                //     'class' => 'yii\log\FileTarget',
                //     'levels' => ['info'],
                //     'categories' => ['rhythmk'],
                //     'logFile' => '@app/runtime/logs/Mylog/requests.log',
                //     'maxFileSize' => 1024 * 2,
                //     'maxLogFiles' => 20,
                // ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'db' => $db,

//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'rules' => [
//            ],
//        ],
        "authManager" => [
            "class" => 'yii\rbac\DbManager',
            'cache' => 'cache',
            // 'cacheDuration' => 3600,
            "defaultRoles" => ["guest"],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@vendor/mdmsoft/yii2-admin/views/user' => '@app/views/user',
                    '@app/views' => '@app/views',
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV && false) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.*', '192.168.144.*','10.0.2.*'] // 按需调整这里
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.*', '192.168.144.*','10.0.2.*'] // 按需调整这里
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
