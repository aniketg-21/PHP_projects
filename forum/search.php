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

    <div class="container min-vh-100 my-2">
      <h1 class="text-center">Search results for <em>"<?php echo $_GET['search']; ?>"</em></h1>
      <?php
        $search = $_GET['search'];
        $query = "SELECT * FROM `threads` WHERE MATCH (`thread_title`, `thread_desc`) against ('$search')";
        $result = mysqli_query($conn, $query);
        $noResults = mysqli_num_rows($result);
        $no=1;
        while ($row = mysqli_fetch_assoc($result)) {
          $title = $row['thread_title'];
          $desc = $row['thread_desc'];
          $thread_id = $row['thread_id'];
          $url = "thread.php?threadid=".$thread_id;
          echo '<div class="result">
                  <h3>'.$no.'. <a href="'.$url.'">'.$title.'</a></h3>
                  <p>'.$desc.'</p>
                </div>';
          $no++;
        }
        if ($noResults == 0){
          echo '<div class="container w-50 rounded my-5 p-2" style="background-color: #90EE90;">
                  <p class="display-4 text-center"> No Results found! </p>
                  <p class="lead"> Your search - "'.$search.'" did not match any documents.
                  <p class="lead"> Suggestions:
                    <ul><li> Make sure that all words are spelled correctly.</li>
                    <li>Try different keywords.</li>
                    <li>Try more general keywords.</li></ul>
                  </p>
                </div>';
        }
      ?>
    </div>

    <?php require 'partials/_footer.php'; ?>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
