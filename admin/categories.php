<?php 
require('includes/header.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}
$query = "SELECT * FROM categorie";
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
                <h2 class="text-info"> Categories </h2>
                <?php 
                    if(isset($_GET['deleted']))
                    {
                        echo "<div class='alert alert-success'>
                                    Categorie supprimer !
                              </div>";
                    }
                ?>
                <hr>
                <table class="table table-bordered">
                    <thead class="">
                        <tr>
                            <th> id </th>
                            <th> Nom  </th>
                            <th> Description </th>
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
                                <td><?php echo $categorie['description']; ?></td>
                                <td>
                                     <a href="editCategory.php?id=<?php echo $categorie['id']; ?>" class="btn btn-sm mr-1 btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                  
                                </td>
                               
                                <td>
                                    <a href="deleteCategorie.php?id=<?php echo $categorie['id']; ?>" class="btn btn-sm btn-danger">
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