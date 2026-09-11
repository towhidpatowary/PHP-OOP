<?php
namespace Core;

abstract class Router
{
    private static array $routes = [];

    public static function get(string $url, array | callable $controlllerMethods) {
        self::$routes['GET'][$url] = $controlllerMethods;
    }

    public static function post(string $url, array | callable $controlllerMethods) {
        self::$routes['POST'][$url] = $controlllerMethods;
    }

    public static function matchRoute(string $pattern, string $url, &$params) {
        $params = [];

        $patternParts = explode('/', trim($pattern, '/'));
        $urlParts = explode('/', trim($url, '/'));

        if (count($patternParts) !== count($urlParts)) {
            return false;
        }

        foreach ($patternParts as $index => $part) {
            if (str_starts_with($part, '{') && str_ends_with($part, '}')) {
                $key = trim($part, '{}');

                $params[$key] = $urlParts[$index];
            } else if ($part !== $urlParts[$index]) {
                return false;
            }
        }

        return true;
    }

    public static function dispatch(Container $container, string $request_method, string $url) {
        if (isset(self::$routes[$request_method][$url]) && is_callable(self::$routes[$request_method][$url])) {
            call_user_func(self::$routes[$request_method][$url]);
            exit;
        }

        foreach (self::$routes[$request_method] as $pattern => $handler) {

            $params = [];

            if (self::matchRoute($pattern, $url, $params)) {

                [$controller, $method] = $handler;

                $instance = $container->get($controller);
                $arguments = $container->resolveMethodArguments($instance, $method, $params); // resolve all the arguments for the method

                // call the method
                $instance->$method(...array_values($arguments));

                return;
            }
        }

        return view("errors/NotFound");
    }
}


?>