<!DOCTYPE html>
<html lang="en" class="no-js">
<!-- Head -->
<head>
  <title>Dashboard | Stream - Dashboard UI Kit</title>

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

  <!-- Theme Styles -->
  <link rel="stylesheet" href="assets/css/theme.css">

  <!-- Custom Charts -->
  <style>.js-doughnut-chart {
      width: 70px !important;
      height: 70px !important;
    }
  </style>
</head>
<!-- End Head -->

<body>
<!-- Header (Topbar) -->
<header class="u-header">
  <div class="u-header-left">
    <a class="u-header-logo" href="/">
      <img class="u-logo-desktop" src="<?php echo config::logo(); ?>" height="60" alt="<?php echo config::name(); ?>">
    </a>
  </div>

  <div class="u-header-middle">
    <a class="js-sidebar-invoker u-sidebar-invoker" href="#!"
       data-is-close-all-except-this="true"
       data-target="#sidebar">
      <i class="fa fa-bars u-sidebar-invoker__icon--open"></i>
      <i class="fa fa-times u-sidebar-invoker__icon--close"></i>
    </a>

    <div class="u-header-search"
         data-search-mobile-invoker="#headerSearchMobileInvoker"
         data-search-target="#headerSearch">
      <a id="headerSearchMobileInvoker" class="btn btn-link input-group-prepend u-header-search__mobile-invoker" href="#!">
        <i class="fa fa-search"></i>
      </a>

      <div id="headerSearch" class="u-header-search-form">
        <form>
          <div class="input-group">
            <button class="btn-link input-group-prepend u-header-search__btn" type="submit">
              <i class="fa fa-search"></i>
            </button>
            <input class="form-control u-header-search__field" type="search" placeholder="Type to search…">
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="u-header-right">


    <!-- User Profile -->
    <div class="dropdown ml-2">
      <a class="link-muted d-flex align-items-center" href="#!" role="button" id="dropdownMenuLink" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
        <img class="u-avatar--xs img-fluid rounded-circle mr-2" src="<?php echo config::baseUploadStaffUrl().$account['photo']; ?>" style="height: 35px; width: 35px;" alt="User Profile">
        <span class="text-dark d-none d-sm-inline-block">
							<?php echo $account['name']; ?> <small class="fa fa-angle-down text-muted ml-1"></small>
						</span>
      </a>

      <div class="dropdown-menu dropdown-menu-right border-0 py-0 mt-3" aria-labelledby="dropdownMenuLink" style="width: 260px;">
        <div class="card">

          <div class="card-body">
            <ul class="list-unstyled mb-0">
              <li class="mb-4">
                <a class="d-flex align-items-center link-dark" href="admin/account">
                  <span class="h3 mb-0"><i class="far fa-user-circle text-muted mr-3"></i></span> Profile
                </a>
              </li>
              <li class="mb-4">
                <a class="d-flex align-items-center link-dark" href="#password" data-toggle="modal">
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
          <img class="" src="<?php echo config::logo(); ?>" height="60" alt="<?php echo config::name(); ?>">
        </a>
      </header>

      <nav class="u-sidebar-nav">
        <ul class="u-sidebar-nav-menu u-sidebar-nav-menu--top-level">
          <!-- Dashboard -->
          <li class="u-sidebar-nav-menu__item">
            <a class="u-sidebar-nav-menu__link <?php if ($page == 'dashboard') { echo 'active'; } ?>" href="admin/dashboard">
              <i class="fa fa-chart-bar u-sidebar-nav-menu__item-icon"></i>
              <span class="u-sidebar-nav-menu__item-title">Dashboard</span>
            </a>
          </li>
          <!-- End Dashboard -->

          <li class="u-sidebar-nav-menu__item">
            <a class="u-sidebar-nav-menu__link <?php if ($page == 'customers') { echo 'active'; } ?>" href="admin/customers">
              <i class="fa fa-users u-sidebar-nav-menu__item-icon"></i>
              <span class="u-sidebar-nav-menu__item-title">Customers</span>
            </a>
          </li>

          <!-- Base UI -->
          <li class="u-sidebar-nav-menu__item">
            <a class="u-sidebar-nav-menu__link" href="#!"
               data-target="#baseUI">
              <i class="far fa-credit-card u-sidebar-nav-menu__item-icon"></i>
              <span class="u-sidebar-nav-menu__item-title">Transactions</span>
              <i class="fa fa-angle-right u-sidebar-nav-menu__item-arrow"></i>
              <span class="u-sidebar-nav-menu__indicator"></span>
            </a>

            <ul id="baseUI" class="u-sidebar-nav-menu u-sidebar-nav-menu--second-level" style="display: none;">
              <li class="u-sidebar-nav-menu__item">
                <a class="u-sidebar-nav-menu__link" href="admin/transactions/payments">
                  <i class="far fa-wallet u-sidebar-nav-menu__item-icon"></i>
                  <span class="u-sidebar-nav-menu__item-title">payments</span>
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


          <li class="u-sidebar-nav-menu__item">
            <a class="u-sidebar-nav-menu__link <?php if ($page == 'staff') { echo 'active'; } ?>" href="admin/staff">
              <i class="fa fa-id-card-alt u-sidebar-nav-menu__item-icon"></i>
              <span class="u-sidebar-nav-menu__item-title">Staff</span>
            </a>
          </li>


          <hr>

          <li class="u-sidebar-nav-menu__item">
            <a class="u-sidebar-nav-menu__link" href="admin/transactions/payments">
              <span class="nav-icon no-fade">
                                            <i class="badge badge-xs badge-o md b-warning"></i>
                                        </span>
              <span class="u-sidebar-nav-menu__item-title">payments</span>
            </a>
          </li>
          <li class="u-sidebar-nav-menu__item">
            <a class="u-sidebar-nav-menu__link" href="admin/transactions/expenses">
              <i class="far fa-book u-sidebar-nav-menu__item-icon"></i>
              <span class="u-sidebar-nav-menu__item-title">Expenses</span>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>
  <!-- End Sidebar -->

  <div class="u-content">


