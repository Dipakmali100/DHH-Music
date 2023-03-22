<?php
include('dbconnect.php');
session_start();
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
    <title>About DHH MUSIC</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="AboutUs.css">
  </head>

  <body>
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

    <br>
    <div class="container my-5 ">
      <h1 class="text-center fw-bold">Welcome to DHH MUSIC</h1>
      <hr>
      
      <div class="logo text-center">
          <a href="https://www.youtube.com/@DipakCreator" target="_blank"><img src="DC Music Logo.png" alt="DHH MUSIC Logo" class="img-fluid w-25" /></a>
      </div>
      <div class="content text-center">
        <p>
          Destination for the latest Desi Hip-Hop music in immersive 8D + Reverb, 8D + Bass Boosted, and Slowed + Reverb versions. We strive to provide our listeners with an unparalleled listening experience that transports them into the heart of the music they love.
        </p>
        <p>
          At DHH MUSIC, we understand that music is more than just a collection of sounds; it's an expression of emotion, culture, and identity. Our passion for music fuels our commitment to delivering the best quality audio for our listeners. Our team consists of experienced professionals who are dedicated to producing top-notch content that exceeds your expectations.
        </p>
        <p>
          In addition to our website, we also have a YouTube channel under the name "Dipak Creator." You can access our channel by clicking on the logo at the top of the page. On our channel, you can find our latest content, and much more.
        </p>
        <p>
          We take pride in our work, and we hope that our dedication and commitment to delivering high-quality music will keep you coming back to DHH MUSIC for more. Thank you for choosing us as your go-to Home page for the latest Desi Hip-Hop music.
        </p>
        <p>
          If you have any questions, comments, or suggestions, please do not hesitate to contact us. We would love to hear from you!
        </p>
        <br>
        <br>
      </div>
      <hr>
      <h2 class="text-center fw-bold">Disclaimer</h2>
      <hr>
      <div class="content text-center">
        <p>
          DHH MUSIC is an online platform that provides different versions of the latest Desi Hip-Hop music in immersive 8D + Reverb, 8D + Bass Boosted, and Slowed + Reverb versions. We do not claim ownership of any original music or content featured on our website or YouTube channel, and we are not associated with any record label, artist, or music producer.
        </p>
        <p>
          Our team of professionals creates unique versions of latest Desi Hip-Hop songs solely for the purpose of providing our listeners with an immersive listening experience. We do not intend to infringe upon any copyright laws or intellectual property rights.
        </p>
        <p>
          We take copyright infringement very seriously and aim to comply with all applicable copyright laws and regulations. If you are a copyright owner and believe that your original work has been used on our platform in a way that constitutes copyright infringement, please contact us immediately, and we will take the necessary steps to remove the content promptly.
        </p>
        <p>
          DHH MUSIC respects the original artist's creative talent and encourages our listeners to support the original artists by listening their music through official channels.
        </p>
        <p>
          Thank you for choosing DHH MUSIC as your go-to source for immersive music experiences.
        </p>
      </div>
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
