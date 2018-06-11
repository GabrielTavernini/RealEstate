<?php
session_start();
$t = time();
if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 900)) {
    header('location:./adminLogout.php');
} else { $_SESSION['logged'] = time();}

if (!isset($_SESSION['login'])) {
    header('LOCATION:./adminLogin.php');die();
}

$string = file_get_contents("../properties/featured.json");
$json = json_decode($string, true);

if (in_array($_GET['id'], $json)) {
    foreach ($json as $value) {
        if ($value == $_GET['id']) {
            $index = array_search($value, $json);
            array_splice($json, $index, $index + 1);
        }
    }
} else {array_push($json, $_GET['id']);}

$generalInfo = fopen("../properties/featured.json", "w");
fwrite($generalInfo, json_encode($json));

header("Location: ./adminHome.php");die();
