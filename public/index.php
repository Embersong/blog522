<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

include __DIR__ . '/../vendor/autoload.php';
include __DIR__ . '/../config/app.php';
$routes = include ROOT_PATH . '/config/router.php';


function getLogger(): Logger
{
    static $log = null;
    if (is_null($log)) {
        $log = new Logger('name');
        $log->pushHandler(new StreamHandler(__DIR__ . '/../logs/app.log', Level::Debug));
    }
    return $log;
}

//ROUTER
$page = $_GET['page'] ?? 'index';

getLogger()->debug($page);

$controllerNameFunction = $routes[$page];


if (function_exists($controllerNameFunction)) {
    call_user_func($controllerNameFunction);
} else {
    http_response_code(404);
    die("Нет контроллера");
}




