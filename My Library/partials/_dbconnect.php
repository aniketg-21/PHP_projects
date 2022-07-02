<?php
  $server = "localhost";
  $username = "root";
  $password = "";
  $database = "mylibrary";  
  $conn = mysqli_connect($server, $username, $password, $database);
  if (!$conn){
    echo "Connection Falied: " . mysqli_connect_error();
  }
?>
