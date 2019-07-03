<div class="u-body">
    <div class="row">
        <div class="card col-md-4">
            <header class="card-header">
                <h2 class="h3 card-header-title"><strong>Add Expense</strong></h2>
            </header>
            <form action="" method="post">

                <?php
                if(isset($_POST['addExpense']))
                {
                    expense::add($staff_id,$_POST['title'], $_POST['cost'], $_POST['category_id']);
                }
                ?>

                <div class="col-md-12 form-group mb-3">
                    <label for="">Title</label>
                    <textarea name="title" id="" cols="30" rows="3" class="form-control"></textarea>
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
                            $name = $category['name'];
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
    </div>
</div>