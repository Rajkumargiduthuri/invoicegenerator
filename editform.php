<?php
require_once('bhavidb.php');

if (isset($_POST["submit"])) {
    $invoice_no = mysqli_real_escape_string($conn, $_POST["invoice_no"]);
    // $invoice_date = mysqli_real_escape_string($conn, $_POST["invoice_date"]);
    $totaladvance = mysqli_real_escape_string($conn, $_POST["totaladvance"]);
    $balance = mysqli_real_escape_string($conn, $_POST["balance"]);
    $balancewords = mysqli_real_escape_string($conn, $_POST["balancewords"]);
    $Sid = mysqli_real_escape_string($conn,$_POST["Sid"]);
    $newadvance = mysqli_real_escape_string($conn,$_POST['newadvance']);


    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE `invoice` SET `advance`=?, `balance`=?, `balancewords`=? WHERE `invoice_no`=?");
    $stmt->bind_param("ddsd", $totaladvance, $balance, $balancewords, $invoice_no);
    
    $currentDate = date("Y-m-d"); // Returns the current date in the format "YYYY-MM-DD"
    $sql = "INSERT INTO `advancehistory`(`Invoice_no`, `Date`, `advance`) VALUES('$invoice_no','$currentDate','$newadvance')";

    $result1 = mysqli_query($conn,$sql);

    // Execute the statement
    $result = $stmt->execute();

    // Check for success or failure
    if ($result) {
        echo "<SCRIPT>
        window.alert('invoice added')
        window.location.href='print.php?Sid=$Sid';</SCRIPT>";
    } else {
        echo "No changes made. Please make sure to modify some fields before updating.";
    }

    // Close the statement after executing the update
    $stmt->close();

    // Close the database connection
    mysqli_close($conn);
}
?>
