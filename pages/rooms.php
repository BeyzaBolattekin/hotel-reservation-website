<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rooms</title>
  <link rel="stylesheet" href="../css/rooms.css" />
</head>

<body>
  <nav class="navbar">
    <img src="../images/logo.jpg" alt="logo" id="logo" />
    <ul class="nav-items">
      <li><a href="../index.php">Home</a></li>
      <li><a href="./about.php">About</a></li>
      <li><a href="./features.php">Facilities</a></li>
      <li><a href="./rooms.php">Rooms</a></li>

      <?php if (isset($_SESSION['user_id'])) : ?>
        <h1 class="welcome_text">Welcome, <?php echo htmlspecialchars($_SESSION['firstname']); ?>!</h1>
        <a href="./logout.php">Logout</a>
      <?php else : ?>
        <li><a href="./signUp.php">Register</a></li>
        <li><a href="./login.php">Login</a></li>
      <?php endif; ?>

    </ul>
  </nav>
  <div class="formContainer">
    <form class="roomForm">
      <div class="arrivalDiv inputDiv">
        <p>Arrival Date</p>
        <input type="date" />
      </div>
      <div class="departureDiv inputDiv">
        <p>Departure Date</p>
        <input type="date" />
      </div>
      <div class="guestsDiv inputDiv">
        <p>Guests</p>
        <input type="number" />
      </div>
      <div class="checkBtn">
        <button>Check Rooms</button>
      </div>
    </form>
  </div>
  <div class="roomsContainer">


    <?php
    include("../pages/con_data.php");

    $sql = "SELECT * FROM rooms";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="roomCard ' . ($row['availability'] ? '' : 'unavailable') . '">';
        echo '  <div class="roomImg">';
        echo '    <img src="' . htmlspecialchars($row['img']) . '" alt="' . htmlspecialchars($row['title']) . '">';
        echo '  </div>';
        echo '  <div class="roomInfo">';
        echo '    <h3>' . htmlspecialchars($row['title']) . '</h3>';
        echo '    <p>' . htmlspecialchars($row['description']) . '</p>';
        echo '    <ul>';
        echo '      <li><strong>Guest Number:</strong> ' . htmlspecialchars($row['guest_number']) . '</li>';
        echo '      <li><strong>Price:</strong> $' . htmlspecialchars($row['price']) . '/night</li>';
        echo '      <li><strong>Availability:</strong> ' . ($row['availability'] ? 'Available' : 'Unavailable (until ' . htmlspecialchars($row['departure_date']) . ')') . '</li>';
        echo '    </ul>';
        if ($row['availability']) {
          echo '    <a href="reserve_room.php?id=' . $row['room_id'] . '" class="btn btn-reserve">Reserve</a>';
        }
        echo '  </div>';
        echo '</div>';
      }
    } else {
      echo "<p>No rooms found</p>";
    }

    mysqli_close($connect);
    ?>



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