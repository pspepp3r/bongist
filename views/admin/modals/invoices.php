<!-- Add Invoice Modal -->
<div class="modal fade" id="addInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Invoice</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body row">

          <div class="col-md-12 mb-3">
            <label for="">Customer Information</label>
            <input type="text" name="customer_name" required placeholder="Customer Name" class="form-control">
          </div>

          <div class="col-md-6 form-group mb-3">
            <input type="email" name="email" placeholder="Email Address" class="form-control">
          </div>
          <div class="col-md-6 form-group mb-3">
            <input type="text" name="phone" required placeholder="Phone Number" class="form-control">
          </div>
          <div class="col-md-12 form-group mb-3">
            <textarea placeholder="Billing Address" name="address" class="form-control" rows="3"></textarea>
          </div>


          <div class="product-section row mx-1 px-2">
            <div class="col-md-12 mb-3">
              <label for="">Products Information</label>
            </div>
            <div id="product-1" class="row product-item">
              <div class="col-md-4 form-group mb-3">
                <input id="product-name-1" type="text" name="products[1][product_name]" placeholder="Product Name"
                  class="form-control">
              </div>
              <div class="col-md-4 form-group mb-3">
                <input id="quantity-1" type="number" name="products[1][quantity]" placeholder="Quantity"
                  class="form-control">
              </div>
              <div class="col-md-4 form-group mb-3">
                <input id="unit-price-1" type="number" step="1" name="products[1][unit_price]" placeholder="Unit Price"
                  class="form-control">
              </div>
              <div class="col-md-12 form-group mb-3">
                <textarea id="description-1" style="height: 45px" name="products[1][description]"
                  placeholder="Description" class="form-control"></textarea>
              </div>
            </div>
            <div class="col-md-12 form-group mb-3" id="add-product">
              <button id="add" type="button" class="btn btn-dark">Add Product</button>
            </div>
          </div>

          <div class="col-md-12 mb-3">
            <label for="">Invoice Summary</label>
          </div>
          <div class="col-md-4 form-group mb-3">
            <input id="subtotal" step="0.01" type="text" name="subtotal" placeholder="Subtotal" class="form-control">
          </div>
          <div class="col-md-4 form-group mb-3">
            <input id="tax" step="0.01" type="number" name="tax" placeholder="Tax (%)" class="form-control">
          </div>
          <div class="col-md-4 form-group mb-3">
            <input id="total" step="0.01" type="number" name="total" placeholder="Total" class="form-control">
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" name="addInvoice" class="btn btn-dark">Add Invoice</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
      <script>
        let productCount = 1;
        const firstProduct = document.querySelector('#product-1');

        document.getElementById('add-product').addEventListener('click', function () {
          productCount++;

          const productSection = document.querySelector('.product-section');
          const newProduct = document.createElement('div');
          newProduct.classList.add('product-item', 'mt-4');
          newProduct.id = `product-${productCount}`;
          newProduct.innerHTML = `
          <div id="product-${productCount}" class="row">
              <div class="col-md-4 form-group mb-3">
                <input id="product-name-${productCount}" type="text" name="products[${productCount}][product_name]" placeholder="Product Name"
                  class="form-control">
              </div>
              <div class="col-md-4 form-group mb-3">
                <input id="quantity-${productCount}" type="number" name="products[${productCount}][quantity]" placeholder="Quantity"
                  class="form-control">
              </div>
              <div class="col-md-4 form-group mb-3">
                <input id="unit-price-${productCount}" type="number" step="0.01" name="products[${productCount}][unit_price]"
                  placeholder="Unit Price" class="form-control">
              </div>
              <div class="col-md-12 form-group mb-3">
                <textarea id="description-${productCount}" style="height: 45px" name="products[${productCount}][description]"
                  placeholder="Description" class="form-control"></textarea>
              </div>
          </div>
            `;


          productSection.insertBefore(newProduct, document.getElementById('add-product'));

          // Add event listeners for subtotal calculation on the new inputs
          addProductEventListeners(newProduct);
        });


        // Function to add event listeners to calculate subtotal
        function addProductEventListeners(product) {
          const quantityInput = product.querySelector('input[type="number"][name*="quantity"]');
          const priceInput = product.querySelector('input[type="number"][name*="unit_price"]');

          quantityInput.addEventListener('input', calculateSubtotal);
          priceInput.addEventListener('input', calculateSubtotal);
        }

        // Function to calculate subtotal and total
        function calculateSubtotal() {
          let subtotal = 0;

          const products = document.querySelectorAll('.product-item');
          products.forEach(product => {
            const quantity = parseFloat(product.querySelector('input[name*="quantity"]').value) || 0;
            const price = parseFloat(product.querySelector('input[name*="unit_price"]').value) || 0;
            subtotal += quantity * price;
          });

          document.getElementById('subtotal').value = subtotal.toFixed(2);
          calculateTotal(subtotal);
        }

        // Function to calculate total after tax
        function calculateTotal(subtotal) {
          const taxPercentage = parseFloat(document.getElementById('tax').value) || 0;
          const total = subtotal - (subtotal * (taxPercentage / 100));
          document.getElementById('total').value = total.toFixed(2);
        }

        // Add event listener for tax input change
        document.getElementById('tax').addEventListener('input', function () {
          const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
          calculateTotal(subtotal);
        });

        // Initial event listener for the first product
        addProductEventListeners(document.getElementById('product-1'));
      </script>
    </div>
  </div>
</div>

<!-- Remove Invoice Modal -->
<div class="modal fade" id="removeInvoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Remove Invoice</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body row">
          <div class="form-group">
            <div class="col-md-12">
              <input type="hidden" name="invoice_id" class='invoice_id'>
              <p class="text-center">
                Are you sure you want to remove this invoice?
              </p>
              <p class="bg-danger pl-2"><strong>Note:</strong> All invoice receipts will be removed also.</p>
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" name="removeInvoice" class="btn btn-dark">Remove Invoice</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>