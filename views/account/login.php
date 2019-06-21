<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Account</li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading mb-0">Customer Account</h1>
        </div>
    </div>
</section>
<!-- customer login-->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="block">
                    <div class="block-header">
                        <h6 class="text-uppercase mb-0">Login</h6>

                    </div>
                    <div class="block-body">
                        <p class="lead">Already our customer?</p>
                        <?php

                            if (isset($_POST['login'])) {
                                user::login($_POST['email'], $_POST['password']);
                            }// Login

                            if (isset($_POST['orderUser'])) {
                                $_SESSION['logged_user'] = request::secureTxt($_POST['orderUser']);
                                header('location: ../account/orders');
                            }

                        ?>
                        <hr>
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <input id="email" type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="login" class="btn btn-block btn-outline-dark"><i class="fa fa-sign-in-alt mr-2"></i> Log in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="block">
                    <div class="block-header">
                        <h6 class="text-uppercase mb-0">New account</h6>
                    </div>
                    <div class="block-body">
                        <p class="lead">Not our registered customer yet?</p>
                        <?php

                            if (isset($_POST['register'])) {
                                user::register($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password']);
                            }// Register

                        ?>
                        <hr>
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname" class="form-label">First Name</label>
                                        <input id="firstname" name="fname" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname" class="form-label">Last Name</label>
                                        <input id="lastname" name="lname" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" name="email" type="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" name="password" type="password" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="register" class="btn btn-block btn-outline-dark"><i class="far fa-user mr-2"></i>Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>