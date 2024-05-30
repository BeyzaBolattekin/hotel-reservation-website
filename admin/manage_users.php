<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include("../pages/con_data.php");

$sql = "SELECT * FROM user";
$result = mysqli_query($connect, $sql);
?>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        main {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            overflow-x: hidden;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #04AA6D;
            color: white;
        }

        tr:hover {
            background-color: #ddd;
        }

        .action_column a {
            color: white;
            border: none;
            border-radius: 10px;
            padding: 3px 10px;
            text-decoration: none;
        }

        .action_column a.view {
            background-color: greenyellow;
        }

        .action_column a.delete {
            background-color: red;
        }

        .err_msg {
            background-color: red;
            padding: 10px;
            color: white;
        }

        .success_msg {
            background-color: green;
            padding: 10px;
            color: white;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include_once('include/navbar.php'); ?>
    <div id="layoutSidenav">
        <?php include_once('include/sidebar.php'); ?>
        <div id="layoutSidenav_content">
            <main>
                <!-- Oda yönetim tablosu -->
                <h2>Existing Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['firstname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No users found</td></tr>";
                        }
                        mysqli_close($connect);
                        ?>
                    </tbody>
                </table>
            </main>
            <?php include_once('../include/footer.php'); ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../datatables-simple-demo.js"></script>
</body>

</html>