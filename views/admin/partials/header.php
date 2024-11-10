<!DOCTYPE html>
<html lang="en" class="no-js">
  <!-- Head -->

  <head>
    <title><?php echo ucfirst($page) . ' | ' . config::name(); ?></title>

    <base href="<?php echo config::url(); ?>">
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <?php echo config::meta(); ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo config::favicon(); ?>" type="image/x-icon">

    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Components Vendor Styles -->
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">

    <!-- Theme Styles -->
    <link rel="stylesheet" href="assets/css/theme.css">

    <style>
      /* Custom Charts */
      .js-doughnut-chart {
        width: 70px !important;
        height: 70px !important;
      }

      /* Print View */
      @media print {
        body * {
          box-sizing: border-box;
          visibility: hidden;
        }

        .invoice_print,
        .invoice_print * {
          visibility: visible;
        }

        .invoice_print {
          position: relative;
          left: 0;
          top: 0;
          right: 0;
          bottom: 0;
          margin: auto;
          width: 80%;
          background: white;
          padding: 2px;
          font-size: 1.5em;
        }
      }
    </style>
  </head>
  <!-- End Head -->

  <body>
    <!-- Header (Topbar) -->
    <header class="u-header">
      <div class="u-header-left">
        <a class="u-header-logo" href="/">
          <img class="u-logo-desktop" src="<?php echo config::logo(); ?>" height="50"
            alt="<?php echo config::name(); ?>">
        </a>
      </div>

      <div class="u-header-middle">
        <a class="js-sidebar-invoker u-sidebar-invoker" href="#!" data-is-close-all-except-this="true"
          data-target="#sidebar">
          <i class="fa fa-bars u-sidebar-invoker__icon--open"></i>
          <i class="fa fa-times u-sidebar-invoker__icon--close"></i>
        </a>

        <div class="u-header-search" data-search-mobile-invoker="#headerSearchMobileInvoker"
          data-search-target="#headerSearch">
          <a id="headerSearchMobileInvoker" class="btn btn-link input-group-prepend u-header-search__mobile-invoker"
            href="#!">
            <i class="fa fa-search"></i>
          </a>

          <div id="headerSearch" class="u-header-search-form">
            <button class="btn btn-dark btn-block" data-target="#addOrderModal" data-toggle="modal"
              onclick="$('#addOrderModal').modal('show')">New Order</button>
          </div>
        </div>
      </div>

      <div class="u-header-right">

        <!-- Notifications -->
        <div class="dropdown mr-4">
          <a class="link-muted" href="#!" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false"
            data-toggle="dropdown">
            <span class="h3">
              <i class="far fa-bell"></i>
            </span>
            <span class="u-indicator u-indicator-top-right u-indicator--xxs bg-info"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right border-0 py-0 mt-4" aria-labelledby="dropdownMenuLink"
            style="width: 360px;">
            <div class="card">
              <div class="card-header d-flex align-items-center py-3">
                <h2 class="h4 card-header-title">Activities</h2>
              </div>

              <div class="card-body p-0">
                <div class="list-group list-group-flush">
                  <?php
                  $activities = activity::all();
                  foreach (array_slice($activities, 0, 5) as $activity) {
                    $category_id = $activity['category_id'];
                    $name = $activity['name'];
                    $order_id = $activity['order_id'];
                    $photo = $activity['photo'];
                    $comment = $activity['comment'];
                    ?>
                    <!-- Notification -->
                    <?php
                    if ($comment == config::noteActivity()) {
                      ?>
                      <a class="list-group-item list-group-item-action" href="admin/orders/<?= $order_id; ?>/details">
                        <div class="media align-items-center">
                          <?php
                          if (!empty($photo)) {
                            ?>
                            <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                              alt="Image description">
                            <?php
                          } else {
                            ?>
                            <img class="u-avatar rounded-circle mr-3"
                              src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                            <?php
                          }
                          ?>
                          <div class="media-body">
                            <div class="d-flex align-items-center">
                              <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New Note</span></h4>
                              <small class="text-muted ml-auto"><?= request::timeago($activity['timestamp']); ?></small>
                            </div>

                            <p class="text-truncate mb-0" style="max-width: 250px;">
                              <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                            </p>
                          </div>
                        </div>
                      </a>
                      <?php
                    } elseif ($comment == config::orderActivity()) {
                      ?>
                      <a class="list-group-item list-group-item-action" href="admin/orders/<?= $order_id; ?>/details">
                        <div class="media align-items-center">
                          <?php
                          if (!empty($photo)) {
                            ?>
                            <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                              alt="Image description">
                            <?php
                          } else {
                            ?>
                            <img class="u-avatar rounded-circle mr-3"
                              src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                            <?php
                          }
                          ?>
                          <div class="media-body">
                            <div class="d-flex align-items-center">
                              <h4 class="mb-1"><span class="badge badge-soft-primary mx-1">New Order</span></h4>
                              <small class="text-muted ml-auto"><?= request::timeago($activity['timestamp']); ?></small>
                            </div>

                            <p class="text-truncate mb-0" style="max-width: 250px;">
                              <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                            </p>
                          </div>
                        </div>
                      </a>
                      <?php
                    } elseif ($comment == config::staffActivity()) {
                      ?>
                      <a class="list-group-item list-group-item-action" href="admin/account?name=<?= $name; ?>">
                        <div class="media align-items-center">
                          <?php
                          if (!empty($photo)) {
                            ?>
                            <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                              alt="Image description">
                            <?php
                          } else {
                            ?>
                            <img class="u-avatar rounded-circle mr-3"
                              src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                            <?php
                          }
                          ?>
                          <div class="media-body">
                            <div class="d-flex align-items-center">
                              <h4 class="mb-1"><span class="badge badge-soft-secondary mx-1">New Staff</span></h4>
                              <small class="text-muted ml-auto"><?= request::timeago($activity['timestamp']); ?></small>
                            </div>

                            <p class="text-truncate mb-0" style="max-width: 250px;">
                              <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                            </p>
                          </div>
                        </div>
                      </a>
                      <?php
                    } elseif ($comment == config::customerActivity()) {
                      ?>
                      <a class="list-group-item list-group-item-action" href="admin/customers">
                        <div class="media align-items-center">
                          <?php
                          if (!empty($photo)) {
                            ?>
                            <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                              alt="Image description">
                            <?php
                          } else {
                            ?>
                            <img class="u-avatar rounded-circle mr-3"
                              src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                            <?php
                          }
                          ?>
                          <div class="media-body">
                            <div class="d-flex align-items-center">
                              <h4 class="mb-1"><span class="badge badge-soft-success mx-1">New Customer</span></h4>
                              <small class="text-muted ml-auto"><?= request::timeago($activity['timestamp']); ?></small>
                            </div>

                            <p class="text-truncate mb-0" style="max-width: 250px;">
                              <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                            </p>
                          </div>
                        </div>
                      </a>
                      <?php
                    } elseif ($comment == config::paymentActivity()) {
                      ?>
                      <a class="list-group-item list-group-item-action" href="admin/transactions/payments">
                        <div class="media align-items-center">
                          <?php
                          if (!empty($photo)) {
                            ?>
                            <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                              alt="Image description">
                            <?php
                          } else {
                            ?>
                            <img class="u-avatar rounded-circle mr-3"
                              src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                            <?php
                          }
                          ?>
                          <div class="media-body">
                            <div class="d-flex align-items-center">
                              <h4 class="mb-1"><span class="badge badge-soft-success mx-1">New Payment</span></h4>
                              <small class="text-muted ml-auto"><?= request::timeago($activity['timestamp']); ?></small>
                            </div>

                            <p class="text-truncate mb-0" style="max-width: 250px;">
                              <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                            </p>
                          </div>
                        </div>
                      </a>
                      <?php
                    } elseif ($comment == config::expenseActivity()) {
                      ?>
                      <a class="list-group-item list-group-item-action" href="#">
                        <div class="media align-items-center">
                          <?php
                          if (!empty($photo)) {
                            ?>
                            <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                              alt="Image description">
                            <?php
                          } else {
                            ?>
                            <img class="u-avatar rounded-circle mr-3"
                              src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                            <?php
                          }
                          ?>
                          <div class="media-body">
                            <div class="d-flex align-items-center">
                              <h4 class="mb-1"><span class="badge badge-soft-danger mx-1">New Expense</span></h4>
                              <small class="text-muted ml-auto"><?= request::timeago($activity['timestamp']); ?></small>
                            </div>

                            <p class="text-truncate mb-0" style="max-width: 250px;">
                              <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                            </p>
                          </div>
                        </div>
                      </a>
                      <?php
                    } elseif ($comment == config::orderUpdateActivity()) {
                      ?>
                      <a class="list-group-item list-group-item-action" href="admin/orders/<?= $order_id; ?>/details">
                        <div class="media align-items-center">
                          <?php
                          if (!empty($photo)) {
                            ?>
                            <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                              alt="Image description">
                            <?php
                          } else {
                            ?>
                            <img class="u-avatar rounded-circle mr-3"
                              src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                            <?php
                          }
                          ?>
                          <div class="media-body">
                            <div class="d-flex align-items-center">
                              <h4 class="mb-1"><span class="badge badge-soft-secondary mx-1">New Order Update</span></h4>
                              <small class="text-muted ml-auto"><?= request::timeago($activity['timestamp']); ?></small>
                            </div>

                            <p class="text-truncate mb-0" style="max-width: 250px;">
                              <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                            </p>
                          </div>
                        </div>
                      </a>
                      <?php
                    } elseif ($comment == config::staffUpdateActivity()) {
                      ?>
                      <a class="list-group-item list-group-item-action" href="admin/account?name=<?= $name; ?>">
                        <div class="media align-items-center">
                          <?php
                          if (!empty($photo)) {
                            ?>
                            <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                              alt="Image description">
                            <?php
                          } else {
                            ?>
                            <img class="u-avatar rounded-circle mr-3"
                              src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                            <?php
                          }
                          ?>
                          <div class="media-body">
                            <div class="d-flex align-items-center">
                              <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New staff Update</span></h4>
                              <small class="text-muted ml-auto"><?= request::timeago($activity['timestamp']); ?></small>
                            </div>

                            <p class="text-truncate mb-0" style="max-width: 250px;">
                              <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                            </p>
                          </div>
                        </div>
                      </a>
                      <?php
                    } elseif ($comment == config::invoiceActivity()) {
                      ?>
                      <a class="list-group-item list-group-item-action" href="admin/accounting/invoice">
                        <div class="media">
                          <?php
                          if (!empty($photo)) {
                            ?>
                            <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                              alt="Image description">
                            <?php
                          } else {
                            ?>
                            <img class="u-avatar rounded-circle mr-3"
                              src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                            <?php
                          }
                          ?>
                          <div class="media-body">
                            <div class="d-md-flex align-items-center">
                              <h4 class="mb-1"><span class="badge badge-soft-secondary mx-1">New Invoice</span></h4>
                              <small class="text-muted ml-md-auto"><?= request::timeago($activity['timestamp']); ?></small>
                            </div>

                            <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                          </div>
                        </div>
                      </a>
                      <?php
                    } elseif ($comment == config::invoiceUpdateActivity()) {
                      ?>
                      <a class="list-group-item list-group-item-action" href="admin/accounting/invoice">
                        <div class="media">
                          <?php
                          if (!empty($photo)) {
                            ?>
                            <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                              alt="Image description">
                            <?php
                          } else {
                            ?>
                            <img class="u-avatar rounded-circle mr-3"
                              src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                            <?php
                          }
                          ?>
                          <div class="media-body">
                            <div class="d-md-flex align-items-center">
                              <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New invoice Update</span></h4>
                              <small class="text-muted ml-md-auto"><?= request::timeago($activity['timestamp']); ?></small>
                            </div>

                            <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                          </div>
                        </div>
                      </a>
                      <?php
                    }
                    if ($role == 1) {
                      if ($category_id == 4) {
                        ?>
                        <a class="list-group-item list-group-item-action" href="admin/account?name=admin; ?>">
                          <div class="media align-items-center">
                            <?php
                            if (!empty($photo)) {
                              ?>
                              <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>"
                                alt="Image description">
                              <?php
                            } else {
                              ?>
                              <img class="u-avatar rounded-circle mr-3"
                                src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                              <?php
                            }
                            ?>
                            <div class="media-body">
                              <div class="d-flex align-items-center">
                                <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New Salary Expense</span></h4>
                                <small class="text-muted ml-auto"><?= request::timeago($activity['timestamp']); ?></small>
                              </div>

                              <p class="text-truncate mb-0" style="max-width: 250px;">
                                <span class="text-primary"><?= $activity['name']; ?></span> <?= $activity['comment']; ?>
                              </p>
                            </div>
                          </div>
                        </a>
                        <?php
                      }
                    }
                  }
                  ?>
                </div>
              </div>

              <div class="card-footer py-3">
                <a class="btn btn-block btn-outline-primary" href="admin/activities">View all activities</a>
              </div>
            </div>
          </div>
        </div>
        <!-- End Notifications -->


        <!-- User Profile -->
        <div class="dropdown ml-2">
          <a class="link-muted d-flex align-items-center" href="#!" role="button" id="dropdownMenuLink"
            aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
            <img class="u-avatar--xs img-fluid rounded-circle mr-2"
              src="<?php echo config::baseUploadStaffUrl() . $account['photo']; ?>" style="height: 35px; width: 35px;"
              alt="User Profile">
            <span class="text-dark d-none d-sm-inline-block">
              <?php echo $account['name']; ?> <small class="fa fa-angle-down text-muted ml-1"></small>
            </span>
          </a>

          <div class="dropdown-menu dropdown-menu-right border-0 py-0 mt-3" aria-labelledby="dropdownMenuLink"
            style="width: 260px;">
            <div class="card">

              <div class="card-body">
                <ul class="list-unstyled mb-0">
                  <li class="mb-4">
                    <a class="d-flex align-items-center link-dark" href="admin/account?name=<?= $name; ?>">
                      <span class="h3 mb-0"><i class="far fa-user-circle text-muted mr-3"></i></span> Profile
                    </a>
                  </li>
                  <li class="mb-4">
                    <a class="d-flex align-items-center link-dark" href="#changePassword" data-toggle="modal">
                      <span class="h3 mb-0"><i class="far fa-list-alt text-muted mr-3"></i></span> Change Password
                    </a>
                  </li>
                  <li>
                    <a class="d-flex align-items-center link-dark" href="admin/logout">
                      <span class="h3 mb-0"><i class="far fa-share-square text-muted mr-3"></i></span> Sign Out
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- End User Profile -->
      </div>
    </header>
    <!-- End Header (Topbar) -->

    <main class="u-main" role="main">
      <!-- Sidebar -->
      <aside id="sidebar" class="u-sidebar">
        <div class="u-sidebar-inner">
          <header class="u-sidebar-header">
            <a class="u-sidebar-logo" href="/">
              <img class="" src="<?php echo config::logo(); ?>" style="height: 50px;"
                alt="<?php echo config::name(); ?>">
            </a>
          </header>

          <nav class="u-sidebar-nav">
            <ul class="u-sidebar-nav-menu u-sidebar-nav-menu--top-level">
              <!-- Dashboard -->
              <li class="u-sidebar-nav-menu__item">
                <a class="u-sidebar-nav-menu__link <?php if ($page == 'dashboard') {
                  echo 'active';
                } ?>" href="admin/dashboard">
                  <i class="fa fa-chart-bar u-sidebar-nav-menu__item-icon"></i>
                  <span class="u-sidebar-nav-menu__item-title">Dashboard</span>
                </a>
              </li>
              <!-- End Dashboard -->

              <li class="u-sidebar-nav-menu__item">
                <a class="u-sidebar-nav-menu__link <?php if ($page == 'customers') {
                  echo 'active';
                } ?>" href="admin/customers">
                  <i class="fa fa-users u-sidebar-nav-menu__item-icon"></i>
                  <span class="u-sidebar-nav-menu__item-title">Customers</span>
                </a>
              </li>

              <!-- Base UI -->
              <li class="u-sidebar-nav-menu__item">
                <a class="u-sidebar-nav-menu__link" href="#!" data-target="#baseUI">
                  <i class="far fa-credit-card u-sidebar-nav-menu__item-icon"></i>
                  <span class="u-sidebar-nav-menu__item-title">Transactions</span>
                  <i class="fa fa-angle-right u-sidebar-nav-menu__item-arrow"></i>
                  <span class="u-sidebar-nav-menu__indicator"></span>
                </a>

                <ul id="baseUI" class="u-sidebar-nav-menu u-sidebar-nav-menu--second-level" style="display: none;">
                  <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link" href="admin/transactions/payments">
                      <i class="far fa-wallet u-sidebar-nav-menu__item-icon"></i>
                      <span class="u-sidebar-nav-menu__item-title">Payments</span>
                    </a>
                  </li>
                  <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link" href="admin/transactions/expenses">
                      <i class="far fa-book u-sidebar-nav-menu__item-icon"></i>
                      <span class="u-sidebar-nav-menu__item-title">Expenses</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- End Base UI -->

              <!-- Base Accounting UI -->
              <li class="u-sidebar-nav-menu__item">
                <a class="u-sidebar-nav-menu__link" href="#!" data-target="#baseAccountingUI">
                  <i class="fas fa-coins u-sidebar-nav-menu__item-icon"></i>
                  <span class="u-sidebar-nav-menu__item-title">Accounting</span>
                  <i class="fa fa-angle-right u-sidebar-nav-menu__item-arrow"></i>
                  <span class="u-sidebar-nav-menu__indicator"></span>
                </a>

                <ul id="baseAccountingUI" class="u-sidebar-nav-menu u-sidebar-nav-menu--second-level"
                  style="display: none;">
                  <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link" href="admin/accounting/invoice">
                      <i class="far fa-file-alt u-sidebar-nav-menu__item-icon"></i>
                      <span class="u-sidebar-nav-menu__item-title">Invoices</span>
                    </a>
                  </li>
                  <li class="u-sidebar-nav-menu__item">
                    <a class="u-sidebar-nav-menu__link" href="admin/accounting/receipt">
                      <i class="fas fa-receipt u-sidebar-nav-menu__item-icon"></i>
                      <span class="u-sidebar-nav-menu__item-title">Receipts</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- End Base Accounting UI -->

              <?php

              if ($role > 0) {
                ?>
                <li class="u-sidebar-nav-menu__item">
                  <a class="u-sidebar-nav-menu__link <?php if ($page == 'staff') {
                    echo 'active';
                  } ?>" href="admin/staff">
                    <i class="fa fa-id-card-alt u-sidebar-nav-menu__item-icon"></i>
                    <span class="u-sidebar-nav-menu__item-title">Staff</span>
                  </a>
                </li>
                <?php
              }

              ?>


              <hr>
              <li class="u-sidebar-nav-menu__item">
                <a class="u-sidebar-nav-menu__link" href="admin/orders">
                  <span class="u-sidebar-nav-menu__item-title">All Orders</span>
                  <span class="badge badge-dark u-sidebar-nav-menu__item-arrow"
                    style="color: #fff;"><?php echo count(order::status_orders()); ?></span>
                </a>
              </li>
              <?php

              $types = order::type();

              foreach ($types as $type) {
                $type_id = $type['id'];
                ?>
                <li class="u-sidebar-nav-menu__item">
                  <a class="u-sidebar-nav-menu__link" href="#!" data-target="#baseUI<?= $type_id; ?>">

                    <span class="u-sidebar-nav-menu__item-title"><?php echo $type['type']; ?></span>
                    <!--                  <span class="badge badge-dark u-sidebar-nav-menu__item-arrow" style="color: #fff;">-->
                    <!--                      --><?php //echo count(order::type_order($type_id)); ?>
                    <!--                  </span>-->
                    <i class="fa fa-angle-right u-sidebar-nav-menu__item-arrow"></i>
                  </a>

                  <ul id="baseUI<?= $type_id; ?>" class="u-sidebar-nav-menu u-sidebar-nav-menu--second-level"
                    style="display: none;">
                    <?php
                    $statuses = order::status();
                    foreach ($statuses as $status) {
                      $status_id = $status['id'];
                      ?>
                      <li class="u-sidebar-nav-menu__item">
                        <a class="u-sidebar-nav-menu__link"
                          href="admin/orders/<?php echo lcfirst($type['type'] . '/' . $status['slug']); ?>">
                          <span class="u-sidebar-nav-menu__item-title"><?= $status['status_name'] ?></span>
                          <span class="badge badge-dark u-sidebar-nav-menu__item-arrow" style="color: #fff;"> <?php
                          echo count(order::type_status($status_id, $type_id));
                          ?>
                          </span>
                        </a>
                      </li>
                      <?php
                    }
                    ?>
                  </ul>
                </li>
                <?php
              }

              ?>


            </ul>
          </nav>
        </div>
      </aside>
      <!-- End Sidebar -->

      <div class="u-content">

        <?php

        if (isset($_POST['addOrder'])) {
          order::add($staff_id, $_POST['customer_name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['cost'], $_POST['dod'], $_POST['deposit'], $_POST['status'], $_POST['type_id'], $_POST['subcat_id'] = !empty($_POST['subcat_id'][1]) ? $_POST['subcat_id'][1] : $_POST['subcat_id'][2], $_POST['note']);
        }

        if (isset($_POST['changePassword'])) {
          staff::change_password($_POST['newPassword'], $_POST['confirmPassword']);
        }
