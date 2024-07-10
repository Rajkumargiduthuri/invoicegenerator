<?php
require_once('bhavidb.php');

// Initialize variables with default values
$Cid = (isset($_POST['Id']) ? $_POST['Id'] : '');

$Name = $Phone = $Email = $Address = $Gst_no = '';

// Fetch customer details for update
$stmt = $conn->prepare("SELECT * FROM `customer` WHERE Id = ?");
$stmt->bind_param("i", $Cid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $Company_name = $row['Company_name'];
    $Name = $row['Name'];
    $Phone = $row['Phone'];
    $Email = $row['Email'];
    $Address = $row['Address'];
    $Gst_no = $row['Gst_no'];
  }
  $stmt->close(); // Close the statement after fetching the data
}

if (isset($_POST['Update'])) {
  // Validate and sanitize inputs
  $Company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
  $Name = mysqli_real_escape_string($conn, $_POST['cname']);
  $Phone = mysqli_real_escape_string($conn, $_POST['cphone']);
  $Email = mysqli_real_escape_string($conn, $_POST['cemail']);
  $Address = mysqli_real_escape_string($conn, $_POST['caddress']);
  $Gst_no = mysqli_real_escape_string($conn, $_POST['cgst']);

  // Update query with prepared statement
  $stmt = $conn->prepare("UPDATE `customer` SET `Company_name`=?, `Name`=?, `Phone`=?, `Email`=?, `Address`=?, `Gst_no`=? WHERE `Id`=?");
  $stmt->bind_param("ssssssi", $Company_name, $Name, $Phone, $Email, $Address, $Gst_no, $Cid);
  $stmt->execute();

  // Check for success or failure
  if ($stmt->affected_rows > 0) {
    echo "<script>
        window.alert('Successfully Updated');
        window.location.href='viewcustomers.php';
      </script>";
  } else {
    echo "No changes made. Please make sure to modify some fields before updating.";
  }

  if ($stmt->error) {
    die("Error: " . $stmt->error);
  }

  // Close the statement after executing the update
  $stmt->close();
}
