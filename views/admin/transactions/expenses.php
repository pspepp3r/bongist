<div class="u-body">
    <button style="margin-left: -15px;margin-bottom: 10px;" class="btn btn-dark" data-target="#addExpenseCategoryModal" data-toggle="modal" onclick="$('#addExpenseCategoryrModal').modal('show')">Add Expense Category</button>
    <div class="row">
        <div class="card col-md-4" style="max-height: 500px;">
            <header class="card-header">
                <h2 class="h3 card-header-title">Add Expense</h2>
            </header>
            <form action="" method="post">

                <?php
                if(isset($_POST['addExpenseCategory']))
                {
                    expense::addExpenseCategory($_POST['category'], $staff_id);
                }

                if(isset($_POST['addExpense']))
                {
                    expense::add($staff_id,$_POST['title'], $_POST['expense_type'], $_POST['cost'], $_POST['category_id']);
                }

                if(isset($_POST['removeExpense']))
                {
                    expense::delete($_POST['id'], $staff_id);
                }
                ?>

                <div class="col-md-12 form-group mb-3">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="col-md-12 form-group mb-3">
                    <label for="">Type</label>
                    <select name="expense_type" id="" class="form-control">
                        <option value="office">office</option>
                        <option value="factory">factory</option>
                    </select>
                </div>
                <div class="col-md-12 form-group mb-3">
                    <label for="">Cost</label>
                    <input type="number" class="form-control" name="cost">
                </div>
                <div class="col-md-12 form-group mb-3">
                    <label for="">Category</label>
                    <select name="category_id" id="" class="form-control">
                        <?php
                        $categories = expense_category::all();

                        foreach($categories as $category)
                        {
                            $id = $category['id'];
                            $name = $category['category'];
                            ?>
                            <option value="<?php echo $id ?>"><?php echo $name ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-12 form-group mb-3">
                    <button type="submit" name="addExpense" class="btn btn-dark">Add Expense</button>
                </div>
            </form>
        </div>
        <!-- Comments -->
        <div class="col-md-5">
            <div class="card h-100">
                <header class="card-header d-md-flex align-items-center">
                    <h2 class="h3 card-header-title">Activities</h2>

                </header>

                <div class="card-body p-0 m-0">
                    <div class="tab-content" id="commentsTabs">
                        <!-- Tabs Content -->
                        <div class="tab-pane fade show active" id="commentsTab1" role="tabpanel">
                            <div class="list-group list-lg-group list-group-flush">
                                <!-- Comment -->
                                <?php

                                if(isset($_POST['editExpense']))
                                {
                                    expense::edit($_POST['id'], $_POST['title'], $_POST['cost'], $staff_id);
                                }

                                $expenseAct = activity::expenseActivity($staff_id);
                                foreach($expenseAct as $act) {
                                    $id = $act['id'];
                                    $title = $act['title'];
                                    $name = $act['name'];
                                    $cost = $act['cost'];
                                    $timestamp = $act['timestamp'];

                                    ?>
                                    <div class="list-group-item list-group-item-action" href="#">
                                        <div class="media">
                                            <img class="u-avatar rounded-circle mr-3"
                                                 src="assets/img/avatars/img1.jpg" alt="Image description">

                                            <div class="media-body">
                                                <div class="d-md-flex align-items-center">
                                                    <h4 class="mb-1">
                                                        <?php echo '<strong>' . $name . '</strong>' . ' - ' . '₦' . $cost; ?>
                                                    </h4>
                                                    <?php
                                                    if($role == 1)
                                                    {
                                                        ?>
                                                        <span class="text-muted ml-md-auto">
                                                        <a data-toggle="modal" href="#editExpenseModal" onclick="$('.expense_id').val('<?php echo $id; ?>'); $('.expense_title').val('<?php echo $title; ?>'); $('.expense_cost').val('<?php echo $cost; ?>');"><i class="fas fa-edit text-info"></i></a>
                                                        <a class="" data-toggle="modal" href="#removeExpenseModal" onclick="$('.expense_id').val('<?php echo $id; ?>');"><i class="fa fa-trash text-danger"></i></a>
                                                    </span>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <p class="mb-0">
                                                    <?php echo $title;
                                                    ?>
                                                </p>
                                                <small class="mb-0">
                                                    <?php echo request::timeago($timestamp);?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                <!-- End Comment -->
                            </div>
                        </div>
                        <!-- End Tabs Content -->

                    </div>
                </div>
            </div>
        </div>
        <!-- End Comments -->
    </div>
</div>