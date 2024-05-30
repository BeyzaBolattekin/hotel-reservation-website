<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rooms</title>
    <link rel="stylesheet" href="../css/rooms.css" />
    <link rel="stylesheet" href="../css/reserve_room.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        .ui-datepicker .ui-state-disabled span,
        .ui-datepicker .ui-state-disabled a {
            background: #f2f2f2 none;
            color: #888888;
        }

        body {
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>

    <?php include_once './include/navbar.php'; ?>


    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include("../pages/con_data.php");

    if (isset($_GET['id'])) {
        $room_id = intval($_GET['id']);

        // Oda bilgilerini çek
        $sql = "SELECT price, img FROM rooms WHERE room_id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $room_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $price, $img);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Doluluk tarihlerini çek
        $sql = "SELECT arrival_date, departure_date FROM reservations WHERE room_id = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "i", $room_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $unavailable_dates = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $unavailable_dates[] = ['start' => $row['arrival_date'], 'end' => $row['departure_date']];
        }


        mysqli_stmt_close($stmt);
        mysqli_close($connect);

        if ($price !== null) {
            $price_per_night = floatval($price);
            $img_url = htmlspecialchars($img, ENT_QUOTES, 'UTF-8');
        } else {
            echo "<p>Room not found</p>";
            exit();
        }
    } else {
        echo "<p>Invalid room ID</p>";
        exit();
    }
    ?>




    <div class="reserve-container">
        <h2>Reserve Room</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $room_id; ?>" enctype="multipart/form-data">
            <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
            <input type="hidden" id="price_per_night" value="<?php echo $price_per_night; ?>">
            <div class="date-wrapper">
                <div class="reserve-wrapper">
                    <label for="check_in_date" class="form-label">Check-in Date</label>
                    <input type="text" placeholder="Select date" class="form-control datepicker" id="check_in_date" name="check_in_date" required>


                </div>
                <div class="reserve-wrapper">

                    <label for="check_out_date" class="form-label">Check-out Date</label>
                    <input type="text" class="form-control datepicker" id="check_out_date" name="check_out_date" placeholder="Select date" required onchange="calculateTotalPrice()">

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
                    $arrival_date_input = filter_input(INPUT_POST, "check_in_date", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $departure_date_input = filter_input(INPUT_POST, "check_out_date", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $arrival_date = DateTime::createFromFormat('Y-m-d', $arrival_date_input);
                    $departure_date = DateTime::createFromFormat('Y-m-d', $departure_date_input);

                    if ($arrival_date && $departure_date) {
                        $arrival_date = $arrival_date->format('Y-m-d');
                        $departure_date = $departure_date->format('Y-m-d');
                        $total_price = filter_input(INPUT_POST, "total_price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                        $user_id = $_SESSION["user_id"];

                        if ($arrival_date == "" || $departure_date == "" || $total_price == "") {
                            echo "Please fill in all fields";
                        } else {
                            include("../pages/con_data.php");

                            // Rezervasyon çakışma kontrolü
                            $sql = "
                                SELECT * FROM reservations 
                                WHERE room_id = ? 
                                AND (
                                    (arrival_date <= ? AND departure_date >= ?)
                                    OR (arrival_date <= ? AND departure_date >= ?)
                                    OR (arrival_date >= ? AND departure_date <= ?)
                                )
                            ";
                            $stmt = mysqli_prepare($connect, $sql);
                            mysqli_stmt_bind_param($stmt, "issssss", $room_id, $departure_date, $arrival_date, $arrival_date, $departure_date, $arrival_date, $departure_date);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            if (mysqli_num_rows($result) > 0) {
                                // Rezervasyon çakışması var
                                echo "Room is not available for the selected dates";
                            } else {
                                // Rezervasyon ekleme
                                $sql = "INSERT INTO reservations(user_id, room_id, arrival_date, departure_date, total_price) VALUES (?, ?, ?, ?, ?)";
                                $stmt = mysqli_prepare($connect, $sql);
                                mysqli_stmt_bind_param($stmt, "iisss", $user_id, $room_id, $arrival_date, $departure_date, $total_price);
                                mysqli_stmt_execute($stmt);
                                echo "Reservation created successfully";
                            }

                            mysqli_stmt_close($stmt);
                            mysqli_close($connect);
                        }
                    } else {
                        echo "Invalid date format";
                    }
                }



                ?>

            </div>

        </form>



    </div>



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

        function disableUnavailableDates(unavailableDates) {
            function disableDate(date) {
                for (const range of unavailableDates) {
                    const startDate = new Date(range.start);
                    const endDate = new Date(range.end);
                    // Normalize dates to midnight to avoid time comparison issues
                    startDate.setHours(0, 0, 0, 0);
                    endDate.setHours(23, 59, 59, 999);
                    if (date >= startDate && date <= endDate) {
                        return [false, 'ui-state-disabled'];
                    }
                }
                return [true, ''];
            }

            $(".datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                beforeShowDay: disableDate
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const unavailableDates = <?php echo json_encode($unavailable_dates); ?>;
            disableUnavailableDates(unavailableDates);
        });
    </script>
</body>
<script src="https://kit.fontawesome.com/b022f45a64.js" crossorigin="anonymous"></script>

</html>