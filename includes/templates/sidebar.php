<div class="card rounded-0 w-100">
    <div class="card-body">
        <div class="align-items-center d-flex d-xl-none">
            <h6 class="text-uppercase mb-0">Filter</h6>
            <div class="btn-mobile-filter-close btn-close ms-auto cursor-pointer"></div>
        </div>
        <hr class="d-flex d-xl-none" />
        <div class="product-categories">
            <h6 class="text-uppercase mb-3">Categories</h6>
            <ul class="list-unstyled mb-0 categories-list">
                <?php
                    $cats = get_From(" categorie.*,(SELECT COUNT(*) FROM produit WHERE produit.id_cat IN(SELECT sous_categorie.id FROM sous_categorie WHERE sous_categorie.id_categorie = categorie.id)) as 'countProduct'","categorie");
                    foreach($cats as $cat)
                    {
                        $cat_id = $cat['id'];
                        $cat_name = $cat['nom'];
                        $cat_pCount = $cat['countProduct'];
                        ?>
                        <li><a href="products.php?cat=<?php echo $cat_id; ?>"><?php echo $cat_name; ?> <span class="float-end badge rounded-pill bg-primary"><?php echo $cat_pCount; ?></span></a></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        <hr>
        <div class="product-categories">
            <h6 class="text-uppercase mb-3">Sous Categories</h6>
            <ul class="list-unstyled mb-0 categories-list">
            <?php
                    $cats = get_From("sous_categorie.*,(SELECT COUNT(*) FROM produit WHERE produit.id_cat = sous_categorie.id) as 'countProduct'","sous_categorie");
                    foreach($cats as $cat)
                    {
                        $cat_id = $cat['id'];
                        $cat_name = $cat['nom'];
                        $cat_pCount = $cat['countProduct'];
                        ?>
                        <!-- <li><a href="products.php?scat=<?php //echo $cat_id; ?>"><?php //echo strtoupper($cat_name); ?> <span class="float-end badge rounded-pill bg-primary"><?php //echo $cat_pCount; ?></span></a></li> -->
                        <li><a href="products.php?scat=<?php echo $cat_id; ?>"><?php echo ucwords($cat_name); ?></a></li>
                        <?php
                    }
                ?>
            </ul>
        </div>
        
    </div>
</div>