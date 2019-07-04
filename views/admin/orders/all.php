<div class="u-body">
    <div class="card mb-4">
        <header class="card-header">
            <h2 class="h3 card-header-title">Basic Table</h2>
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
                        <th scope="col" width="180">Status</th>
                        <th class="text-center" scope="col">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $orders = order::all();

                    foreach($orders as $order)
                    {
                        $order_id = $order['order_id'];
                        $customer = $order['name'];
                        $deposit = $order['initial_deposit'];
                        $dod = $order['date_of_delivery'];
                        $cost = $order['cost'];
                        $status = $order['status_name'];

                    ?>
                    <tr>
                    <td><?php echo $order_id; ?></td>
                    <td><?php echo $customer; ?></td>
                    <td><?php echo '₦' . $deposit; ?></td>
                    <td><?php echo $dod; ?></td>
                    <td><?php echo '₦' . $cost; ?></td>
                    <td>
                        <a class="badge badge-soft-info" href="#"><?php echo $status; ?></a>
                    </td>
                    <td class="text-center">
                        <a id="actions1Invoker" class="link-muted" href="#!" aria-haspopup="true" aria-expanded="false"
                           data-toggle="dropdown">
                            <i class="fa fa-sliders-h"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown" style="width: 150px;" aria-labelledby="actions1Invoker">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <a class="d-flex align-items-center link-muted py-2 px-3" href="#!">
                                        <i class="fa fa-plus mr-2"></i> Add
                                    </a>
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