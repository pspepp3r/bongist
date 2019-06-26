<?php

$orders = customer::orders($account['id']);

if ($orders) {
    ?>
    <table class="table table-borderless table-hover table-responsive-md mb-5">
        <thead class="bg-light">
        <tr>
            <th class="py-4 text-uppercase text-sm">Order ID</th>
            <th class="py-4 text-uppercase text-sm">Date</th>
            <th class="py-4 text-uppercase text-sm">Total</th>
            <th class="py-4 text-uppercase text-sm">Status</th>
            <th class="py-4 text-uppercase text-sm">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php

            foreach ($orders as $order) {
                ?>
                <tr>
                    <th class="py-4 align-middle"><a class="text-dark" href="account/orders/<?php echo $order['order_id']; ?>">#<?php echo $order['order_id']; ?></a></th>
                    <td class="py-4 align-middle"><?php echo request::timeago($order['timestamp']); ?></td>
                    <td class="py-4 align-middle">₦<?php echo number_format($order['total']); ?></td>
                    <td class="py-4 align-middle"><span class="badge text-uppercase badge-<?php echo $order['color']; ?> p-2"><?php echo $order['name']; ?></span></td>
                    <td class="py-4 align-middle"><a href="account/orders/<?php echo $order['order_id']; ?>" class="btn btn-outline-dark btn-sm">View</a></td>
                </tr>
                <?php
            }

        ?>

        </tbody>
    </table>
<?php
}else {
    respond::alert('info', '', 'You have not made any order');
}
