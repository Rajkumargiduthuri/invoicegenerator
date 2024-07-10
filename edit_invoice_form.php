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
    $Sid = mysqli_real_escape_string($conn, $_POST["Sid"]);
    $invoice_no = mysqli_real_escape_string($conn, $_POST["invoice_no"]);
    $invoice_date = date("Y-m-d", strtotime($_POST["invoice_date"]));
    $final_total = mysqli_real_escape_string($conn, $_POST["grand_total"]);
    $Gst = mysqli_real_escape_string($conn, $_POST["gst"]);
    $Gst_total = mysqli_real_escape_string($conn, $_POST["gst_total"]);
    $Grand_total = mysqli_real_escape_string($conn, $_POST["Final_total"]);
    $Totalin_word = mysqli_real_escape_string($conn, $_POST["words"]);
    $terms = mysqli_real_escape_string($conn, $_POST["terms"]);
    $note = mysqli_real_escape_string($conn, $_POST["note"]);
    $advance = mysqli_real_escape_string($conn, $_POST["advance"]);
    $balance = mysqli_real_escape_string($conn, $_POST["balance"]);
    $balancewords = mysqli_real_escape_string($conn, $_POST["balancewords"]);

    $sql = "UPDATE invoice SET 
    Company_name = '$company_name',
    Cname = '$cname',
    Cphone = '$cphone',
    Caddress = '$caddress',
    Cmail = '$cemail',
    Cgst = '$cgst',
    Final = '$final_total',
    Gst = '$Gst',
    Gst_total = '$Gst_total',
    Grandtotal = '$Grand_total',
    Totalinwords = '$Totalin_word',
    Terms = '$terms',
    Note = '$note',
    advance = '$advance',
    balance = '$balance',
    balancewords = '$balancewords',
    status = ''
    WHERE Sid = '$Sid' ";

    $sql3 = "UPDATE advancehistory SET  `advance`='$advance' WHERE Invoice_no= '$invoice_no'";
    $result = mysqli_query($conn, $sql3);

    if ($conn->query($sql)) {
        if (isset($_POST["Sname"]) && is_array($_POST["Sname"])) {
            $updateRows = [];
            $insertRows = [];

            for ($i = 0; $i < count($_POST["Sname"]); $i++) {
                $id = isset($_POST["id"][$i]) ? mysqli_real_escape_string($conn, $_POST["id"][$i]) : null;
                $Sname = mysqli_real_escape_string($conn, $_POST["Sname"][$i]);
                $Description = mysqli_real_escape_string($conn, $_POST["Description"][$i]);
                $Qty = mysqli_real_escape_string($conn, $_POST["Qty"][$i]);
                $Price = mysqli_real_escape_string($conn, $_POST["Price"][$i]);
                $Subtotal = mysqli_real_escape_string($conn, $_POST["subtotal"][$i]);
                $Discount = mysqli_real_escape_string($conn, $_POST["discount"][$i]);
                $total = mysqli_real_escape_string($conn, $_POST["total"][$i]);

                if (!empty($id)) {
                    // Existing row, add to updateRows
                    $updateRows[] = "( '$id', '$Sid', '$Sname', '$Description', '$Qty', '$Price', '$Subtotal', '$Discount', '$total')";
                } else {
                    // New row, add to insertRows
                    $insertRows[] = "( '$Sid', '$Sname', '$Description', '$Qty', '$Price', '$Subtotal', '$Discount', '$total')";
                }
            }

            // Update existing rows
            if (!empty($updateRows)) {
                $updateSql = "INSERT INTO service (Id, Sid, Sname, Description, Qty, Price, Totalprice, Discount, Finaltotal) VALUES ";
                $updateSql .= implode(",", $updateRows);
                $updateSql .= " ON DUPLICATE KEY UPDATE 
                                Sname = VALUES(Sname),
                                Description = VALUES(Description), 
                                Qty = VALUES(Qty), 
                                Price = VALUES(Price), 
                                Totalprice = VALUES(Totalprice), 
                                Discount = VALUES(Discount), 
                                Finaltotal = VALUES(Finaltotal)";
                $conn->query($updateSql);
            }

            // Insert new rows
            if (!empty($insertRows)) {
                $insertSql = "INSERT INTO service (Sid, Sname, Description, Qty, Price, Totalprice, Discount, Finaltotal) VALUES ";
                $insertSql .= implode(",", $insertRows);
                $conn->query($insertSql);
            }

            echo "<SCRIPT>
            window.alert('invoice Updated successfully;')
            window.location.href='print.php?Sid=$Sid';</SCRIPT>";
        }
    } else {
        echo "Invoice Update Failed: " . $conn->error;
    }
}
?>
