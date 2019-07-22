<?php

$order_id = $routes[3];

if ($routes[3] == 'admin') {
  $page = 'all';
}else {

  $check = order::check_status($order_id);

  if ($check) {
    $page = 'status';
  }else {
    $ordered = order::details($order_id);
    if (!$ordered) {
      header('location: admin/orders');
      return false;
    }
    $page = 'details';

  }

}

require('views/admin/orders/'. $page .'.php');
