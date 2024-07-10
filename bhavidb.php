<?php
    $server='localhost';
    // Condition to check if the script is running locally or on a server
    if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '127.0.0.1') {
        // Local environment details
        $username = 'root';
        $pass = '';
        $database = 'bhavi_invoice_db';
    } else {
        // Server environment details
        $username = 'bhavi@invoice.bh';
        $pass = 'Bhavi@client';
        $database = 'invoice';
    }

    $conn = mysqli_connect($server,$username,$pass,$database);
    if(!$conn){
        echo "connection failed";
    }

?>