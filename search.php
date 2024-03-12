<?php
require 'includes/templates/header.php';

$countOfBoxesPreview = 4;
if(!isset($_GET['q']))
{
	echo "<script>window.open('index.php','_self');</script>";
	exit();
}
elseif(isset($_GET['q']))
{
	$term = $_GET['q'];
	$select = "SELECT produit.*,categorie.nom as 'catName',sous_categorie.nom as 'scatName' FROM produit
    INNER JOIN sous_categorie on sous_categorie.id = produit.id_cat
    INNER JOIN categorie ON categorie.id = sous_categorie.id_categorie WHERE produit.nom LIKE '%$term%'";
	$stmt = $cnx->prepare($select);
	$stmt->execute();
	$results = $stmt->fetchAll();
	$count = count($results);
}
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
							<h2 class="searching-for">Result Searching For :<span style="color: #008fbb;"><?php echo $term; ?></span></h2>
							<h4 class="count-result" style="margin-bottom: 20px;">count results :<span style="color: #008fbb;">(<?php echo $count; ?>)</span></h4>
							<div class="product-grid">
								<?php

								$limit = isset($_GET['page'])?"LIMIT ".(intval($_GET['page']) - 1)*$countOfBoxesPreview.",".$countOfBoxesPreview:"LIMIT $countOfBoxesPreview";

								$term = $_GET['q'];
								// $select = "SELECT produit.*,categorie.nom as 'catName' FROM produit INNER JOIN categorie ON categorie.id = produit.id_cat WHERE produit.nom LIKE '%$term%' $limit";
								$select = "SELECT produit.*,categorie.nom as 'catName',sous_categorie.nom as 'scatName' FROM produit
								INNER JOIN sous_categorie on sous_categorie.id = produit.id_cat
								INNER JOIN categorie ON categorie.id = sous_categorie.id_categorie WHERE produit.nom LIKE '%$term%' $limit";
								$stmt = $cnx->prepare($select);
								$stmt->execute();
								$results = $stmt->fetchAll();
										foreach($results as $product)
										{
											$p_id = $product['id'];
											$p_name = $product['nom'];
											$p_image = $product['image'];
											$p_catName = $product['catName'];
											$p_desc = $product['description'];
											?>
											<div class="card rounded-0 product-card">
												<div class="row g-0">
													<div class="col-md-4">
														<a href="product-details.php?p=<?php echo $p_id; ?>"><img src="assets/images/products/<?php echo $p_image; ?>" class="img-fluid" alt="..."></a>
													</div>
													<div class="col-md-8">
														<div class="card-body" style="margin: 6% auto;">
															<div class="product-info">
																<a href="product-details.php?p=<?php echo $p_id; ?>">
																	<p class="product-catergory font-13 mb-1"><?php echo $p_catName; ?></p>
																</a>
																<a href="product-details.php?p=<?php echo $p_id; ?>">
																	<h6 class="product-name mb-2"><?php echo $p_name; ?></h6>
																</a>
																<p class="card-text"><?php echo $p_desc; ?></p>
																<div class="product-action mt-2">
																	<div class="d-flex gap-2">
																		<a href="product-details.php?p=<?php echo $p_id; ?>" class="btn btn-dark btn-ecomm"> <i class="bx bxs-cart-add"></i>Voir Produit</a>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="border-top my-3"></div>
											<?php
										}
								?>
							</div>
							<hr>
							<nav class="d-flex justify-content-between" aria-label="Page navigation">
								<?php
									$count =getCount("produit","WHERE produit.nom LIKE '%$term%'");
									$res = ceil($count/$countOfBoxesPreview);
									$page = isset($_GET['page'])&&is_numeric($_GET['page'])&&intval($_GET['page'])<=$res?intval($_GET['page']):1;
									if($res>1)
									{
										?>
										<ul class="pagination">
											<li class="page-item"><a class="page-link" href='<?php if($page>1)echo "?q=$term&page=".($page-1)?>'><i class='bx bx-chevron-left'></i> Prev</a>
											</li>
										</ul>
										<ul class="pagination">
										<?php
										for($i=1;$i<=$res;$i++)
										{
										?>
									    <li class="page-item d-none d-sm-block"><a class="page-link <?php if($page == $i)echo "active"; ?>" href="?q=<?php echo $term; ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
										<?php
										}
										?>
										</ul>
										<ul class="pagination">
											<li class="page-item"><a class="page-link" href='<?php if($page<$res)echo "?q=$term&page=".($page+1)?>' aria-label="Next">Next <i class='bx bx-chevron-right'></i></a>
											</li>
										</ul>
										<?php

									}
								?>
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