<?php
  session_start();
  $errorMsg = "";

  if(isset($_POST["add"])) {
    $string = file_get_contents("../properties/infos.json");
    $json = json_decode($string);

    $id = date("Y_m_d_h_i_s");
    array_push($json->IDs, $id);
    $generalInfo = fopen("../properties/infos.json", "w");
    fwrite($generalInfo, json_encode($json));

    $object = (object) [
        'name' => $_POST['name'],
        'city' => $_POST['city'],
        'action' => $_POST['action'],
        'bath' => $_POST['bath'],
        'bed' => $_POST['bed'],
        'price' => $_POST['price'],
        'sqm' => $_POST['sqm'],
        'address' => $_POST['address'],
        'shortdescription' => $_POST['shortdescription'],
        'longdescription' => $_POST['longdescription'],
      ];

      $dir = "../properties/".$id;
      mkdir($dir);
      mkdir($dir."/img");

      move_uploaded_file($_FILES["feature"]["tmp_name"],$dir."/img/feature.jpg") or die ("Failure to upload content");
      move_uploaded_file($_FILES["hero"]["tmp_name"],$dir."/img/hero.jpg") or die ("Failure to upload content");

      $total = count($_FILES['img']['name']);
      echo $total;
      for($x = 0; $x < $total; $x++)
      {
        move_uploaded_file($_FILES["img"]["tmp_name"][$x],$dir."/img/img".$x.".jpg") or die ("Failure to upload content");
        echo $_FILES["img"]["name"][$x];
      }



      $myfile = fopen($dir."/info.json", "w");
      fwrite($myfile, json_encode($object));

      header("Location: ./adminHome.php"); die();
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
          <input type="text" placeholder="Città" id="city" name="city"/>
          <div class="select">
                <select name="action">
                    <option value="For Sale">For Sale</option>
                    <option value="For Rent">For Rent</option>
                </select>
                <div class="select__arrow"></div>
          </div>   
          <input type="number_format" placeholder="Bagni (numero)" id="bath" name="bath"/>
          <input type="number_format" placeholder="Camere (numero)" id="bed" name="bed"/>
          <input type="number_format" placeholder="Superfice (m^2)" id="sqm" name="sqm"/>
          <input type="text" placeholder="Prezzo (€250 000)" id="price" name="price"/>
          <input type="text" placeholder="Indirizzo" id="address" name="address"/>
          <textarea name="shortdescription" form="addform" placeholder="Descrizione Corta" id="shortdescription"></textarea>
          <textarea name="longdescription" form="addform" placeholder="Descrizione Lunga" id="longdescription" style="height:150px;"></textarea>
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