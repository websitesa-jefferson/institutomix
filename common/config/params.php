<?php
return [
    'adminEmail' => 'webmaster@localhost',
    'supportEmail' => 'webmaster@localhost',
    'user.passwordResetTokenExpire' => 3600,
    'maskMoneyOptions' => [
        'prefix' => 'R$ ',
        'suffix' => '',
        'affixesStay' => true,
        'thousands' => '.',
        'decimal' => ',',
        'precision' => 2, 
        'allowZero' => false,
        'allowNegative' => false,
    ],
    'projects' => [
        'institutomix',
        'gii',
        'debug',
        'gridview',
    ],
];
