<!-- Add Receipt Modal -->
<div class="modal fade" id="addReceipt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Receipt</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body row">
          <div class="col-md-12 mb-3">
            <label for="">Payment Date:</label>
            <input type="date" name="date" required class="form-control">
          </div>

          <div class="col-md-6 form-group mb-3">
            <label for="">Amount:</label>
            <input type="number" step="0.01" name="amount" class="form-control">
          </div>
          <div class="col-md-6 form-group mb-3">
            <label for="">Payment Method:</label>
            <select name="payment_method" id="" class="form-control">
              <?php
              $categories = payment::paymentCategory();

              foreach ($categories as $category) {

                ?>
                <option value="<?php echo $category['id']; ?>"><?php echo $category['type']; ?></option>
                <?php
              }
              ?>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" name="addReceipt" class="btn btn-dark">Add Receipt</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>