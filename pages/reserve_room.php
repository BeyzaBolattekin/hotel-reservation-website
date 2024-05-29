<?php
session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rooms</title>
    <link rel="stylesheet" href="../css/rooms.css" />
    <link rel="stylesheet" href="../css/reserve_room.css" />
    <script>
        function calculateTotalPrice() {
            const checkInDate = new Date(document.getElementById('check_in_date').value);
            const checkOutDate = new Date(document.getElementById('check_out_date').value);
            const pricePerNight = parseFloat(document.getElementById('price_per_night').value);

            if (checkInDate && checkOutDate && pricePerNight) {
                const timeDifference = checkOutDate - checkInDate;
                const daysDifference = timeDifference / (1000 * 3600 * 24);

                if (daysDifference > 0) {
                    const totalPrice = daysDifference * pricePerNight;
                    document.getElementById('total_price').innerText = 'Total Price: $' + totalPrice.toFixed(2);
                    document.getElementById('total_price_input').value = totalPrice.toFixed(2);
                    document.getElementById('total_price_label').style.display = 'none';

                } else {
                    alert('Check-out date must be after check-in date.');
                }

            } else {
                alert('Please enter valid dates.');
            }
        }
    </script>
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



    <?php
    // PHP Hata raporlamayı aç
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../pages/con_data.php");

    if (isset($_GET['id'])) {
        $room_id = intval($_GET['id']);

        $sql = "SELECT price, img FROM rooms WHERE room_id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $room_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $price, $img);
        mysqli_stmt_fetch($stmt);

        if ($price !== null) {
            // echo $price;
        } else {
            echo json_encode(['error' => 'Room not found']);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['error' => 'Invalid room ID']);
    }

    mysqli_close($connect);


    if (isset($_GET['id'])) {
        $room_id = intval($_GET['id']);
        $price_per_night = floatval($price);
        $img_url = htmlspecialchars($img, ENT_QUOTES, 'UTF-8');
    ?>
        <div class="reserve-container ">
            <h2>Reserve Room</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $room_id; ?>" enctype="multipart/form-data">
                <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                <input type="hidden" id="price_per_night" value="<?php echo $price_per_night; ?>">
                <div class="date-wrapper">
                    <div class="reserve-wrapper">
                        <label for="check_in_date" class="form-label">Check-in Date</label>
                        <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>

                    </div>
                    <div class="reserve-wrapper">
                        <label for="check_out_date" class="form-label">Check-out Date</label>
                        <input type="date" class="form-control" id="check_out_date" name="check_out_date" required onchange="calculateTotalPrice()">
                    </div>
                </div>

                <div class="img-price-wrapper">
                    <div class="reserve-wrapper">
                        <img src="<?php echo $img_url; ?>" alt="Room Image" style="">
                    </div>

                    <div class="reserve-wrapper">
                        <label for="daily_price" class="form-label">Daily Price</label>
                        <p id="daily_price" class="price-display">$<?php echo number_format($price_per_night, 2); ?></p>
                    </div>
                </div>
                <div id="confirm_section">
                    <p id="total_price" class="total-price-display"></p>

                    <label id="total_price_label" for="total_price_input">Total Price: $</label><input type="hidden" id="total_price_input" name="total_price" style="border:none; outline:none">
                    <button type="submit" class="btn btn-primary">Confirm Reservation</button>

                    <?php
                    // PHP Hata raporlamayı aç
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);

                    include("../pages/con_data.php");
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $arrival_date = filter_input(INPUT_POST, "check_in_date", FILTER_SANITIZE_NUMBER_INT);
                        $departure_date = filter_input(INPUT_POST, "check_out_date", FILTER_SANITIZE_NUMBER_INT);
                        $total_price = filter_input(INPUT_POST, "total_price", FILTER_SANITIZE_NUMBER_INT);

                        $user_id = $_SESSION["user_id"];





                        if ($arrival_date == "" || $departure_date == "" || $total_price == "") {
                            echo "Please fill in all fields";
                        } else {
                            $sql = "INSERT INTO reservations(user_id, room_id, arrival_date, departure_date, total_price) VALUES ('$user_id', '$room_id', '$arrival_date', '$departure_date', '$total_price')";
                            mysqli_query($connect, $sql);
                            echo "You are now created<br>";
                        }
                    }
                    mysqli_close($connect);
                    ?>

                </div>

            </form>

        <?php
    } else {
        echo "<p>Invalid room selection.</p>";
    }
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