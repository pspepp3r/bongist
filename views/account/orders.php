<?php

    if ($routes[3] == 'account') {
        $page = 'all';
    }else {
        $order_id = $routes[3];
        $ordered = order::details($order_id);
        if (!$ordered) {
            header('location: account/orders');
            return false;
        }
        $page = 'single';
    }

    require('views/account/orders/'. $page .'.php');