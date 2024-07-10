<?php
include("bhavidb.php");

$id = $_GET['Id'];

$result = mysqli_query($conn, "DELETE FROM customer WHERE Id = $id");

header("Location:viewcustomers.php");
