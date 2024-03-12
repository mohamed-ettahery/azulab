<?php 
require('../Database/connection.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}

$id = mysqli_escape_string($con,$_GET['id']);
$query = "DELETE FROM sous_categorie WHERE id='$id'";
if(mysqli_query($con,$query))
{
    header('location:souscategories.php?deleted');
}
