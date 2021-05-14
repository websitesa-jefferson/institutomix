<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'institutomix',
    'name' => 'Instituto Mix',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'institutomix\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => mdm\admin\Module::className(),
            'controllerMap' => [
                'menu' => 'institutomix\modules\admin\controllers\MenuController',
                'user' => 'institutomix\modules\admin\controllers\UserController',
                'role' => 'institutomix\modules\admin\controllers\RoleController',
                'rule' => 'institutomix\modules\admin\controllers\RuleController',
                'route' => 'institutomix\modules\admin\controllers\RouteController',
                'parametro' => 'institutomix\modules\admin\controllers\ParametroController',
                'permission' => 'institutomix\modules\admin\controllers\PermissionController',
                'assignment' => 'institutomix\modules\admin\controllers\AssignmentController',
            ]
        ],
        'cadastro' => 'institutomix\modules\cadastro\Module',
        'gridview' => '\kartik\grid\Module',
        'datecontrol' => require(__DIR__ . '/../../common/config/datecontrol.php'),
    ],
    'components' => [
        'assetManager' => [
            'forceCopy' => true,
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=db;dbname=institutomix',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'attributes' => [
                PDO::MYSQL_ATTR_LOCAL_INFILE => true
            ],
        ],
        'request' => [
            'cookieValidationKey' => '-sqOI0mlTYB8d2qDwkdnu-UudBJQaNwz',
            'csrfParam' => '_csrf-institutomix',
        ],
        'session' => [
            'name' => 'institutomix',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 1800, // 20 minutes
            'identityCookie' => ['name' => '_identity-institutomix', 'httpOnly' => true],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
//                [
//                    'class' => 'yii\log\EmailTarget',
//                    'levels' => ['error'],
//                    'message' => [
//                        'from' => ['xxxx@xxxx.com'],
//                        'to' => ['xxxxxx@xxxx.com'],
//                        'subject' => 'LOG Instituto Mix',
//                    ],
//                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['autenticado', 'convidado'],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
    'params' => $params,
    'container' => [
        'singletons' => require(__DIR__ . '/di-services.php'),
        'definitions' => require(__DIR__ . '/di-widgets.php')
    ],
];
