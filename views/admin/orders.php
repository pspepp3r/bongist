<?php

$order_id = $routes[3];

if ($routes[3] == 'admin') {
  $page = 'all';
}else {

  $check = order::check_status($order_id);



}
