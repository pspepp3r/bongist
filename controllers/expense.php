<?php

class expense {

    public static function add($staff_id, $title, $cost, $category_id)
    {
        global $db;

        $expense = $db->query("INSERT INTO expenses (staff_id, title, cost, category_id, timestamp) VALUES (:staff_id, :title, :cost, :category_id, :timestamp)", array(
            'staff_id'      => $staff_id,
            'title'         => $title,
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
                'comment'       => 'just made an expense',
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
                'comment'       => 'just edited an expense',
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
}