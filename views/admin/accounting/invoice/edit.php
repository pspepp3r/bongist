<?php
if (isset($_GET['params'])) {
  $invoice = invoice::check($_GET["params"], 'invoice_id');
  $invoice_id = $invoice['invoice_id'];
  $invoice_items = invoice::checkItem($invoice_id, 'invoice_id');
  $customer_id = $invoice['customer_id'];
  $customer = invoice::checkCustomer($customer_id);

  if (isset($_POST['editInvoice'])) {
    // customer::edit($customer_id, $_POST['customer_name'], $_POST['email'], $_POST['phone'], $_POST['address']);
    invoice::edit(
      $invoice_id,
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
  ?>
  <div class="u-body">
    <h1 class="h2 font-weight-semibold mb-4 float-left">Edit Invoices</h1>
    <div class="float-right">
      <a class="btn btn-dark btn-block" href="admin/accounting/invoices">Go back</a>
    </div>

    <div class="card mb-4" style="clear: both;">
      <header class="card-header">
        <h2 class="h3 card-header-title">Edit Invoice <?= $invoice_id ?></h2>
      </header>

      <div class="card-body">
        <form action="" method="post">
          <div class="row">

            <div class="col-md-12 mb-3">
              <label for="">Customer Information</label>
              <input type="text" name="customer_name" required placeholder="Customer Name"
                class="customer_name form-control" value="<?= $customer['customer_name'] ?>">
            </div>

            <div class="col-md-6 form-group mb-3">
              <input type="email" name="email" placeholder="Email Address" class="customer-email form-control"
                value="<?= $customer['email'] ?>">
            </div>
            <div class="col-md-6 form-group mb-3">
              <input type="text" name="phone" required placeholder="Phone Number" class="customer-phone form-control"
                value="<?= $customer['phone'] ?>">
            </div>
            <div class="col-md-12 form-group mb-3">
              <textarea placeholder="Billing Address" name="address" class="customer-address form-control"
                rows="3"><?= $customer['address'] ?></textarea>
            </div>


            <div class="edit-product-section row mx-1 px-2">
              <div class="col-md-12 mb-3">
                <label for="">Products Information</label>
              </div>

              <?php for ($i = 1; $i <= count($invoice_items); $i++): ?>
                <div id="edit-product-<?= $i ?>" class="row edit-product-item">
                  <div class="col-md-4 form-group mb-3">
                    <input id="edit-product-name-<?= $i ?>" type="text" name="products[<?= $i ?>][product_name]"
                      placeholder="Product Name" class="name-<?= $i ?> form-control"
                      value="<?= $invoice_items[$i - 1]['product_name'] ?>">
                  </div>
                  <div class="col-md-4 form-group mb-3">
                    <input id="edit-quantity-<?= $i ?>" type="number" name="products[<?= $i ?>][quantity]"
                      placeholder="Quantity" class="quantity-<?= $i ?> form-control"
                      value="<?= $invoice_items[$i - 1]['quantity'] ?>">
                  </div>
                  <div class="col-md-4 form-group mb-3">
                    <input id="edit-unit-price-<?= $i ?>" type="number" step="1" name="products[<?= $i ?>][unit_price]"
                      placeholder="Unit Price" class="price-<?= $i ?> form-control"
                      value="<?= $invoice_items[$i - 1]['unit_price'] ?>">
                  </div>
                  <div class="col-md-12 form-group mb-3">
                    <textarea id="edit-description-<?= $i ?>" style="height: 45px" name="products[<?= $i ?>][description]"
                      placeholder="Description"
                      class="description-<?= $i ?> form-control"><?= $invoice_items[$i - 1]['description'] ?></textarea>
                  </div>
                </div>
              <?php endfor; ?>

              <div class="col-md-12 form-group mb-3" id="edit-add-product">
                <button id="edit-add" type="button" class="btn btn-dark">Add Product</button>
              </div>
            </div>

            <div class="col-md-12 mb-3">
              <label for="">Invoice Summary</label>
            </div>
            <div class="col-md-4 form-group mb-3">
              <input id="edit-subtotal" step="0.01" type="text" name="subtotal" placeholder="Subtotal"
                class="subtotal form-control" value="<?= $invoice['subtotal'] ?>">
            </div>
            <div class="col-md-4 form-group mb-3">
              <input id="edit-tax" step="0.01" type="number" name="tax" placeholder="Tax (%)" class=" tax form-control"
                value="<?= $invoice['tax'] ?>">
            </div>
            <div class="col-md-4 form-group mb-3">
              <input id="edit-total" step="0.01" type="number" name="total" placeholder="Total" class="total form-control"
                value="<?= $invoice['total'] ?>">
            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" name="editInvoice" class="btn btn-dark">Edit Invoice</button>
            <a class="btn btn-danger" href="admin/accounting/invoices">Cancel</a>
          </div>
        </form>
        <script>
          let editProductCount = <?= count($invoice_items) - 1 ?>;
          const editFirstProduct = document.querySelector('#edit-product-1');

          document.getElementById('edit-add-product').addEventListener('click', function () {
            editProductCount++;

            const editProductSection = document.querySelector('.edit-product-section');
            const editNewProduct = document.createElement('div');
            editNewProduct.classList.add('edit-product-item', 'mt-4');
            editNewProduct.id = `edit-product-${editProductCount + 1}`;
            editNewProduct.innerHTML = `
                                <div id="edit-product-${editProductCount + 1}" class="row">
                                    <div class="col-md-4 form-group mb-3">
                                      <input id="edit-product-name-${editProductCount + 1}" type="text" name="products[${editProductCount + 1}][product_name]" placeholder="Product Name"
                                        class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                      <input id="edit-quantity-${editProductCount + 1}" type="number" name="products[${editProductCount + 1}][quantity]" placeholder="Quantity"
                                        class="form-control">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                      <input id="edit-unit-price-${editProductCount + 1}" type="number" step="0.01" name="products[${editProductCount + 1}][unit_price]"
                                        placeholder="Unit Price" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                      <textarea id="edit-description-${editProductCount + 1}" style="height: 45px" name="products[${editProductCount + 1}][description]"
                                        placeholder="Description" class="form-control"></textarea>
                                    </div>
                                </div>
                                  `;
            editProductSection.insertBefore(editNewProduct, document.getElementById('edit-add-product'));

            // Add event listeners for subtotal calculation on the new inputs
            editAddProductEventListeners(editNewProduct);
          });


          // Function to add event listeners to calculate subtotal
          function editAddProductEventListeners(editProduct) {
            const editQuantityInput = editProduct.querySelector('input[type="number"][name*="quantity"]');
            const editPriceInput = editProduct.querySelector('input[type="number"][name*="unit_price"]');

            editQuantityInput.addEventListener('input', editCalculateSubtotal);
            editPriceInput.addEventListener('input', editCalculateSubtotal);
          }

          // Function to calculate subtotal and total
          function editCalculateSubtotal() {
            let editSubtotal = 0;

            const editProducts = document.querySelectorAll('.edit-product-item');
            editProducts.forEach(editProduct => {
              const editQuantity = parseFloat(editProduct.querySelector('input[name*="quantity"]').value) || 0;
              const editPrice = parseFloat(editProduct.querySelector('input[name*="unit_price"]').value) || 0;
              editSubtotal += editQuantity * editPrice;
            });

            document.getElementById('edit-subtotal').value = editSubtotal.toFixed(2);
            editCalculateTotal(editSubtotal);
          }

          // Function to calculate total after tax
          function editCalculateTotal(editSubtotal) {
            const editTaxPercentage = parseFloat(document.getElementById('edit-tax').value) || 0;
            const editTotal = editSubtotal - (editSubtotal * (editTaxPercentage / 100));
            document.getElementById('edit-total').value = editTotal.toFixed(2);
          }

          // Add event listener for tax input change
          document.getElementById('edit-tax').addEventListener('input', function () {
            const editSubtotal = parseFloat(document.getElementById('edit-subtotal').value) || 0;
            editCalculateTotal(editSubtotal);
          });

          // Initial event listener for the already input products
          for (let i = 1; i <= <?= count($invoice_items) ?>; i++) {
            editAddProductEventListeners(document.getElementById(`edit-product-${i}`));
          }
        </script>
      </div>
    </div>

  <?php
} else {
  ?>
    <div class="u-body">
      <h1 class="h2 font-weight-semibold mb-4 float-left">Edit Invoices</h1>
      <div class="float-right">
        <a class="btn btn-dark btn-block" href="admin/accounting/invoices">Go back</a>
      </div>

      <div class="card mb-4" style="clear: both;">
        <header class="card-header">
          <h2 class="h3 card-header-title">No invoice to edit</h2>
        </header>
      </div>
    </div>
  <?php
}