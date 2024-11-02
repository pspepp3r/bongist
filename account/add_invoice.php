<?php
// session_start(); // Start session

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

// Handle invoice submission
if (isset($_POST['submit_invoice'])) {
    // Retrieve customer information
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $billing_address = $_POST['billing_address'];
    $email = $_POST['email'];

    // Insert customer into the customers table and retrieve customer_id
    $sql = "INSERT INTO new_customers (customer_name, phone, billing_address, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $customer_name, $phone, $billing_address, $email);
    $stmt->execute();
    $customer_id = $stmt->insert_id; // Get the new customer ID
    $stmt->close();

    // Create a unique invoice number
    $invoice_number = 'INV-' . strtoupper(uniqid());

    // Retrieve subtotal, tax, and total from form
    $subtotal = $_POST['subtotal'];
    $tax = $_POST['tax'];
    $total = $_POST['total'];

    // Insert the invoice into the invoices table
    $sql = "INSERT INTO invoices (invoice_number, customer_id, invoice_date, due_date, subtotal, tax, total) VALUES (?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY), ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('siidd', $invoice_number, $customer_id, $subtotal, $tax, $total);
    $stmt->execute();
    $invoice_id = $stmt->insert_id; // Get the new invoice ID
    $stmt->close();

    // Retrieve product data
// Retrieve product data from the form
$products = $_POST['products']; // Assuming 'products' is an array sent from the form

// Loop through each product in the products array
// Retrieve product data from the form
$products = $_POST['products']; // Assuming 'products' is an array sent from the form

// Loop through each product in the products array
foreach ($products as $product) {
    $product_name = $product['product_name']; // Get the product name
    $quantity = $product['quantity']; // Get the quantity of the product
    $unit_price = $product['unit_price']; // Get the unit price of the product
    $description = $product['description']; // Get the product description
    
    // Calculate the total price for the current product
    $item_total_price = $quantity * $unit_price;

    // Step 1: Insert all product details directly into the invoice_items table
    $sql_invoice_item = "INSERT INTO invoice_items (invoice_id, product_name, description, quantity, unit_price, total_price) 
                         VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_invoice_item = $conn->prepare($sql_invoice_item);
    $stmt_invoice_item->bind_param('issidd', $invoice_id, $product_name, $description, $quantity, $unit_price, $item_total_price);
    
    // Execute the query to insert the product into the invoice_items table
    $stmt_invoice_item->execute();
    $stmt_invoice_item->close();
}


    // Close the database connection
    $conn->close();

    // Set session variable for success
    $_SESSION['invoice_success'] = true;

    // Redirect back to the form (or wherever you want)
    header("Location: add_invoice"); // Change to your invoice page
    exit;
}
?>


<?php include 'account_header.php';?>
		

<section>
    <!-- Success Modal -->
<div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
        <h2 class="text-lg font-semibold mb-4">Invoice Created Successfully</h2>
        <p>Your invoice has been created successfully!</p>
        <button id="closeModal" class="mt-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">Close</button>
    </div>
</div>


    <div class="p-6 mt-5 bg-white rounded-lg shadow-md md:mx-10">
        <h1 class="text-xl font-semibold mb-6 border-b pb-4 text-center">Create New Invoice</h1>

        <form method="post" action="" enctype="multipart/form-data">
            <!-- Customer Information Section -->
            <section class="mb-6">
                <h2 class="text-md font-semibold mb-4">Customer Information</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <input type="text" id="customer_name" name="customer_name" placeholder="Customer Name" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <input type="tel" id="phone" name="phone" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" placeholder="Phone" required>
                    </div>

                    <div class="sm:col-span-2">
                        <textarea id="billing_address" name="billing_address" rows="3" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" placeholder="Billing Address" required></textarea>
                    </div>

                    <div class="sm:col-span-2">
                        <input type="email" id="email" name="email" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" placeholder="Email" required>
                    </div>
                </div>
            </section>

            <!-- Product Section -->
            <section class="product-section mb-6">
                <h2 class="text-xl font-semibold mb-4">Products</h2>
                <div class="product-item" id="product_1">
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="flex gap-1 w-[60%]"> 
                            <div>
                                <input type="text" id="product_name_1" name="products[1][product_name]" placeholder="Product Name" class="mt-1 p-2 block w-32 md:w-40 border border-black rounded-md shadow-sm" required>
                            </div>

                            <div>
    <textarea id="description_1" name="products[1][description]" rows="1" placeholder="Description" class="mt-1 p-2 block w-52 border border-black rounded-md shadow-sm"></textarea>
</div>

                        </div>

                        <div class="flex gap-2 justify-center">
                            <div>
                                <input type="number" id="quantity_1" name="products[1][quantity]" min="1" placeholder="QTY" class="mt-1 p-2 block w-20 border border-black rounded-md shadow-sm" required>
                            </div>

                            <div>
                                <input type="number" step="0.01" id="unit_price_1" name="products[1][unit_price]" placeholder="Unit Price" class="mt-1 p-2 block w-24 border border-black rounded-md shadow-sm" required>
                            </div> 
                        </div>
                    </div>
                </div>

                <button type="button" id="add_product" class="mt-4 bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">Add Product</button>
            </section>

            <!-- Invoice Summary -->
            <section class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Invoice Summary</h2>
                <div class="flex gap-2">
                    <div>
                        <label for="subtotal" class="block text-sm font-medium text-gray-700">Subtotal:</label>
                        <input type="number" step="0.01" id="subtotal" name="subtotal" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" readonly>
                    </div>

                    <div>
                        <label for="tax" class="block text-sm font-medium text-gray-700">Tax (%):</label>
                        <input type="number" step="0.01" id="tax" name="tax" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label for="total" class="block text-sm font-medium text-gray-700">Total:</label>
                        <input type="number" step="0.01" id="total" name="total" class="mt-1 p-2 block w-full border border-black rounded-md shadow-sm" readonly>
                    </div>
                </div>
            </section>

            <!-- Submission -->
            <div class="text-right">
                <button type="submit"
                name="submit_invoice" class="bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-700 transition">Create Invoice</button>
            </div>
        </form>
    </div>

    </div>

</section>


<!-- Success Modal -->

    <script>
        let productCount = 1;

        document.getElementById('add_product').addEventListener('click', function() {
            productCount++;

            const productSection = document.querySelector('.product-section');
            const newProduct = document.createElement('div');
            newProduct.classList.add('product-item', 'mt-4');
            newProduct.id = `product_${productCount}`;
            newProduct.innerHTML = `
                <div class="flex flex-col md:flex-row gap-2">
                    <div class="flex gap-1 w-[60%]"> 
                        <div>
                            <input type="text" id="product_name_${productCount}" name="products[${productCount}][product_name]" placeholder="Product Name" class="mt-1 p-2 block w-32 md:w-40 border border-black rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <textarea id="description_${productCount}" name="products[${productCount}][description]" rows="1" placeholder="Description" class="mt-1 p-2 block w-52 border border-black rounded-md shadow-sm"></textarea>
                        </div>
                    </div>
                    <div class="flex gap-2 justify-center">
                        <div>
                            <input type="number" id="quantity_${productCount}" name="products[${productCount}][quantity]" min="1" placeholder="QTY" class="mt-1 p-2 block w-20 border border-black rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <input type="number" step="0.01" id="unit_price_${productCount}" name="products[${productCount}][unit_price]" placeholder="Unit Price" class="mt-1 p-2 block w-24 border border-black rounded-md shadow-sm" required>
                        </div> 
                    </div>
                </div>
            `;

            productSection.insertBefore(newProduct, document.getElementById('add_product'));

            // Add event listeners for subtotal calculation on the new inputs
            addProductEventListeners(newProduct);
        });

        // Function to add event listeners to calculate subtotal
        function addProductEventListeners(product) {
            const quantityInput = product.querySelector('input[type="number"][name*="quantity"]');
            const priceInput = product.querySelector('input[type="number"][name*="unit_price"]');

            quantityInput.addEventListener('input', calculateSubtotal);
            priceInput.addEventListener('input', calculateSubtotal);
        }

        // Function to calculate subtotal and total
        function calculateSubtotal() {
            let subtotal = 0;

            const products = document.querySelectorAll('.product-item');
            products.forEach(product => {
                const quantity = parseFloat(product.querySelector('input[name*="quantity"]').value) || 0;
                const price = parseFloat(product.querySelector('input[name*="unit_price"]').value) || 0;
                subtotal += quantity * price;
            });

            document.getElementById('subtotal').value = subtotal.toFixed(2);
            calculateTotal(subtotal);
        }

        // Function to calculate total after tax
        function calculateTotal(subtotal) {
            const taxPercentage = parseFloat(document.getElementById('tax').value) || 0;
            const total = subtotal - (subtotal * (taxPercentage / 100));
            document.getElementById('total').value = total.toFixed(2);
        }

        // Add event listener for tax input change
        document.getElementById('tax').addEventListener('input', function() {
            const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
            calculateTotal(subtotal);
        });

        // Initial event listener for the first product
        addProductEventListeners(document.getElementById('product_1'));
    </script>


<script>
    // Check if the PHP session variable indicates success
    <?php if (isset($_SESSION['invoice_success'])): ?>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('successModal').classList.remove('hidden');
        });

        // Clear the session variable after showing the modal
        <?php unset($_SESSION['invoice_success']); ?>
    <?php endif; ?>

    // Close modal event
    document.getElementById('closeModal')?.addEventListener('click', function() {
        document.getElementById('successModal').classList.add('hidden');
    });
</script>

<script>
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
            var dropdowns = document.getElementsByClassName("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('invisible')) {
                    openDropdown.classList.add('invisible');
                }
            }
        }
    }
</script>

			

				<?php include 'account_footer.php';?>
		