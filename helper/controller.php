<?php

class controller {

    public static function set($route) {

        if (class_exists($route['controller'])) {

            $controller = new $route['controller']();

            if (isset($route['method'])) {
                if (method_exists($controller, $route['method'])) {
                    $controller::{$route['method']}();
                }else {
                    respond::json(404, 'Request method not found', null);
                }
            }else {
                $controller;
            }

        }else {
            respond::json(404, 'Request controller not found', null);
        }

    }

}
