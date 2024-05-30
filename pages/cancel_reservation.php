<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    include("../pages/con_data.php");

    $reservation_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    // Rezervasyonun kullanıcıya ait olup olmadığını kontrol et
    $sql = "SELECT * FROM reservations WHERE reservation_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $reservation_id, $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Rezervasyonu sil
        $sql_delete = "DELETE FROM reservations WHERE reservation_id = ?";
        $stmt_delete = mysqli_prepare($connect, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, "i", $reservation_id);
        mysqli_stmt_execute($stmt_delete);

        if (mysqli_stmt_affected_rows($stmt_delete) > 0) {
            echo "Reservation successfully cancelled.";
        } else {
            echo "Failed to cancel the reservation.";
        }
        mysqli_stmt_close($stmt_delete);
    } else {
        echo "Reservation not found or does not belong to you.";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connect);
} else {
    echo "Invalid request.";
}

header("Location: user_reservation.php");
exit();
