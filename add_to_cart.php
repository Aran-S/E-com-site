<?php
include("header.php");
if ($level != 2) exit;

if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    $id=$_SESSION['id'];
    if ($product_id > 0) {
        $check_sql = "SELECT * FROM cart WHERE user_id='$id' AND product_id='$product_id'";
        $check_res = mysqli_query($con, $check_sql);
        if (mysqli_num_rows($check_res) > 0) {
            $row = mysqli_fetch_assoc($check_res);
            $new_count = $row['count'] + 1;
            mysqli_query($con, "UPDATE cart SET count='$new_count', selected_on=NOW() WHERE id='{$row['id']}'");
        } else {
            mysqli_query($con, "INSERT INTO cart (user_id, product_id, count, selected_on, created_on) VALUES ('$id', '$product_id', 1, NOW(), NOW())");
        }
    }
    echo "<script>window.location='cart.php';</script>";
    exit;
}
