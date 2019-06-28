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

      $insert = $db->query("INSERT INTO orders (customer_id, cost, date_of_delivery, initial_deposit, staff_id, status, timestamp) VALUES (:customer_id, :cost, :date_of_delivery, :initial_deposit, :staff_id, :status, :now)", array(
        'customer_id' => $customer_id,
        'cost' => $cost,
        'date_of_delivery' => $dod,
        'initial_deposit' => $deposit,
        'staff_id' => $staff_id,
        'status' => $status,
        'now' => time()
      ));

      if ($insert) {

        $order_id = $db->lastInsertId();

        if ($note != '') {
          $db->query("INSERT INTO order_notes (order_id, staff_id, note, timestamp) VALUES (:order_id, :staff_id, :note, :now)", array(
            'order_id' => $order_id,
            'staff_id' => $staff_id,
            'note' => $note,
            'now' => time()
          ));
        }

        respond::alert('success', '', 'Order successfully added');

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

    public static function status_orders($id) {
      global $db;

      $orders = $db->query("SELECT * FROM orders WHERE status = :id", array('id' => $id));

      return $orders;

    }


}
