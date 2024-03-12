<?php
require('./includes/header.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}
if(isset($_POST['changer']))
{
    $mdp = $_POST['mdp'];
    $query = "UPDATE admin SET mdp='$mdp'";
    if(mysqli_query($con,$query))
    {
        echo "<script>
                alert('Votre mot de passe a ete modifier !');
                window.open('?page=mdp','_self');
             </script>";
    }
}

?>
<div class="container mt-5">
    <div class="card shadow-none mb-0">
        <div class="card-body">
            <form action="" method="POST">
                <label>Saisir Nouveau mot de passe :</label>
                <input type="text" name="mdp" placeholder="entrer mot de passe" class="form-control" required/>
                <input type="submit" name="changer" value="changer" style="margin-top:20px;"  class="btn btn-success"/>
            </form>
        </div>
    </div>
</div>  