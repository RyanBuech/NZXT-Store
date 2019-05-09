<?php
$page_title = 'NZXT Store Shopping Cart';
include ('includes/header.html');
echo '<td>';
if (isset($_POST['submitted'])) {

	// Change any quantities:
	foreach ($_POST['qty'] as $k => $v) {

		// Must be integers!
		$pid = (int) $k;
		$qty = (int) $v;
		
		if ( $qty == 0 ) { // Delete.
			unset ($_SESSION['cart'][$pid]);
		} elseif ( $qty > 0 ) { // Change quantity.
			$_SESSION['cart'][$pid]['quantity'] = $qty;
		}		
	} // End of FOREACH.
} // End of SUBMITTED IF.
if (!empty($_SESSION['cart'])) {
   require_once('./mysqli_connect.php');
   $q="SELECT * FROM product where ProductID IN (";
   foreach($_SESSION['cart'] as $pid=>$value){
       $q .=$pid.',';
   }
   $q=substr($q,0,-1).')';
   $r=mysqli_query($dbc,$q);

   //create a form and a table:
   echo '<form action="view_cart.php" method="post">
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
		<td align=\"center\"><input type=\"text\" size=\"3\" 
		name=\"qty[{$row['ProductID']}]\" value=\"{$_SESSION['cart'][$row['ProductID']]['quantity']}\" /></td>
		<td align=\"right\">$" . number_format ($subtotal, 2) . "</td>
   	</tr>\n";
	
	  } // End of the WHILE loop.
	
	mysqli_close($dbc); // Close the database connection.

	// Print the footer, close the table, and the form.
	echo '<tr>
		<td colspan="4" align="right"><b>Total:</b></td>
		<td align="right">$' . number_format ($total, 2) . '</td>
	</tr>
	</table>
	<div align="center"><input type="submit" name="submit" value="Update My Cart" /></div>
	<input type="hidden" name="submitted" value="TRUE" />
	</form><p align="center">Enter a quantity of 0 to remove an item.
	<br /><br /><a href="shipping.php">Checkout</a></p>';

 } else {
	echo '<p>Your cart is currently empty.</p>';
 }
 echo '</td>';
 // Include the footer:
include ('includes/footer.html');
?>
