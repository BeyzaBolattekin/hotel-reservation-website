<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rooms</title>
    <link rel="stylesheet" href="/styles/rooms.css" />
  </head>
  <body>
    <nav class="navbar">
      <img src="/images/logo.jpg" alt="logo" id="logo" />
      <ul class="nav-items">
        <li><a href="/pages/home.html">Home</a></li>
        <li><a href="/pages/about.html">About</a></li>
        <li><a href="/pages/features.html">Facilities</a></li>
        <li><a href="/pages/rooms.html">Rooms</a></li>
        <li><a href="/pages/login.html">Login</a></li>
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
      <div class="roomCard">
        <div class="roomImg">
          <img src="/images/onePerson.jpg" alt="room1" />
        </div>
        <div class="roomInfo">
          <h3>Single Room</h3>
          <p>
            Typically ranging from 10-20 m², these rooms are designed for the
            comfortable stay of one person. They include a standard single bed,
            a desk, a private bathroom, and sometimes a small armchair.
          </p>
        </div>
      </div>
      <div class="roomCard">
        <div class="roomImg">
          <img src="/images/honeyMoon.jpg" alt="room1" />
        </div>
        <div class="roomInfo">
          <h3>Honeymoon Suit</h3>
          <p>
            Offering a spacious and romantic atmosphere, honeymoon suites
            generally feature a king-size bed, a jacuzzi or spa bath, a sitting
            area, and a large balcony. The decoration is luxurious with elegant
            details.
          </p>
        </div>
      </div>
      <div class="roomCard">
        <div class="roomImg">
          <img src="/images/famillyRoom.jpg" alt="room1" />
        </div>
        <div class="roomInfo">
          <h3>Family Room</h3>
          <p>
            Suitable for larger families, these rooms provide multiple bedrooms
            or a large room with extra beds. Family-friendly amenities, a
            spacious sitting area, and sometimes a kitchenette are included.
          </p>
        </div>
      </div>
    </div>
    <footer class="footer">
      <img src="/images/logo.jpg" alt="" />

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
  <script
    src="https://kit.fontawesome.com/b022f45a64.js"
    crossorigin="anonymous"
  ></script>
</html>
