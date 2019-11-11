<?php
	error_reporting(0);
	$string = file_get_contents("./infos.json");
	$infos = json_decode($string);
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

	$to = $email;
	$subject = "WebSite - ".$_POST['contact-name'];
	$txt = "Messaggio da: ".$_POST['contact-name']." <".$_POST['contact-number']." / ".$_POST['contact-email'].">\n\n".$_POST['contact-message'];
	$headers = "From: ".$_POST['contact-email'];

	if(isset($_POST['submit'])){
		$b = mail($to, $subject, $txt, $headers);
		if($b == true){
			echo "<script>
				confirm(\"Mail Inviata!\")
			</script>";
		}
		else{
			echo "<script>
				confirm(\"Errore di Invio!\")
			</script>";
		} 
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
    <title>Studio Immobiliare Europa | Contatti</title>

    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="south-load"></div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <?php include("header.php"); ?>
    <!-- ##### Header Area End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <section class="breadcumb-area bg-img" style="background-image: url(img/bg-img/hero1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h3 class="breadcumb-title">Contatti</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcumb Area End ##### -->

    <section class="south-contact-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-heading">
                        <h6>Info Contatti</h6>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="content-sidebar">
                        <!-- Office Hours -->
                        <div class="weekly-office-hours">
                            <ul>
                                <li class="d-flex align-items-center justify-content-between"><span><?php echo $days1 ?></span> <span><?php echo $hours1 ?></span></li>
                                <li class="d-flex align-items-center justify-content-between"><span><?php echo $days2 ?></span> <span><?php echo $hours2 ?></span></li>
                                <li class="d-flex align-items-center justify-content-between"><span><?php echo $days3 ?></span> <span><?php echo $hours3 ?></span></li>
                            </ul>
                        </div>
                        <!-- Address -->
                        <div class="address mt-30">
                            <a href="tel:+39 0464 519200"><h6><img src="img/icons/phone-call.png" alt=""> <?php echo $phonenumber ?></h6></a>
                            <a href="mailto:<?php echo $email ?>"><h6><img src="img/icons/envelope.png" alt=""> <?php echo $email ?></h6></a>
                            <h6><img src="img/icons/location.png" alt=""> <?php echo $address ?></h6>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Area -->
                <div class="col-12 col-lg-8">
                    <div class="contact-form">
                        <form action="#" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="contact-name" id="contact-name" placeholder="Nome">
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control" name="contact-number" id="contact-number" placeholder="Numero di Telefono">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="contact-email" id="contact-email" placeholder="La tua Email">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="contact-message" id="contact-message" cols="30" rows="10" placeholder="Messaggio"></textarea>
                            </div>
                            <button name="submit" type="submit" class="btn south-btn">Invia</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Maps 
    <div class="map-area mb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="googleMap" address="<?php echo $address ?>" class="googleMap"></div>
                </div>
            </div>
        </div>
    </div>-->

    <!-- ##### Footer Area Start ##### -->
    <?php include("footer.php"); ?>
    <!-- ##### Footer Area End ##### -->

    <!-- jQuery (Necessary for All JavaScript Plugins) -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <script src="js/classy-nav.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
    <!-- Google Maps
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKsSYPfag-HqXCczeOIb8uRfuVTAtJ6f8"></script>
    <script src="js/map-active.js"></script> -->

</body>

</html>
