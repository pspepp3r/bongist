<?php

$pages = array("login", "reset-password", "logout", "orders", "profile", "signup", "edit", "password");

if ($routes[2] != 'account') {

    if (in_array($routes[2], $pages)) {

        $page = $routes[2];

    } else {

        $page = 'orders';

    }

} else {
    $page = 'orders';
}

if ($page == 'login' || $page == 'reset-password' || $page == 'signup') {
    if (isset($_SESSION['logged_customer'])) {
        $page = 'orders';
    }
    require_once "views/account/$page.php";
} else{

    if (!isset($_SESSION['logged_customer'])) {
        $page = 'login';
    }else{
      $email = $_SESSION['logged_customer'];
        $account = $db->query("SELECT * FROM customers WHERE email = :email", array('email' => $email), false);

        if ($account) {
            $customer_id = $account['id'];
            $customer_name = $account['customer_name'];
            $customer_email = $account['email'];
            $customer_photo = $account['photo'];
            $customer_address = $account['address'];
            $customer_phone = $account['phone'];
        }else{
            unset($_SESSION['logged_customer']);
            $page = 'login';
        }
    }


    if ($page == 'login' || $page == 'reset-password' || $page == 'signup') {
        require_once "views/account/$page.php";
    }else {
        require_once 'views/account/partials/header.php';
        require_once "views/account/$page.php";
        require_once 'views/account/partials/footer.php';
    }
}
