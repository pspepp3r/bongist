<?php
class invoice
{
  public static function all()
  {
    global $db;

    $invoice = $db->query("SELECT invoices.invoice_id, invoices.timestamp, invoices.due_date, invoices.subtotal, invoices.tax, invoices.total, invoices.amount_paid, invoices.balance_due, invoices.status, invoices.staff_id, invoices.customer_id FROM invoices 
        ");
    if (count($invoice)) {
      return $invoice;
    } else {
      return false;
    }
  }

  public static function add($staff_id, $customer_name, $email, $phone, $address, $products, $subtotal, $tax, $total)
  {
    global $db;

    $check = customer::check($phone, 'phone');

    if ($check) {
      $customer_id = $check['id'];
    } else {
      $photo = config::defaultPhoto();

      $password = request::generateRandomID(10);
      $customer = $db->query("INSERT INTO customers (customer_name, email, phone, address, password, photo, timestamp) VALUES (:customer_name, :email, :phone, :address, :password, :photo, :now)", [
        'customer_name' => $customer_name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'password' => $password,
        'photo' => $photo,
        'now' => time()
      ]);

      $customer_id = $db->lastInsertId();

      // if ($customer) {
      //   $from = config::email();
      //   $sender = config::name();
      //   $to = $email;
      //   $subject = "Welcome to " . config::name();

      //   $msg = '<p style="color: #3E4095; font-size: 28px;"><span><b style="color: #288feb;">Congratulations, ' . $customer_name . ' your password is:</b></span></p>
      //               <p>' . $password . '</p>
      //           ';

      //   mail::send($from, $sender, $to, $subject, $msg);
      // }
    }


    $invoice_id = request::generateRandomID(5);

    $insertInvoice = $db->query("INSERT INTO invoices (invoice_id, customer_id, timestamp, due_date, subtotal, tax, total, staff_id) 
    VALUES (:invoice_id, :customer_id, :now, :due_date, :subtotal, :tax, :total, :staff_id)", [
      'invoice_id' => $invoice_id,
      'customer_id' => $customer_id,
      'now' => time(),
      'due_date' => time() + 60 * 60 * 24 * 30,
      'subtotal' => $subtotal,
      'tax' => $tax,
      'total' => $total,
      'staff_id' => $staff_id
    ]);

    if ($insertInvoice) {
      foreach ($products as $product) {
        $product_name = $product['product_name'];
        $quantity = $product['quantity'];
        $unit_price = $product['unit_price'];
        $description = $product['description'];

        $total = $unit_price * $quantity;

        $insertInvoiceItem = $db->query("INSERT INTO invoice_items (invoice_id, description, quantity, unit_price, total_price, product_name)
          VALUES (:invoice_id, :desc, :quantity, :unit, :total, :product_name)", [
          'invoice_id' => $invoice_id,
          'desc' => $description,
          'quantity' => $quantity,
          'unit' => $unit_price,
          'total' => $total,
          'product_name' => $product_name
        ]);
      }


      if ($insertInvoiceItem) {
        $db->query("INSERT INTO activities (staff_id, invoice_id, comment, timestamp) 
          VALUES (:staff_id, :invoice_id, :comment, :timestamp)", [
          'staff_id' => $staff_id,
          'invoice_id' => $invoice_id,
          'comment' => config::invoiceActivity(),
          'timestamp' => time()
        ]);
      }



      respond::alert('success', '', 'Invoice successfully created');
    } else {
      respond::alert('danger', '', 'Unable to add invoice at the moment');
    }
  }

  public static function remove($id)
  {
    global $db;

    $removeInvoice = $db->query("DELETE FROM invoices WHERE invoice_id = :id", ['id' => $id]);

    if ($removeInvoice) {
      $removeInvoiceItem = $db->query("DELETE FROM invoice_items WHERE invoice_id = :id", ['id' => $id]);
      $removeReceipt = $db->query("DELETE FROM receipts WHERE invoice_id = :id", ["id"=> $id]);

      if ($removeInvoiceItem && $removeReceipt) {
        respond::alert('success', '', 'Invoice successfully removed');
        return;
      }
    } else {
      respond::alert('danger', '', 'Unable to remove this invoice');
    }
  }

  public static function edit($invoice_id, $staff_id, $customer_name, $email, $phone, $address, $products, $subtotal, $tax, $total)
  {
    global $db;

    $check = customer::check($phone, 'phone');

    if ($check) {
      $customer_id = $check['id'];
    } else {
      $photo = config::defaultPhoto();

      $password = request::generateRandomID(10);
      $customer = $db->query("INSERT INTO customers (customer_name, email, phone, address, password, photo, timestamp) VALUES (:customer_name, :email, :phone, :address, :password, :photo, :now)", [
        'customer_name' => $customer_name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'password' => $password,
        'photo' => $photo,
        'now' => time()
      ]);

      $customer_id = $db->lastInsertId();

      // if ($customer) {
      //   $from = config::email();
      //   $sender = config::name();
      //   $to = $email;
      //   $subject = "Welcome to " . config::name();

      //   $msg = '<p style="color: #3E4095; font-size: 28px;"><span><b style="color: #288feb;">Congratulations, ' . $customer_name . ' your password is:</b></span></p>
      //               <p>' . $password . '</p>
      //           ';

      // mail::send($from, $sender, $to, $subject, $msg);
      // }
    }

    $insertInvoice = $db->query(
      "UPDATE invoices SET customer_id = :customer_id, timestamp = :now, due_date = :due_date, subtotal = :subtotal, tax = :tax, total = :total, staff_id = :staff_id WHERE invoice_id = :invoice_id",
      [
        'invoice_id' => $invoice_id,
        'customer_id' => $customer_id,
        'now' => time(),
        'due_date' => time() + 60 * 60 * 24 * 30,
        'subtotal' => $subtotal,
        'tax' => $tax,
        'total' => $total,
        'staff_id' => $staff_id
      ]
    );

    if ($insertInvoice) {
      $db->query("DELETE FROM invoice_items WHERE invoice_id = :invoice_id", ['invoice_id' => $invoice_id]);
      foreach ($products as $product) {
        $product_name = $product['product_name'];
        $quantity = $product['quantity'];
        $unit_price = $product['unit_price'];
        $description = $product['description'];
        $total = $unit_price * $quantity;

        $insertInvoiceItem = $db->query(
          "INSERT INTO invoice_items (invoice_id, description, quantity, unit_price, total_price, product_name)
            VALUES (:invoice_id, :desc, :quantity, :unit, :total, :product_name)",
          [
            'invoice_id' => $invoice_id,
            'desc' => $description,
            'quantity' => $quantity,
            'unit' => $unit_price,
            'total' => $total,
            'product_name' => $product_name
          ]
        );

      }

      if ($insertInvoiceItem) {

        $activity = $db->query("INSERT INTO activities (staff_id, invoice_id, comment, timestamp) VALUES (:staff_id, :invoice_id, :comment, :timestamp)", array(
          'staff_id' => $staff_id,
          'invoice_id' => $invoice_id,
          'comment' => config::invoiceUpdateActivity(),
          'timestamp' => time()
        ));

        if ($activity) {
          respond::alert('success', '', 'Invoice successfully updated.');
          // header("Location: admin/accounting/invoice");
        } else {
          respond::alert('danger', '', 'Unable to add invoice at the moment');
        }
      } else {
        respond::alert('danger', '', 'Unable to add invoice product at the moment');
      }
    } else {
      respond::alert('danger', '', 'Unable to add invoicey at the moment');
    }
    // respond::alert('danger', '', var_dump($products));
  }

  static function check($value, $column, $id = null)
  {
    global $db;

    $param = array(
      'value' => $value
    );
    if ($id == null) {
      $statement = "SELECT * FROM invoices WHERE $column = :value";
    } else {
      $statement = "SELECT * FROM invoices WHERE $column = :value AND id != :id";
      $param['id'] = $id;
    }

    $user = $db->query($statement, $param, false);

    if ($user) {
      return $user;
    } else {
      return false;
    }
  }

  static function checkItem($value, $column, $id = null)
  {
    global $db;

    $param = array(
      'value' => $value
    );
    if ($id == null) {
      $statement = "SELECT * FROM invoice_items WHERE $column = :value";
    } else {
      $statement = "SELECT * FROM invoice_items WHERE $column = :value AND id != :id";
      $param['id'] = $id;
    }

    $user = $db->query($statement, $param);

    if ($user) {
      return $user;
    } else {
      return false;
    }

  }

  static function checkCustomer($customer_id)
  {
    global $db;

    $check = customer::check($customer_id, 'id');
    return $check;
  }
}