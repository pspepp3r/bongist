<!DOCTYPE html>
<html lang="en" class="no-js">
<!-- Head -->
<head>
  <title>Sign In | <?php echo config::name(); ?></title>

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

  <!-- Theme Styles -->
  <link rel="stylesheet" href="assets/css/theme.css">
</head>
<!-- End Head -->

<body>
<main class="container-fluid w-100" role="main">
  <div class="row">
    <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center bg-white mnh-100vh">
      <a class="u-login-form py-3 mb-auto" href="/">
        <img class="img-fluid" src="<?php echo config::logo(); ?>" style="height: 50px;" alt="logo">
      </a>

      <div class="u-login-form">
        <form class="mb-3" action="" method="post">
          <div class="mb-3">
            <h1 class="h2">Welcome Back!</h1>
            <p class="small">Login to your dashboard with your registered email address and password.</p>
          </div>

          <?php

            if (isset($_POST['login'])) {
              account::login($_POST['email'], $_POST['password']);
            }

          if (isset($_POST['forgotPassword'])) {
            account::forgot_password($_POST['email']);
          }

          ?>

          <div class="form-group mb-4">
            <label for="email">Your email</label>
            <input id="email" class="form-control" name="email" type="email" placeholder="john.doe@example.com">
          </div>

          <div class="form-group mb-4">
            <label for="password">Password</label>
            <input id="password" class="form-control" name="password" type="password" placeholder="Your password">
          </div>

          <div class="form-group d-flex justify-content-between align-items-center mb-4">
            <div class="custom-control custom-checkbox">
              <input id="rememberMe" class="custom-control-input" name="rememberMe" type="checkbox">
              <label class="custom-control-label" for="rememberMe">Remember me</label>
            </div>

            <a class="link-muted small" href="#forgot-password" data-toggle="modal">Forgot Password?</a>
          </div>

          <button class="btn btn-primary btn-block" name="login" type="submit">Login</button>
        </form>

      </div>

      <div class="u-login-form text-muted py-3 mt-auto">
        <small><i class="far fa-question-circle mr-1"></i> If you are not able to sign in, please <a href="mailto:<?php echo config::email(); ?>" target="_blank">contact us</a>.</small>
      </div>
    </div>

    <div class="col-lg-6 d-none d-lg-flex flex-column align-items-center justify-content-center bg-light">
      <img class="img-fluid position-relative u-z-index-3 mx-5" src="assets/svg/mockups/mockup.svg" alt="Image description">

      <figure class="u-shape u-shape--top-right u-shape--position-5">
        <img src="assets/svg/shapes/shape-1.svg" alt="Image description">
      </figure>
      <figure class="u-shape u-shape--center-left u-shape--position-6">
        <img src="assets/svg/shapes/shape-2.svg" alt="Image description">
      </figure>
      <figure class="u-shape u-shape--center-right u-shape--position-7">
        <img src="assets/svg/shapes/shape-3.svg" alt="Image description">
      </figure>
      <figure class="u-shape u-shape--bottom-left u-shape--position-8">
        <img src="assets/svg/shapes/shape-4.svg" alt="Image description">
      </figure>
    </div>
  </div>
</main>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgot-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Forgot your password?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <p class="text-dark">Enter your email address below and we'll get you back on track.</p>
            <label for="newPassword">Email Address</label>
            <input type="email" class="form-control" name="email" required id="newPassword" placeholder="Enter Email Address">
          </div>
          <div class="modal-footer">
            <button type="submit" name="forgotPassword" class="btn btn-dark">Request Reset Link</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
      </form>
    </div>
  </div>
</div>


<script src="assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
<script src="assets/vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="assets/vendor/bootstrap/bootstrap.min.js"></script>

</body>
</html>

