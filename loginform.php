<?php   
require_once('bhavidb.php');

$email = $_POST['email'];
$password = $_POST['password'];

$pass = md5($password);

$sql = "SELECT * from lgtable WHERE `email` = '$email' AND `password` = '$pass'";

$result = mysqli_query($conn,$sql);

if (mysqli_num_rows($result) == 1){
    echo("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Login succesfully');
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
    session_start();
    $_SESSION['email']=$email;      
    header("Location:createinvoice.php");
}

else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Invalid Email or Password')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}