<?php
  session_start();
  session_unset();
  session_destroy();
  $msg = "Logged out successfully.";
  header("Location: /My Library/index.php?tag=success&msg=$msg");
?>
