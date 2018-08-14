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
$actions = $dictionary->actions;

if (isset($_POST["add"])) {
    $object = (object) [
        'cities' => explode(',', $_POST['cities']),
        'categories' => explode(',', $_POST['categories']),
        'actions' => explode(',', $_POST['actions']),
	];

    $generalInfo = fopen("../properties/dictionary.json", "w");
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
			<textarea name="cities" form="addform" placeholder="Città separate da una virgola" id="cities" style="height:150px;"><?php
			  	for ($x = 0; $x < count($cities) - 1; $x++) {
			  		echo $cities[$x].",";
				  }
				echo $cities[$x]; ?></textarea>

          	<textarea name="categories" form="addform" placeholder="Categorie delle proprietà separate da una virgola" id="categories" style="height:150px;"><?php
			  	for ($x = 0; $x < count($categories) - 1; $x++) {
			  		echo $categories[$x].",";
				  }
				echo $categories[$x]; ?></textarea>

		  	<textarea name="actions" form="addform" placeholder="Azioni delle proprietà separate da una virgola" id="actions" style="height:150px;"><?php
			  	for ($x = 0; $x < count($actions) - 1; $x++) {
			  		echo $actions[$x].",";
				  }
				echo $actions[$x]; ?></textarea>

			<button type="submit" name="add">SALVA</button>
        </form>
      </div>
    </div>

</body>

</html>