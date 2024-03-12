<?php 
require('./includes/header.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}
$errors = [];
$message = "";
$id = mysqli_escape_string($con,$_GET['id']);
$query = "SELECT * FROM produit WHERE id = '$id'";
$result = mysqli_query($con,$query);
$produit = $result->fetch_assoc();

if(isset($_POST['submit']))
{
    $nom = mysqli_escape_string($con,$_POST['nom']);
    $description = mysqli_escape_string($con,$_POST['description']);
    $categorie = mysqli_escape_string($con,empty($_POST['category']) ? $produit['id_cat'] : $_POST['category']);
    // $image = mysqli_escape_string($con,$_POST['image']);
    $tags =  mysqli_escape_string($con,$_POST['tags']);
    $image = mysqli_escape_string($con,empty($_FILES['image']['name']) ? $produit['image'] : $_FILES['image']['name']);
    // $created = date('Y-m-d h:s:m');

    if(empty($nom))
    {
        $errors = "Veillez remplir le champ  Nom" ;
    }
    else if(empty($description))
    {
        $errors = "Veillez remplir le champ description" ;
    }
    else if(empty($categorie))
    {
        $errors = "Veillez choisir une categorie" ;
    }
    // else 
    // if(empty($image))
    // {
    //     $errors = "Veillez choisir une image" ;
    // }
    else
    {   
        $directory = "../assets/images/products/";
        $file = $directory.basename($_FILES['image']['name']);
        $query = "UPDATE produit SET nom='$nom',description='$description',image='$image',id_cat ='$categorie',tags='$tags' WHERE id = '$id'";
        if(mysqli_query($con,$query))
        {
            move_uploaded_file($_FILES['image']['tmp_name'],$file);
            $message = "<div class='alert alert-success'>
                           Produit modifie avec secces
                      </div>";
        }
        else
        {
            $message = '<div class="alert alert-danger">
                           Une erreur '.mysqli_error($con).'
                         </div>';
        }
    }
}

?>

<div class="container">
     <div class="row">
             <div class="col-md-6 mx-auto mt-4 mb-3">
                 <div class="card">
                     <h3 class="card-title text-info p-3 text-center"> Modifier un article </h3>
                     <hr>
                        <?php
                            if(!empty($errors))
                            {
                                echo "<div class='alert alert-danger' >
                                        .$errors.
                                      </div>";
                            }
                            else
                            {
                                echo $message;
                            }
                        ?>
                         <form action="#" method="POST" class="p-2" enctype="multipart/form-data">
                                <div class="form-group">
                                    <select name="category" id="category" class="form-control">
                                        <option disabled selected> Veuillez choisir un sous categorie</option>
                                                <?php 
                                                    $categories2 = "SELECT * FROM sous_categorie";
                                                    if($result = mysqli_query($con,$categories2)):
                                                        while($categorie2 = $result->fetch_assoc()):
                                                
                                                ?>
                                                    <option value="<?php echo $categorie2['id']; ?>"
                                                       
                                                    >
                                                        <?php echo $categorie2['nom']; ?>
                                                    </option>
                                                <?php 
                                                        endwhile;
                                                    endif;
                                                ?>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <input type="text" name="nom"
                                    value ="<?php 
                                       echo $produit['nom'];

                                    ?>"
                                     placeholder="Titre" class="form-control">
                                 </div>
                                 
                                 <div class="form-group mb-4">
                                    <input type="text" name="tags"
                                    value ="<?php 
                                       echo $produit['tags'];

                                    ?>"
                                     placeholder="Tags" class="form-control">
                                 </div>

                                 <div class="form-group mb-4">
                                    <textarea rows="5" cols="30" name="description" placeholder="Description" class="form-control">
                                    <?php 
                                       echo $produit['description'];

                                    ?>
                                    </textarea>
                                 </div>
                                 <div class="form-group mb-4">
                                    <input type="file" name="image" class="form-control">
                                 </div>
                                 <div class="form-group">
                                    <button class="btn btn-raised btn-primary" name="submit" type="submit">
                                        Modifier
                                    </button>
                                 </div>
                         </form>      
                  </div>
             </div>
     </div>
</div>

<?php
    require('./includes/footer.php');
?>