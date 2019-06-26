<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Your profile</li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading">Your profile</h1>

        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase">Personal details</strong></div>
                    <?php
                        if (isset($_POST['profile'])) {
                            customer::update($email, $_POST['fname'], $_POST['lname'], $_POST['phone'], $_FILES['photo']);
                        }

                    $account = customer::check($email);

                    ?>
                    <div class="block-body">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname" class="form-label">Firstname</label>
                                        <input id="firstname" name="fname" value="<?php echo $account['fname']; ?>" required type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname" class="form-label">Lastname</label>
                                        <input id="lastname" name="lname" value="<?php echo $account['lname']; ?>" required type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input id="phone" name="phone" value="<?php echo $account['phone']; ?>" required type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input id="email" value="<?php echo $account['email']; ?>" disabled type="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="photo" class="form-label">Profile Photo</label>
                                        <input id="photo" type="file" name="photo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row-->
                            <div class="text-center mt-4">
                                <button type="submit" name="profile" class="btn btn-outline-dark btn-block"><i class="far fa-save mr-2"></i>Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="block mb-5">
                    <div class="block-header"><strong class="text-uppercase">Change your password</strong></div>
                    <?php
                        if (isset($_POST['password'])) {
                            customer::change_password($email, $_POST['password_old'], $_POST['password_1'], $_POST['password_2']);
                        }
                    ?>
                    <div class="block-body">
                        <form method="post" action="">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="password_old" class="form-label">Old password</label>
                                        <input id="password_old" name="password_old" required type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_1" class="form-label">New password</label>
                                        <input id="password_1" name="password_1" required type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_2" class="form-label">Retype new password</label>
                                        <input id="password_2" name="password_2" required type="password" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" name="password" class="btn btn-outline-dark btn-block"><i class="far fa-save mr-2"></i>Change password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php require 'views/account/layout/sidebar.php'; ?>
        </div>
    </div>
</section>
