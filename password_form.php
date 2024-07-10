<?php
require('bhavidb.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    if (isset($_SESSION['email'])) {
        $userId = $_SESSION['email'];

        // Get form data
        $currentPassword = md5($_POST['current_password']);
        $newPassword = md5($_POST['new_password']);
        $confirmPassword = md5($_POST['confirm_password']);

        if ($newPassword != $confirmPassword) {
            echo "
            <script>
                window.alert('New Password and Confirm Password do not match.');
                window.location.href='javascript:history.go(-1)';                 </script>";
        } else {

            $sql = "UPDATE `lgtable` SET `password` = '$newPassword' WHERE `email` = '$userId'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>
                window.alert('Password Updates Successfully');
                window.location.href='index.php';
                 </script>";
            } else {
                echo "Error updating password.";
            }
        }
    } else {
        // Redirect to the login page if the user is not logged in
        header("Location: index.php");
        exit();
    }
}
