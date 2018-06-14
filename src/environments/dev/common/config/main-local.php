<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=allied',
            'username' => 'root',
            'password' => 'matkhau',
            'charset' => 'utf8',
            'enableSchemaCache' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ]
    ],
];
