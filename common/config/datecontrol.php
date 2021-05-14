<?php

use kartik\datecontrol\Module;

return [
    'class' => 'kartik\datecontrol\Module',
    // definições de formato para a exibição de cada atributo de dados (UTI exemplo formato)
    'displaySettings' => [
        Module::FORMAT_DATE => 'dd/mm/yyyy',
        Module::FORMAT_TIME => 'HH:mm:ss a',
        Module::FORMAT_DATETIME => 'dd/mm/yyyy HH:mm:ss a', 
    ],
    // definições de formato para salvar cada atributo de dados (PHP exemplo formato)
    'saveSettings' => [
        Module::FORMAT_DATE => 'php:Y-m-d',
        Module::FORMAT_TIME => 'php:H:i:s',
        Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
    ],
    // definir o seu fuso horário de exibição
    'displayTimezone' => 'America/Sao_Paulo',
    // definir o seu fuso horário para a data salva em db
    'saveTimezone' => 'UTC',
    // automaticamente usar kartik \ Widgets para cada um dos formatos acima
    'autoWidget' => true,
    // utilizar a conversão de ajax para datas de processamento do formato de exibição para salvar formato.
    'ajaxConversion' => true,
    // configurações padrão para cada widget de kartik \ Widgets usado quando autoWidget é verdade
    'autoWidgetSettings' => [
        Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]],
        Module::FORMAT_DATETIME => [], // configurar se necessário
        Module::FORMAT_TIME => [], // configurar se necessário
    ],
    // configurações de widget personalizados que serão utilizados para processar a entrada de dados em vez de kartik \ widgets,
    // isso vai ser usado quando autoWidget é definida como false no módulo ou nível de widget.
    'widgetSettings' => [
        Module::FORMAT_DATE => [
            'class' => 'yii\jui\DatePicker', // example
            'options' => [
                'dateFormat' => 'php:d/m/Y',
                'options' => ['class'=>'form-control'],
            ]
        ]
    ]
];
