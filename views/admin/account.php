<?php
$name = $_GET['name'];
$details = staff::details($name);
foreach($details as $detail)
{
    $staff_id = $detail['id'];
    $photo = $detail['photo'];
    $name = $detail['name'];
    $role_type = $detail['role_type'];
    $email = $detail['email'];
    $address = $detail['address'];
    ?>
    <div class="u-body">
        <h1 class="h2 font-weight-semibold mb-4">Profile</h1>

        <div class="row">
            <div class="card mb-4 col-md-4" style="max-height: 400px;">
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid rounded-circle mb-3" src="<?= config::baseUploadStaffUrl() . $photo; ?>" alt="Image description" style="width: 100px; height: 100px; object-fit: cover;">

                        <h2 class="mb-2"><?= $name; ?></h2>
                        <h5 class="mb-4 badge badge-soft-info"><?= $role_type; ?></h5>

                        <div class="mb-3">
                            <p>Email : <?= $email; ?></p>
                            <p>Address : <?= $address; ?></p>
                        </div>
                        <span>
                        <span>Orders : <p class="badge badge-soft-success"><?= count(staff::staff_orders($staff_id)); ?></p></span> <span>Expenses : <p class="badge badge-soft-warning"><?= count(staff::staff_expenses($staff_id)); ?></p></span>
                    </span>
                    </div>
                </div>
            </div>

                <div class="col-lg-<?php if($role == 1){ echo '4'; }else{ echo '6';} ?> staff_activity">
                    <div class="card mb-4">
                        <header class="card-header">
                            <h2 class="h3 card-header-title">Activities</h2>
                        </header>

                        <div class="card-body">
                            <div class="u-timeline">
                                <?php
                                $activities = staff::staff_activities($staff_id);
                                foreach($activities as $activity)
                                {
                                    $order_id = $activity['order_id'];
                                    $comment = $activity['comment'];
                                    $timestamp = $activity['timestamp'];
                                    ?>
                                    <div class="u-timeline__item">
                                        <div class="h5 font-weight-normal text-muted mb-2"><?= request::timeago($timestamp); ?></div>
                                        <?php
                                        if($comment == config::orderActivity())
                                        {
                                            ?>
                                            <h3 class="mb-0 badge badge-soft-success">New Order</h3>
                                            <p class="mb-2">
                                                <a class="u-link u-link--primary" href="admin/orders/<?= $order_id; ?>/details"><?= $name . ' ', $comment; ?></a>
                                            </p>
                                            <?php
                                        }elseif( $comment == config::noteActivity())
                                        {
                                            ?>
                                            <h3 class="mb-0 badge badge-soft-info">New Note</h3>
                                            <p class="mb-2">
                                                <a class="u-link u-link--primary" href="admin/orders/<?= $order_id; ?>/details"><?= $name . ' ', $comment; ?></a>
                                            </p>
                                            <?php
                                        }elseif( $comment == config::expenseActivity())
                                        {
                                            ?>
                                            <h3 class="mb-0 badge badge-soft-danger">New Expense</h3>
                                            <p class="mb-2">
                                                <a class="u-link u-link--primary" href="#!"><?= $name . ' ', $comment; ?></a>
                                            </p>
                                            <?php
                                        }elseif( $comment == config::paymentActivity())
                                        {
                                            ?>
                                            <h3 class="mb-0 badge badge-soft-success">New Payment</h3>
                                            <p class="mb-2">
                                                <a class="u-link u-link--primary" href="admin/transactions/payment"><?= $name . ' ', $comment; ?></a>
                                            </p>
                                            <?php
                                        }elseif( $comment == config::orderUpdateActivity())
                                        {
                                            ?>
                                            <h3 class="mb-0 badge badge-soft-warning">New Order Update</h3>
                                            <p class="mb-2">
                                                <a class="u-link u-link--primary" href="#!"><?= $name . ' ', $comment; ?></a>
                                            </p>
                                            <?php
                                        }elseif( $comment == config::staffUpdateActivity())
                                        {
                                            ?>
                                            <h3 class="mb-0 badge badge-soft-info">New Staff Update</h3>
                                            <p class="mb-2">
                                                <a class="u-link u-link--primary" href="#!"><?= $name . ' ', $comment; ?></a>
                                            </p>
                                            <?php
                                        } elseif ($comment == config::invoiceActivity()) {
                                            ?>
                                                <h3 class="mb-0 badge badge-soft-info">New Invoice</h3>
                                                <p class="mb-2">
                                                    <a class="u-link u-link--primary" href="admin/accounting/invoice"><?= $name . ' ', $comment; ?></a>
                                                </p>
                                                <?php
                                        } elseif ($comment == config::invoiceUpdateActivity()) {
                                            ?>
                                                    <h3 class="mb-0 badge badge-soft-info">New Invoice Update</h3>
                                                    <p class="mb-2">
                                                        <a class="u-link u-link--primary" href="admin/accounting/invoice"><?= $name . ' ', $comment; ?></a>
                                                    </p>
                                                    <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            if($role == 1)
            {
                ?>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <header class="card-header">
                            <h2 class="h3 card-header-title">Expense</h2>
                        </header>

                        <div class="card-body">
                            <div class="u-timeline">
                                <?php
                                $expenses = expense::all();
                                foreach($expenses as $expense)
                                {
                                    $name = $expense['name'];
                                    $cost = $expense['cost'];
                                    $title = $expense['title'];
                                    $category = $expense['category'];
                                    $timestamp = $expense['timestamp'];
                                    ?>
                                    <div class="u-timeline__item">
                                        <div class="h5 font-weight-normal text-muted mb-2"><?= request::timeago($timestamp); ?></div>
                                        <h3 class="mb-0 badge badge-soft-danger" style="text-transform: uppercase;"><?= $category; ?></h3>
                                        <p class="mb-2">
                                        <p><?= '₦' . number_format($cost); ?></p>
                                        <p style="margin-top: -20px;"><?= $title; ?></p>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
<?php
}
