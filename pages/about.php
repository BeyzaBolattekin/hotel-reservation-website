<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/about.css" />
  <title>About</title>
</head>

<body>
  <section class="about" id="about">

    <?php include_once './include/navbar.php'; ?>

    <div class="section__container about__container">
      <div class="about__grid">
        <div class="about__image">
          <img src="../images/about-01.jpg" alt="about" />
        </div>
        <div class="about__card">
          <span><i class="ri-user-line"></i></span>
          <h4>Strong Team</h4>
          <p>
            Unlocking Hospitality Excellence And Ensures Your Perfect Stay
          </p>
        </div>
        <div class="about__image">
          <img src="../images/about-02.jpg" alt="about" />
        </div>
        <div class="about__card">
          <span><i class="ri-calendar-check-line"></i></span>
          <h4>Luxury Room</h4>
          <p>Experience Unrivaled Luxury at Our Exquisite Luxury Rooms</p>
        </div>
      </div>
      <div class="about__content">
        <p class="section__subheader">ABOUT US</p>
        <h2 class="section__header">Discover Our Underground</h2>
        <p class="section__description">
          Welcome to a hidden realm of extraordinary accommodations where
          luxury, comfort, and adventure converge. Our underground hotels
          offer an unparalleled escape from the ordinary, inviting you to
          explore a subterranean world of wonders.
        </p>
      </div>
    </div>
  </section>
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
<script src="https://unpkg.com/scrollreveal"></script>
<script src="../main.js"></script>

</html>