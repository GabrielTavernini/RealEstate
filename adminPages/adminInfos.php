<?php
session_start();
$t = time();
if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 900)) {
    header('location:./adminLogout.php');
} else { $_SESSION['logged'] = time();}

if (!isset($_SESSION['login'])) {
    header('LOCATION:./adminLogin.php');die();
}

$errorMsg = "";
$string = file_get_contents("../infos.json");
$infos = json_decode($string);
$title = $infos->aboutus_title;
$subtitle = $infos->aboutus_subtitle;
$description = $infos->aboutus_description;
$phonenumber = $infos->phonenumber;
$email = $infos->email;
$address = $infos->address;
$days1 = $infos->days1;
$days2 = $infos->days2;
$days3 = $infos->days3;
$hours1 = $infos->hours1;
$hours2 = $infos->hours2;
$hours3 = $infos->hours3;


if (isset($_POST["add"])) {
    $object = (object) [
        'aboutus_title' => $_POST['title'],
        'aboutus_subtitle' => $_POST['subtitle'],
		'aboutus_description' => $_POST['description'],
		'hours1' => $_POST['hours1'],
		'hours2' => $_POST['hours2'],
		'hours3' => $_POST['hours3'],
		'days1' => $_POST['days1'],
		'days2' => $_POST['days2'],
		'days3' => $_POST['days3'],
		'phonenumber' => $_POST['phonenumber'],
		'email' => $_POST['email'],
		'address' => $_POST['address'],
    ];

    $generalInfo = fopen("../infos.json", "w");
    fwrite($generalInfo, json_encode($object));

    header("Location: ./adminHome.php");die();
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
    <title>Studio Immobiliare Europa | Chi Siamo</title>

    <!-- Favicon  -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Style CSS -->
	<link rel="stylesheet" href="../style.css">
	<link rel="stylesheet" href="./inputs.css">

</head>

<body>

    <!-- ##### About Content Wrapper Start ##### -->
	<div class="container" style="margin-top:20px; height:auto; margin-bottom:20px;">
		<div class="row">
			<form  form="addform" id="addform" action="" method="POST"  enctype="multipart/form-data"></form>
			<div class="col-12 col-lg-8">
				<div class="section-heading text-left wow fadeInUp" data-wow-delay="250ms">
					<input form="addform" type="text" name="title" value="<?php echo $title ?>" style="width:100%; margin-bottom:10px;"/>
					<input form="addform" type="text" name="subtitle" value="<?php echo $subtitle ?>" style="width:100%"/>
				</div>
				<div class="about-content">
					<img class="wow fadeInUp" data-wow-delay="350ms" src="../img/bg-img/about.jpg" alt="">
					<textarea form="addform" name="description" class="wow fadeInUp" data-wow-delay="450ms" style="width:100%; height:150px"><?php echo $description ?></textarea>
				</div>
			</div>

			<div class="col-12 col-lg-4">
				<div class="section-heading text-left wow fadeInUp" data-wow-delay="250ms">
					<h2>Infos</h2>
					<p>Informazioni riguardanti l'ufficio</p>
				</div>

				<!-- Office Hours -->
				<div class="weekly-office-hours" style="margin-bottom:30px;">
					<ul>
						<li class="d-flex align-items-center justify-content-between"><input form="addform" name="days1" type="text" value="<?php echo $days1 ?>"/> <input form="addform" name="hours1" type="text" style="text-align:right;" value="<?php echo $hours1 ?>"/></li>
						<li class="d-flex align-items-center justify-content-between"><input form="addform" name="days2" type="text" value="<?php echo $days2 ?>"/> <input form="addform" name="hours2" type="text" style="text-align:right;" value="<?php echo $hours2 ?>"/></li>
						<li class="d-flex align-items-center justify-content-between"><input form="addform" name="days3" type="text" value="<?php echo $days3 ?>"/> <input form="addform" name="hours3" type="text" style="text-align:right;" value="<?php echo $hours3 ?>"/></li>
					</ul>
				</div>

				<!-- Address -->
				<div class="address">
					<h6><img src="../img/icons/phone-call.png" alt=""><input form="addform" name="phonenumber" type="text" value="<?php echo $phonenumber ?>" style="margin-left:10px; width:89%;"/></h6>
					<h6><img src="../img/icons/envelope.png" alt=""><input form="addform" name="email" type="text" value="<?php echo $email ?>" style="margin-left:10px; width:89%;"/></h6>
					<h6><img src="../img/icons/location.png" alt=""><input form="addform" name="address" type="text" value="<?php echo $address ?>" style="margin-left:10px; width:89%;"/></h6>
				</div>
			</div>
		</div>
	</div>

	<button style="width:90%; margin-left: 5%; margin-right: 5%; margin-bottom: 20px;" class="btn south-btn" type="submit" id="add" name="add" form="addform">Salva</button>

	</div>

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="../js/plugins.js"></script>
    <script src="js/classy-nav.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <!-- Active js -->
    <script src="../js/active.js"></script>

</body>

</html>