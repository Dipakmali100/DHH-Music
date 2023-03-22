<?php
include('dbconnect.php');
session_start();
// $_session['track_name']= $_GET['click_track'];
if(isset($_POST['submit'])){
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
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DHH MUSIC</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
</head>

<link rel="stylesheet" href="style.css" />

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
              <input class="form-control me-2" type="search" placeholder="Search Song Here " aria-label="Search" name="songname"/>
              <input type="submit" name="submit" value="Search" class="btn btn-outline-info">
            </form>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <div class="poster">
    <a href="https://www.youtube.com/@DipakCreator" target="_blank">
      <img src="Website Poster.png" alt="Dipak Creator" />
    </a>
  </div>

  <br />

  <div class="trendingSongs">
    <nav class="navbar">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 ms-3 fw-semibold">Trending Songs</span>
        <span><a class="navbar-text me-3 fw-semibold" href="TrendingSongList.php">Show More</a></span>
      </div>
    </nav>
  </div>
  <br />

  <div class="trendingSongsContainer">
    <div class="row row-cols-2 row-cols-md-6 g-5 ms-3 me-3">
      <?php
      $sql = "SELECT * FROM allsongs ORDER BY listeners DESC LIMIT 6";
      $result = mysqli_query($con, $sql);

      //Display data
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
          ?>
          <a href="songPage.php?track_name=<?php echo urlencode($row["track_name"]); ?>" >
            <div class="col">
              <div class="card bg-dark border-0">
                <img src="<?php echo $row["poster_link_id"]?>" class="card-img-top" alt="..." />
                <div class="card-body text-light">
                  <h5 class="card-title"><?php echo $row["track_name"]?></h5>
                  <p class="card-text"><?php echo $row["artist1"].$row["artist2"].$row["artist3"]?></p>
                </div>
              </div>
            </div>
          </a>
          <?php
        }
      } else {
        echo "0 results";
      }

      ?>
    </div>

    <div class="row row-cols-2 row-cols-md-3 g-5 ms-3 me-3">
    <?php
      $sql = "SELECT * FROM allsongs ORDER BY listeners DESC LIMIT 6";
      $result = mysqli_query($con, $sql);

      //Display data
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
          ?>
          <a href="songPage.php?track_name=<?php echo urlencode($row["track_name"]); ?>" >
            <div class="col">
              <div class="card bg-dark border-0">
                <img src="<?php echo $row["poster_link_id"]?>" class="card-img-top" alt="..." />
                <div class="card-body text-light">
                  <h5 class="card-title"><?php echo $row["track_name"]?></h5>
                  <p class="card-text"><?php echo $row["artist1"].$row["artist2"].$row["artist3"]?></p>
                </div>
              </div>
            </div>
          </a>
          <?php
        }
      } else {
        echo "0 results";
      }

      ?>
    </div>
  </div>

  <br />

  <div class="latestReleasedSongs">
    <nav class="navbar">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 ms-3 fw-semibold">Latest Songs</span>
        <span><a class="navbar-text me-3 fw-semibold" href="LatestSongs.php">Show More</a></span>
      </div>
    </nav>
  </div>
  <br />

  <div class="latestReleasedSongsContainer">
    <div class="row row-cols-2 row-cols-md-6 g-5 ms-3 me-3">
      <?php
      $sql = "SELECT * FROM songs ORDER BY id DESC LIMIT 6";
      $result = mysqli_query($con, $sql);

      //Display data
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
          ?>
          <a href="songPage.php?track_name=<?php echo urlencode($row["track_name"]); ?>" >
            <div class="col">
              <div class="card bg-dark border-0">
                <img src="<?php echo $row["poster_link_id"]?>" class="card-img-top" alt="..." />
                <div class="card-body text-light">
                  <h5 class="card-title"><?php echo $row["track_name"]?></h5>
                  <p class="card-text"><?php echo $row["artist1"].$row["artist2"].$row["artist3"]?></p>
                </div>
              </div>
            </div>
          </a>
          <?php
        }
      } else {
        echo "0 results";
      }

      ?>
    </div>

    <div class="row row-cols-2 row-cols-md-3 g-5 ms-3 me-3">
    <?php
      $sql = "SELECT * FROM songs ORDER BY id DESC LIMIT 6";
      $result = mysqli_query($con, $sql);

      //Display data
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
          ?>
          <a href="songPage.php?track_name=<?php echo urlencode($row["track_name"]); ?>" >
            <div class="col">
              <div class="card bg-dark border-0">
                <img src="<?php echo $row["poster_link_id"]?>" class="card-img-top" alt="..." />
                <div class="card-body text-light">
                  <h5 class="card-title"><?php echo $row["track_name"]?></h5>
                  <p class="card-text"><?php echo $row["artist1"].$row["artist2"].$row["artist3"]?></p>
                </div>
              </div>
            </div>
          </a>
          <?php
        }
      } else {
        echo "0 results";
      }

      ?>
    </div>
  </div>

  <br />
  <hr class="ms-4 me-4" />
  <div class="latestReleasedAlbums">
    <nav class="navbar">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 ms-3 fw-semibold">Latest Albums</span>
        <span><a class="navbar-text me-3 fw-semibold" href="LatestAlbums.php">Show More</a></span>
      </div>
    </nav>
  </div>
  <br />

  <div class="latestReleasedAlbumsContainer">
    <div class="row row-cols-2 row-cols-md-6 g-5 ms-3 me-3">
    <?php
      $sql = "SELECT * FROM albums ORDER BY id DESC LIMIT 6";
      $result = mysqli_query($con, $sql);

      //Display data
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
          ?>
          <a href="AlbumPage.php?album_name=<?php echo urlencode($row["album_name"]); ?>">
            <div class="col">
              <div class="card bg-dark border-0">
                <img src="<?php echo $row["poster_link"]?>" class="card-img-top" alt="..." />
                <div class="card-body text-light">
                  <h5 class="card-title"><?php echo $row["album_name"]?></h5>
                  <p class="card-text"><?php echo $row["artist"]?></p>
                </div>
              </div>
            </div>
          </a>
          <?php
        }
      } else {
        echo "0 results";
      }

      ?>
    </div>

    <div class="row row-cols-2 row-cols-md-3 g-5 ms-3 me-3">
    <?php
      $sql = "SELECT * FROM albums ORDER BY id DESC LIMIT 6";
      $result = mysqli_query($con, $sql);

      //Display data
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
          ?>
          <a href="AlbumPage.php?album_name=<?php echo urlencode($row["album_name"]); ?>">
            <div class="col">
              <div class="card bg-dark border-0">
                <img src="<?php echo $row["poster_link"]?>" class="card-img-top" alt="..." />
                <div class="card-body text-light">
                  <h5 class="card-title"><?php echo $row["album_name"]?></h5>
                  <p class="card-text"><?php echo $row["artist"]?></p>
                </div>
              </div>
            </div>
          </a>
          <?php
        }
      } else {
        echo "0 results";
      }

      ?>
    </div>
  </div>

  <br />
  <hr class="ms-4 me-4" />
  <div class="latestReleasedEP">
    <nav class="navbar">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 ms-3 fw-semibold">Latest EP's</span>
        <span><a class="navbar-text me-3 fw-semibold" href="LatestEP.php">Show More</a></span>
      </div>
    </nav>
  </div>
  <br />

  <div class="latestReleasedEPContainer">
    <div class="row row-cols-2 row-cols-md-6 g-5 ms-3 me-3">
    <?php
      $sql = "SELECT * FROM eps ORDER BY id DESC LIMIT 6";
      $result = mysqli_query($con, $sql);

      //Display data
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
          ?>
          <a href="EpPage.php?ep_name=<?php echo urlencode($row["ep_name"]); ?>">
            <div class="col">
              <div class="card bg-dark border-0">
                <img src="<?php echo $row["poster_link"]?>" class="card-img-top" alt="..." />
                <div class="card-body text-light">
                  <h5 class="card-title"><?php echo $row["ep_name"]?></h5>
                  <p class="card-text"><?php echo $row["artist"]?></p>
                </div>
              </div>
            </div>
          </a>
          <?php
        }
      } else {
        echo "0 results";
      }

      ?>
    </div>

    <div class="row row-cols-2 row-cols-md-3 g-5 ms-3 me-3">
    <?php
      $sql = "SELECT * FROM eps ORDER BY id DESC LIMIT 6";
      $result = mysqli_query($con, $sql);

      //Display data
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          // echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td><td>" . $row["column3"] . "</td></tr>";
          ?>
          <a href="EpPage.php?ep_name=<?php echo urlencode($row["ep_name"]); ?>">
            <div class="col">
              <div class="card bg-dark border-0">
                <img src="<?php echo $row["poster_link"]?>" class="card-img-top" alt="..." />
                <div class="card-body text-light">
                  <h5 class="card-title"><?php echo $row["ep_name"]?></h5>
                  <p class="card-text"><?php echo $row["artist"]?></p>
                </div>
              </div>
            </div>
          </a>
          <?php
        }
      } else {
        echo "0 results";
      }

      ?>
    </div>
  </div>

  <br>
  <br>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>