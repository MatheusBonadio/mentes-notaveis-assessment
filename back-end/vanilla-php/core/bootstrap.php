<?php

use App\Core\Application;
use App\Core\Database\Connection;
use App\Core\Database\QueryBuilder;

Application::bind('config', require 'config.php');

try {
    Application::bind(
        'database',
        new QueryBuilder(
            Connection::make(Application::get('config')['mysql'])
        )
    );
} catch (Exception $e) {
    die($e->getMessage());
}
