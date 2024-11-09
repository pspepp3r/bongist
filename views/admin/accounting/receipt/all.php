<div class="u-body">
  <h1 class="h2 font-weight-semibold mb-4 float-left">Receipts</h1>

  <div class="card mb-4" style="clear: both;">
    <header class="card-header">
      <h2 class="h3 card-header-title">Recent Receipts</h2>
    </header>

    <div class="card-body">
      <?php
      $receipts = receipt::all();

      if ($receipts) {
        ?>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Receipt Number</th>
                <th scope="col">Invoice Number</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Payment Date</th>
                <th scope="col">Amount</th>
              </tr>
            </thead>

            <tbody>
              <?php
              foreach ($receipts as $receipt) {
                $invoice_id = $receipt['invoice_id'];
                $receipt_id = $receipt['receipt_id'];
                $method = $receipt['type'];
                $date = $receipt['timestamp'];
                $amount = number_format($receipt['amount'], 2);
                ?>
                <tr>
                  <td>
                    <!-- <a href="admin/accounting/receipts/<? //=$receipt_id ?>/details" class="btn btn-secondary"><? //=$receipt_id ?></a> -->
                    <?= $receipt_id; ?>
                  </td>
                  <td>
                    <!-- <a href="admin/accounting/invoices/<? //=$invoice_id ?>/details" class="btn btn-secondary"><? //=$invoice_id ?></a> -->
                    <a href="admin/accounting/invoice/view?params=<?= $invoice_id ?>" style="text-transform: uppercase;"
                      class="btn btn-secondary">
                      <?= $invoice_id; ?>
                  <td>
                    <?= $method ?>
                  </td>
                  <td>
                    <span class="badge badge-dark"><?= request::timeago($date); ?></span>
                  </td>
                  <td>
                    <?= $amount ?>
                  </td>
                </tr>
                <?php
              }
              ?>
            </tbody>
          </table>
        </div>
        <?php
      } else {
        respond::alert('info', '', 'No Receipt has been created');
      }
      ?>
    </div>
  </div>


</div>