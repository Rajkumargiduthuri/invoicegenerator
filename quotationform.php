<?php
require_once('bhavidb.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['company'])) {
    $selectedCompanyId = mysqli_real_escape_string($conn, $_POST['company']);

    $sql = "SELECT * FROM `customer` WHERE `Id` = '$selectedCompanyId'";
    $res = $conn->query($sql);

    if ($row = mysqli_fetch_assoc($res)) {

        $company_name = $row['Company_name'];
        $cname = $row['Name'];
        $cphone = $row['Phone'];
        $caddress = $row['Address'];
        $cemail = $row['Email'];
        $cgst = $row['Gst_no'];
    } else {
        echo "Company not found";
    }
}

if (isset($_POST["submit"])) {

    $invoice_no = mysqli_real_escape_string($conn, $_POST["invoice_no"]);
    $invoice_date = date("Y-m-d", strtotime($_POST["invoice_date"]));
    $Gst = mysqli_real_escape_string($conn, $_POST["gst"]);
    $Totalin_word = mysqli_real_escape_string($conn, $_POST["words"]);
    $terms = mysqli_real_escape_string($conn, $_POST["terms"]);
    $note = mysqli_real_escape_string($conn, $_POST["note"]);
    $balancewords = mysqli_real_escape_string($conn, $_POST["balancewords"]);
    // $status = mysqli_real_escape_string($conn,$_POST["status"]);
    $final_total = floatval(mysqli_real_escape_string($conn, $_POST["grand_total"]));
    $Gst_total = floatval(mysqli_real_escape_string($conn, $_POST["gst_total"]));
    $Grand_total = floatval(mysqli_real_escape_string($conn, $_POST["Final_total"]));
    $advance = floatval(mysqli_real_escape_string($conn, $_POST["advance"]));
    $balance = floatval(mysqli_real_escape_string($conn, $_POST["balance"]));

    $sql = "INSERT INTO quotation (quotation_no, quotation_date, Company_name, Cname, Cphone, Caddress, Cmail, Cgst, Final, Gst, Gst_total, Grandtotal, Totalinwords, Terms, Note , advance, balance, balancewords ) 
            VALUES ('$invoice_no', '$invoice_date', '$company_name', '$cname', '$cphone', '$caddress', '$cemail', '$cgst', '$final_total', '$Gst' , '$Gst_total' ,'$Grand_total' , '$Totalin_word','$terms' , '$note' ,'$advance' , '$balance' ,'$balancewords' )";

    if ($conn->query($sql)) {
        $Sid = $conn->insert_id; // Get the inserted Sid

        if (isset($_POST["Sname"]) && is_array($_POST["Sname"])) {
            $sql2 = "INSERT INTO quservice (Sid, Sname, Description, Qty, Price, Totalprice, Discount, Finaltotal) VALUES ";
            $rows = [];

            // Iterate through service details
            for ($i = 0; $i < count($_POST["Sname"]); $i++) {
                $Sid = $conn->insert_id;
                $Sname = mysqli_real_escape_string($conn, $_POST["Sname"][$i]);
                $Description = mysqli_real_escape_string($conn, $_POST["Description"][$i]);
                $Qty = mysqli_real_escape_string($conn, $_POST["Qty"][$i]);
                $Price = mysqli_real_escape_string($conn, $_POST["Price"][$i]);
                $Subtotal = mysqli_real_escape_string($conn, $_POST["subtotal"][$i]);
                $Discount = mysqli_real_escape_string($conn, $_POST["discount"][$i]);
                $total = mysqli_real_escape_string($conn, $_POST["total"][$i]);

                // Add service details to the rows array
                $rows[] = "('$Sid', '$Sname', '$Description', '$Qty', '$Price', '$Subtotal', '$Discount', '$total')";
            }

            $sql2 .= implode(",", $rows);

            // Insert into service table
            if ($conn->query($sql2)) {
                echo "<SCRIPT>
                    window.alert('Quotation added successfully')
                    window.location.href='quprint.php?Sid=$Sid';</SCRIPT>";
            } else {
                echo "Quotation Added Failed: " . $conn->error;
            }
        } else {
            echo "Quotation Added Failed:" . $conn->error;
        }
    } else {
        echo "Quotation Added Failed: " . $conn->error;
    }
}


?>

