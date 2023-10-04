<?php

namespace Aghabalaguluzade\bootstrap;

class Route
{
    public static array $routes = [];
    public static bool $hasRoute = false;

    public static function get($path,$callback) {
        self::$routes['get'][$path] = $callback;
    }

    public static function post($path,$callback) {
        self::$routes['post'][$path] = $callback;
    }

    public static function dispatch() {
        $method = self::getMethod();
        $url = self::getUrl();
        foreach(self::$routes[$method] as $path => $callback) {
            $pattern = '#^' . $path . '$#';
            if(preg_match($pattern, $url)) {
                self::$hasRoute = true;
                if(is_callable($callback)) {
                    echo $callback();
                }elseif(is_string($callback)) {
                    [$controllerName, $methodName] = explode('@', $callback);
                    echo $controllerName . PHP_EOL . $methodName;
                }
            }
        }
        self::checkRoute();
    }

    public static function checkRoute() {
        if(self::$hasRoute === false) {
            die('404');
        }
    }

    public static function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function getUrl() {
        return str_replace(getenv('BASE_PATH'), '', $_SERVER['REQUEST_URI']);
    }

}