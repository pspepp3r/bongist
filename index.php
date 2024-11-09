<?php
session_start();
ob_start();
error_reporting(E_ALL);
require "config/Db.class.php";

// Creates the instance
$db = new Db();


spl_autoload_register( function($class) {

    if (file_exists("controllers/{$class}.php")) {
        require_once "controllers/{$class}.php";
    } elseif (file_exists("helper/{$class}.php")) {
        require_once "helper/{$class}.php";
    }

});

//if($_SERVER["HTTPS"] != "on")
//{
//    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
//    exit();
//}


function getBaseUrl(){
    $protocol = isset($_SERVER['HTTPS']) ? (($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http") : 'http';
    // return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME).'/';
}

function getBaseFileSystem(){
    // return $_SERVER['DOCUMENT_ROOT'].pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME).'/';
    return realpath(dirname(__FILE__)).'/';
}



/*
The following function will strip the script name from URL i.e.  http://www.something.com/search/book/fitzgerald will become /search/book/fitzgerald
*/
function getCurrentUri()
{
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
    $uri = '/' . trim($uri, '/');
    return $uri;
}

$base_url = getCurrentUri();
$routes = [];
$routes = explode('/', $base_url);
foreach($routes as $route)
{
    if(trim($route) != '')
        array_push($routes, $route);
}

/*
Now, $routes will contain all the routes. $routes[0] will correspond to first route. For e.g. in above example $routes[0] is search, $routes[1] is book and $routes[2] is fitzgerald
*/

$pages = ["home", "admin", "account"];

$page = ($routes[1] != '') ? ((in_array($routes[1], $pages)) ? $routes[1] : '404') : 'home';

if($page == 'admin' || $page == 'account') {
    require_once "views/$page.php";
}else {
    require_once 'views/partials/header.php';
    require_once "views/$page.php";
    require_once 'views/partials/footer.php';
}




