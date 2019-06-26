<!-- Hero Section-->
<section class="hero">
    <div class="container">
        <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Your address</li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
            <h1 class="hero-heading">Your address</h1>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 col-xl-9">
                <form action="" method="post">
                    <div class="block">
                        <!-- Invoice Address-->
                        <div class="block-header">
                            <h6 class="text-uppercase mb-0">Invoice address</h6>
                        </div>
                        <?php

                        if (isset($_POST['address'])) {
                            customer::address($email, $_POST['country'], $_POST['state'], $_POST['city'], $_POST['address']);
                        }

                            $account = customer::check($email);
                        ?>
                        <div class="block-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="fullname_invoice" class="form-label">Full Name</label>
                                    <input type="text" name="fullname_invoice" placeholder="Full Name" value="<?php echo $account['fname'].' '.$account['lname']; ?>" disabled id="fullname_invoice" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="emailaddress_invoice" class="form-label">Email Address</label>
                                    <input type="text" name="emailaddress_invoice" value="<?php echo $account['email']; ?>" disabled id="emailaddress_invoice" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phonenumber_invoice" class="form-label">Phone Number</label>
                                    <input type="text" name="phonenumber_invoice" value="<?php echo $account['phone']; ?>" disabled id="phonenumber_invoice" class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="fullname_invoice" class="form-label">Country</label>
                                    <input type="text" name="country" value="<?php echo $account['country']; ?>" required placeholder="Country" id="fullname_invoice" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="state_invoice" class="form-label">State</label>
                                    <input type="text" name="state" value="<?php echo $account['state']; ?>" required placeholder="State" id="state_invoice" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="city_invoice" class="form-label">City</label>
                                    <input type="text" name="city" value="<?php echo $account['city']; ?>" required placeholder="City" id="city_invoice" class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="address" class="form-label">Delivery Address</label>
                                    <textarea name="address" id="address" required rows="3" class="form-control"><?php echo $account['address']; ?></textarea>
                                </div>
                            </div>
                            <!-- /Invoice Address-->
                            <div class="form-group mt-3 text-center">
                                <button type="submit" class="btn btn-outline-dark btn-block"><i class="far fa-save mr-2"></i>Save changes</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <?php require 'views/account/layout/sidebar.php'; ?>
        </div>
    </div>
</section>
