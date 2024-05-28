<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/styles/login.css" />
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
        <div>Don't have an account? <a href="signUp.php">Register</a></div>
      </form>
    </div>

    <script src="/js/login.js"></script>
  </body>
</html>
