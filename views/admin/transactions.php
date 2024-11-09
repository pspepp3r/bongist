<?php

$pages = ["payments", "expenses"];
$page = ($routes[3] != '') ? ((in_array($routes[3], $pages)) ? $routes[3] : "payments") : "404";
require_once "views/admin/transactions/$page.php";
