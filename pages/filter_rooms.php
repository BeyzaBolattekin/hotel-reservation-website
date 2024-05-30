<?php
include("../pages/con_data.php");

if (isset($_GET['arrival_date'], $_GET['departure_date'], $_GET['guests'])) {
    $arrival_date = $_GET['arrival_date'];
    $departure_date = $_GET['departure_date'];
    $guests = intval($_GET['guests']);

    // Odaların doluluk durumunu kontrol eden sorgu
    $sql = "
        SELECT * FROM rooms r
        WHERE r.guest_number >= ?
        AND r.room_id NOT IN (
            SELECT room_id FROM reservations 
            WHERE (arrival_date <= ? AND departure_date >= ?)
            OR (arrival_date <= ? AND departure_date >= ?)
            OR (arrival_date >= ? AND departure_date <= ?)
        )";

    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, "issssss", $guests, $departure_date, $arrival_date, $arrival_date, $departure_date, $arrival_date, $departure_date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $rooms = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connect);

    echo json_encode($rooms);
} else {
    echo json_encode(['error' => 'Invalid input']);
}
