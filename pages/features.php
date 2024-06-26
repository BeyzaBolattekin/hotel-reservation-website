<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://kit.fontawesome.com/b022f45a64.js" crossorigin="anonymous"></script>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Core Features</title>
  <link rel="stylesheet" href="../css/features.css" />
</head>

<body>

  <?php include_once './include/navbar.php'; ?>

  <div class="wrapper-container">
    <div class="core-container">
      <header id="features">FACILITIES</header>
      <h1>Core Features</h1>
      <div class="core-cards">
        <div class="core-card">
          <i class="fa-solid fa-bell-concierge"></i>
          <h2>Accommodation</h2>
          <p>
            Choose from a selection of luxurious rooms and suites, each
            tastefully designed to provide maximum comfort.
          </p>
        </div>
        <div class="core-card">
          <i class="fa-solid fa-utensils"></i>
          <h2>Dining Options</h2>
          <p>
            Indulge your palate at our restaurants and bars. Experience fresh
            seafood or cocktails while enjoying the sunset.
          </p>
        </div>
        <div class="core-card">
          <i class="fa-solid fa-spa"></i>
          <h2>Services</h2>
          <p>
            Relax with our services, including a fitness center, infinity
            pool, full-service massages and beauty treatments.
          </p>
        </div>
        <div class="core-card">
          <i class="fa-solid fa-handshake"></i>
          <h2>Events</h2>
          <p>
            You can a corporate conference, intimate wedding, or family
            reunion, we ensure a memorable experience for all guests.
          </p>
        </div>
        <div class="core-card">
          <i class="fa-solid fa-location-dot"></i>
          <h2>Location</h2>
          <p>
            There is direct beach access and breathtaking sea views. Easily
            accessible from the international airport.
          </p>
        </div>
        <div class="core-card">
          <i class="fa-solid fa-lock"></i>
          <h2>Safety</h2>
          <p>
            Safety is our top priority. Our hotel maintains 24/7 security
            surveillance, electronic keys, and fire safety systems.
          </p>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer">
    <img src="../images/logo.jpg" alt="" />

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