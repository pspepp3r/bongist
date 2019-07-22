<?php

class expense_category {

    public static function all()
    {
        global $db;

        $categories = $db->query("SELECT * FROM expense_category");
        if($categories > 0)
        {
            return $categories;
        }
    }
}