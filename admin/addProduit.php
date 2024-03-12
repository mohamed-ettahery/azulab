<?php 
require('includes/header.php');
if(!isset($_SESSION['admin']))
{
    header('location:login.php');
}
$errors = [];
$message = "";


if(isset($_POST['submit']))
{
   

    if(empty($_POST['nom']))
    {
        $errors = "Veillez remplir le champ  Nom" ;
    }
    else if(empty($_POST['Description']))
    {
        $errors = "Veillez remplir le champ description" ;
    }
    else if(empty($_POST['category']))
    {
        $errors = "Veillez choisir une categorie" ;
    }
    else   if(empty($_FILES['image']['name']))
    {
        $errors = "Veillez choisir une image" ;
    }
    else
    {   
        $directory = "../assets/images/products/";
        $file = $directory.basename($_FILES['image']['name']);
        $nom = mysqli_escape_string($con,$_POST['nom']);
        $tags = mysqli_escape_string($con,$_POST['tags']);
        $description = mysqli_escape_string($con,$_POST['Description']);
        $categorie = mysqli_escape_string($con,$_POST['category']);
        // $image = mysqli_escape_string($con,$_POST['image']);
        // $author =  mysqli_escape_string($con,$_SESSION['name']);
        $image = mysqli_escape_string($con, $_FILES['image']['name']);
        // $created = date('Y-m-d h:s:m');
        $query = "INSERT INTO produit(nom,description,image,id_cat,tags)
                  VALUES ('$nom','$description','$image','$categorie','$tags')";
        if(mysqli_query($con,$query))
        {
            move_uploaded_file($_FILES['image']['tmp_name'],$file);
            $message = "<div class='alert alert-success'>
                           Produit Ajoute avec secces
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
                     <h3 class="card-title text-info p-3 text-center"> Ajouter un article </h3>
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
                                            if(isset($_POST['nom']))
                                            {
                                                echo $_POST['nom']; 
                                            } 
                                    ?>"
                                     placeholder="Nom" class="form-control">
                                 </div>
                                 <div class="form-group mb-4">
                                    <input type="text" name="tags"
                                    value ="<?php 
                                            if(isset($_POST['tags']))
                                            {
                                                echo $_POST['tags']; 
                                            } 
                                    ?>"
                                     placeholder="Tags" class="form-control">
                                 </div>
                                 <div class="form-group mb-4">
                                    <textarea rows="5" cols="30" name="Description" placeholder="Description" class="form-control">
                                    <?php 
                                        if(isset($_POST['Description']))
                                        {
                                            echo $_POST['Description'];
                                        }                                       
                                    ?>
                                    </textarea>
                                 </div>
                                 <div class="form-group mb-4">
                                    <input type="file" name="image" class="form-control">
                                 </div>
                                 <div class="form-group">
                                    <button class="btn btn-raised btn-primary" name="submit" type="submit">
                                        Ajouter
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