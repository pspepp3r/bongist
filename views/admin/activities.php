<div class="u-body">
    <!-- Comments -->
    <div class="col-md-10">
        <div class="card h-100">
            <header class="card-header d-md-flex align-items-center">
                <h2 class="h3 card-header-title">All Activities</h2>
            </header>

            <div class="card-body p-0 m-0">
                <div class="tab-content" id="commentsTabs">
                    <!-- Tabs Content -->
                    <div class="tab-pane fade show active" id="commentsTab1" role="tabpanel">
                        <div class="list-group list-lg-group list-group-flush">
                            <!-- Comment -->
                            <?php
                            $activities = activity::all();

                            foreach($activities as $activity) {
                                $category_id = $activity['category_id'];
                                $order_id = $activity['order_id'];
                                $name = $activity['name'];
                                $photo = $activity['photo'];
                                $comment = $activity['comment'];
                                $timestamp = $activity['timestamp'];

                                if ($category_id != 4) {
                                    if($comment == config::noteActivity())
                                    {
                                        ?>
                                        <a class="list-group-item list-group-item-action" href="admin/orders/<?= $order_id; ?>/details">
                                            <div class="media">
                                                <?php
                                                if(!empty($photo))
                                                {
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                                    <?php
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <div class="d-md-flex align-items-center">
                                                        <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New Note</span></h4>
                                                        <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                    </div>

                                                    <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }elseif($comment == config::orderActivity())
                                    {
                                        ?>
                                        <a class="list-group-item list-group-item-action" href="admin/orders/<?= $order_id; ?>/details">
                                            <div class="media">
                                                <?php
                                                if(!empty($photo))
                                                {
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                                    <?php
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <div class="d-md-flex align-items-center">
                                                        <h4 class="mb-1"><span class="badge badge-soft-primary mx-1">New Order</span></h4>
                                                        <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                    </div>

                                                    <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }elseif($comment == config::staffActivity())
                                    {
                                        ?>
                                        <a class="list-group-item list-group-item-action" href="admin/account?name=<?= $name; ?>">
                                            <div class="media">
                                                <?php
                                                if(!empty($photo))
                                                {
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                                    <?php
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <div class="d-md-flex align-items-center">
                                                        <h4 class="mb-1"><span class="badge badge-soft-secondary mx-1">New Staff</span></h4>
                                                        <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                    </div>

                                                    <p class="mb-0"><?= "$name $comment" ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }elseif($comment == config::paymentActivity())
                                    {
                                        ?>
                                        <a class="list-group-item list-group-item-action" href="admin/transactions/payment">
                                            <div class="media">
                                                <?php
                                                if(!empty($photo))
                                                {
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                                    <?php
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <div class="d-md-flex align-items-center">
                                                        <h4 class="mb-1"><span class="badge badge-soft-success mx-1">New Payment</span></h4>
                                                        <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                    </div>

                                                    <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }elseif($comment == config::customerActivity())
                                    {
                                        ?>
                                        <a class="list-group-item list-group-item-action" href="admin/customers">
                                            <div class="media">
                                                <?php
                                                if(!empty($photo))
                                                {
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                                    <?php
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <div class="d-md-flex align-items-center">
                                                        <h4 class="mb-1"><span class="badge badge-soft-success mx-1">New Customer</span></h4>
                                                        <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                    </div>

                                                    <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }elseif($comment == config::expenseActivity())
                                    {
                                        ?>
                                        <a class="list-group-item list-group-item-action" href="#">
                                            <div class="media">
                                                <?php
                                                if(!empty($photo))
                                                {
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                                    <?php
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <div class="d-md-flex align-items-center">
                                                        <h4 class="mb-1"><span class="badge badge-soft-danger mx-1">New Expense</span></h4>
                                                        <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                    </div>

                                                    <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }elseif($comment == config::orderUpdateActivity())
                                    {
                                        ?>
                                        <a class="list-group-item list-group-item-action" href="admin/orders/<?= $order_id; ?>/details">
                                            <div class="media">
                                                <?php
                                                if(!empty($photo))
                                                {
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                                    <?php
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <div class="d-md-flex align-items-center">
                                                        <h4 class="mb-1"><span class="badge badge-soft-warning mx-1">New Order Update</span></h4>
                                                        <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                    </div>

                                                    <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }elseif($comment == config::staffUpdateActivity())
                                    {
                                        ?>
                                        <a class="list-group-item list-group-item-action" href="admin/account?name=<?= $name; ?>">
                                            <div class="media">
                                                <?php
                                                if(!empty($photo))
                                                {
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                                    <?php
                                                }else{
                                                    ?>
                                                    <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                                    <?php
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <div class="d-md-flex align-items-center">
                                                        <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New staff Update</span></h4>
                                                        <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                    </div>

                                                    <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    } elseif ($comment == config::invoiceActivity()) {
                                        ?>
                                        <a class="list-group-item list-group-item-action" href="admin/accounting/invoices">
                                            <div class="media">
                                                <?php
                                                if (!empty($photo)) {
                                                    ?>
                                                        <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>" alt="Image description">
                                                        <?php
                                                } else {
                                                    ?>
                                                        <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                                                        <?php
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <div class="d-md-flex align-items-center">
                                                        <h4 class="mb-1"><span class="badge badge-soft-secondary mx-1">New Invoice</span></h4>
                                                        <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                    </div>

                                                    <p class="mb-0"><?= "$name $comment" ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }elseif($comment == config::invoiceUpdateActivity()){
                                        ?>
                                        <a class="list-group-item list-group-item-action" href="admin/accounting/invoices">
                                            <div class="media">
                                                <?php
                                                if (!empty($photo)) {
                                                    ?>
                                                        <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>" alt="Image description">
                                                        <?php
                                                } else {
                                                    ?>
                                                        <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl() . config::defaultPhoto(); ?>" alt="Image description">
                                                        <?php
                                                }
                                                ?>
                                                <div class="media-body">
                                                    <div class="d-md-flex align-items-center">
                                                        <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New Invoice Update</span></h4>
                                                        <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                    </div>

                                                    <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                                </div>
                                            </div>
                                        </a>
                                        <?php
                                    }
                                    if($role == 1)
                                    {
                                        if($category_id == 4)
                                        {
                                            ?>
                                            <a class="list-group-item list-group-item-action" href="admin/account?name=admin; ?>">
                                                <div class="media">
                                                    <?php
                                                    if(!empty($photo))
                                                    {
                                                        ?>
                                                        <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl().$photo; ?>" alt="Image description">
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <img class="u-avatar rounded-circle mr-3" src="<?= config::baseUploadStaffUrl(). config::defaultPhoto(); ?>" alt="Image description">
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="media-body">
                                                        <div class="d-md-flex align-items-center">
                                                            <h4 class="mb-1"><span class="badge badge-soft-info mx-1">New Salary Expense</span></h4>
                                                            <small class="text-muted ml-md-auto"><?= request::timeago($timestamp); ?></small>
                                                        </div>

                                                        <p class="mb-0"><?= $name . ' ' . $comment ?></p>
                                                    </div>
                                                </div>
                                            </a>
                                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                            <!-- End Comment -->
                        </div>
                    </div>
                    <!-- End Tabs Content -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Comments -->
</div>