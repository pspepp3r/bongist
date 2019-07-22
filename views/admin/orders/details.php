<?php

if(isset($_POST['editOrder']))
{
    order::update($_POST['order_id'], $_POST['status'], $_POST['note'], $staff_id);
}
if(isset($_POST['addNote']))
{
    order::addNote($_POST['order_id'], $_POST['note'], $staff_id);
}

if(isset($_POST['addPayment']))
{
    payment::add($_POST['order_id'], $_POST['customer_id'], $_POST['payment_method'], $_POST['amount']);
}
foreach($ordered as $order)
{
    $id = $order['id'];
    $order_id = $order['order_id'];
    $amount = $order['initial_deposit'];
    $customer_id = $order['customer_id'];
    $address = $order['address'];
    $customer_name = $order['customer_name'];
    $cost = $order['cost'];
    $photo = $order['photo'];
    $status = $order['status_name'];
    $type = $order['type'];
    $category = $order['category'];
    $timestamp = $order['timestamp'];
?>
<div class="u-body">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100" style="max-height: 350px;">
                <header class="card-header d-flex align-items-center">
                    <h2 class="h3 card-header-title">Order ID : <span class="text-info"><?= $order_id; ?></span></h2>

                    <!-- Card Header Icon -->
                    <ul class="list-inline ml-auto mb-0">
                        <?php

                        if($role == 1)
                        {
                            ?>
                            <li class="list-inline-item mr-3">
                                <a class="link-muted h3 text-info" data-toggle="modal" href="#editOrderModal" onclick="$('.order_id').val('<?= $order_id; ?>'); $('.order_status').val('<?= $status; ?>'); $('.customer_id').val('<?= $customer_id; ?>');"><i class="fas fa-edit"></i> Update</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <!-- End Card Header Icon -->
                </header>

                <div class="card-body">
                    <div class=" list-group-item-action">
                        <div class="media">
                            <img class="u-avatar rounded-circle mr-3"
                                 src="<?= config::baseUploadProfileUrl() . $photo; ?>" alt="Image description">

                            <div class="media-body">
                                <div class="align-items-center">
                                    <h4 class="mb-0">
                                        <strong><?= $customer_name; ?></strong>
                                    </h4>
                                    <p class="mb-0">Deliver address: <?= $address; ?></p>
                                    <p class="mb-0">Cost: <?= '₦' . number_format($cost); ?></p>
                                    <span>Type: <p class="badge badge-soft-info"><?= $type ?></p> Category: <p class="badge badge-soft-secondary"><?= $category; ?></p></span>
                                    <div>
                                      <h4 class="mb-1"><strong>Payments</strong></h4>
                                        <?php
                                        $payments = payment::order_payment($order_id);

                                        if($payments > 0)
                                        {
                                            foreach($payments as $payment)
                                            {
                                                $amount = $payment['amount'];
                                                $type = $payment['type'];
                                                ?>
                                              <p>Amount : <?= '₦' . number_format($amount); ?> <span class="badge badge-soft-success"><?= $type; ?> </span></p>
                                                <?php
                                            }
                                        }else {
                                          respond::alert('info', '', 'No payment has been made');
                                        }
                                        ?>
                                    </div>
                                    <p>
                                        <small class="mb-0">
                                            Added : <?= request::timeago($timestamp); ?>
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="card-footer d-flex align-items-center">
                    <div class="ml-auto">
                        <a class="btn btn-dark" data-toggle="modal" href="#addPaymentModal" onclick="$('.order_id').val('<?= $order_id; ?>'); $('.customer_id').val('<?= $customer_id; ?>'); $('.order_cost').val('<?= $cost; ?>');">Add Payment</a>
                        <a class="btn btn-dark" data-toggle="modal" href="#addNoteModal" onclick="$('.order_id').val('<?= $order_id; ?>');">Add note</a>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Comments -->
        <div class="col-md-6">
            <div class="card h-100">
                <header class="card-header d-md-flex align-items-center">
                    <h2 class="h3 card-header-title">Order Activities</h2>

                </header>

                <div class="card-body p-0 m-0">
                    <div class="tab-content" id="commentsTabs">
                        <!-- Tabs Content -->
                        <div class="tab-pane fade show active" id="commentsTab1" role="tabpanel">
                            <div class="list-group list-lg-group list-group-flush">
                                <!-- Comment -->
                                <?php

                                if(isset($_POST['editExpense']))
                                {
                                    expense::edit($_POST['id'], $_POST['title'], $_POST['cost'], $staff_id);
                                }

                                $order_notes = order::order_note($order_id);
                                foreach($order_notes as $notes) {
                                    $name = $notes['name'];
                                    $order_id = $notes['order_id'];
                                    $photo = $notes['photo'];
                                    $note = $notes['note'];
                                    $timestamp = $notes['timestamp'];

                                    ?>
                                    <div class="list-group-item list-group-item-action" href="#">
                                        <div class="media">
                                            <img class="u-avatar rounded-circle mr-3"
                                                 src="<?= config::baseUploadStaffUrl() . $photo; ?>" alt="Image description">

                                            <div class="media-body">
                                                <div class="d-md-flex align-items-center">
                                                    <h4 class="mb-1">
                                                        <strong><?= $name; ?></strong>
                                                    </h4>
                                                </div>
                                                <p class="mb-0">
                                                    <?= $note;
                                                    ?>
                                                </p>
                                                <small class="mb-0">
                                                    <?= request::timeago($timestamp);?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
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
</div>
<?php
}
