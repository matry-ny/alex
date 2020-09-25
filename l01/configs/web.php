<?php

use app\library\Config;

return [
    Config::CONTROLLERS_NAMESPACE => 'app\\web\\controllers\\',
    Config::COMPONENTS => [
        'db' => require __DIR__ . '/db.php',
        'template' => [
            'viewsDir' => __DIR__ . '/../web/views/',
            'layout' => 'layouts/general',
            'extension' => '.php'
        ],
    ]
];
