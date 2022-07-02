<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>myForum</title>
  </head>
  <body>
    <?php require 'partials/_header.php'; ?>
    <?php
      $id = $_GET['catid'];
      $query = "SELECT * FROM `categories` WHERE `category_id`=$id";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['category_name'];
        $desc = $row['category_description'];
      }
    ?>

    <?php
      if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $th_title = $_POST['title'];
        $thread_desc = $_POST['desc'];
        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);
        $thread_desc = str_replace("<", "&lt;", $thread_desc);
        $thread_desc = str_replace(">", "&gt;", $thread_desc);
        $sno = $_SESSION['sno'];
        $query = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$thread_desc', '$id', '$sno', CURRENT_TIMESTAMP)";
        $result = mysqli_query($conn, $query);
        if ($result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your thread has been added successfully. Please wait for the community to respond. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
      }
    ?>

    <div class="container text-center my-4">
      <div class="alert alert-success" role="alert">
        <h1 class="alert-heading">Welcome to <?php echo $name; ?> forum.</h1>
        <p><?php echo $desc; ?></p>
        <hr>
        <p class="mb-0">This is a diccussion forum. No Spamming / Advertising / Self-promote in the forum. Don't post copyright-infringing material, “offensive” posts, links or images. Don't cross post questions. Remain respectful to other members at all times. <a class="text-decoration-none" href="">Learn more</a></p>
      </div>
    </div>

    <?php
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '<div class="container">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#quesModal">State your problem...</button>
              </div>';
      }
      else {
        echo '<div class="container text-center w-50 rounded" style="background-color: #FAA0A0;">
                <h2>You are not loggedin!</h2>
                <small >Login to ask your question...</small>
              </div>';
      }
    ?>

    <div class="container my-2 mb-5 min-vh-100">
      <h1>Questions</h1>
      <?php
        $id = $_GET['catid'];
        $query = "SELECT * FROM `threads` WHERE `thread_cat_id`=$id";
        $result = mysqli_query($conn, $query);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
          $noResult = false;
          $th_id = $row['thread_id'];
          $title = $row['thread_title'];
          $th_desc = $row['thread_desc'];
          $thread_time = $row['timestamp'];
          $thread_user_id = $row['thread_user_id'];
          $query2 = "SELECT `user_email` FROM `users` WHERE `sno`='$thread_user_id'";
          $result2 = mysqli_query($conn, $query2);
          $row2 = mysqli_fetch_assoc($result2);
          echo '<div class="d-flex">
                  <div class="flex-shrink-0">
                    <img src="images/userImg.png" width="34px;" alt="...">
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <div class="d-flex justify-content-between">
                      <h5><a href="thread.php?threadid='.$th_id.'" class="text-decoration-none">'.$title.'</a> by '.$row2['user_email'].'</h5>
                      <span>'.$thread_time.'</span>
                    </div>
                    '.$th_desc.'
                  </div>
                </div>';
        }
        if ($noResult){
          echo '<div class="container text-center w-50 rounded" style="background-color: #90EE90;">
                  <p class="display-4">No threads found!</p>
                  <p class="lead">Be the first person to ask a question.</p>
                </div>';
        }
      ?>

    </div>

    <?php require 'partials/_quesModal.php'; ?>
    <?php require 'partials/_footer.php'; ?>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
