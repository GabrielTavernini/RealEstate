<?php
  session_start();
  $errorMsg = "";
  $validUser = false;

  if(in_array("login", $_SESSION))
  {
    $validUser = $_SESSION["login"] === true;
  }
  if(isset($_POST["sub"])) {
    $validUser = $_POST["username"] == "admin" && $_POST["password"] == "password";
    if(!$validUser) $errorMsg = "Invalid username or password.";
    else $_SESSION["login"] = true;
  }
  if($validUser) {
    header("Location: ./adminHome.php"); die();
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css" type="text/css">
  </head>

  <body>
    <div class="login-page">
      <div class="form">
        <form class="login-form"  name="input" action="" method="post">
          <input type="text" placeholder="Username" id="username" name="username" />
          <input type="password" placeholder="Password" value="" id="password" name="password"/>
          <div class="error"><?= $errorMsg ?></div>
          <button type="submit" name="sub">LOGIN</button>
        </form>
      </div>
    </div>
  </body>
</html>