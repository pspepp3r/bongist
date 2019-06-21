<?php

class route {

    /*
    The following function will strip the script name from URL i.e.  http://www.something.com/search/book/fitzgerald will become /search/book/fitzgerald
    */

    function __construct() {
        if (self::isRouteValid()) {

            $routes = self::isRouteValid();

            if ($routes[2] != '' && $routes[2] != $routes[1]) {

                $route = array(
                    "controller" => $routes[1],
                    "method" => $routes[2]
                );

            }else {

                $route = array(
                    "controller" => $routes[1]
                );

            }

            controller::set($route);

        }else {
            respond::json(404, 'Request controller not found', null);
        }
    }

    public static function isRouteValid() {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        $url = '/' . trim($uri, '/');

        $routes = array();
        $routes = explode('/', $url);
        foreach($routes as $route)
        {
            if(trim($route) != '')
                array_push($routes, $route);
        }

        if($routes[1] != ''){
            $requests = $GLOBALS['config']['routes'];

            if(in_array($routes[1], $requests)){

                return $routes;


            }else{

                return false;



            }

        }else{
            return false;
        }



    }


    /*
    Now, $routes will contain all the routes. $routes[0] will correspond to first route. For e.g. in above example $routes[0] is search, $routes[1] is book and $routes[2] is fitzgerald
    */
}
