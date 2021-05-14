<?php

return [
    // Component class namespace
    'class' => 'common\components\WSAMaintenanceMode',
    // Page title
    'title' => 'Manutenção',
    // Mode status
    'enabled' => false,
    // Route to action
    'route' => 'maintenance/index',
    // Show title
    'title' => 'Aplicação em manutenção',
    // Show message
    'message' => 'Desculpe-nos o transtorno, estamos trabalhando para melhor atende-los.',
    // HTTP Status Code
    'statusCode' => 503,
];