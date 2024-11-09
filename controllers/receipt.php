<?php
class receipt
{
  public static function all()
  {
    global $db;

    $receipt = $db->query(
      "SELECT receipts.*, type FROM receipts LEFT JOIN payment_category 
              ON payment_method = payment_category.id");
    if (count($receipt)) {
      return $receipt;
    } else {
      return false;
    }
  }

  public static function getInvoiceReceipt($invoice_id)
  {
    global $db;

    $receipt = $db->query(
      "SELECT receipts.*, type FROM receipts 
              LEFT JOIN payment_category ON payment_method = payment_category.id 
              WHERE receipts.invoice_id = :invoice_id",
      ["invoice_id" => $invoice_id]
    );

    if (count($receipt)) {
      return $receipt;
    } else {
      return false;
    }
  }

  public static function add($invoice_id, $amount, $payment_method, $timestamp)
  {
    global $db;

    $invoice = invoice::check($invoice_id, 'invoice_id');

    $receipt_id = request::generateRandomID(5);

    $createReceipt = $db->query(
      "INSERT INTO receipts(receipt_id, invoice_id, amount, payment_method, timestamp)
              VALUES (:receipt_id, :invoice_id, :amount, :payment_method, :timestamp)",
      [
        "receipt_id" => $receipt_id,
        "invoice_id" => $invoice_id,
        "amount" => $amount,
        "payment_method" => $payment_method,
        "timestamp" => strtotime($timestamp)
      ]
    );

    $db->query(
      "UPDATE invoices SET amount_paid = :amount WHERE invoice_id = :invoice_id",
      [
        "amount" => $amount,
        "invoice_id" => $invoice_id
      ]
    );

    if ($createReceipt) {
      respond::alert('success', '', 'Receipt successfully created');
    } else {
      respond::alert('danger', '', 'Unable to create receipt at the moment');
    }

    // Debugger
    // respond::alert('success', '', request::timeago(strtotime($timestamp)));
  }
}