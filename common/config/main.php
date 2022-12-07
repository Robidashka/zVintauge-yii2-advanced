<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'request' => [
            'cookieValidationKey' => '',
            'enableCsrfValidation' => false,
        ], 
    ],
    'modules' => [
        'files' => [
            'class' => 'floor12\files\Module',
            'storage' => '@frontend/storage',
            'cache' => '@frontend/storage_cache',
            'token_salt' => 'jhfy6tjr7i6tit',
        ],
    ],
];
