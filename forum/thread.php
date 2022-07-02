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
      $id = $_GET['threadid'];
      $query = "SELECT * FROM `threads` WHERE `thread_id`=$id";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_user_id = $row['thread_user_id'];
        $query2 = "SELECT `user_email` FROM `users` WHERE `sno`='$thread_user_id'";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);
      }
    ?>

    <?php
      if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $comment = $_POST['comment'];
        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment);
        $sno = $_SESSION['sno'];
        $query = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', CURRENT_TIMESTAMP)";
        $result = mysqli_query($conn, $query);
        if ($result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Success!</strong> Your comment has been posted successfully. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
      }
    ?>

    <div class="container my-4">
      <div class="alert alert-success" role="alert">
        <h1 class="alert-heading"><?php echo $title; ?></h1>
        <p><?php echo $desc; ?></p>
        <hr>
        <p class="mb-0">This is a diccussion forum. No Spamming / Advertising / Self-promote in the forum. Don't post copyright-infringing material, “offensive” posts, links or images. Don't cross post questions. Remain respectful to other members at all times.</p>
        <p><b>Posted by: <?php echo $row2['user_email']; ?></b></p>
      </div>
    </div>

    <?php
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '<div class="container">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#commentModal">Comment your response...</button>
              </div>';
      }
    ?>

    <div class="container min-vh-100 mb-5">
      <h1>Discussions</h1>
      <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
          $id = $_GET['threadid'];
          $query = "SELECT * FROM `comments` WHERE `thread_id`=$id";
          $result = mysqli_query($conn, $query);
          $noResult = true;
          while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $date = $row['comment_time'];
            $by = $row['comment_by'];
            $query2 = "SELECT `user_email` FROM `users` WHERE `sno`='$by'";
            $result2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($result2);
            echo '<div class="d-flex">
                    <div class="flex-shrink-0">
                      <img src="images/userImg.png" width="34px;" alt="...">
                    </div>
                    <div class="flex-grow-1 ms-3">
                      <div class="d-flex justify-content-between">
                        <h5><b>'.$row2['user_email'].'</b></h5> <span>'.$date.'</span>
                      </div>
                      <p>'.$content.'</p>
                    </div>
                  </div>';
          }
          if ($noResult){
            echo '<div class="container text-center w-50 rounded" style="background-color: #90EE90;">
                    <p class="display-4">No Comments found!</p>
                    <p class="lead">Be the first person to post a response.</p>
                  </div>';
          }
        }
        else {
          echo '<div class="container text-center w-50 rounded" style="background-color: #FAA0A0;">
                  <h2>You are not loggedin!</h2>
                  <small >Login to comment your response and See the comments...</small>
                </div>';
        }
      ?>
    </div>;

    <?php require 'partials/_commentModal.php'; ?>
    <?php require 'partials/_footer.php'; ?>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
