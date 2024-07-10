<?php
require_once ('bhavidb.php');

if (isset($_POST['submit'])) {

    $service = mysqli_real_escape_string ($conn,$_POST['service_name']);

    $sql = "INSERT INTO service_names(service_name) VALUES ('$service') ";
    $result = mysqli_query($conn,$sql);
    if($result){
        echo "<SCRIPT> 
        ('successfully Added')
        window.location.href='customized_edits.php'</SCRIPT>";
    }
    else{
        echo "Added Failed";
    }
}

?>