<?php # Script 3.7 - index.php #2

// This function outputs theoretical HTML
// for adding ads to a Web page.


$page_title = 'Welcome to this Site!';
include('includes/header.html');

?>

<div class="page-header">
	<h1>Leave Us A Message</h1>
</div>
<form action="" method="post">
<table>
	<tr>
		<td>Email&nbsp;</td>
		<td><input type="text" name="email" size="30" maxlength="40"></td>
	</tr>
	<tr>
		<td>Message&nbsp;</td>
		<td> <textarea rows = "6" cols = "60" name = "message">
        </textarea><br></td>
	</tr>
	<tr>
		<td><input type="submit" name="submit" value="Submit"></td>
	</tr>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	echo '<div class="page-header"><h1>Login Sucessful</h1></div>';
}
?>

<?php
include('includes/footer.html');
?>