<?php
    $string = file_get_contents("../properties/featured.json");
    $json = json_decode($string, TRUE);

    if(in_array($_GET['id'], $json)) {
        foreach ($json as $value) {
            if ($value == $_GET['id'])
            {
                $index = array_search($value, $json);
                array_splice($json, $index, $index + 1);
            }  
        }
    }
    else { array_push($json , $_GET['id']); }
    

    $generalInfo = fopen("../properties/featured.json", "w");
    fwrite($generalInfo, json_encode($json));

    header("Location: ./adminHome.php"); die();
?>