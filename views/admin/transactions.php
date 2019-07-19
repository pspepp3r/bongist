<?php

$pages = array("payments", "expenses");
if($routes[3] != '')
{
    if(in_array($routes[3], $pages))
    {
        $page = $routes[3];
    }else {

        $page = "payments";
    }
}else {
    $page = "404";
}
require('views/admin/transactions/'. $page .'.php');
