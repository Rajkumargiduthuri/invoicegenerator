<?php
// get_advance_history.php

require_once('bhavidb.php');

if (isset($_GET['invoiceNo'])) {
    $invoiceNo = mysqli_real_escape_string($conn, $_GET['invoiceNo']);

    $sql = "SELECT * FROM advancehistory WHERE `Invoice_no` = '$invoiceNo'";
    $result = $conn->query($sql);

    // Build the HTML for the modal body
    $html = '<table class="table table-bordered viewinvoicetable">
                <thead style="position: sticky; top: 0; z-index: 1; background-color: #f2f2f2;">
                    <tr>
                        <th class="text-center" style="width: 20%;">Invoice No</th>
                        <th style="width: 40%;">Date</th>
                        <th style="width: 40%;">Amount</th>
                    </tr>
                </thead>
                <tbody>';

    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['Invoice_no'] . '</td>';
        $html .= '<td>' . $row['Date'] . '</td>';
        $html .= '<td>' . $row['advance'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    echo $html;
} else {
    echo "Invalid request";
}

$conn->close();
?>
