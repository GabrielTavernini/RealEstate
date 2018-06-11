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

if (isset($_POST["add"])) {
    /*$string = file_get_contents("../properties/infos.json");
    $json = json_decode($string);

    array_push($json->IDs, $id);
    $generalInfo = fopen("../properties/infos.json", "w");
    fwrite($generalInfo, json_encode($json));*/

    $id = date("Y_m_d_h_i_s");
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
    mkdir($dir);
    mkdir($dir . "/img");

    move_uploaded_file($_FILES["feature"]["tmp_name"], $dir . "/img/feature.jpg") or die("Failure to upload content");
    resize_image($dir . "/img/feature.jpg", 1000, 720);

    move_uploaded_file($_FILES["hero"]["tmp_name"], $dir . "/img/hero.jpg") or die("Failure to upload content");
    resize_image($dir . "/img/hero.jpg", 1920, 800);

    $total = count($_FILES['img']['name']);
    for ($x = 0; $x < $total; $x++) {
        move_uploaded_file($_FILES["img"]["tmp_name"][$x], $dir . "/img/img" . $x . ".jpg") or die("Failure to upload content");
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
          <input type="text" placeholder="Titolo" id="name" name="name" />

          <div class="select">
                <select name="city">
                  <option value="">Città</option>
                  <?php
						for ($x = 0; $x < count($cities); $x++) {
							echo "<option value='$cities[$x]'>$cities[$x]</option>";
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
							echo "<option value='$categories[$x]'>$categories[$x]</option>";
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
							echo "<option value='$offers[$x]'>$offers[$x]</option>";
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
						}
					?>
                </select>
                <div class="select__arrow"></div>
          </div>
		  <input type="number_format" placeholder="Locali (numero)" id="rooms" name="rooms"/>
          <input type="number_format" placeholder="Bagni (numero)" id="bath" name="bath"/>
          <input type="number_format" placeholder="Camere (numero)" id="bed" name="bed"/>
          <input type="number_format" placeholder="Superfice (numero di m^2)" id="sqm" name="sqm"/>
          <input type="text" placeholder="Prezzo (es. 120000)" id="price" name="price"/>
          <input type="text" placeholder="Locazione" id="address" name="address"/>
          <textarea name="shortdescription" form="addform" placeholder="Descrizione Corta" id="shortdescription"></textarea>
          <textarea name="longdescription" form="addform" placeholder="Descrizione Lunga" id="longdescription" style="height:150px;"></textarea>
          <textarea name="infos" form="addform" placeholder="Caratteristiche della proprietà separate da una virgola" id="infos" style="height:150px;"></textarea>
          Upload Feature:
          <input type="file" name="feature" id="feature"/>
          Upload Hero:
          <input type="file" name="hero" id="hero"/>
          Upload Immagini:
          <input type="file" placeholder="Immagini" name="img[]" id="img" multiple/>
          <button type="submit" name="add">AGGIUNGI</button>
        </form>
      </div>
    </div>

</body>

</html>