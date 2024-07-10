<?php
// get_advance_history.php

require_once('bhavidb.php');

if (isset($_GET['invoiceNo'])) {
    $invoiceNo = mysqli_real_escape_string($conn, $_GET['invoiceNo']);

    $sql = "SELECT * FROM expenditure_desc_tbl WHERE `main_expenditure_id` = '$invoiceNo'";
    $result = $conn->query($sql);

    // Build the HTML for the modal body
    $html = '<table class="table table-bordered viewinvoicetable">
                <thead style="position: sticky; top: 0; z-index: 1; background-color: #f2f2f2;">
                    <tr>
                        <th class="text-center" style="width: 20%;">Expenditure No</th>
                        <th style="width: 40%;">Name</th>
                        <th style="width: 40%;">Description</th>
                        <th style="width: 40%;">Mode of payment</th>
                        <th style="width: 40%;">Amount</th>
                    </tr>
                </thead>
                <tbody>';

    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $row['main_expenditure_id'] . '</td>';
        $html .= '<td>' . $row['exp_name'] . '</td>';
        $html .= '<td>' . $row['exp_description'] . '</td>';
        $html .= '<td>' . $row['mode_payment'] . '</td>';
        $html .= '<td>' . $row['amount'] . '</td>';
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    echo $html;
} else {
    echo "Invalid request";
}

$conn->close();
?>
