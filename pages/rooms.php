<?php
session_start();
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rooms</title>
  <link rel="stylesheet" href="../css/rooms.css" />

</head>

<body>

  <?php include_once './include/navbar.php'; ?>

  <div class="formContainer">
    <form class="roomForm" id="roomFilterForm">
      <div class="arrivalDiv inputDiv">
        <p>Arrival Date</p>
        <input type="date" id="arrivalDate" name="arrival_date" required />
      </div>
      <div class="departureDiv inputDiv">
        <p>Departure Date</p>
        <input type="date" id="departureDate" name="departure_date" required />
      </div>
      <div class="guestsDiv inputDiv">
        <p>Guests</p>
        <input type="number" id="guests" name="guests" required />
      </div>
      <div class="checkBtn">
        <button type="submit">Check Rooms</button>
      </div>
    </form>
  </div>



  <div id="roomResults" class="roomsContainer">


    <?php
    include("../pages/con_data.php");

    $sql = "SELECT * FROM rooms";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="roomCard">';
        echo '  <div class="roomImg">';
        echo '    <img src="' . htmlspecialchars($row['img']) . '" alt="' . htmlspecialchars($row['title']) . '">';
        echo '  </div>';
        echo '  <div class="roomInfo">';
        echo '    <h3>' . htmlspecialchars($row['title']) . '</h3>';
        echo '    <p>' . htmlspecialchars($row['description']) . '</p>';
        echo '    <ul>';
        echo '      <li><strong>Guest Number:</strong> ' . htmlspecialchars($row['guest_number']) . '</li>';
        echo '      <li><strong>Price:</strong> $' . htmlspecialchars($row['price']) . '/night</li>';
        echo '    </ul>';

        echo '  </div>';
        echo '</div>';
      }
    } else {
      echo "<p>No rooms found</p>";
    }

    mysqli_close($connect);
    ?>



  </div>
  <!-- <footer class="footer">
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
  </footer> -->

  <script>
    document.addEventListener('DOMContentLoaded', () => {

      const userId = <?php echo json_encode($user_id); ?>;

      document.getElementById('roomFilterForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const arrivalDate = document.getElementById('arrivalDate').value;
        const departureDate = document.getElementById('departureDate').value;
        const guests = document.getElementById('guests').value;

        fetch(`filter_rooms.php?arrival_date=${arrivalDate}&departure_date=${departureDate}&guests=${guests}`)
          .then(response => response.json())
          .then(data => {
            const roomResults = document.getElementById('roomResults');
            roomResults.innerHTML = '';

            if (data.length > 0) {
              data.forEach(room => {
                const roomDiv = document.createElement('div');
                roomDiv.classList.add('roomCard');
                roomDiv.innerHTML = `
              <div class="roomImg">
                <img src="${room.img}" alt="${room.title}" width="100">
              </div>
              <div class="roomInfo">
                <h3>${room.title}</h3>
                <p>${room.description}</p>
                <ul>
                  <li><strong>Guest Number:</strong> ${room.guest_number}</li>
                  <li><strong>Price:</strong> $${room.price} per night</li>
                </ul>

                ${userId ? `<a href="reserve_room.php?id=${room.room_id}" class="btn btn-reserve">Reserve</a>` : ''}              


              </div>
            `;
                roomResults.appendChild(roomDiv);
              });
            } else {
              roomResults.innerHTML = '<p>No rooms available for the selected criteria.</p>';
            }
          })
          .catch(error => console.error('Error:', error));
      })
    });;
  </script>


</body>
<script src="https://kit.fontawesome.com/b022f45a64.js" crossorigin="anonymous"></script>

</html>