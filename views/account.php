<?php

$pages = array("login", "reset-password", "logout", "orders", "profile");

if ($routes[2] != 'account') {

    if (in_array($routes[2], $pages)) {

        $page = $routes[2];

    } else {

        $page = 'orders';

    }

} else {
    $page = 'orders';
}

if ($page == 'login' || $page == 'reset-password') {
    if (isset($_SESSION['logged_staff'])) {
        $page = 'orders';
    }
    require('views/account/'.$page.'.php');
} else{

    if (!isset($_SESSION['logged_staff'])) {
        $page = 'login';
    }else{
      $email = $_SESSION['logged_staff'];
        $account = $db->query("SELECT * FROM staff WHERE email = :email", array('email' => $email), false);

        if ($account) {
            $staff_id = $account['id'];
            $role = $account['role'];
            $name = $account['name'];
        }else{
            unset($_SESSION['logged_staff']);
            $page = 'login';
        }
    }


    if ($page == 'login' || $page == 'reset-password') {
        require('views/account/'.$page.'.php');
    }else {
        require('views/account/partials/header.php');
        require('views/account/'.$page.'.php');
        require('views/account/partials/footer.php');
    }
}
