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
    resize_image($dir . "/img/feature.jpg", 1000, 720);

    move_uploaded_file($_FILES["hero"]["tmp_name"], $dir . "/img/hero.jpg");
    resize_image($dir . "/img/hero.jpg", 1920, 800);
	
    $total = count($_FILES['img']['name']);
    for ($x = 0; $x < $total; $x++) {
        move_uploaded_file($_FILES["img"]["tmp_name"][$x], $dir . "/img/img" . $x . ".jpg");
        resize_image($dir . "/img/img" . $x . ".jpg", 1200, 604);
	}


    $myfile = fopen($dir . "/info.json", "w");
    fwrite($myfile, json_encode($object));

    header("Location: ./adminHome.php");die();
}

function resize_image($file, $w, $h)
{
    list($width, $height) = getimagesize($file);
    $thumb = imagecreatetruecolor($w, $h);
    $source = imagecreatefromjpeg($file);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $w, $h, $width, $height);
    imagejpeg($thumb, $file);
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


    <div class="login-page" style="padding-top: 50px;">
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
							if ($categories[$x] == $json->cateogory) {
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
						for ($x = 0; $x < count($offers); $x++) {
							if ($offers[$x] == $json->offers) {
								echo "<option value='$offers[$x]' selected>$offers[$x]</option>";
							} else {
								echo "<option value='$offers[$x]'>$offers[$x]</option>";
							}
						}
					?>
                </select>
                <div class="select__arrow"></div>
          </div>-->

          <div class="select">
                <select name="action">
                  <option value="">Azione</option>
                  <?php
						for ($x = 0; $x < count($actions); $x++) {
							echo "<option value='$actions[$x]'>$actions[$x]</option>";
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
          <input type="text" placeholder="Locazione" id="address" name="address" value="<?php echo $json->address ?>"/>
          <textarea name="shortdescription" form="addform" placeholder="Descrizione Corta" id="shortdescription"><?php echo $json->shortdescription ?></textarea>
          <textarea name="longdescription" form="addform" placeholder="Descrizione Lunga" id="longdescription" style="height:150px;"><?php echo $json->longdescription ?></textarea>
          <textarea name="infos" form="addform" placeholder="Caratteristiche della proprietà separate da una virgola" id="infos" style="height:150px;"><?php
			  	for ($x = 0; $x < count($json->infos) - 1; $x++) {
			  		echo $json->infos[$x].",";
				  }
				echo $json->infos[$x];
			  ?></textarea>
          Cambia Feature:
          <input type="file" name="feature" id="feature"/>
          Cambia Hero:
          <input type="file" name="hero" id="hero"/>
          Cambia Immagini:
          <input type="file" placeholder="Immagini" name="img[]" id="img" multiple/>
          <button type="submit" name="add">MODIFICA</button>
        </form>



      </div>
    </div>

</body>

</html>