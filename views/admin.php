<?php

$pages = array("login", "password", "logout", "customers", "dashboard");

if ($routes[2] != 'admin') {

    if (in_array($routes[2], $pages)) {

        $page = $routes[2];

    } else {

        $page = '404';

    }

} else {
    $page = 'dashboard';
}

if ($page == 'login') {
    if (isset($_SESSION['logged_staff'])) {
        $page = 'dashboard';
    }
    require('views/admin/'.$page.'.php');
} else{

    if (!isset($_SESSION['logged_staff'])) {
        $page = 'login';
    }else{
      $email = $_SESSION['logged_staff'];
        $account = $db->query("SELECT * FROM staff WHERE email = :email", array('email' => $email), false);

        if ($account) {
            $staff_id = $account['id'];
//            $staff_role = $account['role'];
        }else{
            unset($_SESSION['logged_staff']);
            $page = 'login';
        }
    }


    if ($page == 'login' || $page == '404') {
        require('views/admin/'.$page.'.php');
    }else {
        require('views/admin/partials/header.php');
        require('views/admin/'.$page.'.php');
        require('views/admin/partials/footer.php');
    }
}
