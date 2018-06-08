<?php
    session_start();
    session_destroy();
    header('Location:./adminLogin.php');
    exit;
?>