<?php 
require('../Database/connection.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}

$num = mysqli_escape_string($con,$_GET['num']);
$query = "DELETE FROM devis WHERE num='$num'";
if(mysqli_query($con,$query))
{
    header('location:devis.php?deleted');
}
