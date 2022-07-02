<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "notes";
$operation = false;
$myText = "";
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
  echo "Connection Falied: " . mysqli_connect_error();
}

if (isset($_GET["delete"])) {
  $sno = $_GET["delete"];
  $query = "DELETE FROM `notes` WHERE `notes`.`sno` = $sno;
      ALTER TABLE `notes` auto_increment = 3;";
  mysqli_multi_query($conn, $query);
  do {
    if ($result = mysqli_store_result($conn)) {
      while ($row = mysqli_fetch_row($result)) {
        printf("%s\n", $row[0]);
      }
      if (!$result) {
        echo "Deletion Falied: " . mysqli_error($conn);
      }
    }
  } while (mysqli_next_result($conn));
  header("Location: /notes_app");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST["snoEdit"])) {
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];
    $description = str_replace("<", "&lt;", $description);
    $description = str_replace(">", "&gt;", $description);
    if (($title != "") && ($description != "")) {
      $query = "UPDATE `notes` SET `title` = '$title', `description` = '$description', `tstamp` = CURRENT_TIMESTAMP WHERE `notes`.`sno` = '$sno'";
      $result = mysqli_query($conn, $query);
      if (!$result) {
        echo "Updation Falied: " . mysqli_error($conn);
      }
    }
  } else if (isset($_POST["title"])) {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $description = str_replace("<", "&lt;", $description);
    $description = str_replace(">", "&gt;", $description);
    if (($title != "") && ($description != "")) {
      $query = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
      $result = mysqli_query($conn, $query);
      if (!$result) {
        echo "Insertion Falied: " . mysqli_error($conn);
      }
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>StickyNotes</title>
  <style>
    .navbar {
      font-size: 18px;
      font-family: cursive;
    }

    .row {
      width: 150px;
    }

    .card {
      height: 85vh;
    }

    .card input,
    .card .desc {
      outline-color: transparent;
    }

    .card .desc {
      height: inherit;
    }
  </style>
</head>

<body class="d-flex">
  <nav class="navbar navbar-dark bg-dark vh-100 align-items-start">
    <div class="container-fluid flex-column justify-content-start gap-2">
      <a class="navbar-brand border-bottom m-2 fs-4" style="color: yellow;" href="/notes_app">StickyNotes</a>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link text-light py-1 active" aria-current="page" href="/notes_app">🏠 Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light border-bottom mb-2 py-1 pb-2" data-bs-toggle="modal" data-bs-target="#newModal">📝 New Note+ </a>
        </li>
        <ul class="row g-2 list-unstyled">
          <?php getTitles($conn); ?>
        </ul>
      </ul>
    </div>
  </nav>

  <div class="modal fade" id="newModal" tabindex="-1" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newModalLabel">New Note+</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-2">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-2">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="modal-footer pb-0">
              <button type="submit" class="btn btn-primary">Add Note</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="d-flex">
      <button onclick="toggleNav()" class="btn btn-dark m-2 ms-0 mb-0 d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-list" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
        </svg>
      </button>
      <h1 style="font-family: 'Timesnewroman';" class="m-0 mt-2">Notes</h1>
    </div>
    <hr>
    <div class="card"><?php getNote($conn, -1); ?></div>
  </div>
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    let myform = document.querySelector('form');
    myform.addEventListener("submit", (e) => {
      e.preventDefault();
      let formData = new FormData();
      formData.append(myform[0].name, myform[0].value);
      formData.append(myform[1].name, myform[1].value);
      fetch('/notes_app/index.php', {
        method: "POST",
        body: formData,
      });
      document.getElementsByClassName("btn-close")[0].click();
      window.location = `/notes_app/index.php`;
    })

    function handleChange(elem) {
      let Id = elem.id.substr(2, );
      let eTitle = document.getElementById('et' + Id).value;
      let eDesc = document.getElementById('ed' + Id).innerText;
      elem.type === 'text' ? eTitle = elem.value : eDesc = elem.innerText;
      document.getElementById(Id).innerText = eTitle;
      let formData = new FormData();
      formData.append("snoEdit", Id);
      formData.append("titleEdit", eTitle);
      formData.append("descriptionEdit", eDesc);
      fetch('/notes_app/index.php', {
        method: "POST",
        body: formData,
      });
    }


    function delNote(elem) {
      sno = elem.id.substr(1, );
      if (confirm("Do you want to delete this note?")) {
        window.location = `/notes_app/index.php?delete=${sno}`;
      }
    }

    let nav = document.getElementsByClassName("navbar")[0].classList;

    function toggleNav() {
      let con = document.getElementsByClassName("container")[0].classList;
      nav.contains("collapse") ?
        (nav.remove("collapse"), con.add("overflow-hidden")) :
        (nav.add("collapse"), con.remove("overflow-hidden"));
    }
    window.innerWidth < 475 ? nav.add("collapse") : nav.remove("collapse");
  </script>
</body>

</html>
<?php
function getNote($conn, $id)
{
  if ($id === -1) {
    $query = "SELECT * FROM `notes` ORDER BY `tstamp` DESC LIMIT 1";
  } else {
    $query = "SELECT * FROM `notes` WHERE `sno`=$id;";
  }
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $row['description'] = str_replace("&lt;", "<", $row['description']);
    $row['description'] = str_replace("&gt;", ">", $row['description']);
    echo '<script>document.getElementsByClassName("card")[0].innerHTML = 
          `<div class="card-header d-flex align-items-center gap-3">
              <input type="text" class="fw-bold fs-5 border-0 col-10 bg-light" id="et' . $row["sno"] . '" maxlength="42" contenteditable value="' . $row["title"] . '" onchange="handleChange(this)">
              <button class="btn btn-sm p-0 col del" id="d' . $row["sno"] . '" onclick="delNote(this)"><img src="images/delete.png" width="26px" height="26px"></button>
            </div>
            <div class="m-3 desc" id="ed' . $row["sno"] . '" contenteditable oninput="handleChange(this)">' . $row['description'] . '</div>               
            <h6 class="text-muted m-2">' . $row['tstamp'] . '</h6>`
          </script>';
  }
}

function getTitles($conn)
{
  $query = "SELECT `sno`, `title` FROM `notes` ORDER BY `tstamp` DESC";
  $result = mysqli_query($conn, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<li class="col fs-5">
            <a class="text-decoration-none badge rounded-pill bg-primary" id="' . $row["sno"] . '" href="?' . $row["sno"] . '">' . $row["title"] . '</a>
          </li>';
  }
}

if (array_key_first($_GET)) {
  getNote($conn, array_key_first($_GET));
}
?>