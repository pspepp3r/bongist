<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Libs CSS -->
  <link rel="stylesheet" href="assets/home/fonts/Feather/feather.css">
  <link rel="stylesheet" href="assets/home/libs/aos/dist/aos.css">


  <!-- Theme CSS -->
  <link rel="stylesheet" href="assets/home/css/theme.min.css">

  <title><?php echo ucfirst($page).' | '.config::name(); ?></title>
  <?php echo config::meta(); ?>

  <!-- Favicon -->
  <link href="<?php echo config::favicon(); ?>" rel="shortcut icon" type="image/x-icon"/>

</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light">


  <!-- Brand -->
  <a class="navbar-brand" href="/">
    <img src="<?php echo config::logo(); ?>" style="height: 50px;" class="navbar-brand-img" alt="logo">
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

    <!-- Button -->
    <a class="navbar-btn btn btn-sm btn-primary lift ml-auto" href="account">
      Sign In
    </a>

  </div>


</nav>
