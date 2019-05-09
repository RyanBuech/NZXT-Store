<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ryan Buech's NZXT Store</title> 
    <link rel="shortcut icon" type="image/png" href="images/logo.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title; ?></title>
    <link href="css/Buech2.css" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <header>
        <img src="images/logo.png" alt="logo" width="100" height="100" style="float:left"/>
        <h1>Ryan Buech's NZXT Store</h1>
    </header>
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header"><a class="navbar-brand" href="#">NZXT Store</a></div>
		<div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>                

                <?php if(isset($_SESSION['id'])): ?>
                    <li><a href="signin.php">Sign Out</a></li>
                <?php else: ?>
                    <li><a href="signin.php">Sign In</a></li>
                <?php endif; ?>
				<li><a href="register.php">Register</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
		</div>
	</div>
</nav>
<div class="container">
<!-- Script 3.2 - header.html -->