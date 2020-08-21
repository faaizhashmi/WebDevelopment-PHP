<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include("connection.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
if($con->query("DELETE FROM products WHERE id=$id")==true)
//redirecting to the display page (view.php in our case)
    header("Location:view.php");
else
	die("error");
?>

