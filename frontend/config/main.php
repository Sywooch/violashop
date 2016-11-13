<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    
    'components' => [
        
        'deviceDetect' => [
            'class' => 'frontend\components\DeviceDetect'
        ],
        'request' => [
        'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'urlManager' => [
            'scriptUrl'=>'/index.php',
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                    '<controller:catalog>/index' => 'catalog/index',
                    '<controller:catalog>/search' => 'catalog/search',
                    '<controller:catalog>/all' => 'catalog/all',
                    '<controller:catalog>/special' => 'catalog/special',
                    '<controller:catalog>/<id:\w+>' => 'catalog/category',
                    '<controller:catalog>/product/<id:\d+>' => 'catalog/product',
                    '<controller:catalog>/<category:[a-zA-Z0-9_\-\.]+>/<subcategory:[a-zA-Z0-9_\-\.]+>' => 'catalog/subcategory',
                    '<controller:catalog>/<category:[a-zA-Z0-9_\-\.]+>/<subcategory:[a-zA-Z0-9_\-\.]+>/<id:\d+>' => 'catalog/product',
                    '<controller:catalog>/<category:[a-zA-Z0-9_\-\.]+>/<subcategory:[a-zA-Z0-9_\-\.]+>/<subsubcategory:[a-zA-Z0-9_\-\.]+>' => 'catalog/subsubcategory',
                    '<controller:catalog>/<category:[a-zA-Z0-9_\-\.]+>/<subcategory:[a-zA-Z0-9_\-\.]+>/<subsubcategory:[a-zA-Z0-9_\-\.]+>/<id:\d+>' => 'catalog/product',
                    
                
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ],
    
    ],
    'params' => $params,
];
