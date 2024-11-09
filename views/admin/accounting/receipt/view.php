<?php
if (isset($_GET['params'])) {
  $receipts = receipt::getInvoiceReceipt($_GET['params']);
  if ($receipts) {
    ?>

    <div class="u-body">
      <h1 class="h2 font-weight-semibold mb-4 float-left">Receipts for Invoice <?= $receipts[0]["invoice_id"] ?></h1>
      <div class="float-right">
        <a class="btn btn-dark btn-block" href="admin/accounting/invoices/view?params=<?= $receipts[0]["invoice_id"] ?>">Go
          back</a>
      </div>

      <div class="card mb-4" style="clear: both;">
        <header class="card-header">
          <h2 class="h3 card-header-title">Recent Invoice Receipts</h2>
        </header>


        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Receipt Number</th>
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
        </div>
      </div>


    </div>
    <?php
  }
}