<?php

use hyii\console\Application;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'hyii-console',
    'name' => "HYii Console",
    'version' => '0.1',
    'basePath' => dirname(__DIR__),
    'class' => Application::class,
    'bootstrap' => ['log'],
    'controllerNamespace' => 'hyii\console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'db' => $db,
    ],
    'params' => $params,
];

return $config;
