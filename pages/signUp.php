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
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/signUp.css"/>
  </head>
  <body>
    <div class="container">
      <form action="signUp.php" method="post" class="login__form">
        <h1>Sign Up</h1>
        <div class="input__row">
          <span><i class="ri-user-3-line"></i></span>
          <div class="input__group">
            <input type="text" name="firstname" id="firstname"  />
            <label for="firstname">First Name</label>
          </div>
        </div>
        <div class="input__row">
          <span><i class="ri-user-3-line"></i></span>
          <div class="input__group">
            <input type="text" name="lastname" id="lastname" />
            <label for="lastname">Last name</label>
          </div>
        </div>
        <div class="input__row">
          <span><i class="ri-user-3-line"></i></span>
          <div class="input__group">
            <input type="email" name="email" id="email"/>
            <label for="email">Email</label>
          </div>
        </div>
        <div class="input__row">
          <span><i class="ri-lock-2-line"></i></span>
          <div class="input__group">
            <input id="password" type="password" name="password" />
            <label for="password">Password</label>
          </div>
          <span id="password-eye"><i class="ri-eye-off-line"></i></span>
        </div>
        <button type="submit" class="login__btn" name="submit" >Sign Up</button>
        <?php
        include("con_data.php");
          if($_SERVER["REQUEST_METHOD"] == "POST")
          {
            $firstname = filter_input(INPUT_POST,"firstname", FILTER_SANITIZE_SPECIAL_CHARS);
            $lastname = filter_input(INPUT_POST,"lastname", FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST,"email", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
    
            if(empty($firstname))
            {
                echo "Please enter a firstname.<br>";
            }
            elseif(empty($lastname))
            {
                echo "Please enter a lastname.<br>";
            }
            elseif(empty($email))
            {
                echo "Please enter a email.<br>";
            }
            elseif(empty($password))
            {
                echo "Please enter a password.<br>";
            }
            else
            {
              $passwordHash = password_hash($password, PASSWORD_DEFAULT);

              $sql = "INSERT INTO user(firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$passwordHash')";
              mysqli_query($connect, $sql);
              header("Location: login.php");
              echo"You are now registered<br>";
            }  
          }
          mysqli_close($connect);
          
        ?>
      
     <div>Have an account? <a href="login.php">Log in</a></div>
      </form>
    </div>


    <script src="../js/signUp.js"></script>
  </body>
</html>
