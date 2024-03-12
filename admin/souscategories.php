<?php 
require('includes/header.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}
$query = "SELECT sous_categorie.*,categorie.nom as 'nom_cat' FROM sous_categorie INNER JOIN categorie ON sous_categorie.id_categorie =categorie.id";
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
                <h2 class="text-info">  Sous Categories </h2>
                <?php 
                    if(isset($_GET['deleted']))
                    {
                        echo "<div class='alert alert-success'>
                                    Sous categorie supprimer !
                              </div>";
                    }
                ?>
                <hr>
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th> id </th>
                            <th> Nom  </th>
                            <th> Categorie </th>
                            <th> Modifier </th>
                            <th> Supprimer </th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                                $result = mysqli_query($con,$query);
                                while($categorie = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?php echo $categorie['id']; ?></td>
                                <td><?php echo $categorie['nom']; ?></td>
                                <td><?php echo $categorie['nom_cat']; ?></td>
                                <td>
                                     <a href="editsousCategory.php?id=<?php echo $categorie['id']; ?>" class="btn btn-sm mr-1 btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                  
                                </td>
                               
                                <td>
                                    <a href="deleteSouscategorie.php?id=<?php echo $categorie['id']; ?>" class="btn btn-sm btn-danger">
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