<?php
require_once('bhavidb.php');

if(isset($_POST['submit'])) {

    $gst = mysqli_real_escape_string($conn,$_POST['gst']);

    $sql = "INSERT INTO gst_no (gst) VALUES ('$gst')";

    $result = mysqli_query ($conn,$sql);

    if($result){
        echo "<script> 
        'Added Successfully'
        window.location.href='customized_edits.php'</script>";
    }
    else{
        echo "added failed";
    }
}
?>