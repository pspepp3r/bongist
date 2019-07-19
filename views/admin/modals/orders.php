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
            <textarea placeholder="Delivery Address" name="address" class="form-control" rows="1"></textarea>
          </div>

          <div class="col-md-6 form-group mb-3">
            <label for="">Date of Delivery</label>
            <input type="date" required name="dod" placeholder="Date of Delivery" class="form-control">
          </div>
          <div class="col-md-6 form-group mb-3">
            <label for="">Status</label>
            <select name="status" class="form-control">
              <?php
              $statuses = order::status();
              foreach ($statuses as $status) {
                  $id = $status['id'];
                  $name = $status['status_name'];
                ?>
                <option value="<?= $id; ?>"><?= $name; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="col-md-6 form-group mb-3">
            <label for="">Type</label>
            <select name="type_id" id="order_type" class="form-control">
              <?php
              $types = order::type();
              foreach ($types as $type) {
                  $id = $type['id'];
                  $name = $type['type'];
                ?>
                <option value="<?= $id; ?>"><?= $name; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
            <div class="col-md-6 form-group mb-3 subCat" style="display:none;">
                <label for="">Category</label>
                <select name="subcat_id[1]" id="" class="form-control">
                    <option value="" selected>Select branding category</option>
                    <?php
                    $id = 2;
                    $subCategories = order::subCategory($id);
                    foreach ($subCategories as $subCategory) {
                        ?>
                        <option value="<?= $subCategory['id']; ?>"><?=  $subCategory['category']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 form-group mb-3 subCat2" style="display:none;">
                <label for="">Category</label>
                <select name="subcat_id[2]" id="subCater" class="form-control">
                    <option value="" selected>Select service category</option>
                    <?php
                    $id = 3;
                    $subCategories = order::subCategory($id);
                    foreach ($subCategories as $subCategory) {
                        ?>
                        <option value="<?= $subCategory['id']; ?>"><?= $subCategory['category']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 form-group mb-3 subCater1" style="display:none;">
                <label for="">Amount</label>
                <input type="number" class="form-control" id="priced" placeholder="Price">
            </div>
            <div class="col-md-6 form-group mb-3 subCater1" style="display:none;">
                <label for="">Amount</label>
                <input type="number" class="form-control" id="priced" placeholder="Price">
            </div>
            <div class="col-md-6 form-group mb-3 subCater2" style="display:none;">
                <label for="">No. of Clothes</label>
                <input type="number" class="form-control" id="costly" placeholder="amount of cloth">
            </div>

            <div class="col-md-6 form-group mb-3">
                <label for="">Cost</label>
                <input type="number" required name="cost" placeholder="Cost" class="form-control finalPrice">
            </div>
            <div class="col-md-6 form-group mb-3">
                <label for="">Initial Deposit</label>
                <input type="number" required value="0" name="deposit" placeholder="Initial Deposit" class="form-control">
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

                    <div class="col-md-12 form-group mb-3">
                        <input type="hidden" name="order_id" class="order_id">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <?php
                            $status = order::status();
                            foreach ($status as $item) {
                                ?>
                                <option value="<?= $item['id']; ?>"><?= $item['status_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="">Note</label>
                        <textarea name="note" id="" cols="30" rows="3" class="form-control"></textarea>
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

<!--Add Order Note-->
<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Add Note</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-12 form-group mb-3">
                        <input type="hidden" name="order_id" class="order_id">
                        <label for="">Note</label>
                        <textarea name="note" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" name="addNote" class="btn btn-dark">Add Note</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Remove Order Modal -->
<div class="modal fade" id="deleteOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="hidden" name="id" class="id">
                            <p class="text-center">
                                Are you sure you want to remove this Order?
                            </p>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" name="removeOrder" class="btn btn-dark">Remove Order</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
