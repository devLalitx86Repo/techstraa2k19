<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="main.css">
  <script src="main.js"></script>
</head>
<body>
  <h1>SESSION CHECKER</h1>
<?php

     echo '<br>$_SESSION["std_name"] = ' . $_SESSION['std_name'];

     session_unset();
     session_destroy();

     echo '<br>$_SESSION["std_name"] = ' . $_SESSION['std_name'];


?>
</body>
</html>