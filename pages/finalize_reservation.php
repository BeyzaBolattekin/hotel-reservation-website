<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include("../pages/con_data.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = intval($_POST['room_id']);
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $total_price = floatval($_POST['total_price']);

    // Rezervasyon bilgilerini veritabanına kaydet
    $sql = "INSERT INTO reservations (room_id, check_in_date, check_out_date, total_price) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "issd", $room_id, $check_in_date, $check_out_date, $total_price);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "<p>Reservation successfully completed.</p>";
    } else {
        echo "<p>Failed to complete reservation: " . mysqli_stmt_error($stmt) . "</p>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connect);
} else {
    echo "<p>Invalid request.</p>";
}
