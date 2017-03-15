<?php
return [
    'settings' => [
        'displayErrorDetails'   => true,
        // 'db'                    => ['url' => 'pdo_mysql://root:toor@localhost/laptop',],
        'db' => [
            'user' => 'root',
            'pass' => 'toor',
            'host' => 'localhost',
            'port' => '',
            'name' => 'laptop',
        ],
        'view' => [
            'view_path' => __DIR__ . "/../views/",
            'twig'      => [
                'cache'         => false,
                'debug'         => true,
                'auto_reload'   => true,
             ],
        ],
        'lang' => [
            'default' => 'id',
        ],
    ]
];
