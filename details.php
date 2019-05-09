
<?php
$page_title = 'NZXT Store Individual Product Page';
include ('includes/header.html');
// Need the database connection:
require_once ('./mysqli_connect.php');

// Determine how many pages there are...
if (isset($_GET['pid']) && is_numeric($_GET['pid'])) { // Already been determined.

	$pid = $_GET['pid'];

} 
$q = "SELECT * FROM product where ProductID = $pid";
$r = @mysqli_query ($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);

?>

<td width="85%">
Here are details ...
<?php   
	
	// Fetch and print all the records:
$row = mysqli_fetch_array($r, MYSQLI_ASSOC);

echo '<br /><br/>';
echo '<table><tr>';
echo '<td align="left" rowspan="2"><img src="' .$row['ProductImage'] . '" width="200" hight="200"/></td>';
echo '<td>'.$row['Description'].'</td></tr><tr>';
echo '<td>$'.$row['Price'].'</td></tr><tr>';
echo '<td align="left"><a href="add_cart.php?pid=' . $row['ProductID'] .'"><img src="images/addtocart.png" /></a></td>';
echo '</tr></table>';

	mysqli_free_result ($r);

        // Make the links to other pages, if necessary.
?>
</td>
	
<?php // Include the footer:
include ('includes/footer.html');
?>
