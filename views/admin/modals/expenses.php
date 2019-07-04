<!--Edit Staff-->

<div class="modal fade" id="editExpenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong>Edit Expense</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <input type="hidden" name="id" class="expense_id">
                    <div class="col-md-12 mb-3">
                        <label for="">Title</label>
                        <textarea name="title" class="expense_title form-control" id="" cols="30" rows="3"></textarea>
                    </div>
                    <div class="col-md-12 form-group mb-3">
                        <label for="">cost</label>
                        <input type="number" name="cost" placeholder="cost" class="expense_cost form-control">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" name="editExpense" class="btn btn-dark">Save Changes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>