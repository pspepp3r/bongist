<?php

class payment
{

  public static function add($order_id, $customer_id, $payment_method, $amount)
  {
    global $db, $staff_id;

    $check = self::checkPayment($order_id, $payment_method);

    $order = $db->query("SELECT orders.* FROM orders LEFT JOIN payments ON orders.order_id = payments.order_id WHERE orders.order_id = :order_id", array('order_id' => $order_id), false);
    $balance = $order['balance'];

    if ($amount > $balance) {
      respond::alert('warning', 'Payment amount is more than balance', 'Current balance for order is ₦' . number_format($balance));
      return false;
    }

    if ($check) {

      $db->query("UPDATE payments SET amount = amount + :amount, timestamp = :now WHERE id = :id", array(
        'amount' => $amount,
        'id' => $check['id'],
        'now' => time()
      ));

      $payment_id = $check['id'];

    } else {

      $db->query("INSERT INTO payments (order_id, customer_id, payment_method, amount, timestamp, staff_id) VALUES (:order_id, :customer_id, :payment_method, :amount, :timestamp, :staff_id)", array(
        'order_id' => $order_id,
        'customer_id' => $customer_id,
        'staff_id' => $staff_id,
        'payment_method' => $payment_method,
        'amount' => $amount,
        'timestamp' => time()
      ));

      $payment_id = $db->lastInsertId();

    }


    $activity = $db->query("INSERT INTO activities (payment_id, comment, timestamp, staff_id) VALUES (:payment_id, :comment, :timestamp, :staff_id)", array(
      'payment_id' => $payment_id,
      'staff_id' => $staff_id,
      'comment' => config::paymentActivity(),
      'timestamp' => time()
    ));

    if ($activity) {

      $db->query("UPDATE orders SET balance = balance - :amount WHERE order_id = :order_id", array('amount' => $amount, 'order_id' => $order_id));

      respond::alert('success', '', 'payment has been successfully added');
    } else {
      respond::alert('danger', '', 'Unable to add payment');
    }

  }

  public static function all()
  {
    global $db;

    $payments = $db->query("SELECT payments.*, customer_name, type FROM payments LEFT JOIN customers ON customer_id = customers.id LEFT JOIN payment_category ON payment_method = payment_category.id");

    if ($payments > 0) {
      return $payments;
    }
  }

  public static function paymentCategory()
  {
    global $db;

    $categories = $db->query("SELECT * FROM payment_category");

    if ($categories > 0) {
      return $categories;
    }
  }

  public static function checkPayment($order_id, $payment_method)
  {

    global $db;

    $check = $db->query("SELECT * FROM payments WHERE order_id = :order_id AND payment_method = :payment_method", array('order_id' => $order_id, 'payment_method' => $payment_method), false);

    if ($check) {
      return $check;
    }
  }

  public static function order_payment($order_id)
  {
    global $db;

    $payments = $db->query("SELECT payments.*, type FROM payments LEFT JOIN payment_category ON payment_method = payment_category.id WHERE order_id = :order_id", array('order_id' => $order_id));

    if ($payments) {
      return $payments;
    } else {
      return false;
    }
  }
}
