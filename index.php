<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="./css/style.css" />
  <style>
    .welcome-text {
      font-size: 20px;
      font-weight: bold;
      color: #000;
    }
  </style>
</head>

<body>
  <nav class="navbar">
    <img src="./images/logo.jpg" alt="logo" id="logo" />
    <ul class="nav-items">
      <li><a href="./index.php">Home</a></li>
      <li><a href="./pages/about.php">About</a></li>
      <li><a href="./pages/features.php">Facilities</a></li>
      <li><a href="./pages/rooms.php">Rooms</a></li>

      <?php if (isset($_SESSION['user_id'])) : ?>


        <a href="./pages/user_reservation.php" class="welcome-text"><?php echo htmlspecialchars($_SESSION['firstname']); ?></a>

        <a href="./pages/logout.php">Logout</a>
      <?php else : ?>
        <li><a href="./pages/signUp.php">Register</a></li>
        <li><a href="./pages/login.php">Login</a></li>
      <?php endif; ?>

    </ul>
  </nav>

  <div class="home-container">
    <div class="home-text-container">
      <p>The Perfect Location For You</p>
      <h1>GOLDEN SMILE HOTEL</h1>
    </div>
  </div>
  <footer class="footer">
    <img src="./images/logo.jpg" alt="" />

    <div class="footerContactUs">
      <h3 class="footerItem">Contact us!</h3>
      <div class="footerPhone footerItem">
        <i class="fa-solid fa-square-phone"></i>
        <p>0312 557 55 54</p>
      </div>
    </div>
    <div>
      <div class="footerEmail footerItem">
        <i class="fa-solid fa-square-envelope"></i>
        <p>abcd@gmail.com</p>
      </div>
      <div class="footerAddress footerItem">
        <i class="fa-solid fa-location-dot"></i>
        <p>1st street NYC</p>
      </div>
    </div>
    <div id="footerSocials ">
      <h3 class="footerItem">Socials</h3>
      <div class="footerInstagram footerItem">
        <i class="fa-brands fa-square-instagram"></i>
        <p>Golden Smile Hotel</p>
      </div>
    </div>
    <div>
      <div class="footerFacebook footerItem">
        <i class="fa-brands fa-square-facebook"></i>
        <p>Golden Smile Hotel</p>
      </div>
      <div class="footerLinkedin footerItem">
        <i class="fa-brands fa-linkedin"></i>
        <p>Golden Smile Hotel</p>
      </div>
    </div>
  </footer>
</body>
<script src="https://kit.fontawesome.com/b022f45a64.js" crossorigin="anonymous"></script>

</html>