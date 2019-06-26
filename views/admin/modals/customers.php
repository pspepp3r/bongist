<!-- Add Customer Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <input type="text" name="name" required placeholder="Customer Name" class="form-control">
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
          <button type="submit" name="add" class="btn btn-dark">Add Customer</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

