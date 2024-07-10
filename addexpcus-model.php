<?php
require_once('bhavidb.php');

if (isset($_POST["submit"])) {
    $company_name = mysqli_real_escape_string($conn, htmlspecialchars($_POST["name"]));
    $caddress = mysqli_real_escape_string($conn, htmlspecialchars($_POST["address"]));
    $cphone = mysqli_real_escape_string($conn, htmlspecialchars($_POST["phone"]));

    $stmt = $conn->prepare("INSERT INTO `exp_name` (name, address, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $company_name, $caddress, $cphone);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>
            window.alert('Successfully Added');
            window.location.href='exp_customized_edits.php';
            </script>";
    } else {
        echo "Added Failed";
    }

    $stmt->close();
    $conn->close();
}
?>

<div class="container text-center mt-4">
    <div class="row">
        <div class="col-7">
            <div class="modal" tabindex="-1" id="modal_frm_exp">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Persons</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control" required>
                                </div>
                                <input type="submit" name="submit" class="btn btn-success mt-3">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var addCustomerModal = new bootstrap.Modal(document.getElementById('modal_frm_exp'));
        var addCustomerButton = document.getElementById('add_exp_customer');
        addCustomerButton.addEventListener('click', function() {
            addCustomerModal.show();
        });
    });
</script>
