<?php
  $showAlert = "";
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
        header("Location: /forum");
        exit();
      }
      else{ $showAlert = "Invaild Credentials!!!"; }
    }
  }
  header("Location: /forum/index.php?falied=true&error=$showAlert");
?>
