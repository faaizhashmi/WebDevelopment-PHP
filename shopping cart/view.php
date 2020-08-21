<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");

//fetching data in descending order (lastest entry first)
$result = $con->query("SELECT * FROM products WHERE login_id=".$_SESSION['id']." ORDER BY id DESC");
?>

<html>
<head>
	<title>Homepage</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
	<a href="index.php">Home</a> | <a href="add.html">Add New Data</a> | <a href="logout.php">Logout</a>
	<br/><br/>
	
	<table class="table table-light">
		<tr>
			<th>Name</th>
			<th>Quantity</th>
			<th>Price (Rs)</th>
			<th>Image</th>
			<th>Actions</th>
		</tr>
		<?php
		while($r = $result->fetch_assoc()) {
            $imageURL = 'uploads/'.rawurlencode($r["image"]);
			echo "<tr>";
			echo "<td>".$r['name']."</td>";
			echo "<td>".$r['qty']."</td>";
			echo "<td>".$r['price']."</td>";
			echo "<td><a target='_blank' href=".$imageURL.">
			<img class=\"img-thumbnail\" width='100' height='100' src=".$imageURL."></a> </td>";
			echo "<td><a class='btn btn-primary' href=\"edit.php?id=$r[id]\">Edit</a>
                    <a class='btn btn-danger' href=\"delete.php?id=$r[id]\" 
                    onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
		}
		?>
	</table>
    <?php
        include ("footer.php");
    ?>
</body>
</html>
