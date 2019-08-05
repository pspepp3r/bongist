<nav class="bg-gray-200">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Breadcrumb -->
                <ol class="breadcrumb breadcrumb-scroll">
                    <li class="breadcrumb-item">
                        <?= $customer_name; ?>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Account
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?= ucfirst($page) . ' Orders'; ?>
                    </li>
                </ol>

            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</nav>
<?php
$notify = customer::editnotify($customer_id);

if($notify)
{
    $address = $notify['address'];

    if($address == null)
    {
        $url = '<a href="edit">Here</a>';
        respond::alert('success', '', 'Please complete your setup ' .$url);
    }
}
?>
<section class="pt-6 pt-md-8 pb-8 mb-md-8">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="row mb-6 mb-md-8">
                    <div class="col-auto">

                        <!-- Icon -->
<!--                        <div class="icon-circle bg-primary text-white">-->
<!--                            <i class="fe fe-users"></i>-->
<!--                            <img src="--><?//= config::baseUploadProfileUrl() . $customer_photo; ?><!--" alt="">-->
<!--                        </div>-->
                        <img class="img-fluid rounded-circle mb-3" src="<?= config::baseUploadProfileUrlTwo() . $customer_photo; ?>" alt="Image description" style="width: 70px; height: 70px; object-fit: cover;">

                    </div>
                    <div class="col ml-n4">

                        <!-- Heading -->
                        <h2 class="font-weight-bold mb-0">
                            <?= $customer_name; ?>
                        </h2>

                        <!-- Text -->
                        <p class="font-size-lg text-grey-500 mb-0">
                            <?= $customer_address; ?>
                        </p>

                    </div>
                </div> <!-- / .row -->

                <!-- Categories -->
                <div class="row">
                    <?php
                    $orders = order::customer_orders($customer_id);

                    if($orders)
                    {
                        foreach($orders as $order)
                        {
                            $order_id = $order['order_id'];
                            $status = $order['status_name'];
                            $status_id = $order['status'];
                            $type = $order['type'];
                            $type_id = $order['type_id'];
                            $category = $order['category'];
                            $amount = $order['cost'];
                            $timestamp = $order['timestamp'];
                            if($status_id == 1)
                            {
                                ?>
                                <div class="col-12 col-md-6 col-lg-4" style="margin-top: 20px;">

                                    <!-- Card -->
                                    <div class="card card-border border-primary shadow-lg mb-6 mb-md-8 mb-lg-0 lift lift-lg">
                                        <div class="card-body text-center">

                                            <?php
                                            $payments = order::order_payment($order_id);

                                            foreach($payments as $payment)
                                            {
                                                if($payment['SUM(amount)'] == $amount)
                                                {
                                                    ?>
                                                    <!-- Icon -->
                                                    <div class="icon-circle bg-success text-white mb-5">
                                                        <i class="fe fe-check"></i>
                                                    </div>
                                                    <?php
                                                }else {
                                                    ?>
                                                    <!-- Icon -->
                                                    <div class="icon-circle bg-primary text-white mb-5">
                                                        <i class="fe fe-more-horizontal"></i>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <br>

                                            <!-- Heading -->
                                            <button class="font-weight-bold  btn-pill btn-sm btn btn-primary-soft" style="text-transform: uppercase; margin-bottom: 10px;">
                                                <?= $order_id; ?>
                                            </button>
                                            <br>
                                            <div>
                                                <p class="text-gray-700">
                                                    Status: <span class="badge badge-primary-soft"><?= $status; ?></span>
                                                </p>
                                               <!-- Text -->
                                               <p class="text-gray-700 mb-5">
                                                   Amount: <?= '₦' . number_format($amount); ?>
                                               </p>
                                                <?php
                                                $payments = order::order_payment($order_id);
                                                    foreach($payments as $payment)
                                                    {
                                                        $total = $payment['SUM(amount)'];

                                                        if($total > 0)
                                                        {
                                                            ?>
                                                            <!-- Text -->
                                                            <p class="text-gray-700" style="margin-top: -25px;">
                                                                Paid: <?= '₦' . number_format($total); ?>
                                                            </p>
                                                            <?php
                                                        }else {
                                                            ?>
                                                            <!-- Text -->
                                                            <p class="text-danger" style="margin-top: -25px;">
                                                                No payment(s) made
                                                            </p>
                                                            <?php
                                                        }
                                                    ?>
                                                   <?php
                                                    }
                                                ?>
                                                <!-- Text -->
                                                <p class="text-gray-700 mb-5">
                                                    Added&nbsp;<?= request::timeago($timestamp); ?>
                                                </p>
                                            </div>

                                            <!-- Badge -->
                                            <?php
                                            if($type_id == 1)
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-success-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }elseif($type_id == 2)
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-info-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-primary-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }
                                            ?>

                                            <!-- Badge -->
                                            <span class="badge badge-pill badge-dark-soft">
                                              <span class="h6 text-uppercase">
                                                <?= $category; ?>
                                              </span>
                                            </span>

                                        </div>
                                    </div>

                                </div>
                    <?php
                            }elseif($status_id == 2)
                            {
                                ?>
                                <div class="col-12 col-md-6 col-lg-4" style="margin-top: 20px;">

                                    <!-- Card -->
                                    <div class="card card-border border-info shadow-lg mb-6 mb-md-8 mb-lg-0 lift lift-lg">
                                        <div class="card-body text-center">

                                            <?php
                                            $payments = order::order_payment($order_id);

                                            foreach($payments as $payment)
                                            {
                                                if($payment['SUM(amount)'] == $amount)
                                                {
                                                    ?>
                                                    <!-- Icon -->
                                                    <div class="icon-circle bg-success text-white mb-5">
                                                        <i class="fe fe-check"></i>
                                                    </div>
                                                    <?php
                                                }else {
                                                    ?>
                                                    <!-- Icon -->
                                                    <div class="icon-circle bg-primary text-white mb-5">
                                                        <i class="fe fe-more-horizontal"></i>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <br>

                                            <!-- Heading -->
                                            <button class="font-weight-bold  btn-pill btn-sm btn btn-info-soft" style="text-transform: uppercase; margin-bottom: 10px;">
                                                <?= $order_id; ?>
                                            </button>
                                            <br>
                                            <div>
                                                <p class="text-gray-700">
                                                    Status: <span class="badge badge-info-soft"><?= $status; ?></span>
                                                </p>
                                                <!-- Text -->
                                                <p class="text-gray-700 mb-5">
                                                    Amount: <?= '₦' . number_format($amount); ?>
                                                </p>
                                                <?php
                                                $payments = order::order_payment($order_id);
                                                foreach($payments as $payment)
                                                {
                                                    $total = $payment['SUM(amount)'];

                                                    if($total > 0)
                                                    {
                                                        ?>
                                                        <!-- Text -->
                                                        <p class="text-gray-700" style="margin-top: -25px;">
                                                            Paid: <?= '₦' . number_format($total); ?>
                                                        </p>
                                                        <?php
                                                    }else {
                                                        ?>
                                                        <!-- Text -->
                                                        <p class="text-danger" style="margin-top: -25px;">
                                                            No payment(s) made
                                                        </p>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                                ?>
                                                <!-- Text -->
                                                <p class="text-gray-700 mb-5">
                                                    Added&nbsp;<?= request::timeago($timestamp); ?>
                                                </p>
                                            </div>

                                            <!-- Badge -->
                                            <?php
                                            if($type_id == 1)
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-success-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }elseif($type_id == 2)
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-info-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-primary-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }
                                            ?>

                                            <!-- Badge -->
                                            <span class="badge badge-pill badge-dark-soft">
                                              <span class="h6 text-uppercase">
                                                <?= $category; ?>
                                              </span>
                                            </span>

                                        </div>
                                    </div>

                                </div>
                    <?php
                            }elseif($status_id == 3)
                            {
                                ?>
                                <div class="col-12 col-md-6 col-lg-4" style="margin-top: 20px;">

                                    <!-- Card -->
                                    <div class="card card-border border-secondary shadow-lg mb-6 mb-md-8 mb-lg-0 lift lift-lg">
                                        <div class="card-body text-center">

                                            <?php
                                            $payments = order::order_payment($order_id);

                                            foreach($payments as $payment)
                                            {
                                                if($payment['SUM(amount)'] == $amount)
                                                {
                                                    ?>
                                                    <!-- Icon -->
                                                    <div class="icon-circle bg-success text-white mb-5">
                                                        <i class="fe fe-check"></i>
                                                    </div>
                                                    <?php
                                                }else {
                                                    ?>
                                                    <!-- Icon -->
                                                    <div class="icon-circle bg-secondary text-white mb-5">
                                                        <i class="fe fe-more-horizontal"></i>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <br>

                                            <!-- Heading -->
                                            <button class="font-weight-bold  btn-pill btn-sm btn btn-secondary-soft" style="text-transform: uppercase; margin-bottom: 10px;">
                                                <?= $order_id; ?>
                                            </button>
                                            <br>
                                            <div>
                                                <p class="text-gray-700">
                                                    Status: <span class="badge badge-secondary-soft"><?= $status; ?></span>
                                                </p>
                                                <!-- Text -->
                                                <p class="text-gray-700 mb-5">
                                                    Amount: <?= '₦' . number_format($amount); ?>
                                                </p>
                                                <?php
                                                $payments = order::order_payment($order_id);
                                                foreach($payments as $payment)
                                                {
                                                    $total = $payment['SUM(amount)'];

                                                    if($total > 0)
                                                    {
                                                        ?>
                                                        <!-- Text -->
                                                        <p class="text-gray-700" style="margin-top: -25px;">
                                                            Paid: <?= '₦' . number_format($total); ?>
                                                        </p>
                                                        <?php
                                                    }else {
                                                        ?>
                                                        <!-- Text -->
                                                        <p class="text-danger" style="margin-top: -25px;">
                                                            No payment(s) made
                                                        </p>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                                ?>
                                                <!-- Text -->
                                                <p class="text-gray-700 mb-5">
                                                    Added&nbsp;<?= request::timeago($timestamp); ?>
                                                </p>
                                            </div>

                                            <!-- Badge -->
                                            <?php
                                            if($type_id == 1)
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-success-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }elseif($type_id == 2)
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-info-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-primary-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }
                                            ?>

                                            <!-- Badge -->
                                            <span class="badge badge-pill badge-dark-soft">
                                              <span class="h6 text-uppercase">
                                                <?= $category; ?>
                                              </span>
                                            </span>

                                        </div>
                                    </div>

                                </div>
                    <?php
                            }elseif($status_id == 4)
                            {
                                ?>
                                <div class="col-12 col-md-6 col-lg-4" style="margin-top: 20px;">

                                    <!-- Card -->
                                    <div class="card card-border border-warning shadow-lg mb-6 mb-md-8 mb-lg-0 lift lift-lg">
                                        <div class="card-body text-center">

                                            <?php
                                            $payments = order::order_payment($order_id);

                                            foreach($payments as $payment)
                                            {
                                                if($payment['SUM(amount)'] == $amount)
                                                {
                                                    ?>
                                                    <!-- Icon -->
                                                    <div class="icon-circle bg-success text-white mb-5">
                                                        <i class="fe fe-check"></i>
                                                    </div>
                                                    <?php
                                                }else {
                                                    ?>
                                                    <!-- Icon -->
                                                    <div class="icon-circle bg-warning text-white mb-5">
                                                        <i class="fe fe-more-horizontal"></i>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <br>

                                            <!-- Heading -->
                                            <button class="font-weight-bold  btn-pill btn-sm btn btn-warning-soft" style="text-transform: uppercase; margin-bottom: 10px;">
                                                <?= $order_id; ?>
                                            </button>
                                            <br>
                                            <div>
                                                <p class="text-gray-700">
                                                    Status: <span class="badge badge-warning-soft"><?= $status; ?></span>
                                                </p>
                                                <!-- Text -->
                                                <p class="text-gray-700 mb-5">
                                                    Amount: <?= '₦' . number_format($amount); ?>
                                                </p>
                                                <?php
                                                $payments = order::order_payment($order_id);
                                                foreach($payments as $payment)
                                                {
                                                    $total = $payment['SUM(amount)'];

                                                    if($total > 0)
                                                    {
                                                        ?>
                                                        <!-- Text -->
                                                        <p class="text-gray-700" style="margin-top: -25px;">
                                                            Paid: <?= '₦' . number_format($total); ?>
                                                        </p>
                                                        <?php
                                                    }else {
                                                        ?>
                                                        <!-- Text -->
                                                        <p class="text-danger" style="margin-top: -25px;">
                                                            No payment(s) made
                                                        </p>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                                ?>
                                                <!-- Text -->
                                                <p class="text-gray-700 mb-5">
                                                    Added&nbsp;<?= request::timeago($timestamp); ?>
                                                </p>
                                            </div>

                                            <!-- Badge -->
                                            <?php
                                            if($type_id == 1)
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-success-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }elseif($type_id == 2)
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-info-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-primary-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }
                                            ?>

                                            <!-- Badge -->
                                            <span class="badge badge-pill badge-dark-soft">
                                              <span class="h6 text-uppercase">
                                                <?= $category; ?>
                                              </span>
                                            </span>

                                        </div>
                                    </div>

                                </div>
                    <?php
                            }elseif($status_id == 5)
                            {
                                ?>
                                <div class="col-12 col-md-6 col-lg-4" style="margin-top: 20px;">

                                    <!-- Card -->
                                    <div class="card card-border border-success shadow-lg mb-6 mb-md-8 mb-lg-0 lift lift-lg">
                                        <div class="card-body text-center">

                                            <?php
                                            $payments = order::order_payment($order_id);

                                            foreach($payments as $payment)
                                            {
                                                if($payment['SUM(amount)'] == $amount)
                                                {
                                                    ?>
                                                    <!-- Icon -->
                                                    <div class="icon-circle bg-success text-white mb-5">
                                                        <i class="fe fe-check"></i>
                                                    </div>
                                                    <?php
                                                }else {
                                                    ?>
                                                    <!-- Icon -->
                                                    <div class="icon-circle bg-warning text-white mb-5">
                                                        <i class="fe fe-more-horizontal"></i>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <br>

                                            <!-- Heading -->
                                            <button class="font-weight-bold  btn-pill btn-sm btn btn-success-soft" style="text-transform: uppercase; margin-bottom: 10px;">
                                                <?= $order_id; ?>
                                            </button>
                                            <br>
                                            <div>
                                                <p class="text-gray-700">
                                                    Status: <span class="badge badge-success-soft"><?= $status; ?></span>
                                                </p>
                                                <!-- Text -->
                                                <p class="text-gray-700 mb-5">
                                                    Amount: <?= '₦' . number_format($amount); ?>
                                                </p>
                                                <?php
                                                $payments = order::order_payment($order_id);
                                                foreach($payments as $payment)
                                                {
                                                    $total = $payment['SUM(amount)'];

                                                    if($total > 0)
                                                    {
                                                        ?>
                                                        <!-- Text -->
                                                        <p class="text-gray-700" style="margin-top: -25px;">
                                                            Paid: <?= '₦' . number_format($total); ?>
                                                        </p>
                                                        <?php
                                                    }else {
                                                        ?>
                                                        <!-- Text -->
                                                        <p class="text-danger" style="margin-top: -25px;">
                                                            No payment(s) made
                                                        </p>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                }
                                                ?>
                                                <!-- Text -->
                                                <p class="text-gray-700 mb-5">
                                                    Added&nbsp;<?= request::timeago($timestamp); ?>
                                                </p>
                                            </div>

                                            <!-- Badge -->
                                            <?php
                                            if($type_id == 1)
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-success-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }elseif($type_id == 2)
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-info-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }else
                                            {
                                                ?>
                                                <span class="badge badge-pill badge-primary-soft">
                                                  <span class="h6 text-uppercase">
                                                    <?= $type; ?>
                                                  </span>
                                                </span>
                                                <?php
                                            }
                                            ?>

                                            <!-- Badge -->
                                            <span class="badge badge-pill badge-dark-soft">
                                              <span class="h6 text-uppercase">
                                                <?= $category; ?>
                                              </span>
                                            </span>

                                        </div>
                                    </div>

                                </div>
                    <?php
                            }
                        }
                    }
                    ?>
                </div> <!-- / .row -->

            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</section>

<!-- SHAPE
================================================== -->
<div class="position-relative">
    <div class="shape shape-bottom shape-fluid-x svg-shim text-gray-200">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"/>
        </svg>
    </div>
</div>