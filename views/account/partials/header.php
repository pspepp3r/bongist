<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="../assets/home/fonts/Feather/feather.css">
    <link rel="stylesheet" href="../assets/home/libs/aos/dist/aos.css">


    <!-- Theme CSS -->
    <link rel="stylesheet" href="../assets/home/css/theme.min.css">

    <title><?php echo ucfirst($page).' | '.config::name(); ?></title>
    <?php echo config::meta(); ?>

    <!-- Favicon -->
    <link href="<?php echo config::altFavicon(); ?>" rel="shortcut icon" type="image/x-icon"/>

</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light">


    <!-- Brand -->
    <a class="navbar-brand" href="/">
        <img src="<?php echo config::altLogo(); ?>" style="height: 50px;" class="navbar-brand-img" alt="logo">
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="navbarCollapse">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fe fe-x"></i>
        </button>

        <!-- Navigation -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" id="navbarLandings" href="#home">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="navbarLandings" href="#about-us">
                    About Us
                </a>
            </li>
        </ul>

        <?php
        if($_SESSION['logged_customer'])
        {
            ?>
            <!-- Button -->
            <div class="dropdown navbar-btn ml-auto">
                <button class="profile_img dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border:none;background:transparent;">
                    <img src="<?= config::baseUploadProfileUrlTwo() . $customer_photo; ?>" alt="..." class="avatar-img rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="right:0;left:inherit;">
                    <a class="dropdown-item" href="edit">Edit Profile</a>
                    <a class="dropdown-item" href="password">Change password</a>
                    <a class="dropdown-item" href="logout">Logout</a>
                </div>
            </div>
            <?php
        }else
        {
            ?>
            <!-- Button -->
            <a class="navbar-btn btn btn-sm btn-primary lift ml-auto" href="account">
                Sign In
            </a>
        <?php
        }
        ?>

    </div>


</nav>
