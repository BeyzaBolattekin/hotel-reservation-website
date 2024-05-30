<style>
    .navbar {
        position: fixed;
        top: 20px;
        left: 5%;
        z-index: 1000;
        background-color: #fff;
        height: 80px;
        width: 90%;
        display: flex;
        justify-content: space-between;
        border-radius: 15px;
        padding: 0 20px;

    }

    .nav-items {
        display: flex;
        align-items: center;
        justify-content: right;
        gap: 8%;
        padding: 10px;
        height: 100%;
        width: 100%;
        flex-wrap: wrap;
    }

    .navbar img {
        height: 80px;
        width: 80px;
        border-radius: 15px;

    }

    .welcome-text {
        font-size: 20px;
        font-weight: bold;
        color: #000;

    }
</style>
<nav class="navbar">
    <img src="../images/logo.jpg" alt="logo" id="logo" />
    <ul class="nav-items">
        <li><a href="../index.php">Home</a></li>
        <li><a href="./about.php">About</a></li>
        <li><a href="./features.php">Facilities</a></li>
        <li><a href="./rooms.php">Rooms</a></li>

        <?php if (isset($_SESSION['user_id'])) : ?>

            <a href="user_reservation.php" class="welcome-text"><?php echo htmlspecialchars($_SESSION['firstname']); ?></a>
            <a href="./logout.php">Logout</a>
        <?php else : ?>
            <li><a href="./signUp.php">Register</a></li>
            <li><a href="./login.php">Login</a></li>
        <?php endif; ?>

    </ul>
</nav>