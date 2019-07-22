<div class="u-body">
    <div class="card mb-4">
        <header class="card-header">
            <h2 class="h3 card-header-title">All Orders</h2>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Initial deposit</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date of delivery</th>
                        <?php
                        if($role == 1)
                        {
                            ?>
                            <th class="text-center" scope="col">Actions</th>
                            <?php
                        }
                        ?>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    if(isset($_POST['editOrder']))
                    {
                        order::update($_POST['order_id'], $_POST['status'], $_POST['note'], $staff_id);
                    }

                    if (isset($_POST['removeOrder'])) {
                        order::remove($_POST['id']);
                    }
                    $orders = order::all();

                    foreach($orders as $order)
                    {
                        $id = $order['id'];
                        $order_id = $order['order_id'];
                        $customer = $order['customer_name'];
                        $deposit = $order['initial_deposit'];
                        $dod = $order['date_of_delivery'];
                        $type = $order['type'];
                        $cost = $order['cost'];
                        $status = $order['status_name'];

                    ?>
                    <tr>
                    <td><a href="admin/orders/<?php echo $order_id; ?>/details" class="btn btn-secondary" style="text-transform: uppercase;"><?php echo $order_id; ?></a></td>
                    <td><?php echo $customer; ?></td>
                    <td><?php echo '₦' . number_format($deposit); ?></td>
                    <td><?php echo '₦' . number_format($cost); ?></td>
                    <td style="text-transform: uppercase;"><?php echo $type; ?></td>
                        <?php
                        if($status == 'Pending')
                        {
                            ?>
                            <td><a class="badge badge-soft-info" href="#"><?php echo $status; ?></a></td>
                        <?php
                        }elseif($status == 'Digitalizing') {
                            ?>
                            <td><a class="badge badge-soft-secondary" href="#"><?php echo $status; ?></a></td>
                        <?php
                        }elseif($status == 'Machine Processing')
                        {
                            ?>
                            <td><a class="badge badge-soft-warning" href="#"><?php echo $status; ?></a></td>
                        <?php
                        }elseif($status == 'Finishing')
                        {
                            ?>
                            <td><a class="badge badge-soft-primary" href="#"><?php echo $status; ?></a></td>
                        <?php
                        }elseif($status = 'Delivered')
                        {
                            ?>
                            <td><a class="badge badge-soft-success" href="#"><?php echo $status; ?></a></td>
                        <?php
                        }
                        ?>
                    <td><?= $dod; ?></td>
                        <?php
                        if($role == 1)
                        {
                            ?>
                            <td class="text-center">
                                <a id="actions1Invoker" class="link-muted" href="#!" aria-haspopup="true" aria-expanded="false"
                                   data-toggle="dropdown">
                                    <i class="fa fa-sliders-h"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right dropdown" style="width: 150px;" aria-labelledby="actions1Invoker">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <a class="d-flex align-items-center link-muted py-2 px-3" data-toggle="modal" href="#editOrderModal" onclick="$('.order_id').val('<?php echo $order_id; ?>'); $('.order_status').val('<?php echo $status; ?>');"><i class="fa fa-plus mr-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-items-center link-muted py-2 px-3" data-toggle="modal" href="#deleteOrderModal" onclick="$('.id').val('<?php echo $id; ?>');"><i class="fa fa-minus mr-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        <?php
                        }
                        ?>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>