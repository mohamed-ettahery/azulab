<?php 
require('includes/header.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}
$query = "SELECT produit.*,sous_categorie.nom as 'nom_cat' FROM produit INNER JOIN sous_categorie ON sous_categorie.id=produit.id_cat";
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
                <h2 class="text-info"> Produits </h2>
                <?php 
                    if(isset($_GET['deleted']))
                    {
                        echo "<div class='alert alert-success'>
                         Produit supprimer !
                              </div>";
                    }
                ?>
                <hr>
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th> Id </th>
                            <th> Image </th>
                            <th> Nom  </th>
                            <th> Sous Categorie </th>
                            <th> Description </th>
                            <th> Tags </th>
                            <!-- <th> Ajouter </th> -->
                            <!-- <th> Voir </th> -->
                            <th> Modifier </th>
                            <th> Supprimer </th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
                                $result = mysqli_query($con,$query);
                                while($produits = $result->fetch_assoc()):
                                
                            ?>
                            <tr>
                                <td><?php echo $produits['id']; ?></td>
                                <!-- <td><img src="images/<?php echo $produits['image']; ?>" class="img-fluid " width="100" height="100"  alt=""></td> -->
                                <td><img src="../assets/images/products/<?php echo $produits['image']; ?>" class="img-fluid " width="100" height="100"  alt=""></td>
                                <td><?php echo $produits['nom']; ?></td>
                                <td><?php echo $produits['nom_cat']; ?></td>
                                <td><textarea readOnly><?php echo $produits['description']; ?></textarea></td>
                                <td><?php echo $produits['tags']; ?></td>
                                <td>
                                     <a href="editProduit.php?id=<?php echo $produits['id']; ?>" class="btn btn-sm mr-1 btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                  
                                </td>
                                <td>
                                <a href="deleteProduit.php?id=<?php echo $produits['id']; ?>" class="btn btn-sm btn-danger">
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