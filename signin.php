<?php # Script 3.7 - index.php #2

// This function outputs theoretical HTML
// for adding ads to a Web page.

if (isset($_POST['submitted'])) {

	// For processing the login:
	require_once ('./login_functions.inc.php');
	
	// Need the database connection:
	require_once ('./mysqli_connect.php');
		
	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['password']);

	
	if ($check) { // OK!
			
		// Set the cookies:
		session_start();
		$_SESSION['CustomerID']=$data['CustomerID'];
		$_SESSION['FirstName']=$data['FirstName'];
		
		// Redirect:
		$url = absolute_url ('view_cart.php');
		header("Location: $url");
        //redirect_user();
		exit(); // Quit the script.
			
	} else { // Unsuccessful!

		// Assign $data to $errors for error reporting
		// in the login_page.inc.php file.
		$errors = $data;

	}
		
	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.
$page_title = 'Sign In';
include ('includes/header.html');

// Print any error messages, if they exist:
if (!empty($errors)) {
	echo '<tr><td><h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p></td></tr>';
}

?>

<div class="page-header">
	<h1>Sign In Here</h1>
</div>
<form action="signin.php" method="post">
<table>
	<tr>
		<td>Email&nbsp;</td>
		<td><input type="email" name="email" size="20" maxlength="40"></td>
	</tr>
	<tr>
		<td>Password&nbsp;</td>
		<td><input type="password" name="password" size="20" maxlength="40"></td>
	</tr>
	<tr>
		<td><input type="submit" name="submit" value="Sign In"></td>
        <input type="hidden" name="submitted" value="TRUE" />
	</tr>
</table>
</form>

<?php
include('includes/footer.html');
?>