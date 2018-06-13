<?php
session_start();

$t = time();
if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 900)) {
	header('location:./adminLogout.php');
} else { $_SESSION['logged'] = time();}

if (!isset($_SESSION['login'])) {
	header('LOCATION:./adminLogin.php');die();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<!-- Title  -->
	<title>South - Real Estate Agency Template | Listings</title>

	<!-- Favicon  -->
	<link rel="icon" href="../img/core-img/favicon.ico">

	<!-- Style CSS -->
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="./inputs.css">
</head>

<body>
	<!-- Preloader -->
	<div id="preloader">
		<div class="south-load"></div>
	</div>

	<!-- ##### Header Area Start ##### -->
	<header class="header-area">

	<!-- Main Header Area -->
	<div class="main-header-area" id="stickyHeader">
		<div class="classy-nav-container breakpoint-off">
			<!-- Classy Menu -->
			<nav class="classy-navbar justify-content-between" id="southNav">

				<!-- Logo -->
				<a class="nav-brand" href="index.php"><img src="img/core-img/logo.png" alt=""></a>

				<!-- Navbar Toggler -->
				<div class="classy-navbar-toggler">
					<span class="navbarToggler"><span></span><span></span><span></span></span>
				</div>

				<!-- Menu -->
				<div class="classy-menu">

					<!-- close btn -->
					<div class="classycloseIcon">
						<div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
					</div>

					<!-- Nav Start -->
					<div class="classynav">
						<ul>
							<li><a href="./adminHome.php">Home</a></li>
							<li><a href="./adminAdd.php">Aggiungi</a></li>
							<li><a href="./adminInfos.php">Informazioni</a></li>
							<li><a href="./adminSettings.php">Impostazioni</a></li>
							<li><a href="./adminLogout.php">Logout</a></li>
						</ul>

						<!-- Search Form -->
						<div class="south-search-form">
							<form action="#" method="post">
								<input type="search" name="search" id="search" placeholder="Search Anything ...">
								<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
							</form>
						</div>

						<!-- Search Button -->
					</div>
					<!-- Nav End -->
				</div>
			</nav>
		</div>
	</div>
</header>
	<!-- ##### Header Area End ##### -->

	<!-- ##### Listing Content Wrapper Area Start ##### -->
	<section class="listings-content-wrapper section-padding-100">
		<div class="container">
			<div class="row">
			<?php
//path to directory to scan
$directory = "../properties/";
$files = glob($directory . "*");

//print each file name
foreach ($files as $file) {
	//check to see if the file is a folder/directory
	if (is_dir($file)) {
		$string = file_get_contents($file . "/info.json");
		$json = json_decode($string);

		$string = file_get_contents("../properties/featured.json");
		$featured = json_decode($string);

		if (in_array(basename($file), $featured)) {
			$checked = "checked";
		} else {
			$checked = "";
		}

		echo "<!-- Single Featured Property -->
								<div class=\"col-12 col-md-6 col-xl-4\" onclick=\"propertyEdit('".basename($file)."')\">
									<div class=\"single-featured-property mb-50 wow fadeInUp\" data-wow-delay=\"100ms\">
										<!-- Property Thumbnail -->
										<div class=\"property-thumb\">
											<img src=\"" . $file . "/img/feature.jpg\" alt=\"\">

											<div class=\"tag\">
												<span>" . $json->action . "</span>
											</div>
											<div class=\"list-price\">
												<p>" . $json->price . "</p>
											</div>
										</div>
										<!-- Property Content -->
										<div class=\"property-content\">
											<h5>" . $json->name . "</h5>
											<p class=\"location\"><img src=\"../img/icons/location.png\" alt=\"\">" . $json->address . "</p>
											<label class=\"control control--checkbox\">In Evidenza<input type=\"checkbox\" " . $checked . " value=\"1\" name=\"featured\" onchange=\"changeEventHandler('" . basename($file) . "')\"/> <div class=\"control__indicator\"></div> </label>
											<button style=\"width:100%\" class=\"btn south-btn\" onclick=\"propertyRemove('" . basename($file) . "') \">Rimuovi</button>
										</div>
									</div>
								</div>";
	}
}
?>
			</div>
		</div>
	</section>
	<!-- ##### Listing Content Wrapper Area End ##### -->


	<!-- jQuery (Necessary for All JavaScript Plugins) -->
	<script src="../js/jquery/jquery-2.2.4.min.js"></script>
	<!-- Popper js -->
	<script src="../js/popper.min.js"></script>
	<!-- Bootstrap js -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Plugins js -->
	<script src="../js/plugins.js"></script>
	<script src="../js/classy-nav.min.js"></script>
	<script src="../js/jquery-ui.min.js"></script>
	<!-- Active js -->
	<script src="../js/active.js"></script>

	<script>
		function propertyRemove(id) {
			if(confirm("Sei sicuro di voler elliminare questa proprietà?"))
				window.location.href = "./adminRemove.php?id=" + id;
		}

		function propertyEdit(id) {
			window.location.href = "./adminEdit.php?id=" + id;
		}

		function changeEventHandler(event) {
			// You can use “this” to refer to the selected element.
			window.location.href = "./adminFeatured.php?id=" + event;
		}
	</script>

</body>

</html>