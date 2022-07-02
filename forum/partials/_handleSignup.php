<?php
  $showAlert = "";
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
          header("Location: /forum/index.php?signupsuccess=true");
          exit();
        }
        else{ $showAlert = mysqli_error($conn); }
      }
      else { $showAlert = "Passwords do not match."; }
    }
  }
  header("Location: /forum/index.php?falied=true&error=$showAlert");
?>
