<?php # Script 11.9 - loggedin.php #2
// The user is redirected here from login.php.
session_start();
// If no session value is present, redirect the user:
if (!isset($_SESSION['CustomerID'])) {
	require_once ('./login_functions.inc.php');
	$url = absolute_url("signin.php");
	header("Location: $url");
	exit();	
}
$page_title = 'NZXT Store Shipping Selection';
$id=$_SESSION['CustomerID'];

require_once ('./mysqli_connect.php');
if (isset($_POST['submitted'])) {
	$errors = array(); // Initialize an error array.

	// Check for a first name:
	if (empty($_POST['name'])) {
		$errors['name'] = 'You forgot to enter your name.';
	} else {
		$n = mysqli_real_escape_string($dbc, trim($_POST['name']));
	}

	// Check for address:
	if (empty($_POST['address1'])) {
		$errors['address1'] = 'You forgot to enter your address.';
	} else {
		$address1 = mysqli_real_escape_string($dbc, trim($_POST['address1']));
                $address2 = mysqli_real_escape_string($dbc, trim($_POST['address2']));
	}

	// Check for city:
	if (empty($_POST['city'])) {
		$errors['city'] = 'You forgot to enter your city.';
	} else {
		$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
	}
	$state=$_POST['state'];
	// Check for zip:
	if (empty($_POST['zip'])) {
		$errors['zip'] = 'You forgot to enter your zip code.';
	} else {
		$zip = mysqli_real_escape_string($dbc, trim($_POST['zip']));
		if(!preg_match('/^(\d{5})$/',$zip)){
		       $errors['zip'] = 'Invalid zip code.';
		       }
	}

	if (empty($errors)) { // If everything's OK.
          header("Location:billing.php");
          exit();
    }
}


// Count the number of returned rows:


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
<td width="300" height="28" bgcolor="#b200ff"><img src="images/NZXTShipping.png" width="300" height="28" alt="Shipping"></td>
<td width="110" height="28" bgcolor="#b200ff"><img src="images/Secure.png" alt="secure" width="64" height="28"></td>
</tr>
<tr>
<td width="100%" bgcolor="#000000"></td>
<td width="300" bgcolor="#000000"></td>
<td width="110" bgcolor="#000000"></td>
</tr>
</table>
<h2>Enter Shipping Address</h2>
<table border=""1"><tr><td>
<table border="0" cellspacing="6" cellpadding="0" width="30%">
<form action="shipping.php" method="post">

<tr>
<td align="right"> Name
											</td>
<td><input type="text" name="name" value=" <?php if(!empty($_POST['name']))echo $_POST['name'];?>" size="24" maxlength="20" autocomplete="off" value=""></td>
</tr>
<tr>
<td></td><td class="error"><?php if(!empty($errors['name']))echo "Please enter your name!";?></td>
</tr>
<tr>
<td align="right"> Street address
</td>
<td><input type="text" name="address1" size="24" maxlength="100" autocomplete="off" value=""></td>
</tr>
<tr>
<td></td><td class="error"><?php if(!empty($errors['address1']))echo "Please enter your address!";?></td>
</tr>
<tr>
<td align="right"></td>
<td><input type="text" name="address2" size="24" maxlength="100" autocomplete="off" value=""></td>
</tr>
<tr>
<td align="right"> City
											</td>
<td><input type="text" name="city" size="24" maxlength="20" autocomplete="off" value=""><br></td>
</tr>
<tr>
<td></td><td class="error"><?php if(!empty($errors['city']))echo "Please enter your city!";?></td>
</tr>
<tr>
<td align="right"> State
											</td>
<td><select name="state" ><option value="">Select State</option>
<option value="AL">AL</option>
<option value="AK">AK</option>
<option value="AZ">AZ</option>
<option value="AR">AR</option>
<option value="CA">CA</option>
<option value="CO">CO</option>
<option value="CT">CT</option>
<option value="DE">DE</option>
<option value="DC">DC</option>
<option value="FL">FL</option>
<option value="GA">GA</option>
<option value="HI">HI</option>
<option value="ID">ID</option>
<option value="IL">IL</option>
<option value="IN">IN</option>
<option value="IA">IA</option>
<option value="KS">KS</option>
<option value="KY">KY</option>
<option value="LA">LA</option>
<option value="ME">ME</option>
<option value="MD">MD</option>
<option value="MA">MA</option>
<option value="MI">MI</option>
<option value="MN">MN</option>
<option value="MS">MS</option>
<option value="MO">MO</option>
<option value="MT">MT</option>
<option value="NE">NE</option>
<option value="NV">NV</option>
<option value="NH">NH</option>
<option value="NJ">NJ</option>
<option value="NM">NM</option>
<option value="NY">NY</option>
<option value="NC">NC</option>
<option value="ND">ND</option>
<option value="OH">OH</option>
<option value="OK">OK</option>
<option value="OR">OR</option>
<option value="PA">PA</option>
<option value="RI">RI</option>
<option value="SC">SC</option>
<option value="SD">SD</option>
<option value="TN">TN</option>
<option value="TX">TX</option>
<option value="UT">UT</option>
<option value="VT">VT</option>
<option value="VA">VA</option>
<option value="WA">WA</option>
<option value="WV">WV</option>
<option value="WI">WI</option>
<option value="WY">WY</option>
<option value="PR">PR</option>
<option value="VI">VI</option>
<option value="MP">MP</option>
<option value="GU">GU</option>
<option value="AS">AS</option>
<option value="PW">PW</option>
<option value="AA">AA</option>
<option value="AE">AE</option>
<option value="AP">AP</option></select></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td align="right"> Zip Code
			</td>
<td><input type="text" name="zip" size="10" maxlength="10" autocomplete="off" value=""></td>
</tr>
<tr>
<td></td><td class="error"><?php if(!empty($errors['zip']))echo "Please enter your zip!";?></td>
</tr>
<tr>

<td>
				
			<input type="hidden" name="submitted" value="TRUE" /></td>
</tr>
<tr>
<td></td>
<td align="left"><input type="image" src="images/NZXTUseThisAddress.png" width="122" height="20" border="0" alt="Use this Address"></td>
</tr>

</form>
</table>
        </td></tr></table>


</body>
</html>
