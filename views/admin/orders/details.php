<?php

if(isset($_POST['editOrder']))
{
    order::update($_POST['order_id'], $_POST['status'], $_POST['note'], $staff_id);
}
foreach($ordered as $order)
{
    $id = $order['id'];
    $order_id = $order['order_id'];
    $name = $order['name'];
    $cost = $order['cost'];
    $status = $order['status_name'];
?>
<div class="u-body">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <header class="card-header d-flex align-items-center">
                    <h2 class="h3 card-header-title">Customer name : <strong><?php echo $name ?></strong></h2>

                    <!-- Card Header Icon -->
                    <ul class="list-inline ml-auto mb-0">
                        <li class="list-inline-item mr-3">
                            <a class="link-muted h3" data-toggle="modal" href="#editOrderModal" onclick="$('.order_id').val('<?php echo $order_id; ?>'); $('.order_status').val('<?php echo $status; ?>');"><i class="fas fa-edit text-info"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="link-muted h3" href="#!">
                                <i class="fa fa-trash text-danger"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- End Card Header Icon -->
                </header>

                <div class="card-body">
                    <h5 class="h4 card-title">cost : ₦<?php echo $cost ?></h5>
                    <p>Status : <button class="btn btn-soft-info"><?php echo $status; ?></button></p>
                </div>

                <footer class="card-footer d-flex align-items-center">
                    <div class="ml-auto">
                        <a class="btn btn-dark" href="#">Add note</a>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Comments -->
        <div class="col-md-6">
            <div class="card h-100">
                <header class="card-header d-md-flex align-items-center">
                    <h2 class="h3 card-header-title">Activities</h2>

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
                                    $order_id = $notes['order_id'];
                                    $note = $notes['note'];
                                    $timestamp = $notes['timestamp'];

                                    ?>
                                    <div class="list-group-item list-group-item-action" href="#">
                                        <div class="media">
                                            <img class="u-avatar rounded-circle mr-3"
                                                 src="assets/img/avatars/img1.jpg" alt="Image description">

                                            <div class="media-body">
                                                <div class="d-md-flex align-items-center">
                                                    <h4 class="mb-1">
                                                        <strong><?php echo $order_id ?></strong>
                                                    </h4>
                                                </div>
                                                <p class="mb-0">
                                                    <?php echo $note;
                                                    ?>
                                                </p>
                                                <small class="mb-0">
                                                    <?php echo request::timeago($timestamp);?>
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

                <footer class="card-footer">
                    <a class="u-link u-link--primary" href="#!">All activities</a>
                </footer>
            </div>
        </div>
        <!-- End Comments -->
    </div>
</div>
<?php
}