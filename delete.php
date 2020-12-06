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
$id_borrar = $_POST['id_borrar'];

$proceso="borrar_id";
include_once 'api.php';

//deleting the row from table
$result=mysqli_query($mysqli, "DELETE FROM pets WHERE id=$id_borrar");

//redirecting to the display page (view.php in our case)
header("Location:view.php");
?>

