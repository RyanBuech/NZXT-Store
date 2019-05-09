<?php # Script 3.7 - index.php #2

// This function outputs theoretical HTML
// for adding ads to a Web page.


$page_title = 'Registration!';
include('includes/header.html');

if (isset($_POST['submitted'])) 
{
	require_once ('./mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.

    // Check for a first name:
	if (empty($_POST['first'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first']));
	}
	
	// Check for a last name:
	if (empty($_POST['last'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last']));
	}
	
	// Check for an email address:
	if (empty($_POST['email'])) 
    {
		$errors[] = 'You forgot to enter your email address.';
	} 
    else 
    {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
		if(!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/',$e))
        {
		   $errors[] = 'Invalid email address.';
	    }
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['password'])) 
    {
		if ($_POST['password'] != $_POST['password2']) 
        {
			$errors[] = 'Your password did not match the confirmed password.';
		} 
        else 
        {
			$p = mysqli_real_escape_string($dbc, trim($_POST['password']));
			if(!preg_match('/^\w{8,}$/',$p))
            {
			      $errors[] = 'Your password should be at least eight characters.';
			}
		}
	} 
    else 
    {
		$errors[] = 'You forgot to enter your password.';
	}

    if (empty($_POST['adress'])) 
    {
		$errors[] = 'You forgot to enter your adress.';
	} 
    else 
    {
		$a = mysqli_real_escape_string($dbc, trim($_POST['adress']));
	}

    if (empty($_POST['city'])) 
    {
		$errors[] = 'You forgot to enter your city.';
	} 
    else 
    {
		$c = mysqli_real_escape_string($dbc, trim($_POST['city']));
	}

    if (empty($_POST['state'])) 
    {
		$errors[] = 'You forgot to enter your state.';
	} 
    else 
    {
		$s = mysqli_real_escape_string($dbc, trim($_POST['state']));
	}

    if (empty($_POST['zip'])) 
    {
		$errors[] = 'You forgot to enter your zip.';
	} 
    else 
    {
		$z = mysqli_real_escape_string($dbc, trim($_POST['zip']));
	}
		
	if (empty($errors)) { // If everything's OK.
	{
		//Check if the user already registered
        $q = "SELECT Email FROM customer WHERE (Password=SHA2('$p',512) AND FirstName='$fn' AND LastName='$ln' )";
		$r = @mysqli_query($dbc, $q);
		$num = @mysqli_num_rows($r);
		if ($num < 1) { // Match was made.
         // Register the user in the database...
		
		   // Make the query:
		   $q = "INSERT INTO customer (FirstName, LastName, Email, Password, Adress, City, State, Zip) VALUES ('$fn', '$ln', '$e', SHA2('$p',512),'$a', '$c', '$s', '$z')";		
		   $r = @mysqli_query ($dbc, $q); // Run the query.
		   if ($r) 
           { // If it ran OK.
		      // Print a message:
            echo '<tr><td><h1>Thank you!</h1>
		      <p>You are now registered. </p><p><br /></p></td></tr>';			      
		
		   } 
           else 
           { // If it did not run OK.
			
			   // Public message:
			   echo '<tr><td><h1>System Error</h1>
			   <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			
			   // Debugging message:
			   echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p></td></tr>';
						
		   } // End of if ($r) IF.
		
		    mysqli_close($dbc); // Close the database connection.

		    // Include the footer and quit the script:
		    include ('includes/footer.html');
		    exit();
        }
   
        else 
        {
		      echo '<tr><td><p>This user is already in the database!<p></td></tr>';
	    }
    }
} 
else { // Report the errors.
	
		echo '<tr><td><h1>Error!</h1><p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) 
        { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></td></tr></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>

<div class="page-header">
	<h1>Register Here</h1>
</div>

<form action="register.php" method="post">
<table>
    <tr>
		<td>First Name&nbsp;</td>
		<td><input type="text" name="first" size="20" maxlength="40"></td>
	</tr>
    <tr>
		<td>Last Name&nbsp;</td>
		<td><input type="text" name="last" size="20" maxlength="40"></td>
	</tr>
	<tr>
		<td>Email&nbsp;</td>
		<td><input type="email" name="email" size="20" maxlength="40"></td>
	</tr>
	<tr>
		<td>Password&nbsp;</td>
		<td><input type="password" name="password" size="20" maxlength="40"></td>
	</tr>
    <tr>
		<td>Confirm Password&nbsp;</td>
		<td><input type="password" name="password2" size="20" maxlength="40"></td>
	</tr>
    <tr>
		<td>Adress&nbsp;</td>
		<td><input type="adress" name="adress" size="20" maxlength="40"></td>
	</tr>
    <tr>
		<td>City&nbsp;</td>
		<td><input type="city" name="city" size="20" maxlength="40"></td>
	</tr>
    <tr>
		<td>State&nbsp;</td>
		<td><input type="state" name="state" size="20" maxlength="40"></td>
	</tr>
    <tr>
		<td>Zip&nbsp;</td>
		<td><input type="zip" name="zip" size="20" maxlength="40"></td>
	</tr>
	<tr>
		<td><input type="submit" name="submit" value="Register"></td>
	</tr>	
<td>
	<input type="hidden" name="submitted" value="TRUE" /> </td></tr></table>
</form>

<?php
include('includes/footer.html');
?>