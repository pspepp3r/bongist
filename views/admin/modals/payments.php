<!--Add Payment-->

<div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Add Payment</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="order_id" class="order_id">
                    <input type="hidden" name="customer_id" class="customer_id">
                    <div class="col-md-12 mb-3">
                        <label for="">Payment Method</label>
                        <select name="payment_method" id="" class="form-control">
                            <?php
                            $categories = payment::paymentCategory();

                            foreach($categories as $category)
                            {

                            ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo $category['type']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="">Balance</label>
                        <input type="number" name="amount" placeholder="Amount" class="order_cost form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" name="addPayment" class="btn btn-dark">Add Payment</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
