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

// Handle invoice deletion
if (isset($_GET['delete_id'])) {
    $invoice_id = intval($_GET['delete_id']);
    
    // Start transaction to ensure data consistency
    $conn->begin_transaction();
    
    try {
        // Delete associated items in invoice_items first (because of foreign key constraint)
        $delete_items_sql = "DELETE FROM invoice_items WHERE invoice_id = ?";
        $stmt_items = $conn->prepare($delete_items_sql);
        $stmt_items->bind_param("i", $invoice_id);
        $stmt_items->execute();
        $stmt_items->close();

        // Now delete the invoice itself
        $delete_invoice_sql = "DELETE FROM invoices WHERE invoice_id = ?";
        $stmt_invoice = $conn->prepare($delete_invoice_sql);
        $stmt_invoice->bind_param("i", $invoice_id);
        $stmt_invoice->execute();
        $stmt_invoice->close();

        // Commit the transaction
        $conn->commit();

        header("Location: all_invoice.php?delete_success=1");
        exit;
    } catch (Exception $e) {
        // Rollback in case of an error
        $conn->rollback();
        echo "<script>alert('Error deleting invoice and items: " . $e->getMessage() . "');</script>";
    }
}

// Prepare to search invoices
$search = '';
$sql = "SELECT invoices.invoice_id, invoices.invoice_number, customers.customer_name, invoices.invoice_date, invoices.total 
        FROM invoices 
        JOIN new_customers AS customers ON invoices.customer_id = customers.customer_id";

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql .= " WHERE invoices.invoice_number LIKE '%$search%' OR customers.customer_name LIKE '%$search%'";
}

$sql .= " ORDER BY invoices.invoice_date DESC";

$result = $conn->query($sql);
?>

<?php include 'account_header.php'; ?>

<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6 text-center">Invoices</h1>

    <form method="GET" class="mb-4 flex justify-center">
        <input type="search" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search invoices..." class="border border-gray-300 rounded px-4 py-2" />
        <button type="submit" class="ml-2 px-4 py-2 bg-blue-900 text-white rounded">Search</button>
    </form>

    <!-- Success message for deletion -->
    <?php if (isset($_GET['delete_success'])): ?>
        <div class="bg-green-100 text-green-700 p-4 mb-6 rounded">
            Invoice deleted successfully!
        </div>
    <?php endif; ?>

    <table class="min-w-full border border-gray-200">
        <thead>
            <tr class="bg-gray-500">
                <th class="py-2 px-4 border-b">Invoice Number</th>
                <th class="py-2 px-4 border-b">Customer Name</th>
                <th class="py-2 px-4 border-b">Invoice Date</th>
                <th class="py-2 px-4 border-b">Total</th>
                <th class="py-2 px-4 border-b">View</th>
                <th class="py-2 px-4 border-b">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($row['invoice_number']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($row['customer_name']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars($row['invoice_date']) ?></td>
                        <td class="py-2 px-4 border-b"><?= htmlspecialchars(number_format($row['total'], 2)) ?></td>
                        <td class="py-2 px-4 border-b">
                            <a href="view_invoice?id=<?= $row['invoice_id'] ?>" class="text-blue-500 hover:underline">
                                <i class="fas fa-edit"></i> <!-- Font Awesome Edit Icon -->
                            </a>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <button class="text-red-600 hover:underline" onclick="openModal(<?= $row['invoice_id'] ?>)">
                                <i class="fas fa-trash"></i> <!-- Font Awesome Delete Icon -->
                            </button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="py-2 px-4 text-center border-b">No invoices found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal HTML structure -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-gray-800 bg-opacity-75">
    <div class="bg-white rounded-lg p-6 shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Confirm Deletion</h2>
        <p>Are you sure you want to delete this invoice?</p>
        <div class="flex justify-end mt-6">
            <button onclick="closeModal()" class="px-4 py-2 mr-2 bg-gray-300 rounded">Cancel</button>
            <a id="confirmDeleteBtn" href="" class="px-4 py-2 bg-red-600 text-white rounded">Delete</a>
        </div>
    </div>
</div>

<!-- JavaScript for modal -->
<script>
function openModal(invoiceId) {
    // Open the modal
    document.getElementById('deleteModal').classList.remove('hidden');
    // Set the delete URL in the confirm button
    document.getElementById('confirmDeleteBtn').href = '?delete_id=' + invoiceId;
}

function closeModal() {
    // Close the modal
    document.getElementById('deleteModal').classList.add('hidden');
}
</script>

</body>
</html>
