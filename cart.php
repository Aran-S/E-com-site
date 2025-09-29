<?php include("header.php"); ?>
<?php if ($level == 2) { ?>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <h4>Your Wishlist</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Added On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $wishlist_sql = "SELECT w.*, p.product_name, p.price, p.description, p.image 
                                         FROM wishlist w 
                                         JOIN products p ON w.product_id = p.id 
                                         WHERE w.user_id='$id' ORDER BY w.id DESC";
                            $result = $con->query($wishlist_sql);
                            $i = 1;

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><img src="uploads/products/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>" class="img-thumbnail" style="width:80px; height:80px;"></td>
                                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                                        <td><?= htmlspecialchars($row['description']) ?></td>
                                        <td>₹<?= number_format($row['price'], 2) ?></td>
                                        <td><?= date('Y-m-d H:i:s', strtotime($row['created_on'])) ?></td>
                                        <td>
                                            <a href="buy.php?product_id=<?= $row['product_id'] ?>" class="btn btn-success btn-sm">Buy Now</a>
                                            <a href="delete_wishlist.php?wishlist_id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to remove this item from your wishlist?');" class="btn btn-danger btn-sm">Remove</a>
                                        </td>
                                    </tr>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo '<tr><td colspan="7" class="text-center">Your wishlist is empty</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<?php include("footer.php"); ?>