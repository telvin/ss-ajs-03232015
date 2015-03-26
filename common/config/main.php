<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['gii'],
    'modules' => [
        'gii' => 'yii\gii\Module',
        // ...
    ],
    'language' => 'vi-VD',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ]
    ],
];
