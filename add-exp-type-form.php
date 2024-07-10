<?php
require_once('bhavidb.php');

if(isset($_POST['submit'])) {
    $expType = mysqli_real_escape_string($conn, $_POST['exp_type']); // Corrected variable name

    $sql1 = "INSERT INTO `exp_type` (name) VALUES ('$expType')"; // Updated column name

    $result = mysqli_query($conn, $sql1);

    if($result) {
        echo "<script> 
        alert('Added Successfully');
        window.location.href='exp_customized_edits.php';
        </script>";
    } else {
        echo "Added failed";
    }
}
?>