<?php

return [
    // Component class namespace
    'class' => 'common\components\WSAMaintenanceMode',
    // Page title
    'title' => 'Manutenção',
    // Mode status
    'enabled' => true,
    // Route to action
    'route' => 'maintenance/index',
    // Show title
    'title' => 'Aplicação em manutenção',
    // Show message
    'message' => 'Desculpe-nos o transtorno, estamos trabalhando para melhor atende-los.',
    // Remove the project for maintenance
    'projects' => [
        'institutomix',
    ],
    // HTTP Status Code
    'statusCode' => 503,
];