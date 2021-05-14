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
}

return $config;
