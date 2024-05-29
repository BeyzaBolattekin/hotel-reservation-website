<?php
  include("con_data.php");
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/login.css" />
    <title>Login</title>
  </head>
  <body>
    <div class="container">
      <form action="login.php" method="post" class="login__form">
        <h1>Login</h1>
        <div class="input__row">
          <span><i class="ri-user-3-line"></i></span>
          <div class="input__group">
            <input type="text" placeholder=" " name="email" class="emailInput" />
            <label for="email">Email</label>
          </div>
        </div>
        <div class="input__row">
          <span><i class="ri-lock-2-line"></i></span>
          <div class="input__group">
            <input
              id="password"
              type="password"
              placeholder=" "
              class="passwordInput"
              name="password"
            />
            <label for="password">Password</label>
          </div>
          <span id="password-eye"><i class="ri-eye-off-line"></i></span>
        </div>
        <button type="submit" class="login__btn">Login</button>
        <?php
include("con_data.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kullanıcıdan gelen verileri al ve filtrele
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    // E-posta ve parolanın boş olup olmadığını kontrol et
    if (empty($email)) {
        echo "Please enter an email.<br>";
    } elseif (empty($password)) {
        echo "Please enter a password.<br>";
    } else {
        // E-posta ile kullanıcıyı veritabanında ara
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_prepare($connect, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Kullanıcı bulundu, parolayı kontrol et
            if (password_verify($password, $row['password'])) {
                // Parola doğru, kullanıcı giriş yapabilir
                echo 'test';
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                header("Location: ../index.html");
                exit();
            } else {
                // Parola yanlış
                echo "Incorrect password.<br>";
            }
        } else {
            // Kullanıcı bulunamadı
            echo "No user found with that email.<br>";
        }

        // Veritabanı bağlantısını kapat
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($connect);
?>

        <div>Don't have an account? <a href="signUp.php">Register</a></div>
      </form>
    </div>

    <script src="../js/login.js"></script>
  </body>
</html>
