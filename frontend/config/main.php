<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'es', 
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //'homeUrl' => '/archivosGestion/gestionArchivosPdf/administrador',    
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            //'baseUrl' => '/archivosGestion/gestionArchivosPdf/administrador',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 3600, // auth expire
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
            'class' => 'yii\web\Session',
            'cookieParams' => ['httponly' => true, 'lifetime' => 3600 * 4],
        'timeout' => 60, //session expire
        'useCookies' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
         'i18n' => [

              'translations' => [

                    'app' => [
                                'class' => 'yii\i18n\PhpMessageSource',
                                'basePath' => '@common/messages',
                                'sourceLanguage' => 'en-US',
                                ],

                    'yii' => [
                                'class' => 'yii\i18n\PhpMessageSource',
                                'basePath' => '@common/messages',
                                 'sourceLanguage' => 'en-US',
                             ],
                   'yii2mod.rbac' => [
                                'class' => 'yii\i18n\PhpMessageSource',
                                'basePath' => '@common/messages',
                                'sourceLanguage' => 'en-US',
                ],
               ],
        ],
        
    ],
    'as access' => [

        'class' => yii2mod\rbac\filters\AccessControl::class,
        'allowActions' => [
            'site/*',
            'user/*', 
            //'admin/*', 
            //'rbac/*', 
            //'site/login',
            //'site/logout',
        ]

     ],
    'params' => $params,
];
