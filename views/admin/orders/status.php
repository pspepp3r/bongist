<?php

$slug = $order_id;

?>

<div class="u-body">
    <div class="card mb-4">
        <header class="card-header">
            <h2 class="h3 card-header-title"><?php echo $slug; ?> Orders</h2>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Initial deposit</th>
                        <th scope="col">Date of delivery</th>
                        <th scope="col">Cost</th>
                        <th class="text-center" scope="col">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    if(isset($_POST['editOrder']))
                    {
                        order::update($_POST['order_id'], $_POST['status'], $_POST['note'], $staff_id);
                    }

                    $top = order::check_status($slug);
                    $id = $top['id'];
                    $orders = order::status_orders($id);

                    foreach($orders as $order)
                    {
                        $id = $order['id'];
                        $order_id = $order['order_id'];
                        $customer = $order['name'];
                        $deposit = $order['initial_deposit'];
                        $dod = $order['date_of_delivery'];
                        $cost = $order['cost'];
                        $status = $order['status_name'];

                        ?>
                        <tr>
                            <td><a href="admin/orders/<?php echo $order_id; ?>/details"><?php echo $order_id; ?></a></td>
                            <td><?php echo $customer; ?></td>
                            <td><?php echo '₦' . $deposit; ?></td>
                            <td><?php echo $dod; ?></td>
                            <td><?php echo '₦' . $cost; ?></td>
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
                                            <a class="d-flex align-items-center link-muted py-2 px-3" href="#!">
                                                <i class="fa fa-minus mr-2"></i> Remove
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
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
