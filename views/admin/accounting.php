<?php

$pages = ["invoice", "receipt"];
$page = ($routes[3] != '') ? ((in_array($routes[3], $pages)) ? $routes[3] : "invoice") : "404";
require_once "views/admin/accounting/$page.php";
