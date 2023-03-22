<?php
include('dbconnect.php');
session_start();
if (isset($_GET["album_name"])) {
  $_SESSION["album_name"] = $_GET["album_name"];
}
if (isset($_POST['submit'])) {
  $_SESSION['songname'] = $_POST['songname'];
  header('Location: SearchList.php');
}
if (isset($_POST['esubmit'])) {
  $email = $_POST['email'];
  // header('Location: index.php');
  $sql = "SELECT * FROM subscribers WHERE email_address='$email'";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) == 0) {
    // Email address does not exist in table, add it
    $sql = "INSERT INTO subscribers (email_address) VALUES ('$email')";
    if (mysqli_query($con, $sql)) {
      ?>
      <script>
        function submitalert() {
          alert("Thank you for subscribing to DHH MUSIC");
        }
        submitalert();
      </script>
      <?php
    } else {
      echo "Something went wrong";
    }
  } else {
    // Email address already exists in table, do nothing
    ?>
    <script>
      function submitalert() {
        alert("You are already a member of DHH MUSIC");
      }
      submitalert();
    </script>
    <?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php echo $_SESSION["album_name"] ?>
  </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="latestSongs.css">
  <link rel="stylesheet" href="AlbumPage.css">
</head>

<body>
  <br />
  <br />
  <header>
    <div class="navigationBar">
      <nav class="navbar navbar-expand-lg bg-dark fixed-top">
        <div class="container-fluid ms-3">
          <a class="navbar-brand text-light fw-semibold" href="index.php">DHH MUSIC</a>
          <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-3 me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="TrendingSongList.php">Trending</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active text-light" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Categories
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="LatestSongs.php">Songs</a></li>
                  <li><a class="dropdown-item" href="LatestAlbums.php">Albums</a></li>
                  <li><a class="dropdown-item" href="LatestEP.php">EP's</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active text-light" href="ContactUs.php">Contact Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active text-light" href="AboutUs.php">About Us</a>
              </li>
            </ul>
            <form class="d-flex me-3" role="search" method="post">
              <input class="form-control me-2" type="search" placeholder="Search Song Here " aria-label="Search"
                name="songname" />
              <input type="submit" name="submit" value="Search" class="btn btn-outline-info">
            </form>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <?php
  $sql = "SELECT * FROM albums WHERE album_name = '" . $_SESSION["album_name"] . "'";
  $result = mysqli_query($con, $sql);

  //Display data
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      // echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
      ?>
      <div class="container">
        <div class="image">
          <img src="<?php echo $row["poster_link"] ?>" alt="">
        </div>
        <div class="SongDetails text-center">
          <h3>
            <?php echo $row["album_name"] . " - " . $row["artist"] ?>
          </h3>
        </div>
        <div class="songCount text-center">
          <p>
            <?php echo "(" . $row["track_no"] . " Songs)" ?>
          </p>
        </div>
      </div>
      <?php
    }
  } else {
    echo "No Information Available";
  }

  ?>


  <div class="container1 mt-2">

    <ol class="list-group">
      <li class="list-group-item d-flex justify-content-center bg-dark bg-opacity-25">
        <div class="Ctitle fw-bold text-black">ALBUM TRACKS</div>
      </li>
      <?php
      $album_name = strtolower($_SESSION["album_name"]);
      $sql = "SELECT * FROM $album_name ORDER BY id";
      $result = mysqli_query($con, $sql);

      //Display data
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
          ?>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 mt-1 mb-1 me-auto">
              <div class="fw-bold"><a
                  href="AlbumSongPage.php?track_name=<?php echo urlencode($row["track_name"]); ?>&album_name=<?php echo urlencode($album_name); ?>"
                  class="text-black text-decoration-none"><?php echo $row["track_name"] . " - " . $row["artist1"] . $row["artist2"] . $row["artist3"] . " (" . $row["version"] . ")" ?></a></div>
            </div>
          </li>
          <?php
        }
      } else {
        echo "No Songs Available";
      }

      ?>
    </ol>
  </div>


  <div class="footer bg-dark">
    <footer class="py-5" style="padding-left: 15%;">
      <div class="row w-100">
        <div class="col-6 col-md-2">
          <h5 class="fw-semibold text-light">Section</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2">
              <a href="index.php" class="nav-link text-light p-0">Home</a>
            </li>
            <li class="nav-item mb-2">
              <a href="TrendingSongList.php" class="nav-link text-light p-0">Trending</a>
            </li>
            <li class="nav-item mb-2">
              <a href="ContactUs.php" class="nav-link text-light p-0">Contact Us</a>
            </li>
            <li class="nav-item mb-2">
              <a href="AboutUs.php" class="nav-link text-light p-0">About Us</a>
            </li>
          </ul>
        </div>

        <div class="col-6 col-md-2">
          <h5 class="fw-semibold text-light">Categories</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2">
              <a href="LatestSongs.php" class="nav-link text-light p-0">Songs</a>
            </li>
            <li class="nav-item mb-2">
              <a href="LatestAlbums.php" class="nav-link text-light p-0">Albums</a>
            </li>
            <li class="nav-item mb-2">
              <a href="LatestEP.php" class="nav-link text-light p-0">EP's</a>
            </li>
          </ul>
        </div>

        <div class="col-md-5 offset-md-1 pt-3 text-light">
          <form method="post">
            <h5 class="fw-semibold">Subscribe to DHH MUSIC</h5>
            <p>For the notifications of latest songs</p>
            <div class="d-flex flex-column flex-sm-row w-100 gap-2">
              <input id="newsletter1" type="email" name="email" class="form-control" placeholder="Email address" />
              <input type="submit" name="esubmit" value="Subscribe" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </footer>
    <hr class="ms-4 me-4 text-light" />
    <div class="copyright">
      <div class="d-flex justify-content-center pt-1 fw-semibold text-light">
        <p>&copy; 2023 DHH MUSIC, Inc. All rights reserved</p>
      </div>
    </div>
  </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>