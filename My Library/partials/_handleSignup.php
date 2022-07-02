<?php
  $msg = "";
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    require '_dbconnect.php';
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupCpassword'];
    $exist_query = "SELECT * FROM `users` WHERE `user_email`='$user_email'";
    $result = mysqli_query($conn, $exist_query);
    $numRows = mysqli_num_rows($result);
    if ($numRows > 0){ $showAlert = "Email already exists."; }
    else {
      if ($pass == $cpass){
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $query = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', CURRENT_TIMESTAMP)";
        $result = mysqli_query($conn, $query);
        if ($result){
          $msg = "User account created successfully - $user_email";         
          header("Location: /My Library/index.php?tag=success&msg=$msg");
          exit();
        }
        else{ $msg = mysqli_error($conn); }
      }
      else { $msg = "Passwords do not match."; }
    }
  }
  header("Location: /My Library/index.php?tag=danger&msg=$msg");
?>
