<?php
// PHP Hata raporlamayı aç
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../pages/con_data.php");

if (isset($_GET['id'])) {
    $room_id = intval($_GET['id']);

    $sql = "DELETE FROM rooms WHERE room_id = ?";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "i", $room_id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Room successfully deleted.<br>";
    } else {
        echo "Failed to delete room: " . mysqli_stmt_error($stmt) . "<br>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connect);
    header("Location: room_info.php");
    exit();
}
