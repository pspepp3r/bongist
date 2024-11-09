<div class="u-body">
  <h1 class="h2 font-weight-semibold mb-4 float-left">Invoices</h1>
  <div class="float-right">
    <a class="btn btn-dark btn-block" href="#addInvoice" data-toggle="modal">New Invoice</a>
  </div>

  <div class="card mb-4" style="clear: both;">
    <header class="card-header">
      <h2 class="h3 card-header-title">Recent Invoices</h2>
    </header>

    <div class="card-body">
      <?php
      if (isset($_POST['addInvoice'])) {
        invoice::add(
          $staff_id,
          $_POST['customer_name'],
          $_POST['email'],
          $_POST['phone'],
          $_POST['address'],
          $_POST['products'],
          $_POST['subtotal'],
          $_POST['tax'],
          $_POST['total']
        );
      }

      if (isset($_POST['removeInvoice'])) {
        invoice::remove($_POST['invoice_id']);
      }

      $invoices = invoice::all();

      if ($invoices) {
        ?>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Customer</th>
                <th scope="col">Invoice Number</th>
                <th scope="col">Total</th>
                <th scope="col">Time Added</th>
                <?php
                if ($role == 1) {
                  ?>
                  <th class="text-center" scope="col">Actions</th>
                  <?php
                }
                ?>
              </tr>
            </thead>

            <tbody>
              <?php
              foreach ($invoices as $invoice) {
                $invoice_id = $invoice['invoice_id'];
                $customer_id = $invoice['customer_id'];
                $customer = customer::check($customer_id, 'id');
                $date = $invoice['timestamp'];
                $total = number_format($invoice['total'], 2);
                $subtotal = number_format($invoice['subtotal'], 2);
                $tax = $invoice['tax'];
                $name = $customer['customer_name'];
                $invoice_items = invoice::checkItem($invoice_id, 'invoice_id');
                ?>
                <tr>
                  <td><?= $name; ?></td>
                  <td>
                    <!-- <a href="admin/accounting/invoices/<? //=$invoice_id ?>/details" class="btn btn-secondary"><? //=$invoice_id ?></a> -->
                    <a href="admin/accounting/invoice/view?params=<?= $invoice_id ?>" style="text-transform: uppercase;" class="btn btn-secondary">
                      <?= $invoice_id; ?>
                    </a>
                  </td>
                  <td>
                    <?= $total ?>
                  </td>
                  <td>
                    <span class="badge badge-dark"><?= request::timeago($date); ?></span>
                  </td>
                  <?php
                  if ($role == 1) {
                    ?>
                    <td class="text-center">
                      <a id="actions1Invoker" class="link-muted" href="#!" aria-haspopup="true" aria-expanded="false"
                        data-toggle="dropdown">
                        <i class="fa fa-sliders-h"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right dropdown" style="width: 150px;"
                        aria-labelledby="actions1Invoker">
                        <ul class="list-unstyled mb-0">
                          <li>
                            <a class="d-flex align-items-center link-muted py-2 px-3"
                              href="admin/accounting/invoice/edit?params=<?= $invoice_id ?>">
                              <i class="fa fa-plus mr-2"></i> Edit Invoice
                            </a>
                          </li>
                          <li>
                            <a class="d-flex align-items-center link-muted py-2 px-3" data-toggle="modal"
                              href="#removeInvoice" onclick="$('.invoice_id').val('<?= $invoice_id ?>');">
                              <i class="fa fa-minus mr-2"></i> Remove
                            </a>
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
        <?php
      } else {
        respond::alert('info', '', 'No Invoice has been created');
      }
      ?>
    </div>
  </div>


</div>