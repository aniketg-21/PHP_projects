<?php require '_dbconnect.php'; ?>
<style>
  .navbar{  font-size: 18px; font-family: cursive; }
</style>
<?php
  session_start();
  echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container-fluid">
            <a class="navbar-brand" href="/My Library/">My Library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/My Library/">Home</a>
                </li>';
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                echo '<li class="nav-item">
                  <a class="nav-link" data-bs-toggle="modal" data-bs-target="#newModal"> New Record+ </a>
                </li>';
                }
              echo '</ul>
              <div class="d-flex gap-2">';
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                  $email = $_SESSION['user_email'];
                  $username = substr($email, 0, strpos($email,"@"));
                  echo '<span class="mt-1 fst-italic text-light">Welcome '.$username.'</span>
                  <a class="btn btn-outline-danger" href="partials/_logout.php">Logout</a>';
                }
                else{
                  echo '<button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                  <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">SignUp</button>
                </div>';
                }
              echo '</div>
            </div>
          </div>
        </nav>';
  require '_newRecordModal.php';
  require '_editModal.php';
  require '_loginModal.php';
  require '_signupModal.php';
?>
