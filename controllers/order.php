<?php


class order {

  public static function add($staff_id, $customer_name, $email, $phone, $address, $cost, $dod, $deposit, $status, $type_id, $subcat_id, $note) {
      global $db;

      $check = customer::check($phone, 'phone');

      if ($check) {
        $customer_id = $check['id'];
      }else {
          $photo = config::defaultPhoto();

        $db->query("INSERT INTO customers (customer_name, email, phone, address, photo, timestamp, month, year) VALUES (:customer_name, :email, :phone, :address, :photo, :now, :month, :year)", array(
          'customer_name' => $customer_name,
          'email' => $email,
          'phone' => $phone,
          'address' => $address,
          'photo' => $photo,
          'now' => time(),
          'month' => date("M"),
          'year' => date("Y")
        ));

        $customer_id = $db->lastInsertId();

      }

      $order_id = request::generateRandomID(5);

      $insert = $db->query("INSERT INTO orders (order_id, customer_id, cost, date_of_delivery, initial_deposit, staff_id, status, type_id, subcat_id, timestamp, month, year) VALUES (:order_id, :customer_id, :cost, :date_of_delivery, :initial_deposit, :staff_id, :status, :type_id, :subcat_id, :now, :month, :year)", array(
        'order_id' => $order_id,
        'customer_id' => $customer_id,
        'cost' => $cost,
        'date_of_delivery' => $dod,
        'initial_deposit' => $deposit,
        'staff_id' => $staff_id,
        'status' => $status,
        'type_id' => $type_id,
        'subcat_id' => $subcat_id,
        'now' => time(),
        'month' => date("M"),
        'year' => date("Y")
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
                  'comment'     => config::orderActivity(),
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

        $items = $db->query("SELECT orders.*, customer_name, status_name, photo, address, type, category FROM orders LEFT JOIN customers ON customer_id = customers.id LEFT JOIN order_status ON status = order_status.id LEFT JOIN order_type ON type_id = order_type.id LEFT JOIN type_category ON subcat_id = type_category.id WHERE order_id = :order_id", array('order_id' => $order_id));

    return $items;

    }

    public static function all() {
        global $db;

        $orders = $db->query("SELECT orders.*, customer_name, email, status_name, photo, type FROM orders LEFT JOIN customers ON customer_id = customers.id LEFT JOIN order_status ON status = order_status.id LEFT JOIN order_type ON type_id = order_type.id ORDER BY orders.id DESC");

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

    public static function status_orders($status_id = null, $type_id = null) {
      global $db;

      if ($status_id == null) {
        $orders = $db->query("SELECT * FROM orders ORDER BY id DESC");
      }else {
        $orders = $db->query("SELECT orders.*, customer_name, status_name, type FROM orders LEFT JOIN customers ON customer_id = customers.id LEFT JOIN order_status ON status = order_status.id LEFT JOIN order_type ON type_id = order_type.id WHERE orders.status = :status_id AND type_id = :type_id ORDER BY id DESC", array('status_id' => $status_id, 'type_id' => $type_id));
      }

      if (count($orders) > 0) {
        return $orders;
      }else {
        return false;
      }

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

    public static function update($order_id, $status, $note, $staff_id)
    {
        global $db;

        $orderUpdate = $db->query("UPDATE orders SET status = :status WHERE order_id = :order_id", array(
            'order_id'  => $order_id,
            'status'    => $status
        ), false);

        if($orderUpdate)
        {
            if($note != '')
            {
                $addNote = $db->query("INSERT INTO order_notes (order_id, staff_id, note, timestamp) VALUES (:order_id, :staff_id, :note, :timestamp)", array(
                    'order_id'  => $order_id,
                    'staff_id'  => $staff_id,
                    'note'      => $note,
                    'timestamp' => time()
                ));

                if($addNote)
                {
                    $db->query("INSERT INTO activities (staff_id, order_id, comment, timestamp) VALUES (:staff_id, :order_id, :comment, :timestamp)", array(
                        'staff_id'      => $staff_id,
                        'order_id'    => $order_id,
                        'comment'       => config::noteActivity(),
                        'timestamp'     => time()
                    ));
                }
            }else{
                return false;
            }
            $activity = $db->query("INSERT INTO activities (staff_id, order_id, comment, timestamp) VALUES (:staff_id, :order_id, :comment, :timestamp)", array(
                'staff_id'      => $staff_id,
                'order_id'    => $order_id,
                'comment'       => config::orderUpdateActivity(),
                'timestamp'     => time()
            ));

            if($activity)
            {
                respond::alert('success', '', 'Order edited successfully');
            }
        }
    }

    public static function order_note($order_id)
    {
        global $db;

        $order_notes = $db->query("SELECT order_notes.*, name, photo FROM order_notes LEFT JOIN staff ON staff_id = staff.id WHERE order_id = :order_id", array('order_id' => $order_id));
        if($order_notes)
        {
            return $order_notes;
        }
    }

    public static function type()
    {
        global $db;

        $type = $db->query("SELECT * FROM order_type");
        if($type)
        {
            return $type;
        }
    }

    public static function subCategory($id)
    {
        global $db;

        $subCategories = $db->query("SELECT * FROM type_category WHERE type_id = :type_id", array('type_id' => $id));

        if($subCategories)
        {
            return $subCategories;
        }
    }

    public static function type_order($type_id)
    {
        global $db;

        $type_orders = $db->query("SELECT type_id FROM orders WHERE type_id = :type_id", array('type_id' => $type_id));
            return $type_orders;
    }

    public static function type_status($status_id, $type_id)
    {
        global $db;

        $count = $db->query("SELECT * FROM orders WHERE status = :id AND type_id = :type_id", array('id' => $status_id, 'type_id' => $type_id));

        return $count;
    }

    public static function addNote($order_id, $note, $staff_id)
    {
        global $db;

        $addNote = $db->query("INSERT INTO order_notes (order_id, note, staff_id, timestamp) VALUES (:order_id, :note, :staff_id, :timestamp)", array(
            'order_id'  => $order_id,
            'note'      => $note,
            'staff_id'  => $staff_id,
            'timestamp' => time()
        ));

        if($addNote)
        {
            $db->query("INSERT INTO activities (staff_id, order_id, comment, timestamp) VALUES (:staff_id, :order_id, :comment, :timestamp)", array(
                'staff_id'      => $staff_id,
                'order_id'    => $order_id,
                'comment'       => config::noteActivity(),
                'timestamp'     => time()
            ));

            return respond::alert('success', '', 'note has been added successfully');
        }
    }

    public static function remove($id) {
        global $db;

        $remove = $db->query("DELETE FROM orders WHERE id = :id", array('id' => $id));

        if ($remove) {
            respond::alert('success', '', 'Order successfully removed');
        }else {
            respond::alert('danger', '', 'Unable to remove this order');
        }

    }// remove customer
}
