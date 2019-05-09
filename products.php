<?php
$page_title = 'NZXT Store';
include ('includes/header.html');
require_once ('./mysqli_connect.php');
?>  

    <?php
	require_once ('./mysqli_connect.php');// Find top five sales
	
	$q = 'Select ProductID,Name,Description,ProductImage,Price from product';
        //echo $q;
	$r = @mysqli_query ($dbc, $q);
	echo '<table>';
	
	$count=0;
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) 
    {
	    if($count==0)
	        echo '<tr>';
	        $count=(++$count)%3;
	        echo '<td align="right"><a href="details.php?pid=' . $row['ProductID'].'" style="color: #b200ff"> ' . $row['Name'] . '</a></td>
            <td width="5"></td>
            <td align="left"><a href="details.php?pid=' . $row['ProductID'].'"><img src="' .$row['ProductImage'] . '" width="100" hight="100"/></a></td>
            <td>$'.$row['Price'].'</td>
            
            <td width="50"></td>';
	        if($count==0)
	            echo '</tr><tr height="20"></tr>';
	}
	if($count!=0)
	    echo '</tr>';
	    echo '</table>'; // Close the table.
	mysqli_free_result ($r);
?>
	
<?php // Include the footer:
include ('includes/footer.html');
?>
