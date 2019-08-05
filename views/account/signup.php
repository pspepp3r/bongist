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
    <link href="<?php echo config::favicon(); ?>" rel="shortcut icon" type="image/x-icon"/>
</head>
<body>

<section class="section-border border-primary">
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center no-gutters min-vh-100">
            <div class="col-8 col-md-6 col-lg-7 offset-md-1 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">

                <!-- Image -->
                <img src="../assets/home/img/illustrations/illustration-8.png" alt="..." class="img-fluid">

            </div>
            <div class="col-12 col-md-5 col-lg-4 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">

                <!-- Heading -->
                <h1 class="mb-0 font-weight-bold text-center">
                    Register
                </h1>

                <!-- Text -->
                <p class="mb-6 text-center text-muted">
                    Simplify your workflow in minutes.
                </p>

                <?php
                if(isset($_POST['signUp']))
                {
                    customer::signUp($_POST['customer_name'], $_POST['email'], $_POST['password']);
                }
                ?>
                <!-- Form -->
                <form class="mb-6" method="post" action="">


                    <!-- Name -->
                    <div class="form-group">
                        <label for="customer_name">
                            Full name
                        </label>
                        <input type="text" name="customer_name" class="form-control" id="customer_name" placeholder="Example : John Doe">
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">
                            Email Address
                        </label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@address.com">
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-5">
                        <label for="password">
                            Password
                        </label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                    </div>

                    <!-- Submit -->
                    <button class="btn btn-block btn-primary" name="signUp" type="submit">
                        Sign in
                    </button>

                </form>

                <!-- Text -->
                <p class="mb-0 font-size-sm text-center text-muted">
                    Already have an account? <a href="../account">Log In</a>.
                </p>

            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</section>

<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="../assets/home/libs/aos/dist/aos.js"></script>
<script src="../assets/home/libs/smooth-scroll/dist/smooth-scroll.min.js"></script>


<script src="../assets/home/js/theme.min.js"></script>

</body>
</html>