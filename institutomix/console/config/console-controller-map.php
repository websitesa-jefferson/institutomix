<?php

return [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => '@institutomix/migrations',
    ],
    'migrate-routes' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => '@institutomix/migrations/routes',
    ],
    'migrate-users' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => '@institutomix/migrations/users',
    ],
    'migrate-menus' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => '@institutomix/migrations/menus',
    ],
    'migrate-assignments' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => '@institutomix/migrations/assignments',
    ],
    'migrate-rules' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => '@institutomix/migrations/rules',
    ],
    'migrate-rbac' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => '@yii/rbac/migrations',
    ],
    'migrate-admin' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => '@mdm/admin/migrations',
    ],
    'migrate-datas' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => '@institutomix/migrations/datas',
    ],
];
