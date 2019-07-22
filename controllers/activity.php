<?php

class activity {

    public static function all()
    {
        global $db;

        $activities = $db->query("SELECT activities.*, name, photo, category_id FROM activities LEFT JOIN staff ON staff_id = staff.id LEFT JOIN expenses ON expense_id = expenses.id ORDER BY id DESC");
        if($activities > 0)
        {
            return $activities;
        }
    }

    public static function expenseActivity($staff_id)
    {
        global $db;

        $expenseAct = $db->query("SELECT expenses.*, category FROM expenses LEFT JOIN expense_category ON category_id = expense_category.id WHERE staff_id = :staff_id", array(
            'staff_id' => $staff_id
        ));

        if($expenseAct > 0)
        {
            return $expenseAct;
        }else {
            respond::alert('error', '', 'there are no expense activities');
        }
    }
}