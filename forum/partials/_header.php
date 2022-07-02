<?php require 'partials/_dbconnect.php'; ?>
<?php
  session_start();
  echo '<style> *{ font-family: cursive; } </style>
        <nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand">myForum</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/forum">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Top Categories
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
                    $query = "SELECT `category_id`, `category_name` FROM `categories` LIMIT 5";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'"> '.$row['category_name'].' </a></li>';
                    }
                  echo '</ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
              </ul>
              <form class="d-flex gap-2" action="search.php" method="get">
                <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success me-2" type="submit">Search</button>
              </form>
              <div class="d-flex my-2 gap-2">';
              if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                $email = $_SESSION['user_email'];
                $username = substr($email, 0, strpos($email,"@"));
                echo '<span class="my-2 fst-italic text-light">Welcome '.$username.'</span>
                <a class="btn btn-outline-success" href="partials/_logout.php">Logout</a>';
              }
              else{
                echo '<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>
              </div>';
              }
            echo '</div>
          </div>
        </nav>';
  require 'partials/_loginModal.php';
  require 'partials/_signupModal.php';
  if (isset($_GET['signupsuccess']) && $_GET['signupsuccess'] == true){
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Success! </strong>Your account has been created successfully. You may now login.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
  if (isset($_GET['falied']) && $_GET['falied'] == true){
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Error! </strong>'.$_GET['error'].'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
?>
