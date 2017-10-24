<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            //'dsn' => 'mysql:dbname=autogem;host=192.168.1.69;port=3306',
            'dsn' => 'mysql:dbname=survey;host=localhost;port=3306',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
             'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.mailtrap.io',  // e.g. smtp.mandrillapp.com or smtp.gmail.com
             'username' => '91431c5400b988',
             'password' => '7649f1f905a833',
             'port' => '465', // Port 25 is a very common port too
             'encryption' => 'tls', // It is often used, check your provider or mail 
            ], 
        ],
    ],
];
