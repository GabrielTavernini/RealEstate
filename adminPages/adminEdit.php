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
$string = file_get_contents("../properties/dictionary.json");
$dictionary = json_decode($string);
$cities = $dictionary->cities;
$categories = $dictionary->categories;
//$offers = $dictionary->offers;
$actions = $dictionary->actions;

if (isset($_GET["id"])) {
    $file = "../properties/".$_GET['id'];
    $string = file_get_contents($file . "/info.json");
	$json = json_decode($string);
}

if (isset($_POST["add"])) {

    $id = $_POST['id'];
    $object = (object) [
        'name' => $_POST['name'],
        'city' => $_POST['city'],
        'category' => $_POST['category'],
        //'offers' => $_POST['offers'],
        'action' => $_POST['action'],
		'rooms' => $_POST['rooms'],
		'bath' => $_POST['bath'],
        'bed' => $_POST['bed'],
        'price' => $_POST['price'],
        'sqm' => $_POST['sqm'],
        'address' => $_POST['address'],
        'shortdescription' => $_POST['shortdescription'],
        'longdescription' => $_POST['longdescription'],
        'infos' => explode(',', $_POST['infos']),
    ];

    $dir = "../properties/" . $id;

    move_uploaded_file($_FILES["feature"]["tmp_name"], $dir . "/img/feature.jpg");
    resize_image_max($dir . "/img/feature.jpg", 1000, 720);

    move_uploaded_file($_FILES["hero"]["tmp_name"], $dir . "/img/hero.jpg");
    resize_image_crop($dir . "/img/hero.jpg", 1920, 800);
	
    $total = count($_FILES['img']['name']);
    for ($x = 0; $x < $total; $x++) {
        move_uploaded_file($_FILES["img"]["tmp_name"][$x], $dir . "/img/img" . $x . ".jpg");
        resize_image_max($dir . "/img/img" . $x . ".jpg" , 1200, 604);
	}

    $total = count($_FILES['plan']['name']);
    for ($x = 0; $x < $total; $x++) {
        echo $x;
        echo pathinfo($_FILES["plan"]["name"][$x])[basename];
        move_uploaded_file($_FILES["plan"]["tmp_name"][$x], $dir . "/plans/".$_FILES["plan"]["name"][$x]);
	}
	
	
    $myfile = fopen($dir . "/info.json", "w");
    fwrite($myfile, json_encode($object));

    //header("Location: ./adminHome.php");die();
}

function resize_image($file, $w, $h)
{
    list($width, $height) = getimagesize($file);
    $thumb = imagecreatetruecolor($w, $h);
    $source = imagecreatefromjpeg($file);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $w, $h, $width, $height);
    imagejpeg($thumb, $file);
}

function resize_image_max($path,$max_width,$max_height) {
	$image = imagecreatefromjpeg($path);
    $w = imagesx($image); //current width
    $h = imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    
    //try max width first...
    $ratio = $max_width / $w;
    $new_w = $max_width;
    $new_h = $h * $ratio;
    
    //if that didn't work
    if ($new_h > $max_height) {
        $ratio = $max_height / $h;
        $new_h = $max_height;
        $new_w = $w * $ratio;
    }
	
	if((($max_width - $new_w) / 2) <= 30 && (($max_height - $new_h) / 2) <= 30) {
		resize_image($path,$max_width,$max_height);
	}
	else {
		$new_image = imagecreatetruecolor ($max_width, $max_height);
		$backcolor = imagecolorallocate($new_image,242,242,242);
		imagefill($new_image,0,0,$backcolor);
		imagecopyresampled($new_image,$image, ($max_width - $new_w) / 2, ($max_height - $new_h) / 2, 0, 0, $new_w, $new_h, $w, $h);
		imagejpeg($new_image, $path);
		return $new_image;
	}
	
}

function resize_image_crop($path,$width,$height) {
	$image = imagecreatefromjpeg($path);
    $w = @imagesx($image); //current width
    $h = @imagesy($image); //current height
    if ((!$w) || (!$h)) { $GLOBALS['errors'][] = 'Image couldn\'t be resized because it wasn\'t a valid image.'; return false; }
    if (($w == $width) && ($h == $height)) { return $image; } //no resizing needed
	if((($w/$h)-($width/$height)) < 0.3 || (($w/$h)-($width/$height)) < 0.3){ resize_image($path,$width,$height); }
	
    //try max width first...
    $ratio = $width / $w;
    $new_w = $width;
    $new_h = $h * $ratio;
    
    //if that created an image smaller than what we wanted, try the other way
    if ($new_h < $height) {
        $ratio = $height / $h;
        $new_h = $height;
        $new_w = $w * $ratio;
    }
    
    $image2 = imagecreatetruecolor ($new_w, $new_h);
    imagecopyresampled($image2,$image, 0, 0, 0, 0, $new_w, $new_h, $w, $h);

    //check to see if cropping needs to happen
    if (($new_h != $height) || ($new_w != $width)) {
        $image3 = imagecreatetruecolor ($width, $height);
        if ($new_h > $height) { //crop vertically
            $extra = $new_h - $height;
            $x = 0; //source x
            $y = round($extra / 2); //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        } else {
            $extra = $new_w - $width;
            $x = round($extra / 2); //source x
            $y = 0; //source y
            imagecopyresampled($image3,$image2, 0, 0, $x, $y, $width, $height, $width, $height);
        }
		imagedestroy($image2);
		imagejpeg($image3, $path);
        return $image3;
    } else {
		imagejpeg($image2, $path);
        return $image2;
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
    <title>South - Real Estate Agency Template | Listings</title>

    <!-- Favicon  -->
    <link rel="icon" href="../img/core-img/favicon.ico">

    <!-- Style CSS -->
    <link rel="stylesheet" href="./inputs.css">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../style.css">

</head>

<body>

	<!-- ##### Header Area Start ##### -->
	<header class="header-area">

		<!-- Main Header Area -->
		<div class="main-header-area" id="stickyHeader">
			<div class="classy-nav-container breakpoint-off">
				<!-- Classy Menu -->
				<nav class="classy-navbar justify-content-between" id="southNav">

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
								<li><a href="../index.php">Home</a></li>
								<li><a href="./adminAdd.php">Aggiungi</a></li>
								<li><a href="./adminInfos.php">Informazioni</a></li>
								<li><a href="./adminSettings.php">Impostazioni</a></li>
								<li><a href="./adminLogout.php">Logout</a></li>
							</ul>

							<!-- Search Button -->
						</div>
						<!-- Nav End -->
					</div>
				</nav>
			</div>
		</div>
	</header>
	<!-- ##### Header Area End ##### -->

    <div class="login-page" style="padding-top: 110px;">
      <div class="form">
        <form class="add-form" id="addform" name="input" action="" method="post"  enctype="multipart/form-data">
          <input type="hidden" id="id" name="id" value = "<?php echo $_GET['id'] ?>"/>
          <input type="text" placeholder="Titolo" id="name" name="name" value="<?php echo $json->name ?>"/>

          <div class="select">
                <select name="city">
                  <option value="">Città</option>
                  <?php
						for ($x = 0; $x < count($cities); $x++) {
							if ($cities[$x] == $json->city) {
								echo "<option value='$cities[$x]' selected>$cities[$x]</option>";
							} else {
								echo "<option value='$cities[$x]'>$cities[$x]</option>";
							}
						}
					?>
                </select>
                <div class="select__arrow"></div>
          </div>

          <div class="select">
                <select name="category">
                  <option value="">Categoria</option>
                  <?php
						for ($x = 0; $x < count($categories); $x++) {
							if ($categories[$x] == $json->category) {
								echo "<option value='$categories[$x]' selected>$categories[$x]</option>";
							} else {
								echo "<option value='$categories[$x]'>$categories[$x]</option>";
							}
						}
					?>
                </select>
                <div class="select__arrow"></div>
          </div>

          <!--<div class="select">
                <select name="offers">
                  <option value="">Offerta</option>
                  <?php
						/*for ($x = 0; $x < count($offers); $x++) {
							if ($offers[$x] == $json->offers) {
								echo "<option value='$offers[$x]' selected>$offers[$x]</option>";
							} else {
								echo "<option value='$offers[$x]'>$offers[$x]</option>";
							}
						}*/
					?>
                </select>
                <div class="select__arrow"></div>
          </div>-->

          <div class="select">
                <select name="action">
                  <option value="">Azione</option>
                  <?php
						for ($x = 0; $x < count($actions); $x++) {
							if ($actions[$x] == $json->action) {
								echo "<option value='$actions[$x]' selected>$actions[$x]</option>";
							} else {
								echo "<option value='$actions[$x]'>$actions[$x]</option>";
							}
						}
					?>
                </select>
                <div class="select__arrow"></div>
          </div>
		  <input type="number_format" placeholder="Locali (numero)" id="rooms" name="rooms" value="<?php echo $json->rooms ?>"/>
          <input type="number_format" placeholder="Bagni (numero)" id="bath" name="bath" value="<?php echo $json->bath ?>"/>
          <input type="number_format" placeholder="Camere (numero)" id="bed" name="bed" value="<?php echo $json->bed ?>"/>
          <input type="number_format" placeholder="Superfice (numero di m^2)" id="sqm" name="sqm" value="<?php echo $json->sqm ?>"/>
          <input type="text" placeholder="Prezzo (es. 120000)" id="price" name="price" value="<?php echo $json->price ?>"/>
          <input type="text" placeholder="Posizione" id="address" name="address" value="<?php echo $json->address ?>"/>
          <textarea name="shortdescription" form="addform" placeholder="Descrizione Corta" id="shortdescription"><?php echo $json->shortdescription ?></textarea>
          <textarea name="longdescription" form="addform" placeholder="Descrizione Lunga" id="longdescription" style="height:150px;"><?php echo $json->longdescription ?></textarea>
          <textarea name="infos" form="addform" placeholder="Caratteristiche della proprietà separate da una virgola" id="infos" style="height:150px;"><?php
			  	for ($x = 0; $x < count($json->infos) - 1; $x++) {
			  		echo $json->infos[$x].",";
				  }
				echo $json->infos[$x];
			  ?></textarea>
          Cambia Copertina:
          <input type="file" name="feature" id="feature"/>
          Cambia Intestazione:
          <input type="file" name="hero" id="hero"/>
          Cambia Immagini:
          <input type="file" placeholder="Immagini" name="img[]" id="img" multiple/>
          Carica Planimetria:
          <input type="file" placeholder="Planimetrie" name="plan[]" id="plan" multiple/>
          <button type="submit" name="add">MODIFICA</button>
        </form>



      </div>
    </div>

</body>

</html>