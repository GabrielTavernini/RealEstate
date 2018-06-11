<?php
session_start();
$t = time();
if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 900)) {
    header('location:./adminLogout.php');
} else { $_SESSION['logged'] = time();}

if (!isset($_SESSION['login'])) {
    header('LOCATION:./adminLogin.php');die();
}

//Delete Folder
$myPath = "../properties/" . $_GET['id'];
deleteDir($myPath);

//Remove From Featured
$string = file_get_contents("../properties/featured.json");
$json = json_decode($string, true);
if (in_array($_GET['id'], $json)) {
    foreach ($json as $value) {
        if ($value == $_GET['id']) {
            $index = array_search($value, $json);
            array_splice($json, $index, $index + 1);
        }
    }
}

$generalInfo = fopen("../properties/featured.json", "w");
fwrite($generalInfo, json_encode($json));

//Delete Directory Recursive Function
function deleteDir($dirPath)
{
    if (!is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

//header("Location: ./adminHome.php"); die();
