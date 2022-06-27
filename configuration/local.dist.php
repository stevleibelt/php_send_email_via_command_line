<?php

return [
    'mailer'    => [
        'debug' => [
            //for symfony mail: @see: https://symfony.com/doc/current/mailer.html#handling-sending-failures
            'enabled'       => false,
            'log_to_file'   => false,   //if set to true, logging is done to file and not to cli
            'log_file_path' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data'
                . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . date('Ymd') . '.log'  //feel free to use a different format like >>Ymd_His<<
        ],
    ],
    'transporter'   => [
        //set the active transporter
        'active_transporter_class_name'     => Swift_SmtpTransport::class,
        //this are all supported arguments or optional settings for all supported transporters
        'list_of_transporter_to_arguments'  => [
            Swift_SendmailTransport::class => [
                'command'   => '/usr/lib/sendmail -t'
            ],
            Swift_SmtpTransport::class => [
                'hostname'  => '127.0.0.1',
                'port'      => 25
            ],
            //----symfony mail
            \Symfony\Component\Mailer\Transport\SendmailTransport::class => [
                'command'   => '/usr/lib/sendmail -t'
            ],
            Symfony\Component\Mailer\Transport\Smtp\SmtpTransport::class => [
                'dsn' => 'smtps://127.0.0.1'
            ]
        ]
    ]
];