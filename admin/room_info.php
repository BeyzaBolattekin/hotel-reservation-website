<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Dashboard | Registration and Login System </title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="./styles.css" rel="stylesheet" />
    <link href='./room.css' rel='stylesheet' />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed">
    <?php include_once('include/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('include/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">

                    <div>
                        <form action="room_info.php" method="post" class="room-form" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="desc">Description</label>
                                <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="img" class="form-label">Image</label>
                                <input type="file" class="form-control" id="img" name="img" required>
                            </div>

                            <div class=' mb-3'>
                                <label for="guest_number" class="form-label">Guest Number</label>
                                <select name="guest_number" id="guest_number">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>

                            <button type="submit" class="btn-11 btn btn-primary">Submit</button>


                            <?php
                            // PHP Hata raporlamayı aç
                            ini_set('display_errors', 1);
                            ini_set('display_startup_errors', 1);
                            error_reporting(E_ALL);

                            include("../pages/con_data.php");
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_SPECIAL_CHARS);
                                $desc = filter_input(INPUT_POST, "desc", FILTER_SANITIZE_SPECIAL_CHARS);
                                $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_SPECIAL_CHARS);

                                $guest_number = filter_input(INPUT_POST, "guest_number", FILTER_SANITIZE_SPECIAL_CHARS);

                                // Dosya yükleme işlemi
                                $img_dir = "../uploads/"; // Resim dosyalarının saklanacağı dizin
                                if (!is_dir($img_dir)) {
                                    mkdir($img_dir, 0777, true); // Dizini oluştur
                                }

                                $img_file = $img_dir . basename($_FILES["img"]["name"]);
                                $img_file_type = strtolower(pathinfo($img_file, PATHINFO_EXTENSION));

                                // Dosya tipi kontrolü
                                $valid_file_types = array("jpg", "jpeg", "png", "gif");
                                if (!in_array($img_file_type, $valid_file_types)) {
                                    echo "Only JPG, JPEG, PNG, and GIF files are allowed.<br>";
                                    exit();
                                }

                                // Dosya zaten var mı kontrolü
                                if (file_exists($img_file)) {
                                    echo "File already exists.<br>";
                                    exit();
                                }

                                // Dosyayı yükle
                                if (move_uploaded_file($_FILES["img"]["tmp_name"], $img_file)) {
                                    echo "The file " . basename($_FILES["img"]["name"]) . " has been uploaded.<br>";
                                } else {
                                    echo "There was an error uploading the file.<br>";
                                    exit();
                                }

                                if (empty($title)) {
                                    echo "Please enter a title.<br>";
                                } elseif (empty($desc)) {
                                    echo ("Please enter a description.<br>");
                                } elseif (empty($price)) {
                                    echo ("Please enter a price.<br>");
                                } elseif (empty($guest_number)) {
                                    echo ("Please enter a guest number.<br>");
                                } else {




                                    $sql = "INSERT INTO rooms(guest_number,price,title,description,img) VALUES ('$guest_number','$price','$title', '$desc', '$img_file')";
                                    mysqli_query($connect, $sql);
                                    echo "You are now created<br>";
                                }
                            }
                            mysqli_close($connect);
                            ?>




                        </form>
                    </div>


                    <!-- Oda yönetim tablosu -->
                    <h2>Existing Rooms</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Room ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Guest Number</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include("../pages/con_data.php");

                            $sql = "SELECT * FROM rooms";
                            $result = mysqli_query($connect, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['room_id'] . "</td>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['description'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";

                                    echo "<td>" . $row['guest_number'] . "</td>";
                                    echo "<td><img src='" . $row['img'] . "' alt='Room Image' width='100'></td>";
                                    echo "<td>";

                                    echo "<a href='delete_room.php?id=" . $row['room_id'] . "'>Delete</a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>No rooms found</td></tr>";
                            }

                            mysqli_close($connect);
                            ?>
                        </tbody>
                    </table>

                </div>

            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../datatables-simple-demo.js"></script>
</body>

</html>