<?php session_start(); ?>
<html>
<head>
	<title>Homepage</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div id="header">
		Welcome to my Store!
	</div>
	<?php
	if(isset($_SESSION['valid'])) {
		include("connection.php");					
		$result = $con->query("SELECT * FROM login");
	?>
				
		Welcome <?php echo $_SESSION['name'] ?> ! <a href='logout.php'>Logout</a><br/>
		<br/>
		<a href='view.php'>View and Add Products</a>
		<br/><br/>
	<?php	
	} else {
		echo "You must be logged in to view this page.<br/><br/>";
		echo "<a href='login.php'>Login</a> | <a href='register.php'>Register</a>";
	}
	include ("footer.php");
	?>

</body>
</html>
