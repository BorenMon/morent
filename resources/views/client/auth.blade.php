<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="description" content="MORENT - Your
    Trusted Car Rental Partner in Cambodia">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Authentication</title>
    @vite('resources/scss/client/pages/auth.css')
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container">
      <!-- Form Login -->
      <div class="form-box login">
        <form id="login">
          <h1>Login</h1>
          <div class="input-box">
            <input type="email" placeholder="Email" name="email" required />
            <i class="bx bxs-envelope"></i>
          </div>
          <div class="input-box">
            <input type="password" placeholder="Password" name="password" required />
            <i class="bx bxs-lock-alt"></i>
          </div>
          <div class="forgot-link">
            <a href="#">Forget Password</a>
          </div>
          <button type="submit" class="btn">Login</button>
        </form>
      </div>

      <!-- Form Register -->
      <div class="form-box register">
        <form id="register">
          <h1>Registration</h1>
          <div class="input-box">
            <input type="email" placeholder="Email" name="email" required />
            <i class="bx bxs-envelope"></i>
          </div>
          <div class="input-box">
            <input type="password" placeholder="Password" name="password" required />
            <i class="bx bxs-lock-alt"></i>
          </div>
          <div class="input-box">
            <input type="password" placeholder="Confirm Password" name="confirmPassword" required />
            <i class="bx bxs-lock-alt"></i>
          </div>
          <button type="submit" class="btn">Register</button>
        </form>
      </div>

      <div class="toggle-box">
        <div class="toggle-panel toggle-left">
          <a href="/"><img src="/images/logo.svg" alt="logo" style="height: 15px; margin-bottom: 50px;" class="hide"></a>
          <h1 class="hide">Hello, Welcome!</h1>
          <p>Don't have an account?</p>
          <button class="btn register-btn">Register</button>
        </div>
        <div class="toggle-panel toggle-right">
          <a href="/"><img src="/images/logo.svg" alt="logo" style="height: 15px; margin-bottom: 50px;" class="hide"></a>
          <h1 class="hide">Welcome Back!</h1>
          <p>Already have an account?</p>
          <button class="btn login-btn">Login</button>
        </div>
      </div>
    </div>

    @vite('resources/js/client/pages/auth.js')
  </body>
</html>
