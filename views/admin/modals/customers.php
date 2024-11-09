<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body row">

          <div class="col-md-12 mb-3">
            <label for="">Name</label>
            <input type="text" name="customer_name" required placeholder="Customer Name" class="form-control">
          </div>

          <div class="col-md-6 form-group mb-3">
            <label for="">Email Address</label>
            <input type="email" name="email" placeholder="Email Address" class="form-control">
          </div>
          <div class="col-md-6 form-group mb-3">
            <label for="">Phone Number</label>
            <input type="text" name="phone" required placeholder="Phone Number" class="form-control">
          </div>
          <div class="col-md-12 form-group mb-3">
            <label for="">Address</label>
            <textarea placeholder="Delivery Address" name="address" class="form-control" rows="3"></textarea>
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" name="addCustomer" class="btn btn-dark">Add Customer</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Customer Modal -->
<div class="modal fade" id="editCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body row">
          <input type="hidden" name="id" class="customer_id">
          <div class="col-md-12 mb-3">
            <label for="">Name</label>
            <input type="text" name="customer_name" required placeholder="Customer Name"
              class="customer_name form-control">
          </div>

          <div class="col-md-6 form-group mb-3">
            <label for="">Email Address</label>
            <input type="email" name="email" placeholder="Email Address" class="customer_email form-control">
          </div>
          <div class="col-md-6 form-group mb-3">
            <label for="">Phone Number</label>
            <input type="text" name="phone" required placeholder="Phone Number" class="customer_phone form-control">
          </div>
          <div class="col-md-12 form-group mb-3">
            <label for="">Address</label>
            <textarea placeholder="Delivery Address" name="address" class="customer_address form-control"
              rows="3"></textarea>
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" name="editCustomer" class="btn btn-dark">Save Changes</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Remove Customer Modal -->
<div class="modal fade" id="removeCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Remove Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body row">
          <div class="form-group">
            <div class="col-md-12">
              <input type="hidden" name="id" class="customer_id">
              <p class="text-center">
                Are you sure you want to remove this customer?
              </p>
              <p class="bg-danger pl-2"><strong>Note:</strong> All customer's order will be removed also.</p>
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" name="removeCustomer" class="btn btn-dark">Remove Customer</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>