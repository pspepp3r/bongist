<?php
if (isset($_GET['params'])) {
  $receipt = receipt::getInvoiceReceipt($_GET['params']);
  if ($receipt) {
    ?>
            <div class="u-body">
                <h1 class="h2 font-weight-semibold mb-4 float-left">Receipts</h1>

                <div class="card mb-4" style="clear: both;">
                    <header class="card-header">
                        <h2 class="h3 card-header-title">Recent Receipts</h2>
                    </header>


                    <div class="card-body">
                    </div>
                </div>


            </div>
            <?php
  }
}