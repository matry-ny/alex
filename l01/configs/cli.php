<?php

use app\library\Config;

return [
    Config::CONTROLLERS_NAMESPACE => 'app\\cli\\controllers\\',
    Config::COMPONENTS => [
        'db' => require __DIR__ . '/db.php'
    ]
];
