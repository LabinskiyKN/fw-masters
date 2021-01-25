<?php

$query = rtrim($_SERVER['QUERY_STRING'], '/');


use vendor\core\Router;


define('WWW', __DIR__);
define('CORE', dirname(__DIR__) . "/vendor/core");
define('APP', dirname(__DIR__) . "/app");
define('ROOT', dirname(__DIR__));
define('LAYOUT', 'default');

require "../vendor/libs/functions.php";


spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if(is_file($file)){
        require_once($file);
    }
});


Router::add('^$', ["controller" => "main", "action" => "index"]);
Router::add('^(?P<controller>[a-z]+)/?(?P<action>[a-z]+)?$', []);

//debug(Router::getRoutes());

Router::dispatch($query);