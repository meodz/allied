<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'vi',
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'i18n' => array(
            'translations' => array(
                'eauth' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@eauth/messages',
                ),
                'frontend' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    // 'sourceLanguage' => 'vi',
                    'fileMap' => [
                        'frontend' => 'main.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ),
        ),
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'UTC',
            'timeZone' => 'Asia/Bangkok',
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'currencyCode' => 'VNĐ',
        ]
    ],
];
