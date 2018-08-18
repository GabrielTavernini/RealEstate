<?php
	error_reporting(0);
	$string = file_get_contents("./infos.json");
	$infos = json_decode($string);
	$phonenumber = $infos->phonenumber;
	$email = $infos->email;

	if(isset($_POST['submit'])){
		if(mail('1707gabri@gmail.com', $_POST['realtor-name'], $_POST['realtor-message'], 'From:'.$_POST['realtor-name'].'<'.$_POST['realtor-email'].' ; '.$_POST['realtor-number'].'>')){
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
    <title>Studio Immobiliare Europa | Dettagli Proprietà</title>

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
    <?php
        echo "<section class=\"breadcumb-area bg-img\" style=\"background-image: url(./properties/".$_GET['id']."/img/hero.jpg);\">
                <div class=\"container h-100\">
                    <div class=\"row h-100 align-items-center\">
                        <div class=\"col-12\">
                            <div class=\"breadcumb-content\">
                                <h3 class=\"breadcumb-title\">Proprietà</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>";
    ?>
    <!-- ##### Breadcumb Area End ##### -->

    <!-- ##### Listings Content Area Start ##### -->
    <section class="listings-content-wrapper section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Single Listings Slides -->
                    <div class="single-listings-sliders owl-carousel">
                        <?php 
                            $directory = "./properties/".$_GET['id']."/img/";
                            $files = glob($directory . "*");
                            
                            $string = file_get_contents("./properties/".$_GET['id']."/info.json");
                            $json = json_decode($string);

                            //print each file
                            for($x = 0; $x < sizeof($files) - 2; $x++)
                            {
                                echo "<img src=".$directory."img".$x.".jpg>";
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="listings-content">
                        <!-- Price -->
                        <div class="list-price">
                            <p>
                                <?php 
                                    setlocale(LC_MONETARY, 'it_IT');
                                    echo(str_replace('EUR', '€', money_format('%.0n', $json->price))); 
                                ?>
                            </p>
                        </div>
                        <h5><?php echo $json->name ?></h5>
                        <p class="location"><img src="img/icons/location.png" alt=""><?php echo $json->address ?></p>
                        <p><?php echo $json->longdescription ?></p>
                        <!-- Meta -->
                        <div class="property-meta-data d-flex align-items-end">
                            <div class="new-tag">
                                <img src="img/icons/new.png" alt="">
                            </div>
                            <div class="bathroom">
                                <img src="img/icons/bathtub.png" alt="">
                                <span><?php echo $json->bath ?></span>
                            </div>
                            <div class="garage">
                                <img src="img/icons/bed.png" alt="">
                                <span><?php echo $json->bed ?></span>
                            </div>
                            <div class="space">
                                <img src="img/icons/space.png" alt="">
                                <span><?php echo $json->sqm ?> m<SUP>2</SUP></span>
                            </div>
                        </div>
                        <!-- Core Features -->
                        <ul class="listings-core-features d-flex align-items-center">
                            <?php
                                $infos = $json->infos;

                                foreach($infos as $info)
                                {
                                    echo "<li><i class=\"fa fa-check\" aria-hidden=\"true\"></i> ".$info."</li>";
                                }
                            ?>
                        </ul>
                        <!-- Listings Btn Groups -->
                        <div class="listings-btn-groups">
                            <a href="#" class="btn south-btn">Scarica Planimetrie</a>
                            <a href="#" class="btn south-btn active">Do Something</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="contact-realtor-wrapper">
                        <div class="realtor-info">
                            <img src="img/bg-img/profile.jpg" alt="">
                            <div class="realtor---info">
                                <h2>Michele Fratangelo</h2>
                                <p>Realtor</p>
                                <a href="tel:<?php echo $phonenumber ?>"><h6><img src="img/icons/phone-call.png" alt=""> <?php echo $phonenumber ?></h6></a>
                                <a href="mailto:<?php echo $email ?>"><h6><img src="img/icons/envelope.png" alt=""> <?php echo $email ?></h6></a>
                            </div>
                            <div class="realtor--contact-form">
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="realtor-name" placeholder="Nome">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="realtor-number" placeholder="Numero di Telefono">
                                    </div>
                                    <div class="form-group">
                                        <input type="enumber" class="form-control" name="realtor-email" placeholder="La tua Mail">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" name="realtor-message" cols="30" rows="10" placeholder="Messaggio"></textarea>
                                    </div>
                                    <button name="submit" type="submit" class="btn south-btn">Invia Messagio</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Listing Maps
            <div class="row">
                <div class="col-12">
                    <div class="listings-maps mt-100">
                        <div id="googleMap" address="<?php //echo $json->address ?>" ></div>
                    </div>
                </div>
            </div>-->
        </div>
    </section>
    <!-- ##### Listings Content Area End ##### -->

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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeaLRptvrBwaKGujhLGFGngAPUzfbK9MA"></script>
    <script src="js/map-active.js"></script>-->

</body>

</html>