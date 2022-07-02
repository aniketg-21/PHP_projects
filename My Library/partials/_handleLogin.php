<?php
  $msg = "";
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    require '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];
    $query = "SELECT * FROM `users` WHERE `user_email`='$email'";
    $result = mysqli_query($conn, $query);
    $numRows = mysqli_num_rows($result);
    if ($numRows == 1){
      $row = mysqli_fetch_assoc($result);
      if (password_verify($pass, $row['user_pass'])){
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['sno'] = $row['sno'];
        $_SESSION['user_email'] = $email;
        $msg = "User $email logged-in successfully";
        header("Location: /My Library/index.php?tag=success&msg=$msg");
        exit();
      }
      else{ $msg = "Invaild Credentials!!!"; }
    }
  }
  header("Location: /My Library/index.php?tag=danger&msg=$msg");
?>
