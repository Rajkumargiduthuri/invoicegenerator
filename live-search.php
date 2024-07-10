<?php
require_once('bhavidb.php');

// Sanitize the search value to prevent SQL injection
$search_value = mysqli_real_escape_string($conn, $_POST["search"]);

// Query the database using a prepared statement
$sql = "SELECT * FROM invoice WHERE Cname LIKE ? OR Company_name LIKE ?";
$stmt = $conn->prepare($sql);
$search_param = '%' . $search_value . '%';
$stmt->bind_param('ss', $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();

$output = "";

if ($result->num_rows > 0) {
$output = '
<table class="table table-bordered viewinvoicetable">
    <thead style="position: sticky; top: 0; z-index: 1; background-color: white;">
        <tr>
            <th class="text-center">Invoice No</th>
            <th>Customer Name</th>
            <th>Issued Date</th>
            <th>Invoice Amount</th>
            <th class="status">Status</th>
            <th>Advance Actions</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody id="product_tbody_viewinvoicetable">';

        // Loop through the fetched data and display it in the table
        while ($row = $result->fetch_assoc()) {
        $invoice_no = htmlspecialchars($row['Invoice_no']);
        $customer_name = htmlspecialchars($row['Cname']);
        $invoice_date = htmlspecialchars($row['Invoice_date']);
        $invoice_amount = htmlspecialchars($row['Grandtotal']);
        $status = htmlspecialchars($row['status']);
        $sid = htmlspecialchars($row['Sid']);

        $output .= "<tr>";
            $output .= "<td>$invoice_no</td>";
            $output .= "<td>$customer_name</td>";
            $output .= "<td>$invoice_date</td>";
            $output .= "<td>$invoice_amount</td>";
            $output .= "<td class='status' data-invoice-no='$invoice_no'>$status</td>";

            // Render the actions buttons
            $output .= "<td>
                <div class='btn-group'>
                    <button type='button' class='view-button'>
                        <a href='edit.php?Sid=" . urlencode($sid) . "'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293z' />
                                <path d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z' />
                            </svg>
                        </a>
                    </button>
                    <button type='button' class='history-button' data-bs-toggle='modal' data-bs-target='#advance_frm' data-id='$invoice_no'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-clock-history' viewBox='0 0 16 16'>
                            <path d='M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022z' />
                            <path d='M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z' />
                            <path d='M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z' />
                        </svg>
                    </button>
                </div>
            </td>";

            // Render the additional actions buttons and delete form
            $output .= "<td>
                <div class='btn-group'>
                    <button type='button' class='bg_color_icon'>
                        <a href='edit_invoice.php?Sid=" . urlencode($sid) . "'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293z' />
                                <path d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z' />
                            </svg>
                        </a>
                    </button>
                    <button type='button' class='view-button'>
                        <a href='print.php?Sid=" . urlencode($sid) . "'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0' />
                                <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7' />
                            </svg>
                        </a>
                    </button>
                    <form method='POST' action='delete_invoice.php' onsubmit='return confirm(\"Are you sure you want to delete this record?\");'>
                        <input type='hidden' name='delete_id' value='" . htmlspecialchars($invoice_no) . "'>
                        <button type='submit' class='delete-button'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                                <path d='M3 6H5H21' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />
                                <path d='M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />
                                <path d='M10 11V17' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />
                                <path d='M14 11V17' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' />
                            </svg>
                        </button>
                    </form>
                </div>
            </td>";

            $output .= "</tr>";
        }

        $output .= '</tbody>
</table>';
} else {
$output = '<div>No invoice records found.</div>';
}

// Close the statement and the database connection
$stmt->close();
$conn->close();

// Output the result
echo $output;

?>