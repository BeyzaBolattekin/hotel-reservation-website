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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reservations</title>
    <link rel="stylesheet" href="../css/features.css" />

    <style>
        .reservation-wrapper-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 2rem 0;
            margin-top: 8rem;
        }

        .reservation-card-container {
            margin: 0 auto;
            width: 75%;
            padding: 20px;
            display: grid;
            flex-wrap: wrap;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .reservation-card {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

        }

        .reservation-card h3 {
            margin: 0 0 10px;
            font-size: 24px;
            color: #333;
        }

        .reservation-card p {
            margin: 0 0 5px;
        }

        .reservation-card .price {
            font-size: 18px;
            font-weight: bold;
        }

        .reservation-card img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .reservation-card .action {
            margin-top: 10px;
        }

        .reservation-card .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            background-color: #007BFF;
        }

        .reservation-card .btn:hover {
            background-color: #0056b3;
        }

        .reservation-info {
            display: flex;
            flex-direction: column;
            justify-content: space-around;

        }
    </style>
</head>

<body>

    <?php include_once './include/navbar.php'; ?>

    <div class="reservation-wrapper-container">
        <h2>My Reservations</h2>
        <div class="reservation-card-container">
            <?php
            include("../pages/con_data.php");

            $user_id = $_SESSION['user_id'];
            $sql = "SELECT r.room_id, r.title, r.img, rv.reservation_id, rv.arrival_date, rv.departure_date, rv.total_price
                FROM reservations rv
                JOIN rooms r ON rv.room_id = r.room_id
                WHERE rv.user_id = ?";
            $stmt = mysqli_prepare($connect, $sql);
            mysqli_stmt_bind_param($stmt, "i", $user_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='reservation-card'>";
                    echo "<img src='" . htmlspecialchars($row['img']) . "' alt='" . htmlspecialchars($row['title']) . "'>";
                    echo "<div class='reservation-info'>";
                    echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                    echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                    echo "<ul>";
                    echo "<li><strong>Arrival Date:</strong> " . htmlspecialchars($row['arrival_date']) . "</li>";
                    echo "<li><strong>Departure Date:</strong> " . htmlspecialchars($row['departure_date']) . "</li>";
                    echo "<li class='price'><strong>Total Price:</strong> $" . htmlspecialchars($row['total_price']) . "</li>";
                    echo "</ul>";
                    echo "<div class='action'><a href='cancel_reservation.php?id=" . $row['reservation_id'] . "' class='btn'>Cancel Reservation</a></div>";
                    echo "</div></div>";
                }
            } else {
                echo "<p>You have no reservations.</p>";
            }

            mysqli_close($connect);
            ?>
        </div>
    </div>



</body>
<script src="https://kit.fontawesome.com/b022f45a64.js" crossorigin="anonymous"></script>

</html>