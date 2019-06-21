<?php

if ($routes[2] == 'orders' AND $routes[3] != 'account') {
    $order_id = $routes[3];
    $order = user::order($order_id);

    if (!$order) {
        header('location: ../../account/orders');
    }else {
        $id = $order['id'];
        $view = 'single';
    }

}else {
    $view = 'all';
}

?>
<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Orders</li>
        </ol>
        <!-- Hero Content-->
        <?php
        if ($view == 'all') {
            ?>
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading">Your orders</h1>
            <div class="row">
                <div class="col-xl-8 offset-xl-2"><p class="lead">Your orders in one place.</p></div>
            </div>
        </div>
        <?php
        }else {
            ?>
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading">Order Details</h1>
            <div class="row">
                <div class="col-xl-8 offset-xl-2"><p class="lead text-dark">ORDER ID: <?php echo $order_id; ?></p></div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">


            <div class="col-lg-8 col-xl-9">
                <?php require 'views/account/orders/'.$view.'.php'; ?>
            </div>

            <?php require 'views/account/layout/sidebar.php'; ?>

        </div>
    </div>
</section>