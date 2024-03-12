<?php
 require 'includes/cnxpdo.php';
 require 'includes/functions/functions.php';
 $ip = getIP();
 ?>
<!doctype html>
<html lang="en" >
<!-- Mirrored from codervent.com/shopingo/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Feb 2022 17:17:54 GMT -->
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/favicon.jpg" type="image/png" />
	<!--plugins-->
	<link href="assets/plugins/OwlCarousel/css/owl.carousel.min.css" rel="stylesheet" />
	<link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	
	<!-- loader-->
	<link href="assets/css/pace.min.css" rel="stylesheet" />
	<script src="assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">
	<link href="assets/css/icons.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
	<link href="assets/css/app.css" rel="stylesheet">
	
	<title>AZULAB</title>

	<script src="assets/js/jquery.min.js"></script>
	<script src='assets/js/jquery.zoom.js'></script>
	<script>
		$(document).ready(function(){
			if(window.innerWidth>767)
			{
			  $('#zoomHover').zoom();
			}
		});
	</script>
	<script src='assets/js/sweet-alert.min.js'></script>
</head>

<body style="width: 100%;overflow-x: hidden;">

	<b class="screen-overlay"></b>
      <!-- Start top Menu-->
      <div class="top-menu">
          <div class="container">
          <div class="row">
              <div class="col-sm text-sm-left">
                <i class="fas fa-phone"></i> <span>05283-21334</span>
                <i class="fa fa-envelope" style="font-weight: 500;"></i> <span>contact@azulab.ma</span>
              </div>
              <div class="col-sm" style="text-align: right;">
                TRAVAILLONS ENSEMBLE !
                <span class="Get-contact"><a href="contact-us.php">CONTACT</a></span>
              </div>
          </div>
          </div>
      </div>
      <!-- End top Menu-->
		<!--start top header wrapper-->
		<div class="header-wrapper">
			<div class="header-content pb-3 pb-md-0">
				<div style="padding: 0 10px;">
					<div class="row align-items-center">
						<div class="col-4 col-md-auto">
							<div class="d-flex align-items-center">
								<div class="mobile-toggle-menu d-lg-none px-lg-2" data-trigger="#navbar_main"><i class='bx bx-menu'></i>
								</div>
								<div class="logo  d-lg-flex" style="margin-left: 10px;">
									<a href="index.php">
										<img src="assets/images/logo-icon.png" class="logo-icon" alt="" />
										<!-- <img src="assets/images/logo-icon.jpeg" class="logo-icon" alt="" /> -->
									</a>
								</div>
							</div>
						</div>
						<div class="col col-md order-4 search-box order-md-2">
							<div class="input-group flex-nowrap px-xl-4">
								<input type="text" id="inputSearch" class="form-control w-100" placeholder="Search for Products">
						        <a id="serachBtn" class="input-group-text cursor-pointer bg-transparent"><i class='bx bx-search'></i></a>
							</div>
						</div>
						<div class="col-4 col-md-auto order-3 d-none d-xl-flex align-items-center">
							<div class="fs-1 text-white"><i class='bx bx-headphone'></i>
							</div>
							<div class="ms-2">
								<p class="mb-0 font-13">APPELEZ-NOUS MAINTENANT</p>
								<h5 class="mb-0">05283-21334</h5>
							</div>
							<div class="col-4 col-md-auto order-2 order-md-4">
								<div class="top-cart-icons float-end">
									<nav class="navbar navbar-expand">
										<ul class="navbar-nav ms-auto">
											<li class="nav-item dropdown dropdown-large">
												<div class="dropdown-menu dropdown-menu-end">
													<div class="cart-list">
													</div>
												</div>
											</li>
										</ul>
									</nav>
								</div>
						    </div>
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
			<div class="primary-menu border-top">
				<div class="container">
					<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg">
						<div class="offcanvas-header">
							<button class="btn-close float-end"></button>
							<!-- <h5 class="py-2">Navigation</h5> -->
							<div class="logo  d-lg-flex" style="margin-left: 10px;">
									<a href="index.php">
										<img src="assets/images/logo-icon.png" class="logo-icon" alt="" />
									</a>
								</div>
						</div>
						<ul class="navbar-nav">
							<li class="nav-item active"> <a class="nav-link" href="index.php">Acceuil </a> 
							</li>
							<li class="nav-item dropdown"><a class="nav-link dropdown-toggle dropdown-toggle-nocaret" onclick="if(window.innerWidth>767) window.open('products.php','_self');" href="products.php" data-bs-toggle="dropdown">Produits  <i class='bx bx-chevron-down'></i></a>
								<ul class="dropdown-menu" style="width: 230px;">
									<?php
										global $cnx;
										$query = "SELECT * FROM categorie";
										$stmt = $cnx->prepare($query);
										$stmt->execute();
										$rows = $stmt->fetchAll();
										foreach($rows as $cat)
										{
											$idcat = $cat['id'];
											$nomcat = $cat['nom'];
											?>
											<li><a class="dropdown-item dropdown-toggle dropdown-toggle-nocaret" onclick="window.open('products.php?cat=<?php echo $idcat; ?>','_self');" href="products.php?cat=<?php echo $idcat; ?>"><?php echo $nomcat; ?>
                                            <?php
											 $count = getCount("sous_categorie","WHERE id_categorie = $idcat");
											 if($count>1)
											 {
												 ?>
												 <i class='bx bx-chevron-right float-end'></i>
												 <?php
											 }
											 ?>
											 <?php
											 ?></a>
											 <?php
											   if($count>1)
											   {
												   ?>
												 <ul class="submenu dropdown-menu">
												   <?php
												   $sousCats = get_From("*","sous_categorie","WHERE id_categorie = $idcat");
												   foreach($sousCats as $s_cat)
												   {
														$s_idcat = $s_cat['id'];
														$s_nomcat = $s_cat['nom'];
														?>
														<li><a class="dropdown-item" href="products.php?scat=<?php echo $s_idcat; ?>"><?php echo $s_nomcat; ?></a></li>
														<?php
												   }
												   ?>
												  </ul>
												   <?php
											   }
											 ?>
											 </li>
											<?php
										}
									 ?>
								</ul>
							</li>
							<li class="nav-item"> <a class="nav-link" href="maintenance.php">Maintenance</a> 
							</li>
							<li class="nav-item"> <a class="nav-link" href="about-us.php">Â propos de nous</a> 
							</li>
							<li class="nav-item"> <a class="nav-link" href="contact-us.php">Contact</a> 
							</li>
							<li class="nav-item item-demande" style="position: relative;right: -28%;"><a href="devis.php" class="btn btn-info" style="background: #008fbb;color: #FFFF;border:none;">Demande un Devis</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
		<!--end top header wrapper-->