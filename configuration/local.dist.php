<?php

return [
    'mailer'    => [
        'debug' => [
            'enabled'       => false,
            'log_level'     => \Psr\Log\LogLevel::DEBUG,
            'log_to_file'   => false,   //if set to true, logging is done to file and not to cli
            'log_file_path' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . date('Ymd') . '.log'  //feel free to use a different format like >>Ymd_His<<
        ],
    ],
    'transporter'   => [
        //set the active transporter
        'active_transporter_class_name'     => \Symfony\Component\Mailer\Transport::class,
        //this are all supported arguments or optional settings for all supported transporters
        'list_of_transporter_to_arguments'  => [
            //@see:
            //  https://symfony.com/doc/current/mailer.html#transport-setup - 20220629T12:08:20
            //  https://doeken.org/blog/using-symfony-mailer-without-framework - 20220628T22:10:20
            \Symfony\Component\Mailer\Transport::class => [
                //test example
                'dsn'   => 'null://default'
                //sendmail example
                //'dsn'   => 'sendmail://default'
                //smtp example
                //'dsn'   => 'smtp://<username>:<password>@<smtp.example.com>:<port>'
            ],
            \Symfony\Component\Mailer\Transport\SendmailTransport::class => [
                'command'   => '/usr/lib/sendmail -t'
            ]
        ]
    ]
];