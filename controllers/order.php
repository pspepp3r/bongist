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

          if($note)
          {
              $db->query("INSERT INTO activities (staff_id, order_id, comment, timestamp) VALUES (:staff_id, :order_id, :comment, :timestamp)", array(
                  'staff_id'    => $staff_id,
                  'order_id'    => $order_id,
                  'comment'     => "just added an order",
                  'timestamp'   => time()
              ));
          }
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

        $orders = $db->query("SELECT orders.*, name, email, status_name FROM orders LEFT JOIN customers ON customer_id = customers.id LEFT JOIN order_status ON status = order_status.id ORDER BY orders.id DESC");

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
        $orders = $db->query("SELECT orders.*, name, status_name FROM orders LEFT JOIN customers ON customer_id = customers.id LEFT JOIN order_status ON status = order_status.id WHERE status = :id ORDER BY id DESC", array('id' => $id));
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

    public static function totalSales()
    {
        global $db;

        $total = $db->query("SELECT SUM(cost) FROM orders");
        return $total;
    }

    public static function update($id, $status, $staff_id)
    {
        global $db;

        $orderUpdate = $db->query("UPDATE orders SET status = :status WHERE id = :id", array(
            'id'        => $id,
            'status'    => $status
        ));

        if($orderUpdate)
        {
            $expense_id = $db->lastInsertId();
            $activity = $db->query("INSERT INTO activities (staff_id, expense_id, comment, timestamp) VALUES (:staff_id, :expense_id, :comment, :timestamp)", array(
                'staff_id'      => $staff_id,
                'expense_id'    => $expense_id,
                'comment'       => 'just edited an order',
                'timestamp'     => time()
            ));

            if($activity)
            {
                respond::alert('success', '', 'Order edited successfully');
            }
        }
    }
}
