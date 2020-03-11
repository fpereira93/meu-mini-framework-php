<?php namespace Classes;

use Throwable;

class Route {

    const POST = 'POST';
    const GET = 'GET';

    private static $routes = array();

    /**
     * Populate a list of routes
     *
     * @param String $route
     * @param array $data
     * @param String $method
     * @return Route::class
     */
    private static function set(String $route, array $data, String $method)
    {
        [$class, $function] = explode("@", $data['action']);

        self::$routes[] = [
            'route' => $route,
            'class' => $class,
            'function' => $function,
            'method' => $method,
            'alias' => $data['as'],
        ];

        return __CLASS__;
    }

    /**
     * create a simple default response_array
     *
     * @param array $response
     * @return void
     */
    public static function response_array(array $response)
    {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    /**
     * call a route with paramns
     *
     * @param [type] $route_data
     * @param array $params
     * @return void
     */
    private static function callRoute($route_data = null, array $params = [])
    {
        if (!$route_data || $route_data['class'] == null){
            http_response_code(404);
        } else {
            try {
                $controller_instance = new $route_data['class'];
    
                if ($route_data['method'] == self::POST){
                    $response = call_user_func_array([$controller_instance, $route_data['function']], array($params));
                } else {
                    $response = call_user_func_array([$controller_instance, $route_data['function']], $params);
                }
    
                if (is_array($response)){
                    self::response_array($response, 200);
                }
            } catch (Throwable $th) {
                http_response_code(500);
            }
        }
    }

    /**
     * check actual route access
     *
     * @return void
     */
    public static function run()
    {
        $route_parsed = parse_url($_SERVER['REQUEST_URI']);

        $route_data = current(array_filter(self::$routes, function($route) use ($route_parsed){
            return $route['route'] == $route_parsed['path'] && $route['method'] == $_SERVER['REQUEST_METHOD'];
        }));

        $contents = file_get_contents('php://input');
        $params = $contents ? json_decode($contents, true) : [];

        self::callRoute($route_data, $params);
    }

    /**
     * get a url with pass the alias name
     *
     * @param String $alias
     * @return void
     */
    public static function url(String $alias)
    {
        $route_data = current(array_filter(self::$routes, function($route) use ($alias){
            return $route['alias'] == $alias;
        }));

        if ($route_data){
            return $route_data['route'];
        }

        return null;
    }

    /**
     * populate a method type GET
     *
     * @param String $route
     * @param array $data
     * @return void
     */
    public static function get(String $route , array $data)
    {
        return self::set($route, $data, self::GET);
    }

    /**
     * populate a method type POST
     *
     * @param String $route
     * @param array $data
     * @return void
     */
    public static function post(String $route , array $data)
    {
        return self::set($route, $data, self::POST);
    }
}
