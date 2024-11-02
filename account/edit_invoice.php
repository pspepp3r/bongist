<?php
// Database connection
$host = 'localhost';
$db = 'bongist';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the invoice ID from the URL
// Get the invoice ID from the URL
if (!isset($_GET['invoice_id'])) {
    die("No invoice ID provided."); // You can also redirect to an error page or display a message
}

$invoice_id = $_GET['invoice_id'];

// Fetch invoice data
$sql = "SELECT * FROM invoices WHERE invoice_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $invoice_id);
$stmt->execute();
$invoice_result = $stmt->get_result();
$invoice = $invoice_result->fetch_assoc(); // Fetch invoice details

// Fetch customer data
$sql = "SELECT * FROM new_customers WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $invoice['customer_id']);
$stmt->execute();
$customer_result = $stmt->get_result();
$customer = $customer_result->fetch_assoc(); // Fetch customer details

// Fetch product data associated with the invoice
$sql = "SELECT * FROM invoice_items WHERE invoice_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $invoice_id);
$stmt->execute();
$invoice_items_result = $stmt->get_result();
$invoice_items = $invoice_items_result->fetch_all(MYSQLI_ASSOC); // Fetch all invoice items

// Handle invoice update submission
if (isset($_POST['update_invoice'])) {
    // Retrieve invoice ID
    $invoice_id = $_POST['invoice_id'];

    // Retrieve customer information
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $billing_address = $_POST['billing_address'];
    $email = $_POST['email'];

    // Update customer information in the customers table
    $sql = "UPDATE new_customers SET customer_name = ?, phone = ?, billing_address = ?, email = ? WHERE customer_id = (SELECT customer_id FROM invoices WHERE invoice_id = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssi', $customer_name, $phone, $billing_address, $email, $invoice_id);
    $stmt->execute();
    $stmt->close();

    // Retrieve subtotal, tax, and total from form
    $subtotal = $_POST['subtotal'];
    $tax = $_POST['tax'];
    $total = $_POST['total'];

    // Update the invoice in the invoices table
    $sql = "UPDATE invoices SET subtotal = ?, tax = ?, total = ? WHERE invoice_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('dddi', $subtotal, $tax, $total, $invoice_id);
    $stmt->execute();
    $stmt->close();

    // Retrieve product data from the form
    $products = $_POST['products']; // Assuming 'products' is an array sent from the form

    // Loop through each product in the products array
    foreach ($products as $product) {
        $product_name = $product['product_name']; // Get the product name
        $quantity = $product['quantity']; // Get the quantity of the product
        $unit_price = $product['unit_price']; // Get the unit price of the product
        $description = $product['description']; // Get the product description
        $item_id = $product['item_id']; // Get the ID of the item to updateNo invoice ID provided

        // Calculate the total price for the current product
        $item_total_price = $quantity * $unit_price;

        // Update product details in the invoice_items table
        $sql_invoice_item = "UPDATE invoice_items SET product_name = ?, description = ?, quantity = ?, unit_price = ?, total_price = ? WHERE item_id = ? AND invoice_id = ?";
        $stmt_invoice_item = $conn->prepare($sql_invoice_item);
        $stmt_invoice_item->bind_param('ssiddii', $product_name, $description, $quantity, $unit_price, $item_total_price, $item_id, $invoice_id);
        
        // Execute the query to update the product in the invoice_items table
        $stmt_invoice_item->execute();
        $stmt_invoice_item->close();
    }

    // Close the database connection
    $conn->close();

    // Set session variable for success
    $_SESSION['invoice_success'] = true;

    // Redirect back to the invoice overview page (or wherever you want)
    header("Location: all_invoice"); // Change to your invoice overview page
    exit;
}
?>



<?php include 'account_header.php';?>

<!-- <pre><?php print_r($products); ?></pre> -->


<section class="p-6 mt-5 bg-white rounded-lg shadow-md md:mx-10">
    <h1 class="text-xl font-semibold mb-6 border-b pb-4 text-center">Edit Invoice</h1>

    <form method="post">
        <!-- Hidden input to store invoice ID -->
        <!-- <input type="hidden" name="invoice_id" value="<?php echo $invoice['invoice_id']; ?>"> -->
        <input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>"> <!-- Make sure this is present -->

        <!-- Customer Information Section -->
        <section class="mb-6">
            <h2 class="text-md font-semibold mb-4">Customer Information</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <input type="text" name="customer_name" value="<?php echo $customer['customer_name']; ?>" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" required>
                </div>
                <div>
                    <input type="tel" name="phone" value="<?php echo $customer['phone']; ?>" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" required>
                </div>
                <div class="sm:col-span-2">
                    <textarea name="billing_address" rows="3" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" required><?php echo $customer['billing_address']; ?></textarea>
                </div>
                <div class="sm:col-span-2">
                    <input type="email" name="email" value="<?php echo $customer['email']; ?>" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" required>
                </div>
            </div>
        </section>

<!-- Products Section -->
<section class="product-section mb-6">
    <h2 class="text-xl font-semibold mb-4">Products</h2>
    <?php foreach ($invoice_items as $index => $item): ?>
        <div class="product-item" id="product_<?php echo $index + 1; ?>">
            <div class="flex flex-col md:flex-row gap-2">
                <div class="flex gap-1 w-[60%]">
                    
                    <div>
                    <label for="">Product Name</label>
                        <input type="text"  name="products[<?php echo $index + 1; ?>][product_name]" value="<?php echo htmlspecialchars($item['product_name']); ?>" class="mt-1 p-2 block w-32 md:w-40 border border-black rounded-md shadow-sm" required>
                    </div>
                    <div>
                    <label for="">Product Name</label>
                        <textarea name="products[<?php echo $index + 1; ?>][description]" rows="1" class="mt-1 p-2 block w-52 border border-black rounded-md shadow-sm"><?php echo htmlspecialchars($item['description']); ?></textarea>
                    </div>
                </div>
                <div class="flex gap-2 justify-center">
                
                    <div>
                    <label for="">QTY</label>
                        <input type="number" name="products[<?php echo $index + 1; ?>][quantity]" value="<?php echo htmlspecialchars($item['quantity']); ?>" class="mt-1 p-2 block w-20 border border-black rounded-md shadow-sm" required>
                    </div>
                    <div>
                    <label for="">Unit Price</label>
                        <input type="number" name="products[<?php echo $index + 1; ?>][unit_price]" value="<?php echo htmlspecialchars($item['unit_price']); ?>" class="mt-1 p-2 block w-24 border border-black rounded-md shadow-sm" required>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</section>


        <!-- Invoice Summary -->
        <section class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Invoice Summary</h2>
            <div class="flex gap-2">
                <div>
                    <label for="subtotal" class="block text-sm font-medium text-gray-700">Subtotal:</label>
                    <input type="number" name="subtotal" value="<?php echo $invoice['subtotal']; ?>" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" required>
                </div>
                <div>
                    <label for="tax" class="block text-sm font-medium text-gray-700">Tax (%):</label>
                    <input type="number" name="tax" value="<?php echo $invoice['tax']; ?>" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" required>
                </div>
                <div>
                    <label for="total" class="block text-sm font-medium text-gray-700">Total:</label>
                    <input type="number" name="total" value="<?php echo $invoice['total']; ?>" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" required>
                </div>
            </div>
        </section>

        <!-- Submission -->
        <div class="text-right">
            <button type="submit" name="update_invoice" class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-700 transition">Update Invoice</button>
        </div>
    </form>
</section>


<?php include 'account_footer.php';?>


