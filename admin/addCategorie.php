<?php 
require('./includes/header.php');
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
        $errors = "Veillez remplir le champ  nom" ;
    }
   
    else
    {   
        
        $nom = mysqli_escape_string($con,$_POST['nom']);
        $Description =  mysqli_escape_string($con,$_POST['Description']);
        
        $query = "INSERT INTO categorie(nom,description)
                  VALUES ('$nom','$Description')";
        if(mysqli_query($con,$query))
        {
           
            $message = "<div class='alert alert-success'>
                           Categorie Ajoute avec secces
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
                     <h3 class="card-title text-info p-3 text-center"> Ajouter une Categorie </h3>
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
                         <form action="#" method="POST" class="p-2" >
                                
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
                                    <textarea rows="5" cols="30" name="Description" placeholder="Description" class="form-control">
                                    <?php 
                                        if(isset($_POST['Description']))
                                        {
                                            echo $_POST['Description'];
                                        }                                       
                                    ?>
                                    </textarea>
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