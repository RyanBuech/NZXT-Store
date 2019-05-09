<?php # Script 11.9 - loggedin.php #2
session_start();
// If no session customer_id is present, redirect the user login page:
if (!isset($_SESSION['CustomerID'])) {
	require_once ('./login_functions.inc.php');
	$url = absolute_url("login.php");
	header("Location: $url");
	exit();	
}

$page_title = 'NZXT Store Billing Selection';
$id=$_SESSION['CustomerID'];

require_once ('./mysqli_connect.php');
?>

<html>
<head>
<title>NZXT Store Checkout: Choose Shipping Address</title>
<link rel="stylesheet" href="css/style1.css" type="text/css" media="screen" />
</head>
<body>
<div id="header">
		<h1>NZXT Store</h1>
</div>
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width="100%" height="28" bgcolor="#b200ff"></td>
<td width="300" height="28" bgcolor="#b200ff"><img src="images/NZXTPlaceOrder.png" width="300" height="28" alt="Place Order"></td>
<td width="110" height="28" bgcolor="#b200ff"><img src="images/Secure.png" alt="secure" width="64" height="28"></td>
</tr>
<tr>
<td width="100%" bgcolor="#000000"></td>
<td width="300" bgcolor="#000000"></td>
<td width="110" bgcolor="#000000"></td>
</tr></table>
<div align="center">
    <a href="Thankyou.php"><img src="images/NZXTBuy.png" alt="Place order"></a>
</div>

    <h2>Here is what your ordered:</h2>
    <?php
    if (!empty($_SESSION['cart'])) {

   $q="SELECT * FROM product where ProductID IN (";
   foreach($_SESSION['cart'] as $pid=>$value){
       $q .=$pid.',';
   }
   $q=substr($q,0,-1).')';
   $r=mysqli_query($dbc,$q);

   //create a form and a table:
   echo '<form action="confirm.php" method="post">
        <table border="1" align="center">
     <tr>
     	<td align="left" width="15%"><b>Name</b></td>
		<td align="left" width="40%"><b>Description</b></td>
		<td align="right" width="15%"><b>Price</b></td>
		<td align="center" width="15%"><b>Qty</b></td>
		<td align="right" width="15%"><b>Total Price</b></td>
	  </tr>
     ';

	// Print each item...
	$total = 0; // Total cost of the order.
	while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {

		// Calculate the total and sub-totals.
		$subtotal = $_SESSION['cart'][$row['ProductID']]['quantity'] * $row['Price'];
		$total += $subtotal;

		// Print the row.
		echo "\t<tr>
		<td align=\"left\">{$row['Name']}</td>
		<td align=\"left\">{$row['Description']}</td>
		<td align=\"right\">\${$row['Price']}</td>
		<td align=\"center\"><input type=\"text\" size=\"3\" name=\"qty[{$row['ProductID']}]\" value=\"{$_SESSION['cart'][$row['ProductID']]['quantity']}\" /></td>
		<td align=\"right\">$" . number_format ($subtotal, 2) . "</td>
   	</tr>\n";

	  } // End of the WHILE loop.

	
	// Print the footer, close the table, and the form.
	echo '<tr>
		<td colspan="4" align="right"><b>Total:</b></td>
		<td align="right">$' . number_format ($total, 2) . '</td>
	</tr>
	</table>
	<div align="center"><input type="submit" name="submit" value="Update My Cart" /></div>
	<input type="hidden" name="submitted" value="TRUE" />
	</form><p align="center">Enter a quantity of 0 to remove an item.
	<br /><br /></p>';

 } else {
	echo '<p>Your cart is currently empty.</p>';
 }

	
?>
    <div align="center">
     <a href="Thankyou.php"><img src="images/btnPlaceOrder.gif" alt=""Place order"></a>
</div>
</body>
</html>