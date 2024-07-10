<?php



session_start();
if (!isset($_SESSION['email'])) {
    header('Location:index.php');
    exit();
}




require_once('bhavidb.php');

// echo $database;

$sql1 = "SELECT * FROM invoice WHERE `status` = 'pending';";

$result = $conn->query($sql1);

$sql2 = "SELECT * FROM invoice WHERE `status`= 'paid';";
$result2 = $conn->query($sql2);


include('addcus-model.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BHAVIINVOICE</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>






    <link rel="stylesheet" href="img/style.css">
    <link rel="stylesheet" href="img/stylemi.css">

    <style>
        .table.viewinvoicetable thead {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Add shadow to the bottom */
        }

        table {
            background-color: white;
            border-radius: 20px;
        }

        thead {
            background-color: white;
        }

        .nav-item {
            padding-top: 20px;
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
                                    <a  class="nav-link  nav-links text-dark"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14 2V8H20" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 13H8" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 17H8" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 9H9H8" stroke="black " stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
                                    <a class="nav-link  nav-links active-link"  ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
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

                                
                                <li class="dropdown nav-item ">
                                    <a  class="nav-link  nav-links text-dark"  href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14 2V8H20" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 13H8" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16 17H8" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M10 9H9H8" stroke="black " stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
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
                                    <a class="nav-link  nav-links active-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
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

            <section class="col-lg-10 ">
                <!-- <div class="container " style="margin-top: 70px;">
                    <h5 style="text-align: center;" class="mb-4"><strong>Pending Invoices</strong></h5>
                    <div class="table-responsive ms-5" style="max-height: 350px; max-width: 1194px; overflow-y: auto;">
                        <table class="table table-bordered viewinvoicetable">
                            <thead style="position: sticky; top: 0; z-index: 1; background-color: #f2f2f2;">
                                <tr>
                                    <th class="text-center" style="width: 10%;">Invoice No</th>
                                    <th style="width: 20%;">Customer Name</th>
                                    <th style="width: 20%;">Issued Date</th>
                                    <th style="width: 20%;">Invoice Amount</th>
                                    <th style="width: 15%;">Advance</th>
                                    <th style="width: 15%;">Balance</th>
                                    <th style="width: 10%;">Status</th>
                            </thead>
                            <tbody id="product_tbody viewinvoicetable">
                                <?php

                                $totalAdvance = 0;
                                $totalBalance = 0;
                                // Loop through the fetched data and display it in the table
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['Invoice_no'] . "</td>";
                                    echo "<td>" . $row['Cname'] . "</td>";
                                    echo "<td>" . $row['Invoice_date'] . "</td>";
                                    echo "<td>" . $row['Grandtotal'] . "</td>";
                                    echo "<td>" . $row['advance'] . "</td>";
                                    $totalAdvance += $row['advance'];
                                    echo "<td>" . $row['balance'] . "</td>";
                                    $totalBalance += $row['balance'];
                                    echo "<td>" . $row['status'] .  "</td>";
                                    echo "</tr>";
                                }
                                ?>

                            </tbody>
                            <tfoot style="background-color: #f2f2f2; position: sticky; bottom: 0; z-index: 1;">
                                <tr>
                                    <td>Total</td>
                                    <td colspan="3"></td>
                                    <td style="font-weight: bold;"><?php echo $totalAdvance ?></td>
                                    <td style="font-weight: bold;"><?php echo $totalBalance ?></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div> -->


                <!-- <div class="container pb-5" style="margin-top: 70px;">
                    <h5 style="text-align: center;" class="mb-4"><strong>Paid Invoices</strong></h5>
                    <div class="table-responsive ms-5" style="max-height: 350px; max-width: 1194px; overflow-y: auto;">
                        <table class="table table-bordered viewinvoicetable">
                            <thead style="position: sticky; top: 0; z-index: 1; background-color: #f2f2f2;">
                                <tr>
                                    <th class="text-center" style="width: 10%;">Invoice No</th>
                                    <th style="width: 30%;">Customer Name</th>
                                    <th style="width: 20%;">Issued Date</th>
                                    <th style="width: 20%;">Invoice Amount</th>
                                    <th style="width: 10%;">Status</th>
                                </tr>
                            </thead>
                            <tbody id="product_tbody viewinvoicetable">
                                <?php
                                // Loop through the fetched data and display it in the table
                                while ($col = $result2->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $col['Invoice_no'] . "</td>";
                                    echo "<td>" . $col['Cname'] . "</td>";
                                    echo "<td>" . $col['Invoice_date'] . "</td>";
                                    echo "<td>" . $col['Grandtotal'] . "</td>";
                                    echo "<td>" . $col['status'] .  "</td>";
                                    echo "</tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div> -->

                <?php




                require_once('bhavidb.php');

                // Fetch paid invoices
                $sql = "SELECT MONTH(date) AS month, SUM(total_amount) AS totalAmount
                FROM expenditure_tbl
                -- WHERE `status` = 'paid'
                GROUP BY MONTH(date);";

                $result = $conn->query($sql);

                $dataPoints = array();

                // Loop through the fetched data and organize it for the chart
                while ($row = $result->fetch_assoc()) {
                    $dataPoints[] = array("label" => getMonthName($row['month']), "y" => $row['totalAmount']);
                }

                function getMonthName($monthNumber)
                {
                    $dateObj = DateTime::createFromFormat('!m', $monthNumber);
                    return $dateObj->format('F');
                }

                ?>

                <script>
                    window.onload = function() {
                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            exportEnabled: true,
                            theme: "light1",
                            title: {
                                text: "Monthly Expenditure Status"
                            },
                            axisX: {
                                title: "Months"
                            },
                            axisY: {
                                title: "Expenditure",
                                includeZero: true
                            },
                            data: [{
                                type: "column",
                                indexLabel: "{y}",
                                indexLabelFontColor: "#5A5757",
                                indexLabelPlacement: "outside",
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();
                    }
                </script>


                <!-- Monthly Invoice Amount Chart -->
                <div class="container  mt-5 mb-5  ">
                    <div class="  mango">
                    <h5 style="text-align: center;" class="mb-4"><strong>Monthly Expenditure Amount Chart</strong></h5>
                    <div id="chartContainer" style="height: 300px; "></div>
                </div>
                </div>




                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>





                <div class="container " style="margin-top: 70px;">
                    <div class="table-responsive mango" style="max-height: 500px; max-width: 1194px; overflow-y: auto;">
                        <table class="table table-bordered viewinvoicetable">
                            <thead style="position: sticky; top: 0; z-index: 1; background-color: white;">
                                <tr>
                                    <th class="text-center" >ID</th>
                                    <th style="  padding-right: 30px; padding-left: 30px;  ">Expenditure Date</th>
                                    <th style="  padding-right: 30px; padding-left: 30px;  ">Total Amount paid</th>
                                    <th style="  padding-right: 50px; padding-left: 50px;  ">Amount in words</th>
                                    <th style="  padding-right: 50px; padding-left: 50px;  ">Note</th>
                                    <!-- <th style="width: 10%;">Actions</th> -->
                                    <!-- <th style="width: 30%;">Actions</th> -->
                                </tr>
                            </thead>
                            <tbody id="product_tbody viewinvoicetable">
                                <?php
                                $sql = "SELECT * FROM expenditure_tbl";
                                $result = $conn->query($sql);
                                // Loop through the fetched data and display it in the table
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr style='border: hidden;'>";
                                    echo "<td style='border: hidden;'>" . $row['id'] . "</td>";
                                    echo "<td style='border: hidden;'>" . $row['date'] . "</td>";
                                    echo "<td style='border: hidden;'>" . $row['total_amount'] .  "</td>";
                                    echo "<td style='border: hidden;'>" . $row['amount_in_words'] . "</td>";
                                    echo "<td style='border: hidden;'>" . $row['exp_note'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include('changepass-modal.php'); ?>
</body>

</html>