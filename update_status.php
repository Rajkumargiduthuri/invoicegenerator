<?php
require_once('bhavidb.php'); // Include your database connection logic here

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $invoiceNo = $_POST['invoiceNo'];
   $selectedStatus = $_POST['selectedStatus'];

   // Update the status in the database using prepared statements
   $stmt = $conn->prepare("UPDATE invoice SET status = ? WHERE Invoice_no = ?");
   $stmt->bind_param("ss", $selectedStatus, $invoiceNo);
   $stmt->execute();
   $stmt->close();

   // You can echo a response if needed
   echo "Status updated successfully";
}
?>
