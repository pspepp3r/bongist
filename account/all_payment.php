<?php

// Database connection
$host = 'localhost'; // Change if necessary
$db = 'bongist'; // Replace with your database name
$user = 'root'; // Replace with your database username
$pass = ''; // Replace with your database password

$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the invoice_id from the URL
$invoice_id = isset($_GET['invoice_id']) ? intval($_GET['invoice_id']) : 0;

// Handle receipt deletion
if (isset($_GET['delete_id'])) {
    $receipt_id = intval($_GET['delete_id']);
    
    // Start transaction to ensure data consistency
    $conn->begin_transaction();
    
    try {
        // Delete the receipt from the receipts table
        $delete_receipt_sql = "DELETE FROM receipts WHERE receipt_id = ?";
        $stmt_receipt = $conn->prepare($delete_receipt_sql);
        $stmt_receipt->bind_param("i", $receipt_id);
        $stmt_receipt->execute();
        $stmt_receipt->close();

        // Commit the transaction
        $conn->commit();

        header("Location: all_receipt.php?invoice_id=$invoice_id&delete_success=1");
        exit;
    } catch (Exception $e) {
        // Rollback in case of an error
        $conn->rollback();
        echo "<script>alert('Error deleting receipt: " . $e->getMessage() . "');</script>";
    }
}

// Retrieve receipts for a particular invoice
$sql = "SELECT receipts.receipt_id, receipts.receipt_number, receipts.receipt_date, receipts.amount, 
        invoice_payments.payment_date, invoice_payments.payment_method, invoices.invoice_number, customers.customer_name
        FROM receipts 
        JOIN invoice_payments ON receipts.payment_id = invoice_payments.payment_id
        JOIN invoices ON invoice_payments.invoice_id = invoices.invoice_id
        JOIN new_customers AS customers ON invoices.customer_id = customers.customer_id 
        WHERE invoices.invoice_id = ? 
        ORDER BY receipts.receipt_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $invoice_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<?php include 'account_header.php';?>

<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6 text-center">Receipts for Invoice #<?= htmlspecialchars($invoice_id) ?></h1>

    <!-- Success message for deletion -->
    <?php if (isset($_GET['delete_success'])): ?>
        <div class="bg-green-100 text-green-700 p-4 mb-6 rounded">
            Receipt deleted successfully!
        </div>
    <?php endif; ?>

    <table class="min-w-full border border-gray-200">
        <thead>
            <tr class="bg-gray-500">
                <th class="py-2 px-4 border-b">Receipt Number</th>
                <th class="py-2 px-4 border-b">Payment Method</th>
                <th class="py-2 px-4 border-b">Payment Date</th>
                <th class="py-2 px-4 border-b">Amount</th>
                <th class="py-2 px-4 border-b">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($row['receipt_number']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($row['payment_method']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($row['payment_date']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars(number_format($row['amount'], 2)) ?></td>
                        <td class="py-2 px-4 border-b">
                            <button class="text-red-600 hover:underline" onclick="openModal(<?= $row['receipt_id'] ?>)">
                                <i class="fas fa-trash"></i> <!-- Font Awesome Delete Icon -->
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="py-2 px-4 text-center border-b">No receipts found for this invoice.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal HTML structure -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-800 bg-opacity-75">
    <div class="bg-white rounded-lg p-6 shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete this receipt?</p>
        <div class="flex justify-end mt-6">
            <button onclick="closeModal()" class="px-4 py-2 mr-2 bg-gray-300 rounded">Cancel</button>
            <a id="confirmDeleteBtn" href="" class="px-4 py-2 bg-red-600 text-white rounded">Delete</a>
        </div>
    </div>
</div>

<!-- JavaScript for modal -->
<script>
function openModal(receiptId) {
    // Open the modal
    document.getElementById('deleteModal').classList.remove('hidden');
    // Set the delete URL in the confirm button
    document.getElementById('confirmDeleteBtn').href = '?invoice_id=<?= $invoice_id ?>&delete_id=' + receiptId;
}

function closeModal() {
    // Close the modal
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>

</body>
</html>
