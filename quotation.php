<?php


session_start();
if (!isset($_SESSION['email'])) {
    header('Location:index.php');
    exit();
}



define('INVOICE_INITIAL_VALUE', '1');


require_once('bhavidb.php');

function getInvoiceId()
{
   include('bhavidb.php');

    if ($conn->connect_error) {
        die('Error : (' . $conn->connect_errno . ') ' . $conn->connect_error);
    }

    $query = "SELECT quotation_no FROM quotation ORDER BY quotation_no DESC LIMIT 1";

    if ($result = $conn->query($query)) {
        $row_cnt = $result->num_rows;

        $row = mysqli_fetch_assoc($result);

        if ($row_cnt == 0) {
            $nextInvoiceNumber = INVOICE_INITIAL_VALUE;
        } else {
            $nextInvoiceNumber = $row['quotation_no'] + 1;
        }


        $formattedInvoiceNumber = sprintf('%04d', $nextInvoiceNumber);


        $result->free();


        $conn->close();

        return $formattedInvoiceNumber;
    }
}

$invoiceNumber = getInvoiceId();

/* Customer Details */



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BHAVIINVOICE</title>


 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.13.0-rc.3/jquery-ui.min.js" integrity="sha256-R6eRO29lbCyPGfninb/kjIXeRjMOqY3VWPVk6gMhREk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="img/style.css">
    <link rel="stylesheet" href="img/stylemi.css">

    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 20px;
            /* text-align: center; */
        }

        .dropdown-content a {
            color: black;
            padding: 12 px 16px;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .navbar-nav li:hover .dropdown-content {
            display: block;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        .nav-links {
            background-color: aliceblue;
            border-radius: 20px;
        }

        .active-link {
            background-color: blue;
            color: white ;
        }

        body {
            background-color: #f9f9f9;
        }

        form {
            background-color: white;
            border-radius: 50px;
        }

        .form-input {
            border-radius: 20px;
            border: none;
            background-color: aliceblue;
            padding: 5px;
        }



        table {
            border-collapse: collapse;
            width: 100%;
        }

        .thead {
            /* background-color: aliceblue; */
            border: 1px solid black;
        }

        th {
            border: none;
            padding: 4px;
            /* Adjust padding as needed */
            text-align: center;
        }

        .table-responsive {
            border-radius: 10px;
            border: 1px solid black;
        }

        /* 
        .navbar-nav {
            color: black;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 17px;
        }
         */

        .nav-item {
            padding-top: 20px;
        }


        @media (min-widt:768px) {
  .only_sm{
    margin-top:175px;
  }
}
    </style>



</head>

<body>
    <!--  LARGE SCREEN NAVBAR  -->
    <div class="container-fluid">
        <div class="row">
            <section class="col-lg-2">
                <nav id="sidebarMenu" class="  collapse d-lg-block sidebar collapse bg-white">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#" id="change_password"><img src="img/Bhavi-Logo-2.png" alt="" height="80px" width="200px"></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class=" navbar-collapse  " id="navbarNav">
                            <ul class="navbar-nav " style="margin-left: 10%; text-align: center;">
                                <li class=" ">
                                    <a href="#" class="nav-link  nav-links active-link" id="add_customer"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 5V19" stroke="#F4F5FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5 12H19" stroke="#F4F5FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> Add Customer</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link  nav-links text-dark" href="viewcustomers.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 21 20" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.842 12.957C11.531 12.957 14.684 13.516 14.684 15.749C14.684 17.982 11.552 18.557 7.842 18.557C4.152 18.557 1 18.003 1 15.769C1 13.535 4.131 12.957 7.842 12.957Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.84199 9.77C5.41999 9.77 3.45599 7.807 3.45599 5.385C3.45599 2.963 5.41999 1 7.84199 1C10.263 1 12.227 2.963 12.227 5.385C12.236 7.798 10.286 9.761 7.87299 9.77H7.84199Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14.7336 8.6318C16.3346 8.4068 17.5676 7.0328 17.5706 5.3698C17.5706 3.7308 16.3756 2.3708 14.8086 2.1138" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16.8459 12.4824C18.3969 12.7134 19.4799 13.2574 19.4799 14.3774C19.4799 15.1484 18.9699 15.6484 18.1459 15.9614" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Customers</a>
                                </li>

                                <li class="dropdown nav-item ">
                                    <a class="nav-link active-link nav-links" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 13H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 17H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 9H9H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Quotation <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                        </svg></a>
                                    <div class="dropdown-content">
                                        <a class="nav-link text-dark" href="quotation.php">
                                            <h6>Create Quotation</h6>
                                        </a>

                                        <a class="nav-link text-dark" href="viewquotes.php">
                                            <h6>View Quotations</h6>
                                        </a>
                                    </div>
                                </li>

                                <!-- Invoice dropdown -->
                                <li class="dropdown nav-item ">
                                    <a class="nav-link  nav-links text-dark" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                            <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                                            <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                                        </svg> Invoice <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill " viewBox="0 0 16 16">
                                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                        </svg></a>

                                    <div class="dropdown-content">

                                        <a class="nav-link text-dark" href="createinvoice.php">
                                            <h6>Create Invoice</h6>
                                        </a>
                                        <a class="nav-link text-dark" href="viewinvoices.php">
                                            <h6>View Invoices</h6>
                                        </a>

                                    </div>
                                </li>
                                <li class="dropdown nav-item ">
                                    <a class="nav-link  nav-links text-dark"  ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                                        </svg> Expenses <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                        </svg></a>
                                    <div class="dropdown-content">
                                    <a class="nav-link text-dark"  href="expenditures.php">
                                            <h6>Expenses</h6>
                                        </a>
                                        <a class="nav-link text-dark" href="view_expenditure.php">
                                            <h6>View Expenses</h6>
                                        </a>
                                        <a class="nav-link text-dark" href="exp_customized_edits.php">
                                            <h6>Customized edits</h6>
                                        </a>
                                        <a class="nav-link text-dark" href="exp_reports.php">
                                            <h6>Reports</h6>
                                        </a>

                                        <a class="nav-link text-dark" href="stocks.php">
                                            <h6>Stock</h6>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-dark nav-links" href="customized_edits.php"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg> Customized Edits</a>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link text-dark nav-links" href="report.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M21.21 15.89C20.5738 17.3945 19.5788 18.7202 18.3119 19.7513C17.0449 20.7824 15.5447 21.4874 13.9424 21.8048C12.3401 22.1221 10.6844 22.0421 9.12012 21.5718C7.55585 21.1015 6.1306 20.2551 4.969 19.1067C3.80739 17.9582 2.94479 16.5428 2.45661 14.984C1.96843 13.4251 1.86954 11.7705 2.16857 10.1646C2.46761 8.55878 3.15547 7.05063 4.17202 5.77203C5.18857 4.49343 6.50286 3.48332 7.99998 2.83" stroke="#53545C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7362 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2V12H22Z" stroke="#53545C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> Reports</a>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link text-dark nav-links " href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path opacity="0.4" d="M0 4.447C0 1.996 2.03024 0 4.52453 0H9.48564C11.9748 0 14 1.99 14 4.437V15.553C14 18.005 11.9698 20 9.47445 20H4.51537C2.02515 20 0 18.01 0 15.563V14.623V4.447Z" fill="black" />
                                            <path d="M19.7789 9.4548L16.9331 6.5458C16.639 6.2458 16.1657 6.2458 15.8725 6.5478C15.5803 6.8498 15.5813 7.3368 15.8745 7.6368L17.4337 9.2298H15.9387H7.54844C7.13452 9.2298 6.79852 9.5748 6.79852 9.9998C6.79852 10.4258 7.13452 10.7698 7.54844 10.7698H17.4337L15.8745 12.3628C15.5813 12.6628 15.5803 13.1498 15.8725 13.4518C16.0196 13.6028 16.2114 13.6788 16.4043 13.6788C16.5952 13.6788 16.787 13.6028 16.9331 13.4538L19.7789 10.5458C19.9201 10.4008 20 10.2048 20 9.9998C20 9.7958 19.9201 9.5998 19.7789 9.4548Z" fill="black" />
                                        </svg>
                                        logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- SMALL SCREEN AND MEDIUM SCREEN  NAVBAR -->

                <nav class="navbar navbar-expand-lg navbar-light bg-light d-block d-lg-none ">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <!-- <a class="navbar-brand" href="#"><img src="img/Bhavi-Logo-2.png" alt="" height="50%" width="50%"></a> -->
                            <a class="navbar-brand" href="#" id="change_password_sm"><img src="img/Bhavi-Logo-2.png" alt="" height="80px" width="200px" class="img-fluid"></a>

                            <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                         <div class="collapse navbar-collapse  " id="navbarNav">
                            <ul class="navbar-nav " style="margin-left: 10%; text-align: center;">
                               


                                <li class=" ">
                                    <a href="#" class="nav-link  nav-links active-link" id="add_customer_min"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 5V19" stroke="#F4F5FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M5 12H19" stroke="#F4F5FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> Add Customer</a>
                                </li>




                                
                                <li class="nav-item ">
                                    <a class="nav-link  nav-links text-dark" href="viewcustomers.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 21 20" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.842 12.957C11.531 12.957 14.684 13.516 14.684 15.749C14.684 17.982 11.552 18.557 7.842 18.557C4.152 18.557 1 18.003 1 15.769C1 13.535 4.131 12.957 7.842 12.957Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.84199 9.77C5.41999 9.77 3.45599 7.807 3.45599 5.385C3.45599 2.963 5.41999 1 7.84199 1C10.263 1 12.227 2.963 12.227 5.385C12.236 7.798 10.286 9.761 7.87299 9.77H7.84199Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14.7336 8.6318C16.3346 8.4068 17.5676 7.0328 17.5706 5.3698C17.5706 3.7308 16.3756 2.3708 14.8086 2.1138" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16.8459 12.4824C18.3969 12.7134 19.4799 13.2574 19.4799 14.3774C19.4799 15.1484 18.9699 15.6484 18.1459 15.9614" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Customers</a>
                                </li>

                                <li class="dropdown  nav-item ">
                                    <a class="nav-link active-link nav-links" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14 2V8H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 13H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 17H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 9H9H8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Quotation <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                        </svg></a>
                                    <div class="dropdown-content">
                                        <a class="nav-link text-dark" href="quotation.php">
                                            <h6>Create Quotation</h6>
                                        </a>

                                        <a class="nav-link text-dark" href="viewquotes.php">
                                            <h6>View Quotations</h6>
                                        </a>
                                    </div>
                                </li>

                                <!-- Invoice dropdown -->
                                <li class="dropdown nav-item ">
                                    <a class="nav-link  nav-links text-dark" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-receipt" viewBox="0 0 16 16">
                                            <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                                            <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                                        </svg> Invoice <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill " viewBox="0 0 16 16">
                                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                        </svg></a>
                                    <div class="dropdown-content">

                                        <a class="nav-link text-dark" href="createinvoice.php">
                                            <h6>Create Invoice</h6>
                                        </a>
                                        <a class="nav-link text-dark" href="viewinvoices.php">
                                            <h6>View Invoices</h6>
                                        </a>

                                    </div>
                                </li>
                                <li class="dropdown nav-item ">
                                    <a class="nav-link  nav-links text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                                        </svg> Expenses <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                        </svg></a>
                                    <div class="dropdown-content">
                                    <a class="nav-link text-dark"  href="expenditures.php">
                                            <h6>Expenses</h6>
                                        </a>
                                        <a class="nav-link text-dark" href="view_expenditure.php">
                                            <h6>View Expenses</h6>
                                        </a>
                                        <a class="nav-link text-dark" href="exp_customized_edits.php">
                                            <h6>Customized edits</h6>
                                        </a>
                                        <a class="nav-link text-dark" href="exp_reports.php">
                                            <h6>Reports</h6>
                                        </a>

                                        <a class="nav-link text-dark" href="stocks.php">
                                            <h6>Stock</h6>
                                        </a>
                                    </div>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link text-dark nav-links" href="customized_edits.php"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg> Customized Edits</a>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link text-dark nav-links" href="report.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M21.21 15.89C20.5738 17.3945 19.5788 18.7202 18.3119 19.7513C17.0449 20.7824 15.5447 21.4874 13.9424 21.8048C12.3401 22.1221 10.6844 22.0421 9.12012 21.5718C7.55585 21.1015 6.1306 20.2551 4.969 19.1067C3.80739 17.9582 2.94479 16.5428 2.45661 14.984C1.96843 13.4251 1.86954 11.7705 2.16857 10.1646C2.46761 8.55878 3.15547 7.05063 4.17202 5.77203C5.18857 4.49343 6.50286 3.48332 7.99998 2.83" stroke="#53545C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M22 12C22 10.6868 21.7413 9.38642 21.2388 8.17317C20.7362 6.95991 19.9997 5.85752 19.0711 4.92893C18.1425 4.00035 17.0401 3.26375 15.8268 2.7612C14.6136 2.25866 13.3132 2 12 2V12H22Z" stroke="#53545C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg> Reports</a>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link text-dark nav-links " href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path opacity="0.4" d="M0 4.447C0 1.996 2.03024 0 4.52453 0H9.48564C11.9748 0 14 1.99 14 4.437V15.553C14 18.005 11.9698 20 9.47445 20H4.51537C2.02515 20 0 18.01 0 15.563V14.623V4.447Z" fill="black" />
                                            <path d="M19.7789 9.4548L16.9331 6.5458C16.639 6.2458 16.1657 6.2458 15.8725 6.5478C15.5803 6.8498 15.5813 7.3368 15.8745 7.6368L17.4337 9.2298H15.9387H7.54844C7.13452 9.2298 6.79852 9.5748 6.79852 9.9998C6.79852 10.4258 7.13452 10.7698 7.54844 10.7698H17.4337L15.8745 12.3628C15.5813 12.6628 15.5803 13.1498 15.8725 13.4518C16.0196 13.6028 16.2114 13.6788 16.4043 13.6788C16.5952 13.6788 16.787 13.6028 16.9331 13.4538L19.7789 10.5458C19.9201 10.4008 20 10.2048 20 9.9998C20 9.7958 19.9201 9.5998 19.7789 9.4548Z" fill="black" />
                                        </svg>
                                        logout</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </nav>
            </section>

            <!--  INVOICE  FORM  -->

            <section class=" col-lg-10 md-">
                <div class="container ">

                    <!-- FORM -->

                    <form class="mango  pb-4 mb-5" action="quotationform.php" method="post">
                        <img src="img/Bhavi-Logo-2.png" alt="" class="mx-auto d-block pt-5" height="20%" width="20%">

                        <!-- FORM INVOICENUMBER -->

                        <div class="row container pt-5  mb-5">
                            <div class="row">   
                                <div class="col-lg-8 col-sm-12 col-md-12">
                                    <h5><strong>Quotation</strong></h5>
                                    <h5><strong> Date :</strong> <input type="date" name="invoice_date" required value="<?php echo date('Y-m-d') ?>" class="form-input"></h5>
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-12 invoicenumber">
                                    <h5><strong>Quotation Number </strong></h5>
                                    <h4><strong>BHAVI_KKD_2024_ <input type="text" name="invoice_no" style="border: none;" class="row-1 col-4" value="<?php echo $invoiceNumber; ?>" readonly></strong></h4>
                                </div>
                            </div>

                        </div>

                        <!-- ENDING  FORM INVOICENUMBER -->

                        <!--  COMPANY DETAILS  -->

                        <div class="  container   mb-5">
                            <div class="row">   
                                <div class="col-lg-8 col-sm-12 col-md-12">
                                    <h4 class="pb-2"><strong>Bhavi Creations Pvt Ltd </strong></h4>
                                    <h6>Plot no28, H No70, 17-28, RTO Office Rd, opposite to New </h6>
                                    <h6>RTO Office, behind J.N.T.U Engineering College Play Ground,</h6>
                                    <h6> RangaRaoNagar,Kakinada,</h6>
                                    <h6>AndhraPradesh533003</h6>
                                    <h6>Phone no.: 9642343434</h6>
                                    <h6>Email: admin@bhavicreations.com</h6>
                                    <h6>GSTIN: 37AAKCB6960H1ZB.</h6>
                                </div>
                                
                            <div class="col-lg-4 col-sm-12 col-md-12">
                                <h4>
                                    <select name="company" id="companySelect">
                                        <?php
                                        $sql = "SELECT * FROM `customer`";
                                        $res = $conn->query($sql);
                                        $fetched_data = [];
                                        echo "<option value=''>Select Customer/Company</option>";
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $fetched_data[] = $row;
                                            echo "<option value='" . $row['Id'] . "'>" . $row['Company_name'] . "</option>";
                                        }
                                        // this hidden input is used to store the data & get the data in javascript
                                        echo "<input type='hidden' id='company_data' value='" . json_encode($fetched_data) . "' />";
                                        ?>
                                    </select>
                                </h4>
                                <p class="mb-1" id="company_name"></p>
                                <p class="mb-1" id="name"></p>
                                <p class="mb-1" id="email"></p>
                                <p class="mb-1" id="phone"></p>
                                <p class="mb-1" id="gst"></p>
                            </div>

                            </div>
                        </div>

                        <!-- ENDING COMPANY DETAILS -->

                        <!-- BILLING SECTION  -->
                        <h3 class="text-center mb-5"><B>Price Quotation</B></h3>

                        <!-- <div class="col-1 ms-2 mb-3">
                <select name="status" id="">
                    <option value="paid">Paid</option>
                    <option value="pending">Not paid</option>
                </select>
            </div> -->

                        <div class="  billing">
                            <div class="table-responsive">
                                <div style="overflow-x:auto;">
                                    <table border="0">

                                        <thead class="thead">
                                            <tr>
                                                <th></th>
                                                <th class="text-center">S.no</th>
                                                <th class="text-center"   >Services</th>
                                                <th class="text-center"  >Description</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Price/Unit</th>
                                                <th class="text-center">Sub Total</th>
                                                <th class="text-center">Disc %</th>
                                                <th class="text-center">Disc Total</th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody id="product_tbody">
                                            <tr>
                                                <td><button type="button" id="btn-add-row" class="btn btn-primary btn-add-row"><b>+</b></button></td>
                                                <td class="serial-number">01</td>
                                                <td > <select style="width:200px;" name="Sname[]" class="form-control">
                                                        <?php
                                                        $sql = "SELECT `service_name` FROM `service_names`";
                                                        $res = $conn->query($sql);

                                                        while ($row = mysqli_fetch_assoc($res)) {
                                                            echo "<option value='" . $row['service_name'] . "'>" . $row['service_name'] . "</option>";
                                                        }
                                                        ?>
                                                    </select></td>
                                                <td><textarea   style="width:250px;" class="form-control" name="Description[]" placeholder="DESCRIPITION." style="width: 100%;"></textarea></td>
                                                <td><input type='text' required name='Qty[]' class='form-control qty'></td>
                                                <td><input type='text' required name='Price[]' class='form-control price'></td>
                                                <td><input type='text'  name='subtotal[]' class='form-control subtotal'></td>
                                                <td><input type='text'  name='discount[]' class='form-control discount'></td>
                                                <td><input type='text' required name='total[]' class='form-control total'></td>
                                                <td></td>
                                            </tr>

                                            <!-- Add more rows as needed -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan='8' class='text-right' style="text-align: right;">Total Before Tax</td>
                                                <td colspan="2"><input type='text' name='grand_total' id='grand_total' class='form-control grand_total' required></td>
                                            </tr>
                                            <tr>
                                                <td colspan='7' class='text-right' style="text-align: right;">GST%</td>
                                                <td>
                                                    <select name="gst" id="gst" class="gst">
                                                        <?php
                                                        require_once('bhavidb.php');
                                                        $sql2 = "SELECT `gst` FROM `gst_no`";
                                                        $result = $conn->query($sql2);

                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            echo "<option value='" . $row['gst'] . "'>" . $row['gst'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td colspan="2"><input type='text' name='gst_total' id='gst_total' class='form-control gst_total'></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><input name='words' type='text' class="form-control words" readonly id="words"></td>
                                                <td class="text-center" class='text-right' style="text-align: right;">Total</td>
                                                <td colspan="2"><input type='text' name='Final_total' id='final_total' class='form-control final_total' readonly></td>
                                            </tr>
                                            <tr>
                                                <td colspan="8" class="text-right" class='text-right' style="text-align: right;">Advance</td>
                                                <td colspan="2"><input type='text' name='advance' id='advance' class='form-control advance'></td>
                                            </tr>
                                            <tr>
                                                <td colspan="7"><input name='balancewords' type='text' class="form-control balancewords" readonly id="balancewords"></td>
                                                <td class="text-right" class='text-right' style="text-align: right;">Balance</td>
                                                <td colspan="2"><input type='text' name='balance' id='balance' class='form-control balance' readonly></td>
                                            </tr>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                     



                            <div class="container mt-5">
                                <div class="row">

                                    <div class="col-lg-5 col-md-5 col-sm-12 mt-3">
                                        <textarea name="terms" class="form-control" style="border-radius: 10px;" rows="5" placeholder="Terms & Conditions"></textarea>
                                    </div>

                                    <div class="col-lg-5 col-md-5 col-sm-12 mt-3">
                                        <textarea name="note" class="form-control" style="border-radius: 10px;" rows="5" placeholder="Note:"></textarea>
                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-12 text-center mt-3" >
                                        <input style="   margin-top:50px;"  type="submit" name="submit" value="Save & Print" class="btn btn-primary">
                                    </div>

                                </div>
                            </div>

                            <!--  ENDING BILLING SECTION  -->

                            <!--   Functions of invoice -->
                            <script>
                                $(document).ready(function() {
                                    $("#date").datepicker({
                                        dateFormat: "dd-mm-yy"
                                    });

                                    $("#btn-add-row").click(function() {
                                        var row = "<tr><td></td> <td class='serial-number'></td><td><select name='Sname[]' class='form-control'><?php $sql = 'SELECT `service_name` FROM `service_names`';
                                                                                                                                                $res = $conn->query($sql);
                                                                                                                                                while ($row = mysqli_fetch_assoc($res)) {
                                                                                                                                                    echo "<option value='" . $row['service_name'] . "'>" . $row['service_name'] . "</option>";
                                                                                                                                                } ?></select></td><td><textarea class='form-control' name='Description[]' placeholder='DESCRIPTION.' style='width: 100%;'></textarea></td><td><input type='text' required name='Qty[]' class='form-control qty'></td><td><input type='text' required name='Price[]' class='form-control price'></td><td><input type='text' required name='subtotal[]' class='form-control subtotal'></td><td><input type='text' name='discount[]' class='form-control discount'></td><td><input type='text' required name='total[]' class='form-control total'></td><td><button type='button' value='X' class='btn btn-danger btn-sm' id='btn-row-remove'><b>X</b></button></td></tr>";

                                        $("#product_tbody").append(row);

                                        // Update serial numbers
                                        updateSerialNumbers();
                                    });

                                    // Function to update serial numbers
                                    function updateSerialNumbers() {
                                        $(".serial-number").each(function(index) {
                                            $(this).text((index + 1).toString().padStart(2, '0'));
                                        });
                                    }

                                    $("body").on("click", "#btn-row-remove", function() {
                                        if (confirm("Are You Sure?")) {
                                            $(this).closest("tr").remove();
                                            updateSerialNumbers();
                                            grand_total();
                                        }
                                    });





                                    /*----Ending balnce--*/


                                    // $("#advance").val(0);

                                    $("body").on("input", ".price, .qty, .subtotal, .discount, .final_total, #advance, .gst", function() {
                                        var $row = $(this).closest("tr");

                                        var price = Number($row.find(".price").val());
                                        var qty = Number($row.find(".qty").val());
                                        $row.find(".subtotal").val(price * qty);

                                        var subtotal = Number($row.find(".subtotal").val());
                                        var discount = Number($row.find(".discount").val());
                                        $row.find(".total").val(subtotal - (subtotal * (discount / 100)));


                                        // Update final_total and advance fields
                                        var finalTotal = Number($("#final_total").val());


                                        grand_total();
                                        gst_total();
                                        final_total();
                                        updateBalanceWords();
                                        updateBalance();


                                    });
                                    grand_total();
                                    gst_total();
                                    final_total();
                                    updateBalanceWords();

                                    $("body").on("change", ".gst", function() {
                                        calculateTotals();
                                    });

                                    $("body").on("keyup", "#balance", function() {
                                        updateBalanceWords();
                                    });
                                });

                                function updateBalance() {
                                    var finalTotal = Number($("#final_total").val());
                                    var advance = Number($("#advance").val());
                                    var balance = finalTotal - advance;

                                    $("#balance").val(balance);
                                    updateBalanceWords();
                                }

                                function grand_total() {
                                    var tot = 0;
                                    $(".total").each(function() {
                                        tot += Number($(this).val());
                                    });

                                    var formatted_total = tot.toFixed(2);
                                    $("#grand_total").val(formatted_total.toString());
                                }

                                function gst_total() {
                                    var grand_total = Number($("#grand_total").val());
                                    var gst = Number($(".gst").val());
                                    var gst_amount = (grand_total * gst) / 100;

                                    var formatted_gst_amount = gst_amount.toFixed(2);

                                    $("#gst_total").val(formatted_gst_amount);
                                }

                                function final_total() {
                                    var grand_total = Number($("#grand_total").val());
                                    var gst_amount = Number($("#gst_total").val());
                                    var final_total = grand_total + gst_amount;

                                    var formatted_final_total = final_total.toFixed(2);

                                    $("#final_total").val(formatted_final_total);

                                    var words = amountToWords(final_total);
                                    $("#words").val(words);
                                }

                                function updateBalanceWords() {
                                    var balance = Number($("#balance").val());
                                    var balanceWords = amountToWords(balance);
                                    $("#balancewords").val(balanceWords);
                                }

                                function calculateTotals() {
                                    grand_total();
                                    gst_total();
                                    final_total();
                                    updateBalanceWords();
                                }





                                function amountToWords(num) {
                                    var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ', 'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '];
                                    var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

                                    // Separate the whole and decimal parts
                                    var parts = num.toString().split('.');
                                    var wholePart = parts[0];
                                    var decimalPart = parts[1] || 0;

                                    if (wholePart.length > 9) return 'overflow';

                                    var n = ('000000000' + wholePart).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);

                                    if (!n) return '';

                                    var str = '';
                                    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
                                    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
                                    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
                                    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
                                    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + 'rupees ' : '';

                                    // Handle paisa
                                    var paisaWords = amountToWordsDecimal(decimalPart);
                                    if (paisaWords) {
                                        str += 'and ' + paisaWords;
                                    }

                                    str += 'only ';

                                    return str;
                                }

                                function amountToWordsDecimal(decimalPart) {
                                    var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine '];
                                    var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

                                    var n = ('00' + decimalPart).substr(-2).match(/^(\d{1})(\d{1})$/);

                                    if (!n) return '';

                                    var str = '';

                                    if (n[1] != 0 || n[2] != 0) {
                                        // If both digits are non-zero, use the combined word
                                        str += (n[1] > 0 ? b[n[1]] : '') + (n[1] > 0 && n[2] > 0 ? ' ' : '') + (n[2] > 0 ? a[n[2]] : '');
                                    } else if (n[1] != 0) {
                                        // If only the first digit is non-zero, use its word
                                        str += (b[n[1]]);
                                    } else if (n[2] != 0) {
                                        // If only the second digit is non-zero, use its word
                                        str += (a[n[2]]);
                                    }

                                    str += (str !== '') ? ' paisa ' : '';

                                    return str;
                                }
                            </script>

                            <!--     SCANNER SECTION  -->

                            <div class=" container pt-5   mb-5  " >

                                <div class="row  "     >
                                    <span class="verticalline mb-5"></span>
                                    <div class="col-lg-6  col-sm-12 col-md-6   ">
                                        <h5 class="mb-3"><strong>Scan to Pay:</strong></h5>
                                        <h4><img src="img/qrcode.jpg" alt="" height="120px" width="120px"></h4>
                                         <br> 
                                    </div>
                                    <div class="col-lg-6  col-sm-12 col-md-6 invoicenumber only_sm  " >
                                        <h5 class="mb-2"><strong>Payment details</strong></h5>
                                        <h6 class="mb-2">Bank Name : HDFC Bank, Kakinada</h6>
                                        <h6 class="mb-2">Account Name : Bhavi Creations Private Limited</h6>
                                        <h6 class="mb-2">Account No. : 59213749999999</h6>
                                        <h6 class="mb-2">IFSC : HDFC000042</h6>
                                        <br>  
                                    </div>
                                    <span class="verticalline  "></span>
                                </div>    
                            </div>
                            <!--   ENDING  SCANNER SECTION  -->

                            <!--    GOOGLEPAY SECTION   -->

                            <div class="googlepay">
                                <div class="col-lg-12 col-sm-12 col-md-12">
                                    <h6 class="text-center">Google pay , Phone pay. Paytm 8686394079</h6>
                                </div>
                            </div>
                            <!--  ENDING  GOOGLEPAY SECTION  -->





                    </form>

                    <!-- ENDING  FORM -->
                </div>



            </section>

            <!-- add customer model -->
            <div class="container text-center mt-4 ">
                <div class="row">
                    <div class="col-7">
                        <div class="modal" tabindex="-1" id="modal_frm">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Customer Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="modalform.php" method="post">
                                            <div class="form-group">

                                                <label for="">Company Name</label>
                                                <input type="text" name="company_name" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <input type="text" name="cname" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" name="caddress" required class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input type="tel" name="cphone" required class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" name="cemail" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">GST_No</label>
                                                <input type="text" name="cgst" id="gstInput" class="form-control">
                                            </div>
                                            <input type="submit" name="submit" id="submit" class="btn btn-success mt-5">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ENDING   INVOICE  FORM  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function() {
            $("select").selectize();

            $('#companySelect').change(() => {
                var selectedCompany = $('#companySelect').val();
                var companyData = JSON.parse($('#company_data').val());
                console.log(companyData);
                companyData.forEach(element => {
                    if (element.Id == selectedCompany) {
                        console.log(element);
                        $('#company_name').html(element.Company_name);
                        $('#name').html(element.Name);
                        $('#email').html(element.Email);
                        $('#phone').html(element.Phone);
                        $('#gst').html(element.Gst_no);
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addCustomerModal = new bootstrap.Modal(document.getElementById('modal_frm'));
            var addCustomerButton = document.getElementById('add_customer');
            addCustomerButton.addEventListener('click', function() {
                addCustomerModal.show();
            });

            document.getElementById('gstInput').addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('update_gstInput').addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        });
    </script>

    <?php include('changepass-modal.php');
    ?>
</body>


</html>