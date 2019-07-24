<?php

$type = $routes[3];
$status = $routes[4];

if ($routes[3] == 'admin') {
  $page = 'all';
}else {

  $check = order::check_status($status);

  if ($check) {
    $page = 'status';
  }else {
    $order_id = $routes[3];
    $ordered = order::details($order_id);
    if (!$ordered) {
      header('location: admin/orders');
      return false;
    }
    $page = 'details';

  }

}



require('views/admin/orders/'. $page .'.php');
