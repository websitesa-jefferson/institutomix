<?php

use kartik\mpdf\Pdf;

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'pt-BR',
    'sourceLanguage' => 'pt-BR',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
//            'enableSwiftMailerLogging' => true,
//            'viewPath' => '@common/mail',
//            'htmlLayout' => false,
//            'textLayout' => false,
//            'useFileTransport' => true,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                    'host' => 'smtp.xxx.com',
//                    'username' => 'xxx@xxx.com',
//                    'password' => 'xxxxxxx',
//                    'port' => '587',
//                    'encryption' => 'tls',
//            //       'port' => '465',
//            //       'encryption' => 'ssl',
//            ],
//        ],
        'formatter' => [
            'dateFormat' => 'php:d/m/Y',
            'datetimeFormat' => 'php:d/m/Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'locale' => 'pt-BR',
            'defaultTimeZone' => 'America/Sao_Paulo',
            'thousandSeparator' => '.',
            'decimalSeparator' => ',',
//            'currencyCode' => 'R$ '
        ],
        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            // refer settings section for all configuration options
        ],
    ],
];
