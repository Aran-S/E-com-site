<?php include("header.php"); ?>
<?php if ($level == "2") { ?>

    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-body">
                <h4>Add New Address</h4>
                <form method="post" autocomplete="off" action="">
                    <?php 
                    if(isset($_POST['add_add'])){
                        $addresss = $_POST['addresss'];
                        $contact_number = $_POST['contact_number'];
                        $created_on = date('Y-m-d H:i:s');

                        $insert_sql = "INSERT INTO address (user_id, addresss, contact_number, created_on) VALUES ('$id', '$addresss', '$contact_number', '$created_on')";
                        if (mysqli_query($con, $insert_sql)) {
                            echo '<div class="alert alert-success">Address added successfully.</div>';
                        } else {
                            echo '<div class="alert alert-danger">Error: ' . mysqli_error($con) . '</div>';
                        }
                    }
                    ?>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea name="addresss" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" required>
                    </div>
                    <button type="submit" name="add_add" class="btn btn-primary">Add Address</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4>Saved Addresses</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Created On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $addr_sql = "SELECT * FROM address WHERE user_id='$id' ORDER BY id DESC";
                            $result = $con->query($addr_sql);
                            $i = 1;

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= htmlspecialchars($row['addresss']) ?></td>
                                        <td><?= htmlspecialchars($row['contact_number']) ?></td>
                                        <td><?= date('Y-m-d H:i:s', strtotime($row['created_on'])) ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editAddress<?= $row['id'] ?>">Edit</button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editAddress<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editAddressLabel<?= $row['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editAddressLabel<?= $row['id'] ?>">Edit Address</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="update-address.php">
                                                        <input type="hidden" name="address_id" value="<?= $row['id'] ?>">
                                                        <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                                        <div class="mb-3">
                                                            <label class="form-label">Address</label>
                                                            <textarea name="addresss" class="form-control" rows="3"><?= htmlspecialchars($row['addresss']) ?></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Contact Number</label>
                                                            <input type="text" name="contact_number" class="form-control" value="<?= htmlspecialchars($row['contact_number']) ?>">
                                                        </div>
                                                        <button type="submit" class="btn btn-success w-100">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                    $i++;
                                }
                            } else {
                                echo '<tr><td colspan="5" class="text-center">No addresses found</td></tr>';
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