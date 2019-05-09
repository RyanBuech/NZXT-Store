<?php # Script 3.7 - index.php #2

// This function outputs theoretical HTML
// for adding ads to a Web page.
function create_ad() 
{
  echo '<div class="alert alert-info" role="alert"><p>This is an annoying ad! This is an annoying ad! This is an annoying ad! This is an annoying ad!</p></div>';
} // End of the function definition.

$page_title = 'Welcome to this Site!';
include('includes/header.html');

// Call the function:
//create_ad();
?>

<div class="page-header">
	<h2>NZXT PC Cases</h2>
        <p>The elegant all-steel construction includes the iconic cable management system to streamline building and upgrading your system. You can easily build a powerful system with plenty of options for storage and cooling.</p>
    <h2>NZXT Cooling</h2>
        <p>High preformance all-in-one CPU coolers with digital control.</p>
        <img src="images/NZXTCase.png" width="250" height="250" alt="NZXT Case" id="floatright">
  	<h2>NZXT Motherboards</h2>
        <p>All the essentials are included, along with a built-in digital fan controller and integrated RGB lighting channels. The all-metal motherboard cover perfectly matches the color and finish of your case, creating a visually seamless backdrop for your components. </p>
    <h2>NZXT Power</h2>
        <p>The new E Series ATX power supplies from NZXT feature digital voltage and temperature monitoring so you get precise, real-time information about your PSU, including uptime, wattage by rail, and temperature.</p>


<?php
// Call the function again:
//create_ad();

include('includes/footer.html');
?>