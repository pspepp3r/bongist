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

                <?php
                if(isset($_POST['editProfile']))
                {
                    customer::editProfile($id, $_POST['customer_name'], $_POST['address'], $_POST['phone'], $_FILES['photo']);
                }
                ?>

                <form action="" method="post" enctype="multipart/form-data">
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

                            <label class="btn btn-primary btn-sm">
                                <input type="file" value="<?= $customer_photo; ?>" name="photo" id="custom_input"/>
                                Upload Image
                            </label>

                        </div>
                    </div> <!-- / .row -->

                    <!-- Categories -->
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="name">Full name</label>
                                <input type="text" name="customer_name" value="<?= $customer_name; ?>" class="form-control" placeholder="<?= $customer_name; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="<?= $customer_email; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" value="<?= $customer_address; ?>" placeholder="<?php if(!empty($customer_address)){ echo $customer_address;}else {echo 'Add address';} ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone number</label>
                                <input type="number" name="phone" class="form-control" value="<?= $customer_phone; ?>" placeholder="<?php if(!empty($customer_phone)){ echo $customer_phone;}else {echo 'Add Phone number';} ?>">
                            </div>

                            <div class="mt-6">
                                <button class="btn btn-block btn-primary lift" name="editProfile" type="submit">
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