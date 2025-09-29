<?php include("header.php"); ?>
<?php
if ($level == 2) {
    $product_id = intval($_GET['product_id'] ?? 0);
    if ($product_id <= 0) {
        echo "<p class='text-danger'>Invalid product.</p>";
        exit;
    }
    $product_sql = "SELECT p.*, c.category FROM products p JOIN category c ON p.category_id=c.id WHERE p.id='$product_id'";
    $product_res = mysqli_query($con, $product_sql);
    if (!$product_res || mysqli_num_rows($product_res) == 0) {
        echo "<p class='text-danger'>Product not found.</p>";
        exit;
    }
    $product = mysqli_fetch_assoc($product_res);
    $address_res = mysqli_query($con, "SELECT * FROM address WHERE user_id='$id' ORDER BY created_on DESC");
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
        $selected_address = intval($_POST['address_id'] ?? 0);
        $quantity = intval($_POST['quantity'] ?? 1);
        $payment_method = $_POST['payment_method'] ?? '';
        if ($selected_address <= 0 || $quantity <= 0 || $quantity > $product['count']) {
            $error = "Invalid address or quantity.";
        } elseif ($payment_method !== 'cod') {
            $error = "Invalid payment method.";
        } else {
            $last_order_res = mysqli_query($con, "SELECT order_number FROM orders ORDER BY id DESC LIMIT 1");
            if ($last_order_res && mysqli_num_rows($last_order_res) > 0) {
                $last_order = mysqli_fetch_assoc($last_order_res);
                $order_number = intval($last_order['order_number']) + 1;
            } else {
                $order_number = 001;
            }
            $amount = $product['price'] * $quantity;
            $insert_order = "INSERT INTO orders 
                (user_id, product_id, seller_id, category_id, ordered_on, order_address, warranty_years, delivery_status, amount, order_number, order_placed, payment_method, quantity)
                VALUES
                ('$id', '{$product['id']}', '{$product['user_id']}', '{$product['category_id']}', NOW(), '$selected_address', '{$product['warranty']}', 1, '$amount', '$order_number', 1, 'cod', $quantity)";
            if (mysqli_query($con, $insert_order)) {
                mysqli_query($con, "UPDATE products SET count = count - $quantity WHERE id='{$product['id']}'");
                echo "<script>alert('Order placed successfully!'); window.location='orders.php';</script>";
                exit;
            } else {
                $error = "Failed to place order. Try again.";
            }
        }
    }
?>
    <div class="container mt-4">
        <h3>Buy Now: <?php echo htmlspecialchars($product['product_name']); ?></h3>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <img src="uploads/products/<?php echo $product['image']; ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                <p class="fw-bold mt-2">Price: ₹<?php echo number_format($product['price'], 2); ?></p>
                <p>Category: <?php echo $product['category']; ?></p>
                <p>Warranty: <?php echo $product['warranty']; ?> years</p>
                <p><?php echo substr($product['description'], 0, 200); ?>...</p>
            </div>
            <div class="col-md-6">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Select Delivery Address</label>
                        <select name="address_id" class="form-select" required>
                            <option value="">-- Choose Address --</option>
                            <?php while ($addr = mysqli_fetch_assoc($address_res)) { ?>
                                <option value="<?php echo $addr['id']; ?>"><?php echo htmlspecialchars($addr['addresss']) . " - " . $addr['contact_number']; ?></option>
                            <?php } ?>
                        </select>
                        <a href="add_address.php" class="small">Add New Address</a>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" min="1" max="<?php echo $product['count']; ?>" value="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="cod">Cash on Delivery (COD)</option>
                        </select>
                    </div>
                    <button type="submit" name="place_order" class="btn btn-success w-100">Place Order</button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<?php include("footer.php"); ?>