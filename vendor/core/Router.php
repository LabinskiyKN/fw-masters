<?php


namespace vendor\core;


class Router
{

    protected static $route = [];
    protected static $routes = [];

    public static function add($regexp, $route) {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes() {
        return self::$routes;
    }

    public static function getRoute() {
        return self::$route;
    }

    public static function matchRoute($url) {
        foreach(self::$routes as $pattern=>$route) {
            if(preg_match("#$pattern#i", $url, $matches)) {
                foreach($matches as $k => $v) {
                    if(is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if(!isset($route['action'])) {
                    $route['action'] = 'index';
                }
                // ---------------------------------------
                $route['controller'] = ucfirst(strtolower($route['controller']));
                $route['action'] = strtolower($route['action']);
                // ---------------------------------------
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url) {
        if(self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'];
            if(class_exists($controller)){
                $cObj = new $controller(self::$route);
                $action = self::$route['action'] . 'Action';
                if(method_exists($cObj, $action)) {
                    $cObj->$action();
                    $cObj->getView();
                } else {
                    echo "Method <b>$action</b> not found";
                }
            } else {
                echo "Controller <b>$controller</b> not found";
            }
        } else {
            http_response_code(404);
            include '404.html';
        }
    }

}

