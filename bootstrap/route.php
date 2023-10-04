<?php

namespace Aghabalaguluzade\bootstrap;

class Route
{
    public static array $routes = [];
    public static bool $hasRoute = false;
    public static array $patterns = [
        ':id' => '([0-9]+)',
        ':url' => '([0-9a-zA-Z-_]+)'
    ];

    public static function get($path,$callback): Route {
        self::$routes['get'][$path] = [
            'callback' => $callback
        ];
        return new self();
    }

    public static function post($path,$callback): void {
        self::$routes['post'][$path] = [
            'callback' => $callback
        ];
    }

    public static function dispatch() {
        $method = self::getMethod();
        $url = self::getUrl();

        foreach(self::$routes[$method] as $path => $payload) {

            $callback = $payload['callback'];

            foreach(self::$patterns as $key => $pattern) {
                $path = str_replace($key, $pattern, $path);
            }

            $pattern = '#^' . $path . '(/)?$#';
        
            if(preg_match($pattern, $url, $params)) {
                array_shift($params);
                self::$hasRoute = true;
            
                if(is_callable($callback)) {
                    
                    echo call_user_func_array($callback, $params);
                    
                }elseif(is_string($callback)) {

                    [$controllerName, $methodName] = explode('@', $callback);
                    $controllerName = 'Aghabalaguluzade\app\Http\Controllers\\' . $controllerName;
                    $controller = new $controllerName();
                    echo call_user_func_array([$controller, $methodName], $params);
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

    public static function getMethod(): string {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function getUrl(): string {
        return str_replace(getenv('BASE_PATH'), '', $_SERVER['REQUEST_URI']);
    }

    public function name($name): void {
        $key = array_key_last(self::$routes['get']);
        self::$routes['get'][$key]['name'] = $name;
    }

}