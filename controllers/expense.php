<?php

class expense {

    public static function add($staff_id, $title, $expense_type, $cost, $category_id)
    {
        global $db;

        $expense = $db->query("INSERT INTO expenses (staff_id, title, expense_type, cost, category_id, timestamp) VALUES (:staff_id, :title, :expense_type, :cost, :category_id, :timestamp)", array(
            'staff_id'      => $staff_id,
            'title'         => $title,
            'expense_type'  => $expense_type,
            'cost'          => $cost,
            'category_id'   => $category_id,
            'timestamp'     => time()
        ));

        if($expense)
        {
            $expense_id = $db->lastInsertId();
            $activity = $db->query("INSERT INTO activities (staff_id, expense_id, comment,timestamp) VALUES (:staff_id, :expense_id, :comment, :timestamp)",array(
                'staff_id'      => $staff_id,
                'expense_id'    => $expense_id,
                'comment'       => config::expenseActivity(),
                'timestamp'     => time()
            ));

            if($activity)
            {
                respond::alert('success', '', 'Expense has been added successfully');
            }
        }
    }

    public static function edit($id, $title, $cost, $staff_id)
    {
        global $db;

        $edit = $db->query("UPDATE expenses SET title = :title, cost = :cost, timestamp = :timestamp WHERE id = :id", array(
            'id'        => $id,
            'title'     => $title,
            'cost'      => $cost,
            'timestamp' => time()
        ));

        if($edit)
        {
            $expense_id = $id;
            $editActivity = $db->query("INSERT INTO activities (comment, expense_id, staff_id, timestamp) VALUES (:comment, :expense_id, :staff_id, :timestamp)", array(
                'comment'       => '',
                'expense_id'    => $expense_id,
                'staff_id'      => $staff_id,
                'timestamp'     => time()
            ));

            if($editActivity)
            {
                respond::alert('success', '', 'expense has been edited successfully');
            }
        }
    }

    public static function delete($id, $staff_id)
    {
        global $db;

        $delete = $db->query("DELETE FROM expenses WHERE id = :id", array(
            'id' => $id
        ));

        if($delete)
        {
            $activity = $db->query("INSERT INTO activities (staff_id, comment, timestamp) VALUES (:staff_id, :comment, :timestamp)", array(
                'staff_id'  => $staff_id,
                'comment'   => config::expenseActivity(),
                'timestamp' => time()
            ));

            if($activity)
            {
                respond::alert('success', '', 'expense has been deleted successfully');
            }
        }
    }

    public static function addExpenseCategory($category, $staff_id)
    {
        global $db;

        $add = $db->query("INSERT INTO expense_category (category) VALUES (:category)", array('category' => $category));

        if($add) {
            $activity = $db->query("INSERT INTO activities (staff_id, comment, timestamp) VALUES (:staff_id, :comment, :timestamp)", array(
                'staff_id'  => $staff_id,
                'comment'   => config::expenseCategoryActivity(),
                'timestamp' => time()
            ));

            if($activity)
            {
                respond::alert('success', '', 'expense category has been added successfully');
            }
        }
    }

    public static function totalExpense()
    {
        global $db;

        $total = $db->query("SELECT SUM(cost) FROM expenses");
        return $total;
    }

    public static function all()
    {
        global $db;

        $expenses = $db->query("SELECT expenses.*, name, category FROM expenses LEFT JOIN staff ON staff_id = staff.id LEFT JOIN expense_category ON category_id = expense_category.id ORDER BY id DESC");

        return $expenses;
    }
}