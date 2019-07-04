<!-- Add Order Modal -->
<div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Order</h5>
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
            <textarea placeholder="Delivery Address" name="address" class="form-control" rows="1"></textarea>
          </div>


          <div class="col-md-6 form-group mb-3">
            <label for="">Cost</label>
            <input type="number" required name="cost" placeholder="Cost" class="form-control">
          </div>
          <div class="col-md-6 form-group mb-3">
            <label for="">Initial Deposit</label>
            <input type="number" required value="0" name="deposit" placeholder="Initial Deposit" class="form-control">
          </div>

          <div class="col-md-6 form-group mb-3">
            <label for="">Date of Delivery</label>
            <input type="date" required name="dod" placeholder="Date of Delivery" class="form-control">
          </div>
          <div class="col-md-6 form-group mb-3">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
              <?php
              $status = order::status();
              foreach ($status as $item) {
                ?>
                <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <div class="col-md-12 form-group mb-3">
            <label for="">Order Note</label>
            <textarea placeholder="Order Note" name="note" class="form-control" rows="3"></textarea>
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" name="addOrder" class="btn btn-dark">Add Order</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--Update Order-->
<div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">

                    <div class="col-md-6 form-group mb-3">
                        <input type="hidden" name="id" class="order_id">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <?php
                            $status = order::status();
                            foreach ($status as $item) {
                                ?>
                                <option value="<?php echo $item['id']; ?>"><?php echo $item['status_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="editOrder" class="btn btn-dark">Edit Order</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
