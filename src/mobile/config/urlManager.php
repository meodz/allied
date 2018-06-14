<?php

return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'rules' => [
        'v1/<controller:\w+>/<action:\w+>.api' => 'version1/<controller>/<action>',
    ],
];
