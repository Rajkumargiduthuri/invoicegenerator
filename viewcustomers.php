<?php

session_start();
if (!isset($_SESSION['email'])) {
  header('Location:index.php');
  exit();
}

include('bhavidb.php');

$sql = "SELECT COUNT(*) AS rowCount From `customer`";
$sql2 = "SELECT COUNT(*) AS rowCount2 From `invoice`";


$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

if ($result && $result2) {
  $row = $result->fetch_assoc();
  $row2 = $result2->fetch_assoc();

  $rowcount2 = $row2['rowCount2'];
  $rowcount = $row['rowCount'];
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BHAVIINVOICE</title>

    <!-- BOOTSTRAP PLUGIN -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- jQuery -->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/ui/1.13.0-rc.3/jquery-ui.min.js" integrity="sha256-R6eRO29lbCyPGfninb/kjIXeRjMOqY3VWPVk6gMhREk=" crossorigin="anonymous"></script>

    <!-- ADDING STYLE SHEET  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <link rel="stylesheet" href="img/style.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
      color: white;
    }

    .card-customer {
      height: 200px;
      margin: auto;
      /* padding-left: 23px; */
      width: 150px;
      border-radius: 44px;
    }

    .table.viewinvoicetable thead {
      position: sticky;
      top: 0;
      z-index: 1;
      background-color: #f2f2f2;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      /* Add shadow to the bottom */
    }

    .input-cus {
      text-align: center;
      width: 109px;
      border: none;
      font-size: 30px;
    }

    .div-cus {
      text-align: center;
      font-size: 24px;
    }

    .nav-item {
      padding-top: 20px;
    }


    .table-responsive {
  overflow-x: auto;
  }

  /* Adjust table styles as needed */
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 8px;
  border: 1px solid #dddddd;
  text-align: left;
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
                                    <a class="nav-link active-link nav-links " href="viewcustomers.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 21 20" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.842 12.957C11.531 12.957 14.684 13.516 14.684 15.749C14.684 17.982 11.552 18.557 7.842 18.557C4.152 18.557 1 18.003 1 15.769C1 13.535 4.131 12.957 7.842 12.957Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.84199 9.77C5.41999 9.77 3.45599 7.807 3.45599 5.385C3.45599 2.963 5.41999 1 7.84199 1C10.263 1 12.227 2.963 12.227 5.385C12.236 7.798 10.286 9.761 7.87299 9.77H7.84199Z" stroke="white   " stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14.7336 8.6318C16.3346 8.4068 17.5676 7.0328 17.5706 5.3698C17.5706 3.7308 16.3756 2.3708 14.8086 2.1138" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16.8459 12.4824C18.3969 12.7134 19.4799 13.2574 19.4799 14.3774C19.4799 15.1484 18.9699 15.6484 18.1459 15.9614" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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
                            <a class="navbar-brand" href="#"  id="change_password_sm" ><img src="img/Bhavi-Logo-2.png" alt="" height="80px" width="200px" class="img-fluid"></a>

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
                                    <a  class="nav-link active-link nav-links" href="viewcustomers.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 21 20" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.842 12.957C11.531 12.957 14.684 13.516 14.684 15.749C14.684 17.982 11.552 18.557 7.842 18.557C4.152 18.557 1 18.003 1 15.769C1 13.535 4.131 12.957 7.842 12.957Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.84199 9.77C5.41999 9.77 3.45599 7.807 3.45599 5.385C3.45599 2.963 5.41999 1 7.84199 1C10.263 1 12.227 2.963 12.227 5.385C12.236 7.798 10.286 9.761 7.87299 9.77H7.84199Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14.7336 8.6318C16.3346 8.4068 17.5676 7.0328 17.5706 5.3698C17.5706 3.7308 16.3756 2.3708 14.8086 2.1138" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M16.8459 12.4824C18.3969 12.7134 19.4799 13.2574 19.4799 14.3774C19.4799 15.1484 18.9699 15.6484 18.1459 15.9614" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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


      <!-- Modal for Add Customers-->
      <section class="col-lg-10">
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
                        <input type="submit" name="submit" id="" class="btn btn-success mt-5">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div>
                <p class="float-end d-flex flex-row justify-content-center"><a href="#" class="btn btn-success" id="add_customer">Add Customer</a></p>
              </div> -->
            </div>
          </div>
        </div>

        <!-- Modal for Update Customers-->
        <div class="container  ">
          <div class="modal" tabindex="-1" id="update_frm">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Update Details</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="updatemodal.php" method="post">
                    <input type="text" name="Id" required hidden class="form-control" value="<?php echo $Cid; ?>">
                    <div class="form-group">
                      <label for="update_company_name">Company Name</label>
                      <input type="text" name="company_name" id="update_company_name" class="form-control" value="<?php echo $Company_name; ?>">
                    </div>
                    <div class="form-group">
                      <label for="update_cname">Name</label>
                      <input type="text" name="cname" id="update_cname" class="form-control" value="<?php echo $Name; ?>">
                    </div>
                    <div class="form-group">
                      <label for="update_caddress">Address</label>
                      <input type="text" name="caddress" id="update_caddress" required class="form-control" value="<?php echo $Address; ?>">
                    </div>
                    <div class="form-group">
                      <label for="update_cphone">Phone</label>
                      <input type="text" name="cphone" id="update_cphone" required class="form-control" value="<?php echo $Phone; ?>">
                    </div>
                    <div class="form-group">
                      <label for="update_cemail">Email</label>
                      <input type="text" name="cemail" id="update_cemail" class="form-control" value="<?php echo $Email; ?>">
                    </div>
                    <div class="form-group">
                      <label for="update_gstInput">GST_No</label>
                      <input type="text" name="cgst" id="update_gstInput" class="form-control" value="<?php echo $Gst_no; ?>">
                    </div>
                    <input type="submit" value="update" name="Update" id="update_customer" class="btn btn-success mt-5">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="container mango">
          <div class="row">
            <div class="col-lg-7 col-sm-12 pb-4">
              <?php




              require_once('bhavidb.php');

              // Fetch paid invoices
              $sql = "SELECT MONTH(Invoice_date) AS month, SUM(Grandtotal) AS totalAmount
                FROM invoice
                WHERE `status` = 'paid'
                GROUP BY MONTH(Invoice_date);";

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
                      text: "Monthly Income Status"
                    },
                    axisX: {
                      title: "Months"
                    },
                    axisY: {
                      title: "Income",
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
              <div class="container mt-5" style="border-radius: 50px;">
                <h5 style="text-align: center;" class="mb-4"><strong></strong></h5>
                <div id="chartContainer" style="height: 180px; border-radius: 20px;"></div>
              </div>
              <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>


            </div>

            <div class="col-lg-2  col-sm-6 card card-customer">
              <div class=" text-ceneter ps-5 pt-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" viewBox="0 0 16 16" fill="none">
                  <path d="M5.66629 7.22225C7.38451 7.22225 8.7774 5.82936 8.7774 4.11114C8.7774 2.39292 7.38451 1.00003 5.66629 1.00003C3.94807 1.00003 2.55518 2.39292 2.55518 4.11114C2.55518 5.82936 3.94807 7.22225 5.66629 7.22225Z" stroke="#3575FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M1 14.9995V13.4439C1 12.6188 1.32778 11.8275 1.91122 11.244C2.49467 10.6606 3.28599 10.3328 4.11111 10.3328H7.22222C8.04734 10.3328 8.83866 10.6606 9.42211 11.244C10.0056 11.8275 10.3333 12.6188 10.3333 13.4439V14.9995" stroke="#3575FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M11.1112 1.10257C11.7804 1.27391 12.3736 1.66311 12.7971 2.20881C13.2207 2.75451 13.4506 3.42566 13.4506 4.11646C13.4506 4.80726 13.2207 5.47841 12.7971 6.02411C12.3736 6.5698 11.7804 6.959 11.1112 7.13035" stroke="#3575FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M14.9997 15.0007V13.4452C14.9958 12.7585 14.7648 12.0924 14.3427 11.5508C13.9206 11.0092 13.3312 10.6224 12.6664 10.4507" stroke="#3575FF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
              <div class="div-cus">
                <p><b>Clients</b></p>
                <input class="input-cus" type="text" value="<?php echo $rowcount ?>" readonly>
              </div>
            </div>

            <div class="col-lg-2 col-sm-6 card card-customer">
              <div class=" text-ceneter ps-5 pt-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="40" fill="#007BFF" class="bi bi-receipt" viewBox="0 0 16 16">
                  <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                  <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                </svg>

              </div>
              <div class=" div-cus">
                <p><b>Invoices</b></p>
                <input class=" input-cus" type="text" value="<?php echo $rowcount2 ?> " readonly>
              </div>
            </div>
          </div>
        </div>

        <!-- Table for View Customers-->
        <div class="container mango mt-2">
    <div class="" style="max-height: 500px; overflow-y: auto; border-radius: 40px; background-color: white;">  

     <div class="table-responsive">  
       <table class="table viewinvoicetable pb-5" style="border-collapse: collapse; border: none; border-radius: 40px;"> 
      

        <thead style="position: sticky; top: 0; z-index: 1; background-color: #f2f2f2;">
          <tr style="background-color: #ffffff;" class="pb-2">
            <th>Id</th>
            <th >Company Name</th>
            <th>Customer Name</th>
            <th>Customer Phone</th>
            <th>Customer Email</th>
            <th>Customer Address</th>
            <th>Customer Gst NO</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="product_tbody" class="viewinvoicetable" style="border: hidden;">

   
          <?php
          require_once('bhavidb.php');
          $sql = "SELECT * FROM customer";
          $res = $conn->query($sql);
          while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr style='border: hidden;'>";
            echo "<td style='border: hidden;'>" . $row['Id'] . "</td>";
            echo "<td style='border: hidden;'>" . $row['Company_name'] . "</td>";
            echo "<td style='border: hidden;'>" . $row['Name'] . "</td>";
            echo "<td style='border: hidden;'>" . $row['Phone'] . "</td>";
            echo "<td style='border: hidden;'>" . $row['Email'] . "</td>";
            echo "<td style='border: hidden;'>" . $row['Address'] . "</td>";
            echo "<td style='border: hidden;'>" . $row['Gst_no'] . "</td>";

            // Pass the customer ID as a parameter to the JavaScript function
            echo "<td>
                  <div class='btn-group'>
                    <a href=\"#\" class=\"update_customer\" data-bs-toggle=\"modal\" data-bs-target=\"#update_frm\" data-id=\"{$row['Id']}\">
                      <button class=\"update-button-cus\"><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                        <path d='M23 4V10H17' stroke='#569C10' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                        <path d='M1 20V14H7' stroke='#569C10' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                        <path d='M3.51 9C4.01717 7.56678 4.87913 6.2854 6.01547 5.27542C7.1518 4.26543 8.52547 3.55976 10.0083 3.22426C11.4911 2.88875 13.0348 2.93434 14.4952 3.35677C15.9556 3.77921 17.2853 4.56471 18.36 5.64L23 10M1 14L5.64 18.36C6.71475 19.4353 8.04437 20.2208 9.50481 20.6432C10.9652 21.0657 12.5089 21.1112 13.9917 20.7757C15.4745 20.4402 16.8482 19.7346 17.9845 18.7246C19.1209 17.7146 19.9828 16.4332 20.49 15' stroke='#569C10' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                      </svg></button>
                    </a>  <br><br>
                    <span style='margin-left: 10px;'></span> 
                    <a href=\"delete.php?Id={$row['Id']}\" onClick=\"return confirm('Are you sure you want to delete?')\">
                      <button class=\"delete-button-cus\"><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                        <path d='M3 6H5H21' stroke='#C01818' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                        <path d='M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6' stroke='#C01818' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                        <path d='M10 11V17' stroke='#C01818' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                        <path d='M14 11V17' stroke='#C01818' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/>
                      </svg>
                      </button>
                    </a>
                  </div>
                </td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

      </section>

    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var addCustomerModal = new bootstrap.Modal(document.getElementById('modal_frm'));
      var updateCustomerModal = new bootstrap.Modal(document.getElementById('update_frm'));

      var addCustomerButton = document.getElementById('add_customer');
      var updateCustomerButtons = document.querySelectorAll('.update_customer');

      addCustomerButton.addEventListener('click', function() {
        addCustomerModal.show();
      });

      updateCustomerButtons.forEach(function(button) {
        button.addEventListener('click', function() {
          var row = button.closest('tr');
          var id = row.cells[0].innerText;
          var company_name = row.cells[1].innerText;
          var name = row.cells[2].innerText;
          var address = row.cells[5].innerText;
          var phone = row.cells[3].innerText;
          var email = row.cells[4].innerText;
          var gstNo = row.cells[6].innerText;

          document.querySelector('#update_frm [name="Id"]').value = id;
          document.querySelector('#update_frm [name="company_name"]').value = company_name;
          document.querySelector('#update_frm [name="cname"]').value = name;
          document.querySelector('#update_frm [name="caddress"]').value = address;
          document.querySelector('#update_frm [name="cphone"]').value = phone;
          document.querySelector('#update_frm [name="cemail"]').value = email;
          document.querySelector('#update_frm [name="cgst"]').value = gstNo;

          updateCustomerModal.show();
        });
      });
    });

    document.getElementById('gstInput').addEventListener('input', function() {
      this.value = this.value.toUpperCase();
    });

    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('update_gstInput').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
      });
    });
  </script>
  <?php include('changepass-modal.php'); ?>


</body>

</html>