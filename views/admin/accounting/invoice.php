<?php

$pages = ["all", "edit", "view"];
$page = ($routes[4] != '') ? ((in_array($routes[4], $pages)) ? $routes[4] : "all") : "404";
require_once "views/admin/accounting/invoice/$page.php";
