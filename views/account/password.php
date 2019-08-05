<?php
$id = $customer_id;
?>
<nav class="bg-gray-200">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Breadcrumb -->
                <ol class="breadcrumb breadcrumb-scroll">
                    <li class="breadcrumb-item">
                        <?= $customer_name; ?>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Account
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?= ucfirst($page); ?>
                    </li>
                </ol>

            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</nav>
<section class="pt-6 pt-md-8 pb-8 mb-md-8">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="row mb-6 mb-md-8">
                    <div class="col-auto hovered">
                        <img class="img-fluid rounded-circle mb-3" src="<?= config::baseUploadProfileUrlTwo() . $customer_photo; ?>" alt="Image description" style="width: 70px; height: 70px; object-fit: cover;">

                    </div>
                    <div class="col ml-n4">

                        <!-- Heading -->
                        <h2 class="font-weight-bold mb-0 a_hover">
                            <a href="../account">
                                <?= $customer_name; ?>
                            </a>
                        </h2>

                    </div>
                </div> <!-- / .row -->

                <?php
                if(isset($_POST['editPassword']))
                {
                    if($_POST['password'] != $_POST['confirmpassword'])
                    {
                        respond::alert('warning', '', 'confirm password does not match');
                    }else {
                        customer::changePassword($id, $_POST['password']);
                    }
                }
                ?>

                <form action="" method="post">
                    <!-- Categories -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="confirmpassword">Confirm Password</label>
                                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
                            </div>

                            <div class="mt-6">
                                <button class="btn btn-block btn-primary lift" name="editPassword" type="submit">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div> <!-- / .row -->
                </form>

            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</section>

<!-- SHAPE
================================================== -->
<div class="position-relative">
    <div class="shape shape-bottom shape-fluid-x svg-shim text-gray-200">
        <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"/>
        </svg>
    </div>
</div>