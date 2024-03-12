
<?php
require 'includes/templates/header.php';
$previewProductsCount = 9;
?>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--start shop area-->
		<section class="py-4">
			<div class="container">
				<div class="row">
					<div class="col-12 col-xl-3">
						<div class="btn-mobile-filter d-xl-none"><i class='bx bx-slider-alt'></i>
						</div>
						<div class="filter-sidebar d-none d-xl-flex">
                            <?php include 'includes/templates/sidebar.php'; ?>
						</div>
					</div>
					<div class="col-12 col-xl-9">
						<div class="product-wrapper">
							<div class="product-grid">
								<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3">


								<?php
									$start = isset($_GET['page'])&&is_numeric($_GET['page'])&&intval($_GET['page'])>1?(intval($_GET['page']) - 1)*$previewProductsCount:0;
                                    if(isset($_GET['cat'])&& is_numeric($_GET['cat']))
                                    {
                                        // $whereIDCat = "WHERE id_cat = {$_GET['cat']}";
                                        $query = "SELECT produit.*,categorie.nom as 'catName',sous_categorie.nom as 'scatName' FROM produit
                                        INNER JOIN sous_categorie on sous_categorie.id = produit.id_cat
                                        INNER JOIN categorie ON categorie.id = sous_categorie.id_categorie
                                        WHERE categorie.id = {$_GET['cat']}
                                        ORDER BY produit.id DESC LIMIT $start,$previewProductsCount";
                                        // echo "<script>alert('yes')</script>";
                                    }
                                    elseif(isset($_GET['scat'])&& is_numeric($_GET['scat']))
                                    {
                                        $query = "SELECT produit.*,categorie.nom as 'catName',sous_categorie.nom as 'scatName' FROM produit
                                        INNER JOIN sous_categorie on sous_categorie.id = produit.id_cat
                                        INNER JOIN categorie ON categorie.id = sous_categorie.id_categorie
                                        WHERE sous_categorie.id = {$_GET['scat']}
                                        ORDER BY produit.id DESC LIMIT $start,$previewProductsCount";
                                        // echo "<script>alert('yes')</script>";
                                        
                                    }
                                    else
                                    {
                                        $query = "SELECT produit.*,categorie.nom as 'catName',sous_categorie.nom as 'scatName' FROM produit
                                        INNER JOIN sous_categorie on sous_categorie.id = produit.id_cat
                                        INNER JOIN categorie ON categorie.id = sous_categorie.id_categorie
                                        ORDER BY produit.id DESC LIMIT $start,$previewProductsCount";
                                        // echo "<script>alert('yes')</script>";
                                    }
									// $whereIDCat = isset($_GET['idcat'])&& is_numeric($_GET['idcat'])?"WHERE id_cat = {$_GET['idcat']}":NULL;
									// $query = "SELECT produit.*,categorie.nom as 'catName' FROM produit INNER JOIN categorie ON categorie.id = produit.id_cat ORDER BY 1 ASC LIMIT $start,$previewProductsCount";
									$stmt = $cnx->prepare($query);
									$stmt->execute();
									$products = $stmt->fetchAll();
									foreach($products as $product)
									{
										$p_id = $product['id'];
										$p_name = $product['nom'];
										$p_image = $product['image'];
										$p_catName = $product['catName'];
										$p_scatName = $product['scatName'];
										?>
										<div class="col" style="margin-bottom: 20px;">
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
																<a href="product-details.php?p=<?php echo $p_id; ?>" class="btn btn-dark btn-ecomm"><i class="bx bxs-cart-add"></i>Voir Produit</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php
									}
								?>
								</div>
								<!--end row-->
							</div>
							<hr>
							<nav class="d-flex justify-content-between" aria-label="Page navigation">
							 <!--Start Pagination -->
									<?php
										// $count = getCount("produit");


                                        if(isset($_GET['cat'])&& is_numeric($_GET['cat']))
                                        {
                                            $queryString = "&cat={$_GET['cat']}";
                                            $count = getCount("produit","WHERE id_cat IN(SELECT id FROM sous_categorie WHERE sous_categorie.id_categorie = {$_GET['cat']})");
                                        }
                                        elseif(isset($_GET['scat'])&& is_numeric($_GET['scat']))
                                        {   
                                            $queryString = "&scat={$_GET['scat']}";
                                            $count = getCount("produit","WHERE id_cat = {$_GET['scat']}");
                                        }
                                        else
                                        {
                                            $queryString = "";
                                            $count = getCount("produit");
                                        }


										// $count =isset($_GET['idcat'])&&is_numeric($_GET['idcat'])? getCount("produit","WHERE idCategorie ={$_GET['idcat']}"):getCount("produit");
										$res = ceil($count/$previewProductsCount);
										$page = isset($_GET['page'])&&is_numeric($_GET['page'])&&intval($_GET['page'])<=$res?intval($_GET['page']):1;

										// $idcat = isset($_GET['idcat'])&&is_numeric($_GET['idcat'])?intval($_GET['idcat']):"";

										if($res>1)
										{
											?>
											<ul class="pagination">
												<li class="page-item"><a class="page-link" href='<?php if($page>1)echo "?page=".($page-1).$queryString?>'><i class='bx bx-chevron-left'></i> Prev</a>
												</li>
											</ul>
											<ul class="pagination">
											<?php
											for($i=1;$i<=$res;$i++)
											{
											?>
											<li class="page-item d-none d-sm-block"><a class="page-link <?php if($page == $i)echo "active"; ?>" href="?page=<?php echo $i ?><?php echo $queryString ?>"><?php echo $i ?></a></li>
											<?php
											}
											?>
											</ul>
											<ul class="pagination">
												<li class="page-item"><a class="page-link" href='<?php if($page<$res)echo "?page=".($page+1).$queryString?>' aria-label="Next">Next <i class='bx bx-chevron-right'></i></a>
												</li>
											</ul>
											<?php
	
										}
									?>
							 <!--End Pagination -->
						    </nav>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</section>
		<!--end shop area-->
	</div>
</div>
<!--end page wrapper -->
<?php
require 'includes/templates/footer.php'; 
?>