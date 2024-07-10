<?php
// Include your database connection file
require_once('bhavidb.php');

if (isset($_POST["submit"])) {
    // Get data from the form arrays
    $stock_names = $_POST["stock_name"];
    $stock_descs = $_POST["stock_desc"];
    $stock_qtys = $_POST["stock_qty"];
    $stock_detailss = $_POST["stock_details"];

    // Loop through the arrays and insert each entry into the main expenditure table
    for ($i = 0; $i < count($stock_names); $i++) {
        // Use mysqli_real_escape_string for each array element
        $stock_name = mysqli_real_escape_string($conn, $stock_names[$i]);
        $stock_desc = mysqli_real_escape_string($conn, $stock_descs[$i]);
        $stock_qty = mysqli_real_escape_string($conn, $stock_qtys[$i]);
        $stock_details = mysqli_real_escape_string($conn, $stock_detailss[$i]);

        // Insert data into the main expenditure table
        $sql = "INSERT INTO stocks (stock_name, stock_desc, stock_qty, stock_details) VALUES ('$stock_name', '$stock_desc', '$stock_qty', '$stock_details')";

        if ($conn->query($sql)) {
            // Records inserted successfully
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo "<script>
        alert('Details saved successfully');
        window.location.href='stocks.php';
    </script>";
}



// Close the database connection
$conn->close();
?>
