<?php
include("header.php");
if ($level != 2) {
    exit;
}
$product_id = intval($_GET['product_id'] ?? 0);
if ($product_id <= 0) exit;

$check_sql = "SELECT * FROM wishlist WHERE user_id='$id' AND product_id='$product_id'";
$check_res = mysqli_query($con, $check_sql);
if (mysqli_num_rows($check_res) == 0) {
    $insert_sql = "INSERT INTO wishlist (user_id, product_id, created_on) VALUES ('$id', '$product_id', NOW())";
    mysqli_query($con, $insert_sql);
}

$product_sql = "SELECT p.*, c.category FROM products p JOIN category c ON p.category_id=c.id WHERE p.id='$product_id'";
$product_res = mysqli_query($con, $product_sql);
if ($product_res && mysqli_num_rows($product_res) > 0) {
    $product = mysqli_fetch_assoc($product_res);
} else {
    exit;
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div class="row mt-3">
                <div class="col-md-6">
                    <img src="uploads/products/<?php echo $product['image']; ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                    <p class="fw-bold mt-2">Price: ₹<?php echo number_format($product['price'], 2); ?></p>
                    <p>Category: <?php echo $product['category']; ?></p>
                    <p>Warranty: <?php echo $product['warranty']; ?> years</p>
                </div>
                <div class="col-md-6">
                    <a href="buy.php?product_id=<?php echo $product['id']; ?>" class="btn btn-success w-100 mb-2">Buy Now</a>
                    <a href="wishlist.php" class="btn btn-primary w-100">View Wishlist</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>