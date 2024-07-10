<?php

include ('bhavidb.php');

$id = $_GET['Id'];
$result = mysqli_query($conn, "DELETE FROM service_names WHERE si_NO = '$id' ");

header('Location:customized_edits.php')

?>