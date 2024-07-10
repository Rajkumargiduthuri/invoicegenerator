<?php

   


require_once('bhavidb.php');
require('bhavidb.php');
$Sid = (isset($_GET['Sid']) && $_GET['Sid'] !== '') ? $_GET['Sid'] : 0;
$sql = "SELECT * FROM invoice
JOIN service ON invoice.Sid = service.Sid
WHERE invoice.Sid = $Sid;";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM service WHERE service.Sid = $Sid;";
$result2 = mysqli_query($conn, $sql2);

if (!$result) {
	die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);

$html = '
<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
	font-size: 12px;
	font-weight: bold;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: center;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}

.table-heading{
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 20px;
}
.table-content{
	font-size: 12px;
}
.term{
	style="border: none;"
}
</style>
</head>
<body>

<!--mpdf
<htmlpageheader name="myheader">
    <table width="100%" height="50%">
        <tr>
            <td style="text-align: center;">
			<img src="img/logo.png" alt="img/logo.png" class="" height="12%" width="25%">
            </td>
        </tr>
    </table>
</htmlpageheader>

<htmlpagefooter name="myfooter">

<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" show-this-page="lastpage" />
mpdf-->


<table width="100%" style="font-family: Arial; " cellpadding="8" class="table-heading"><tr>
<td width="70%" style="text-align: left;">
INVOICE
</td>
<td width="40%" style="text-align: left;">
INVOICE NUMBER
</td>
</tr>
<tr>
<td width="70%" style="text-align: left;">
DATE:  ' . $row['Invoice_date'] . '
</td>
<td width="40%" style="text-align: left;">
BHAVI_KKD_2024_ ' . $row['Invoice_no'] . '
</td>
</tr>
</table>

<table width="100%" style="font-family: Arial; font-size: 15px;" cellpadding="10"><tr>
<td width="45%" style=" "><span style="font-size: 7pt; color: #555555; font-family: sans;">SOLD From:</span><br /><br />Bhavi Creations Pvt. Ltd<br />Plot no28, H No70, 17-28, RTO Office Rd,
<br />opposite to New RTO Office, behind J.N.T.U,<br />Engineering College Play Ground,RangaRaoNagar, Kakinada,
<br />Phone no: 9642343434 <br /> Email: admin@bhavicreations.com <br /> GSTIN 37AAKCB6060HIZB <br /></td>
<td width="30%"></td>
<td width="45%" style=""><span style="font-size: 7pt; color: #555555; font-family: sans;">SHIP TO:</span><br /><br /> ' . $row['Company_name'] . ', <br />' . $row['Cname'] . ', <br /> ' . $row['Caddress'] . ' <br /> ' . $row['Cphone'] . ', <br /> ' . $row['Cmail'] . ' <br /> ' . $row['Cgst'] . ' </td>
</tr></table>

<br />

<table class="items" width="100%" style="border-collapse: collapse; " cellpadding="8">
<thead>

<tr>
    <td width="5%">Si.no</td>
    <td width="15%">Services</td>
    <td width="20%">Description</td>
    <td width="5%">Qty</td>
    <td width="10%">Unit Price</td>
    <td width="10%">Total</td>
    <td width="10%">Discount</td>
    <td width="15%">Final</td>
</tr>
</thead>
<tbody>';
$counter = 1;
while ($data = mysqli_fetch_assoc($result2)) {
	$html .= '
		<tr >
			<td class="serial-number">' . sprintf('%02d', $counter) . '</td>
			<td class="table-content" align="center">' . $data["Sname"] . ' </td>
			<td class="table-content" align="center" style="word-wrap: break-word;">' . $data['Description'] . '</td>
			<td class="table-content" align="center">' . $data['Qty'] . '</td>
			<td class="cost table-content">' . $data['Price'] . '</td>
			<td class="cost table-content">' . $data['Totalprice'] . '</td>
			<td class="cost table-content">' . $data['Discount'] . '</td>
			<td class="cost table-content">' . $data['Finaltotal'] . '</td>
		</tr>';
		$counter++; 
}

$html .= '
<tr>
<td class="blanktotal" colspan="6" rowspan="1"></td>
<td class="totals table-content ">Subtotal:</td>
<td class="totals cost table-content">' . $row['Final'] . '</td>
</tr>
<tr>
<td class="table-content" style="text-align: right;" colspan="6">GST %</td>
<td class=" cost table-content">' . $row['Gst'] . '</td>
<td class="totals cost table-content">' . $row['Gst_total'] . '</td>
</tr>
<tr>
<td colspan="6" class="totals table-content">' . $row['Totalinwords'] . '</td>
<td class="totals table-content">Total</td>
<td class="totals cost table-content">' . $row['Grandtotal'] . '</td>
</tr>
<tr>
<td colspan="6" class="totals table-content"></td>
<td class="totals table-content">Advance</td>
<td class="totals cost table-content">' . $row['advance'] . '</td>
</tr>
<tr>
<td colspan="6" class="totals table-content">' . $row['balancewords'] . '</td>
<td class="totals table-content">Balance</td>
<td class="totals cost table-content">' . $row['balance'] . '</td>
</tr>
</tbody>
</table>
<br/>
<p style="font-weight: bold; ">Terms&Conditions</p>
<p style="width: 50%">' . $row['Terms'] . '</p>
<br/>
<p style="font-weight: bold;">Note:</p>
<p style="width: 50%">' . $row['Note'] . '</p>
<br/>
<br/>
<br/>
<br/>


<table>
<tr>
	<td style="width: 70%; text-align: left; font-weight: bold;">
		Scan To Pay
	</td>
	<td style="width: 20%; font-weight: bold;">
		Payment Details<br/>
	</td>
</tr>
<tr>
	<td style="width: 70%; text-align: left; font-weight: bold;">
		<img src="img/qrcode.jpg" alt="" class="" height="15%" width="15%">
	</td>
	<td style="width: 60%; text-align: left; font-weight: ;">
		Bank Name : HDFC Bank, Kakinada<br/>
		Account Name : Bhavi Creations Private Limited<br/>
		Account No. : 59213749999999<br/>
		IFSC : HDFC000042
	</td>
<tr/>
<tr>
	<td colspan="2" style=" text-align: center; font-weight: bold; border: 1px;">
		Google pay, Phone pay, Paytm 8686394079
	</td>
</tr>
</table>


</body>
</html>
';

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 20,
	'margin_right' => 15,
	'margin_top' => 35,
	'margin_bottom' => 25,
	'margin_header' => 5,
	'margin_footer' => 10
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Bhavi Creations. - Invoice");
$mpdf->SetAuthor("Bhavi Creations.");
$mpdf->SetWatermarkText("");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);

$mpdf->Output();
