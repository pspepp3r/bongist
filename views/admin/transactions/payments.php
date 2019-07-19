<div class="u-body">
    <div class="card mb-4">
        <header class="card-header">
            <h2 class="h3 card-header-title">Payments Table</h2>
        </header>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Customer </th>
                        <th scope="col">Order ID</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Ref. No</th>
                        <th scope="col">Time Added</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $payments = payment::all();

                    foreach($payments as $payment)
                    {
                        ?>
                        <tr>
                            <td><?= $payment['customer_name']; ?></td>
                            <td><button style="text-transform: uppercase;" class="btn btn-disabled btn-secondary"><?= $payment['order_id']; ?></button></td>
                            <td>₦ <?= $payment['amount']; ?></td>
                            <td style="text-transform: uppercase;"><?= $payment['type'] ?></td>
                            <td><?= $payment['ref_no'] ?></td>
                            <td><?= request::timeago($payment['timestamp']); ?></td>
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