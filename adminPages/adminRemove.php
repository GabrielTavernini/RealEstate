<?php
$myPath = "../properties/".$_GET['id'];
deleteDir($myPath);

/*$string = file_get_contents("../properties/infos.json");
$json = json_decode($string);
if (($key = array_search($_GET['id'], $json->IDs)) !== false) {
    unset($json->IDs[$key]);
}
$generalInfo = fopen("../properties/infos.json", "w");
fwrite($generalInfo, json_encode($json));*/

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
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

header("Location: ./adminHome.php"); die();
?>