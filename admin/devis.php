<?php 
require('includes/header.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}
$query = "SELECT * FROM devis";
$result = mysqli_query($con,$query);
?>
<div class="container-fluid">
        <div class="row mt-4">
            <div class="col-sm-3 co-md-4 sidebar">
            <?php 
                require('includes/sidebar.php');
            ?>
            </div>
            <div class="col-sm-6 col-md-8 mr-3 main">
                <h2 class="text-info"> Devis </h2>
                <?php 
                    if(isset($_GET['deleted']))
                    {
                        echo "<div class='alert alert-success'>
                                    Commentaire supprimer !
                              </div>";
                    }
                ?>
                <hr>
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th> Numero </th>
                            <th> Nom  </th>
                            <th> Prenom </th>
                            <th> Email </th>
                            <th> Telephone </th>
                            <th> Message </th>
                            <th> Supprimer </th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                                $result = mysqli_query($con,$query);
                                while($devis = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $devis['num']; ?></td>
                                <td><?php echo $devis['nom']; ?></td>
                                <td><?php echo $devis['prenom']; ?></td>
                                <td><?php echo $devis['email']; ?></td>
                                <td><?php echo $devis['tele']; ?></td>
                                <td><?php echo $devis['message'];?></td>
                               
                                <td>
                                    <a href="deleteDevis.php?num=<?php echo $devis['num']; ?>" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    
                                </td>
                            </tr>
                            
                            <?php 
                                
                                endwhile;
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>