<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dW5Mfd-07usKRTrX4fnZPs0mZTuL9_B4',
        ],
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

$config['components']['db'] = array(
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii-advanced',
    'username' => 'root',
    'password' => '1111',
    'charset' => 'utf8',
    // 'enableSchemaCache' => true,
    // 'schemaCacheDuration' => 3600,
);

return $config;
