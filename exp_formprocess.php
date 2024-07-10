<?php
// Include your database connection file
require_once('bhavidb.php');

if (isset($_POST["submit"])) {
    // Get data from the form
    $invoice_date = mysqli_real_escape_string($conn, $_POST["exp_date"]);
    $note = mysqli_real_escape_string($conn, $_POST["note"]);
    $total_amount_exp = mysqli_real_escape_string($conn, $_POST["total_amount_exp"]);
    $exp_words = mysqli_real_escape_string($conn, $_POST["exp_words"]);

    // Insert data into the main expenditure table
    $sql = "INSERT INTO expenditure_tbl (date, exp_note, total_amount, amount_in_words) VALUES ('$invoice_date', '$note', '$total_amount_exp', '$exp_words')";

    if ($conn->query($sql)) {
        $main_expenditure_id = $conn->insert_id; // Get the ID of the inserted row

        // Iterate through individual expenditure details
        for ($i = 0; $i < count($_POST["exp_name"]); $i++) {
            $exp_name = mysqli_real_escape_string($conn, $_POST["exp_name"][$i]);
            $exp_description = mysqli_real_escape_string($conn, $_POST["exp_description"][$i]);
            $mode_payment = mysqli_real_escape_string($conn, $_POST["mode_payment"][$i]);
            $amount = mysqli_real_escape_string($conn, $_POST["amount"][$i]);

            // Insert data into the detailed expenditure table
            $sql_detail = "INSERT INTO expenditure_desc_tbl (main_expenditure_id, exp_name, exp_description, mode_payment, amount) VALUES ('$main_expenditure_id', '$exp_name', '$exp_description', '$mode_payment', '$amount')";

            $conn->query($sql_detail);
        }

        echo "<script>
            alert('Expenditure added successfully');
            window.location.href='expenditures.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
