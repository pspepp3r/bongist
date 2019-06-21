<?php
$account = user::check($email);
?><!-- Customer Sidebar-->
<div class="col-xl-3 col-lg-4 mb-5">
    <div class="customer-sidebar card border-0">
        <div class="customer-profile"><a href="account/profile" class="d-inline-block">
                <img src="<?php echo config::baseUploadProfileUrl().$account['photo']; ?>" class="img-fluid rounded-circle customer-image" style="height: 150px; width: 150px; object-fit: cover;">
            </a>
            <h5><?php echo $account['fname'].' '.$account['lname']; ?></h5>
            <?php

            if ($account['country'] != '') {
                ?>
                <p class="text-muted text-sm mb-0"><?php echo $account['country']; ?>, <?php echo $account['state']; ?></p>
            <?php
            }

            ?>
        </div>
        <nav class="list-group customer-nav">
            <a href="account/orders" class="list-group-item d-flex justify-content-between align-items-center <?php
            if ($page == 'orders') {
                echo 'active';
            }
            ?>"><span>
                    <svg class="svg-icon svg-icon-heavy mr-2">
                      <use xlink:href="#paper-bag-1"> </use>
                    </svg>Orders</span>
                <div class="badge badge-pill badge-light font-weight-normal px-3"><?php

                    $orders = user::orders($account['id']);
                    echo count($orders);

                    ?></div></a>
            <a href="account/profile" class="list-group-item d-flex justify-content-between align-items-center <?php
            if ($page == 'profile') {
                echo 'active';
            }
            ?>"><span>
                    <svg class="svg-icon svg-icon-heavy mr-2">
                      <use xlink:href="#male-user-1"> </use>
                    </svg>Profile</span></a>
            <a href="account/address" class="list-group-item d-flex justify-content-between align-items-center <?php
            if ($page == 'address') {
                echo 'active';
            }
            ?>"><span>
                    <svg class="svg-icon svg-icon-heavy mr-2">
                      <use xlink:href="#navigation-map-1"> </use>
                    </svg>Address</span></a>
            <a href="account/logout" class="list-group-item d-flex justify-content-between align-items-center"><span>
                    <svg class="svg-icon svg-icon-heavy mr-2">
                      <use xlink:href="#exit-1"> </use>
                    </svg>Log out</span></a>
        </nav>
    </div>
</div>
<!-- /Customer Sidebar-->