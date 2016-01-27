<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '5o5sg3pm4ojUElhUb29NmnMtmrm_c-Gf',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'charset'=>'UTF8',
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'cartatar@gmail.com',
                'password' => 'Pi=3,1415',
                'port' => '587',
                'encryption' => 'tls',
                ],
        ],
        'response' => [
            'formatters' => [
                'pdf' => [
                    'class' => 'robregonm\pdf\PdfResponseFormatter',
                    'mode' => '', // Optional
                    'format' => 'A4',  // Optional but recommended. http://mpdf1.com/manual/index.php?tid=184
                    'defaultFontSize' => 8, // Optional
                    'defaultFont' => '', // Optional
                    'marginLeft' => 10, // Optional
                    'marginRight' => 10, // Optional
                    'marginTop' => 10, // Optional
                    'marginBottom' => 16, // Optional
                    'marginHeader' => 9, // Optional
                    'marginFooter' => 9, // Optional
                    'orientation' => 'Landscape', // optional. This value will be ignored if format is a string value.
                    'options' => [
                        // mPDF Variables
                        // 'fontdata' => [
                            // ... some fonts. http://mpdf1.com/manual/index.php?tid=454
                        // ]
                    ]
                ],
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'dbconta' => require(__DIR__ . '/db2.php'),
        'dbuser' => require(__DIR__ . '/db3.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '192.168.1.110', '192.168.1.*'],
    ];
}

return $config;
