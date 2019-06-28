<?php


class order {

  public static function add($staff_id, $name, $email, $phone, $address, $cost, $dod, $deposit, $status, $note) {
      global $db;

      $check = customer::check($phone, 'phone');

      if ($check) {
        $customer_id = $check['id'];
      }else {

        $db->query("INSERT INTO customers (name, email, phone, address, timestamp) VALUES (:name, :email, :phone, :address, :now)", array(
          'name' => $name,
          'email' => $email,
          'phone' => $phone,
          'address' => $address,
          'now' => time()
        ));

        $customer_id = $db->lastInsertId();

      }

      $order_id = request::generateRandomID(5);

      $insert = $db->query("INSERT INTO orders (order_id, customer_id, cost, date_of_delivery, initial_deposit, staff_id, status, timestamp) VALUES (:order_id, :customer_id, :cost, :date_of_delivery, :initial_deposit, :staff_id, :status, :now)", array(
        'customer_id' => $customer_id,
        'cost' => $cost,
        'order_id' => $order_id,
        'date_of_delivery' => $dod,
        'initial_deposit' => $deposit,
        'staff_id' => $staff_id,
        'status' => $status,
        'now' => time()
      ));

      if ($insert) {

        if ($note != '') {
          $db->query("INSERT INTO order_notes (order_id, staff_id, note, timestamp) VALUES (:order_id, :staff_id, :note, :now)", array(
            'order_id' => $order_id,
            'staff_id' => $staff_id,
            'note' => $note,
            'now' => time()
          ));
        }

        respond::alert('success', '', 'Order successfully created');

      }else {
        respond::alert('danger', '', 'Unable to add order at the moment');
      }

  }

    public static function details($order_id) {
        global $db;

        $items = $db->query("SELECT order_details.*, thumbnail, slug, name FROM order_details LEFT JOIN products ON product_id = products.id WHERE order_id = :order_id", array('order_id' => $order_id));

    return $items;

    }

    public static function all() {
        global $db;

        $orders = $db->query("SELECT orders.*, name, email FROM orders LEFT JOIN customers ON customer_id = customers.id ORDER BY orders.id DESC");

        if (count($orders) > 0) {
            return $orders;
        }else {
            return false;
        }

    }

    public static function status() {
      global $db;

      $status = $db->query("SELECT * FROM order_status ORDER BY id ASC");
      return $status;

    }

    public static function status_orders($id = null) {
      global $db;

      if ($id == null) {
        $orders = $db->query("SELECT * FROM orders ORDER BY id DESC", array('id' => $id));
      }else {
        $orders = $db->query("SELECT * FROM orders WHERE status = :id ORDER BY id DESC", array('id' => $id));
      }

      return $orders;

    }

    public static function check_status($slug) {
      global $db;

      $check = $db->query("SELECT * FROM order_status WHERE slug = :slug", array('slug' => $slug), false);

      if ($check) {
        return $check;
      }else {
        return false;
      }

    }


}
