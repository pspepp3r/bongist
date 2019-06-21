<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta charset="utf-8">
<title><?php echo config::name(); ?> | Admin Dashboard</title>
<base href="<?php echo config::url(); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport">
    <?php echo config::meta(); ?>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css">
<link href="jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
<link href="assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/pages/css/inbox.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="assets/admin/pages/css/todo.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-toastr/toastr.min.css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="assets/css/lightbox.min.css">

<!-- END THEME STYLES -->
<link href="<?php echo config::favicon(); ?>" type="image/x-icon" rel="shortcut icon">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
<!-- BEGIN HEADER -->
<div class="page-header">
	<!-- BEGIN HEADER TOP -->
	<div class="page-header-top">
		<div class="container">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="/admin/"><img src="<?php echo config::logo(); ?>" alt="logo" style="height: 68px; margin-top: 3px;" class="logo-default"></a>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler"></a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN INBOX DROPDOWN -->

					<li class="dropdown dropdown-extended dropdown-dark dropdown-inbox" id="header_inbox_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="circle order_count">0</span>
						<span class="corner"></span>
						</a>
						<ul class="dropdown-menu">

							<li class="external">
								<h3>You have <strong><span class="order_count">0</span> New</strong> Orders</h3>
								<a href="../../../admindd/index.php">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list notification scroller" style="height: 275px;" data-handle-color="#637283"></ul>
							</li>

						</ul>
					</li>
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<img alt="" class="img-circle" src="assets/admin/layout3/img/user.png">
						<span class="username username-hide-mobile"><?php echo $user; ?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="../../../admindd/index.php">
								<i class="fa fa-cutlery"></i> Orders <span class="badge badge-danger">
								<span class="order_count">0</span> </span>
								</a>
							</li>
							<li>
								<a onclick="localStorage.setItem('mail_page', 'inbox');" href="../../../admindd/include/mail">
								<i class="icon-envelope-open"></i> Inbox <span class="badge badge-success">
								<span class="inbox_count">0</span> </span>
								</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="#passwordModal" data-toggle="modal">
								<i class="icon-lock"></i> Change Password </a>
							</li>
							<li>
								<a href="../../../admindd/index.php">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-extended quick-sidebar-toggler" onclick="window.location.replace('admin/logout')">
	                    <span class="sr-only">Toggle Quick Sidebar</span>
	                    <i class="icon-logout"></i>
	                </li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
	</div>
	<!-- END HEADER TOP -->
	<!-- BEGIN HEADER MENU -->
	<div class="page-header-menu">
		<div class="container">
		<!-- BEGIN MEGA MENU -->
			<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
			<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
			<div class="hor-menu ">
				<ul class="nav navbar-nav">
					<li class="<?php if($page == "products"){echo "active";}?>">
						<a href="admin/products">Products</a>
					</li>
					<li class="<?php if($page == "category"){echo "active";}?>">
						<a href="admin/category">Category</a>
					</li>
					<li class="<?php if($page == "customers"){echo "active";}?>">
						<a href="admin/customers">Customers</a>
					</li>
					<li class="<?php if($page == "orders"){echo "active";}?>">
						<a href="admin/orders">Orders</a>
					</li>
				<li class="<?php if($page == "slider"){echo "active";}?>">
						<a href="admin/slider">Slider</a>
					</li>
                    <li class="<?php if($page == "lookbook"){echo "active";}?>">
                        <a href="admin/slider">Lookbook</a>
                    </li>

				<?php
if ($staff_role != 0) {
	?>
<li class="<?php if($page == "staff"){echo "active";}?>">
						<a href="admin/staff">Staff</a>
					</li>
	<?php
}
				?>
				</ul>
			</div>
			<!-- END MEGA MENU -->
		</div>
	</div>
	<!-- END HEADER MENU -->
</div>
<!-- END HEADER -->

