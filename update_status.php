<?php
include("header.php");
if ($level != 1) exit;

$order_id = intval($_GET['order_id'] ?? 0);
$new_status = intval($_GET['status'] ?? 0);

if ($order_id > 0 && in_array($new_status, [2, 3, 4])) {
    mysqli_query($con, "UPDATE orders SET delivery_status='$new_status' WHERE id='$order_id'");
}

echo "<script>window.location='orders.php';</script>";
exit;
