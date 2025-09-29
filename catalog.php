<?php include("header.php"); ?>

<?php
$category_filter = intval($_GET['category'] ?? 0);
$price_sort = $_GET['price_sort'] ?? '';
$new_sort = $_GET['new_sort'] ?? '';

$cat_sql = "SELECT * FROM category ORDER BY category ASC";
$cat_result = $con->query($cat_sql);

$where = " WHERE 1 ";
if ($category_filter > 0) {
    $where .= " AND p.category_id='$category_filter' ";
}

$order_by = "";
if ($price_sort === 'low') {
    $order_by = " ORDER BY p.price ASC ";
} elseif ($price_sort === 'high') {
    $order_by = " ORDER BY p.price DESC ";
} elseif ($new_sort === 'new') {
    $order_by = " ORDER BY p.created_on DESC ";
} elseif ($new_sort === 'old') {
    $order_by = " ORDER BY p.created_on ASC ";
}

$sql = "SELECT p.*, c.category FROM products p JOIN category c ON p.category_id = c.id $where $order_by";
$result = $con->query($sql);
?>

<div class="container mt-4">
    <h3 class="mb-4">Available Products</h3>

    <form method="get" class="row mb-3 g-2">
        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="0">All Categories</option>
                <?php while ($cat = $cat_result->fetch_assoc()) { ?>
                    <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $category_filter) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['category']) ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="price_sort" class="form-select">
                <option value="">Sort by Price</option>
                <option value="low" <?= ($price_sort == 'low') ? 'selected' : '' ?>>Low to High</option>
                <option value="high" <?= ($price_sort == 'high') ? 'selected' : '' ?>>High to Low</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="new_sort" class="form-select">
                <option value="">Sort by Newness</option>
                <option value="new" <?= ($new_sort == 'new') ? 'selected' : '' ?>>Newest First</option>
                <option value="old" <?= ($new_sort == 'old') ? 'selected' : '' ?>>Oldest First</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
        </div>
    </form>

    <div class="row">
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="uploads/products/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['product_name'] ?>" style="height:200px;object-fit:cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['product_name'] ?></h5>
                            <p class="card-text text-muted">Category: <?= $row['category'] ?></p>
                            <p class="card-text"><?= substr($row['description'], 0, 80) ?>...</p>
                            <p class="fw-bold text-success">₹<?= number_format($row['price'], 2) ?></p>
                            <p class="text-secondary">Warranty: <?= $row['warranty'] ?> years</p>
                            <?php if ($row['stock'] == 0 || $row['count'] == 0) { ?>
                                <p class="text-danger fw-bold">Out of Stock</p>
                            <?php } elseif ($row['count'] < 45) { ?>
                                <p class="text-danger fw-bold">Hurry! Only <?= $row['count'] ?> left</p>
                            <?php } ?>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="add_to_cart.php?product_id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Add to Cart</a>
                            <a href="add_to_wishlist.php?product_id=<?= $row['id'] ?>" class="btn btn-outline-secondary btn-sm">Wishlist</a>
                            <a href="buy.php?product_id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Buy Now</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p class="text-center">No products available right now.</p>
        <?php } ?>
    </div>
</div>

<?php include("footer.php"); ?>