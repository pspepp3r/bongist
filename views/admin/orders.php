<?php

$type = $routes[3];
$status = $routes[4];

switch ($routes[3]) {
  case 'admin':
    $page = 'all';
    break;
  default:
    $check = order::check_status($status);

    if ($check) {
      $page = 'status';
    } else {
      $order_id = $routes[3];
      $ordered = order::details($order_id);
      if (!$ordered) {
        header('location: admin/orders');
        return false;
      }
      $page = 'details';

    }
    break;
}



require_once "views/admin/orders/$page.php";
