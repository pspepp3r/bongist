<?php
if (isset($_GET['params'])) {
  $invoice = invoice::check($_GET["params"], 'invoice_id');
  if ($invoice) {
    $invoice_id = strtoupper($invoice['invoice_id']);
    $invoice_items = invoice::checkItem($invoice_id, 'invoice_id');
    $customer_id = $invoice['customer_id'];
    $customer = invoice::checkCustomer($customer_id);

    if (isset($_POST['addReceipt'])) {
      receipt::add(
        $invoice_id,
        $_POST['amount'],
        $_POST['payment_method'],
        $_POST['date']
      );
    }
    ?>
    <div class="u-body">
      <h1 class="h2 font-weight-semibold float-left">Invoice</h1>
      <a class="btn btn-dark ml-4 float-right" href="#addReceipt" data-toggle="modal">Generate Receipt</a>
      <a class="btn btn-dark ml-4 float-right" href="admin/accounting/receipt/view?params=<?= $invoice_id ?>">View
        Receipts</a>
      <a class="btn btn-dark ml-4 float-right" href="javascript:void(0);" onclick="window.print()"><i class="fas fa-print"></i>
        Print</a>
      <div class="float-right">
        <a class="btn btn-dark btn-block" href="admin/accounting/invoices">Go back</a>
      </div>
    </div>
    <div class="container invoice_print">
      <div class="card">
        <div class="card-header text-center">
          <h2><?= config::name() ?></h2>
          <small>Invoice #: <?= $invoice_id ?> | Created: <?= date("d/m/Y", $invoice['timestamp']) ?> | Due:
            <?= date("d/m/Y", $invoice['due_date']) ?></small>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h5>From:</h5>
              <p><?= config::address() ?><br>Phone: <?= config::phone() ?>
              </p>
            </div>
            <div class="col-md-6 text-right">
              <h5>Bill To:</h5>
              <p><?= $customer['customer_name'] ?><br><?= $customer['address'] ?><br><?= $customer['phone'] ?></p>
            </div>
          </div>
          <table class="table mt-4">
            <thead>
              <tr class="table-active">
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th class="text-right">Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($invoice_items as $item): ?>
                <tr>
                  <td><?= $item['product_name'] ?></td>
                  <td><?= $item['unit_price'] ?></td>
                  <td><?= $item['quantity'] ?></td>
                  <td class="text-right"><?= $item['unit_price'] * $item['quantity'] ?></td>
                </tr>
              <?php endforeach; ?>
              <tr class="table-active">
                <td><strong>Subtotal:</strong></td>
                <td></td>
                <td></td>
                <td class="text-right"><strong>₦<?= $invoice['subtotal'] ?></strong></td>
              </tr>
              <tr>
                <td>Taxable: ₦<?= $invoice['total'] ?></td>
                <td class="text-right"></td>
              </tr>
              <tr>
                <td>Tax Rate: <?= $invoice['tax'] ?>%</td>
                <td class="text-right"></td>
              </tr>
              <tr>
                <td>Amount paid: ₦<?= $invoice['amount_paid'] ?></td>
                <td class="text-right"></td>
              </tr>
              <tr>
                <td>Balance due: ₦<?= $invoice['balance_due'] ?></td>
                <td class="text-right"></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-footer text-center">
          <img src="<?= config::logo() ?>" alt="<?= config::name() ?> Logo" style="width: 100px; height: 30px">
        </div>
      </div>
    </div>
    <?php
  } else {
    ?>
    <div class="u-body">
      <h1 class="h2 font-weight-semibold mb-4 float-left">View Invoices</h1>
      <div class="float-right">
        <a class="btn btn-dark btn-block" href="admin/accounting/invoices">Go back</a>
      </div>

      <div class="card mb-4" style="clear: both;">
        <header class="card-header">
          <h2 class="h3 card-header-title">No invoice to view</h2>
        </header>
      </div>
    </div>
    <?php
  }
} else {
  ?>
  <div class="u-body">
    <h1 class="h2 font-weight-semibold mb-4 float-left">View Invoices</h1>
    <div class="float-right">
      <a class="btn btn-dark btn-block" href="admin/accounting/invoices">Go back</a>
    </div>

    <div class="card mb-4" style="clear: both;">
      <header class="card-header">
        <h2 class="h3 card-header-title">No invoice to view</h2>
      </header>
    </div>
  </div>
  <?php
}