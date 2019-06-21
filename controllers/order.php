<?php


class order {

    public static function details($order_id) {
        global $db;

        $items = $db->query("SELECT order_details.*, thumbnail, slug, name FROM order_details LEFT JOIN products ON product_id = products.id WHERE order_id = :order_id", array('order_id' => $order_id));

    return $items;

    }

    public static function all() {
        global $db;

        $orders = $db->query("SELECT orders.*, fname, lname, email FROM orders LEFT JOIN accounts ON user_id = accounts.id ORDER BY orders.id DESC");

        if (count($orders) > 0) {
            return $orders;
        }else {
            return false;
        }

    }


}