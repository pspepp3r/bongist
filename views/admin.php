<?php

$pages = ["login", "reset-password", "logout", "orders", "customers", "dashboard", "staff", "transactions", "activities", "account", "accounting"];

$page = ($routes[2] != 'admin') ? ((in_array($routes[2], $pages)) ? $routes[2] : 'dashboard') : 'dashboard';

if ($page == 'login' || $page == 'reset-password') {
    if (isset($_SESSION['logged_staff'])) {
        $page = 'dashboard';
    }

    $email = $_SESSION['logged_staff'];
    $account = $db->query("SELECT * FROM staff WHERE email = :email", array('email' => $email), false);

    if ($account) {
        $staff_id = $account['id'];
        $role = $account['role'];
        $name = $account['name'];
    } else {
        unset($_SESSION['logged_staff']);
        $page = 'login';
    }

    require_once 'views/admin/partials/header.php';
    require_once "views/admin/$page.php";
    require_once 'views/admin/partials/footer.php';
    
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
        require_once "views/admin/$page.php";
    }else {
        require_once 'views/admin/partials/header.php';
        require_once "views/admin/$page.php";
        require_once 'views/admin/partials/footer.php';
    }
}
