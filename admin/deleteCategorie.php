<?php 
require('../Database/connection.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}

$id = mysqli_escape_string($con,$_GET['id']);
$query = "DELETE FROM categorie WHERE id='$id'";
if(mysqli_query($con,$query))
{
    header('location:categories.php?deleted');
}
