<?php

$params = array_merge(
    require(__DIR__ . '/../../../common/config/params.php'),
    require(__DIR__ . '/../../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$controllerMap = require(__DIR__ . '/console-controller-map.php');

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'maintenanceMode'],
    'controllerMap' => $controllerMap,
    'controllerNamespace' => 'console\controllers',
    'components' => [
        'maintenanceMode' => require(__DIR__ . '/../../../common/config/maintenance.php'),
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
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['autenticado', 'convidado'],
        ],
    ],
    'params' => $params,
];
