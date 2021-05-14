<?php

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['components']['log'] = [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ]
        ]
    ];
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['::1', '127.0.0.1', '172.*'],
    ];

    $config['modules']['gii'] = [
        'class' => 'common\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '172.*'],
        'generators' => [
            'controller' => [
                'class' => 'common\gii\templates\controller\Generator',
                'templates' => ['wsa' => '@common/gii/templates/controller/default']
            ],
            'crud' => [
                'class' => 'common\gii\templates\crud\Generator',
                'templates' => ['wsa' => '@common/gii/templates/crud/default']
            ],
            'form' => [
                'class' => 'yii\gii\generators\form\Generator',
                'templates' => ['wsa' => '@common/gii/templates/form']
            ],
            'model' => [
                'class' => 'common\gii\templates\model\Generator',
                'templates' => ['wsa' => '@common/gii/templates/model/default']
            ],
            'module' => [
                'class' => 'yii\gii\generators\module\Generator',
                'templates' => ['wsa' => '@common/gii/templates/module']
            ],
            'menu' => [
                'class' => 'common\gii\templates\menu\Generator',
                'templates' => ['wsa' => '@common/gii/templates/menu/default']
            ],
            'route' => [
                'class' => 'common\gii\templates\route\Generator',
                'templates' => ['wsa' => '@common/gii/templates/route/default']
            ],
            'rule' => [
                'class' => 'common\gii\templates\rule\Generator',
                'templates' => ['wsa' => '@common/gii/templates/rule/default']
            ],
            'user' => [
                'class' => 'common\gii\templates\user\Generator',
                'templates' => ['wsa' => '@common/gii/templates/user/default']
            ],
            'assignment' => [
                'class' => 'common\gii\templates\assignment\Generator',
                'templates' => ['wsa' => '@common/gii/templates/assignment/default']
            ],
            'migration' => [
                'class' => 'dee\gii\generators\migration\Generator',
                'templates' => ['wsa' => '@common/vendor/deesoft/yii2-gii/generators/migration/default']
            ],
        ],
    ];
}

return $config;
