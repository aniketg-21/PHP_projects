<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

  <title>My Library</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>

<body>
  <?php require 'partials/_header.php'; ?>

  <?php
  $msg = "";
  $tag = "";
  if (isset($_GET["msg"])) {
    $tag = $_GET["tag"];
    $msg = $_GET["msg"];
  }

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $user = $_SESSION['user_email'];

    if (isset($_GET["delete"])) {
      $sno = $_GET["delete"];
      $query = "DELETE FROM `books` WHERE `books`.`sno` = '$sno' AND `user`= '$user'";
      $result = mysqli_query($conn, $query);
      if (!$result) {
        echo "Deletion Falied: " . mysqli_error($conn);
      } else {
        $tag = "success";
        $msg = "Book deleted successfully";
      }
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST["snoEdit"])) {
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];
        $description = str_replace("'", "\'", $description);
        $author = $_POST["authorEdit"];
        $query = "UPDATE `books` SET `book_title` = '$title', `book_desc` = '$description', `book_author` = '$author' WHERE `books`.`sno` = '$sno' AND `user`= '$user'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
          echo "Insertion Falied: " . mysqli_error($conn);
        } else {
          $tag = "success";
          $msg = "Book updated successfully";
        }
      } else {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $description = str_replace("'", "\'", $description);
        $author = $_POST["author"];
        if (($title != "") && ($description != "") && ($author != "")) {
          $query = "INSERT INTO `books` (`user`,`book_title`, `book_desc`, `book_author`) VALUES ('$user', '$title', '$description', '$author')";
          $result = mysqli_query($conn, $query);
          if (!$result) {
            echo "Insertion Falied: " . mysqli_error($conn);
          } else {
            $tag = "success";
            $msg = "Book added successfully";
          }
        }
      }
    }
  }

  if ($tag) {
    echo '<div class="alert alert-' . $tag . ' alert-dismissible fade show" role="alert">
    <strong>' . $tag . ':</strong> ' . $msg . '.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  ?>

  <div class="container my-5" style="overflow-x:auto;">
    <h1 style="font-family: 'Timesnewroman';">My Library</h1>
    <hr>
    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      $sno = 1;
      $query = "SELECT * FROM `books` WHERE `user`= '$user'";
      $result = mysqli_query($conn, $query);
      $numRows = mysqli_num_rows($result);
      if ($numRows > 0) {
        echo '<table class="table table-striped" id="myTable">
        <thead>
          <tr style="background-color: yellowgreen; color: white;">
            <th scope="col">Sr no.</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Author</th>
            <th scope="col">Date & Time</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>
                      <th scope="row">' . $sno . '.</th>
                      <td>' . $row['book_title'] . '</td>
                      <td>' . $row['book_desc'] . '</td>
                      <td>' . $row['book_author'] . '</td>
                      <td>' . $row['sub_date'] . '</td>
                      <td><button class="btn btn-sm p-0 edit" id=' . $row['sno'] . ' data-bs-toggle="modal" data-bs-target="#editModal"><img src="images/edit.png" width="32px" height="32px"></button>
                      <button class="btn btn-sm p-0 del" id=d' . $row['sno'] . '><img src="images/delete.png" width="32px" height="32px"></button></td>
                    </tr>';
          $sno += 1;
        }
        echo '</tbody>
        </table>';
        echo '<script>
        $(document).ready( function (){
          $("#myTable").DataTable();
        });

        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((element) => {
          element.addEventListener("click", (e)=>{
            tr = e.target.parentNode.parentNode.parentNode.getElementsByTagName("td");
            title = tr[0].innerText;
            description = tr[1].innerText;
            author = tr[2].innerText;
            titleEdit.value = title;
            descriptionEdit.value = description;
            authorEdit.value = author;
            snoEdit.value = e.target.parentNode.id;
          })
        });
        deletes = document.getElementsByClassName("del");
        Array.from(deletes).forEach((element) => {
          element.addEventListener("click", (e)=>{
            sno = e.target.parentNode.id.substr(1,);
            if (confirm("Are you sure? This will be deleted permanently.")){
              window.location = `/My Library/index.php?delete=${sno}`;
            }
          })
        });
      </script>';
      } else {
        echo '<div class="fs-4 bg-primary text-light p-2 text-center fst-italic">Click on <a class="text-dark" data-bs-toggle="modal" data-bs-target="#newModal">New Record+</a> to add your first record.</div>';
      }
    } else {
      echo '<div class="fs-4 bg-warning text-light p-2 text-center fst-italic">Login to add or view records.</div>';
    }
    ?>
    <hr>
  </div>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script>
    elem = document.getElementsByClassName("alert");
    if (elem.length) {
      setTimeout(() => {
        window.location = `/My Library/`;
      }, 5000);
    }
  </script>
</body>

</html>