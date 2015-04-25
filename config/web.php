<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'language' => 'ru',
    'bootstrap' => ['log'],
    'modules' => [
        'pages' => [
            'class' => 'app\system\modules\pages\Module',
        ],
        'user' => [
            'class' => 'app\system\modules\user\Module',
    ],
    ],
    'components' => [
        /* 'assetManager' => [
          'forceCopy' => YII_DEBUG,
          'linkAssets'=>true,
          'bundles' => [
          'yii\web\JqueryAsset' => [
          //'sourcePath' => null,   // do not publish the bundle
          'css' => ['themes/dot-luv/jquery-ui.css'],
          'js' => [
          YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
          ]
          ],
          ],
          ], */
        'view' => [
            'theme' => [
                'pathMap' => ['@app/views' => '@webroot/themes/corner/views'],
                'baseUrl' => '@web/themes/corner',
        ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/system/messages',
                    //  'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'app.php',
                ],
            ],
        ],
        ],
        'session' => [
            'class' => 'yii\web\Session',
        ],
        'request' => [
            'class' => 'app\cms\components\LangRequest',
            'baseUrl' => '',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fpsiKaSs1Mcb6zwlsUZwuhqScBs5UgPQ',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        // 'class' => 'yii\caching\ApcCache',
        ],
        'user' => [
            'class' => 'app\system\modules\user\components\User',
        // 'identityClass' => 'app\models\User',
        // 'enableAutoLogin' => false,
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOpenId'
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => 'facebook_client_id',
                    'clientSecret' => 'facebook_client_secret',
                ],
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => '4375462',
                    'clientSecret' => '0Rr2U4iCdisssqDor1tY',
            ],
        ],
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
            'targets' => [[
            'class' => 'yii\log\FileTarget',
            'levels' => ['error', 'warning'],
            ]],
        ],
        'languageManager' => array('class' => 'app\cms\components\CManagerLanguage'),
        'urlManager' => [
            'class' => 'app\cms\components\CManagerUrl',
            // List all supported languages here
            // Make sure, you include your app's default language.
            // 'languages' => ['en', 'fr', 'de', 'es-*'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'page/<action>' => 'site/<action>',
                'admin/<module:\w+>' => '<module>/admin/default/index',
                'admin/<module:\w+>/<action:\w+>' => '<module>/admin/default/<action>',
                'admin/<module:\w+>/<action:\w+>/<id>' => '<module>/admin/default/<action>',
            // '<module:\w+>' => '<module>/default/index',
            // '<module:\w+>/<action:\w+>' => '<module>/default/<action>',
            //'<module:\w+>/<action:\w+>/<id>' => '<module>/default/<action>',
        ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
