<?php

include ('bhavidb.php');

$id = $_GET['Id'];
$result = mysqli_query($conn, "DELETE FROM gst_no WHERE si_NO = '$id' ");

header('Location:customized_edits.php')

?>