<?php
// Database connection
$host = 'localhost'; // Change if necessary
$db = 'bongist'; // Replace with your database name
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if invoice_id is set
if (isset($_GET['id'])) {
    $invoice_id = intval($_GET['id']);

    // Retrieve invoice details
    $sql_invoice = "SELECT invoices.*, customers.customer_name, customers.billing_address, customers.phone, customers.email
                    FROM invoices
                    JOIN new_customers AS customers ON invoices.customer_id = customers.customer_id
                    WHERE invoices.invoice_id = ?";
    $stmt = $conn->prepare($sql_invoice);
    $stmt->bind_param('i', $invoice_id);
    $stmt->execute();
    $result_invoice = $stmt->get_result();
    $invoice = $result_invoice->fetch_assoc();
    $stmt->close();

    // Retrieve invoice items
    $sql_items = "SELECT * FROM invoice_items WHERE invoice_id = ?";
    $stmt_items = $conn->prepare($sql_items);
    $stmt_items->bind_param('i', $invoice_id);
    $stmt_items->execute();
    $result_items = $stmt_items->get_result();
    $invoice_items = $result_items->fetch_all(MYSQLI_ASSOC);
    $stmt_items->close();
    
    if (!$invoice) {
        echo "<script>alert('Invoice not found'); window.location.href = 'all_invoices.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('No invoice ID provided'); window.location.href = 'all_invoices.php';</script>";
    exit;
}

// Close connection
$conn->close();
?>

<?php include 'account_header.php';?>



<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.invoice-container {
    width: 80%;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.invoice-header h1 {
    margin: 0;
}

.invoice-details p, .company-details p {
    margin: 5px 0;
}

.company-details {
    text-align: right;
}

.customer-info {
    margin-top: 30px;
}

.customer-info h3 {
    border-bottom: 1px solid #ccc;
    padding-bottom: 10px;
}

.invoice-items table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.invoice-items th, .invoice-items td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ccc;
}

.invoice-summary {
    margin-top: 30px;
    display: flex;
    justify-content: flex-end;
}

.invoice-summary table {
    width: 300px;
}

.invoice-summary td {
    padding: 10px;
    text-align: right;
}

footer {
    margin-top: 50px;
    text-align: center;
    font-size: 14px;
}

@media (max-width: 768px) {
    .invoice-container {
        width: 95%;
    }

    header {
        flex-direction: column;
        align-items: flex-start;
    }

    .company-details {
        text-align: left;
        margin-top: 10px;
    }
}

@media print {
            body * {
                visibility: hidden;
            }

            .invoice-container,
            .invoice-container * {
                visibility: visible;
            }

 

            .invoice-container {
                position: relative;
                left: 0;
                top: 0;
                right: 0;
                bottom: 0;
                margin: auto;
                width: 80%;
                background: white;
                padding: 20px;
                box-shadow: none;
            }

            .w-screen .flex {
                display: none;
            }

        }

</style>

<style>
    .modal {
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .hidden {
        display: none;
    }
</style>





<div class="w-screen">

<div class="flex mt-10 justify-center gap-2"> 
    <div class="p-3 bg-blue-900 text-white">
        <a href="edit_invoice?invoice_id=<?php echo $invoice_id; ?>">Edit</a>
    </div>

    <div class="p-3 bg-green-800 text-white">
    <a href="javascript:void(0);" onclick="printInvoice()">Print</a>
</div>


<?php
// Database connection
$host = 'localhost';
$db = 'bongist';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['generate_receipt'])) {
    $invoice_id = intval($_POST['invoice_id']);
    $payment_date = $_POST['payment_date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    // Insert into payments table
    $sql_payment = "INSERT INTO invoice_payments (invoice_id, payment_date, amount, payment_method) VALUES (?, ?, ?, ?)";
    $stmt_payment = $conn->prepare($sql_payment);
    $stmt_payment->bind_param('isds', $invoice_id, $payment_date, $amount, $payment_method);
    $stmt_payment->execute();
    $payment_id = $stmt_payment->insert_id;
    $stmt_payment->close();

    // Update the amount_paid in invoices table
    $sql_update_invoice = "UPDATE invoices SET amount_paid = amount_paid + ? WHERE invoice_id = ?";
    $stmt_update_invoice = $conn->prepare($sql_update_invoice);
    $stmt_update_invoice->bind_param('di', $amount, $invoice_id);
    $stmt_update_invoice->execute();
    $stmt_update_invoice->close();

    // Insert into receipts table
    $receipt_number = 'REC-' . strtoupper(uniqid());
    $sql_receipt = "INSERT INTO receipts (payment_id, receipt_number, amount) VALUES (?, ?, ?)";
    $stmt_receipt = $conn->prepare($sql_receipt);
    $stmt_receipt->bind_param('isd', $payment_id, $receipt_number, $amount);
    $stmt_receipt->execute();
    $stmt_receipt->close();

    // Redirect back to the invoice page
    header("Location: all_invoice?id=" . $invoice_id);
    exit;
}

$conn->close();
?>


<div class="p-3 bg-black text-white">
    <a href="javascript:void(0);" onclick="openModal()">Generate Receipt</a>
</div>

<!-- Modal for Generate Receipt Form -->
<div id="generateReceiptModal" class="modal hidden fixed z-50 inset-0 overflow-y-auto">
    <div class="modal-content bg-white p-5 w-1/3 mx-auto mt-20">
        <h2 class="text-xl font-bold mb-4">Generate Receipt</h2>
        <form id="generateReceiptForm" method="POST">
            <div class="mb-3">
                <label for="payment_date" class="block mb-1">Payment Date:</label>
                <input type="date" id="payment_date" name="payment_date" class="border border-gray-300 p-2 w-full" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="block mb-1">Amount:</label>
                <input type="number" id="amount" name="amount" class="border border-gray-300 p-2 w-full" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="block mb-1">Payment Method:</label>
                <select id="payment_method" name="payment_method" class="border border-gray-300 p-2 w-full" required>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="Bank Deposit">Bank Deposit</option>
                    <option value="POS">POS</option>
                </select>
            </div>
            <input type="hidden" name="invoice_id" value="<?= $invoice_id; ?>">
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="bg-gray-500 text-white p-2 mr-2">Cancel</button>
                <button type="submit" name="generate_receipt" class="bg-blue-500 text-white p-2">Generate</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('generateReceiptModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('generateReceiptModal').classList.add('hidden');
}
</script>


<div class="p-3 bg-black text-white">
    <a href="all_payment?invoice_id=<?= htmlspecialchars($invoice_id) ?>" class="hover:underline">All Payment Made</a>
</div>



</div>


<div class="invoice-container">




<header>
    <div class="invoice-header">
        <div class="invoice-details">
        <h1 class="text-3xl font-bold">Bongist Koncept</h1>

            <p>Invoice Number: <?= htmlspecialchars($invoice['invoice_number']) ?></p>
            <p>Invoice Date: <?= htmlspecialchars($invoice['invoice_date']) ?></p>
            <!-- <p>Due Date: <?= htmlspecialchars($invoice['due_date']) ?></p> -->
            <p>Email: contact@bongistKoncept.com</p>
        </div>
    </div>
 
</header>

<section class="customer-info">
    <h3>Bill To</h3>
    <p>Customer Name: <?= htmlspecialchars($invoice['customer_name']) ?></p>
    <p>Billing Address: <?= htmlspecialchars($invoice['billing_address']) ?></p>
    <p>Phone: <?= htmlspecialchars($invoice['phone']) ?></p>
    <!-- <p>Email: <?= htmlspecialchars($invoice['email']) ?></p> -->
</section>

<section class="invoice-items">
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <!-- <th>Description</th> -->
                <th>QTY</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoice_items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['product_name']) ?></td>
                <!-- <td><?= htmlspecialchars($item['description']) ?></td> -->
                <td><?= htmlspecialchars($item['quantity']) ?></td>
                <td>$<?= number_format($item['unit_price'], 2) ?></td>
                <td>$<?= number_format($item['quantity'] * $item['unit_price'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<section class="invoice-summary">
    <table>
        <tr>
            <td>Subtotal:</td>
            <td>NGN<?= number_format($invoice['subtotal'], 2) ?></td>
        </tr>
        <tr>
            <td>Tax:</td>
            <td><?= number_format($invoice['tax'], 2) ?>%</td>
        </tr>
        <tr>
            <td>Total:</td>
            <td>$<?= number_format($invoice['total'], 2) ?></td>
        </tr>
        <tr>
            <td>Amount Paid:</td>
            <td>$<?= number_format($invoice['amount_paid'], 2) ?></td>
        </tr>
        <tr>
            <td>Balance Due:</td>
            <td>$<?= number_format($invoice['balance_due'], 2) ?></td>
        </tr>
    </table>
</section>

<footer>
    <p>Payment Methods: Bank Transfer, Bank Deposit, POS</p>
    <p>Bongist Koncept © 2024</p>
</footer>


</div>
</div>




<script>
function printInvoice() {
    window.print();
}
</script>



</body>
<?php include 'account_footer.php';?>

