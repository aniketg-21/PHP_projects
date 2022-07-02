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

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/slide1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="images/slide2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="images/slide3.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <div class="container text-center min-vh-100 my-2">
      <h1>myForum - Categories</h1>
      <div class="row">
        <?php
          $query = "SELECT * FROM `categories`";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['category_id'];
            $name = $row['category_name'];
            $desc = $row['category_description'];
            echo '<div class="col-md-4">
                    <div class="card my-2" style="width: 18rem;">
                      <img src="https://source.unsplash.com/500x400/?'.$name.',coding" class="card-img-top" alt="...">
                      <div class="card-body" style="background-color: yellowgreen;">
                        <h5 class="card-title"><a href="threadlist.php?catid='.$id.'" class="text-decoration-none">'.$name.'</a></h5>
                        <p class="card-text">'.substr($desc, 0, 90).'... </p>
                        <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
                      </div>
                    </div>
                  </div>';
          }
        ?>
      </div>
    </div>

    <?php require 'partials/_footer.php'; ?>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
