<?php
session_start();
if (!isset($_SESSION['user_id'])) {
} else {
  $user_id = $_SESSION['user_id'];

  include('db/dbconn.php');
  $query = "SELECT role FROM users WHERE user_id = $user_id";
  $result = mysqli_query($conn, $query);

  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $user_role = $row['role'];

    header("Location: " . $user_role . "/$user_role.php");
    exit();
  } else {

    echo "Error: " . mysqli_error($conn);
  }


  mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | TriSakay</title>
  <?php
  $imagePath = "img/Logo_Nobg.png";
  ?>
  <link rel="icon" href="<?php echo $imagePath; ?>" type="image/png" />


  <?php
  include 'php/dependencies.php';
  ?>
  <link rel="stylesheet" href="css/login.css" />
</head>

<body>
  <img src="img/nye3.png" alt="Baliwag City Logo" />
  <h1>Welcome</h1>
  <h2 style="color: white">Hi there! Sign in to continue.</h2>

  <div class="error-container">
    <?php
    if (isset($_GET['error'])) {
      echo '<p class="error-message">Invalid username or password. Please try again.</p>';
    }
    ?>
  </div>
  <div class="container2">
    <form action="login_back.php" method="POST">
      <div class="container d-flex justify-content-center">
        <div class="input-box">
          <div class="input-field">
            <input type="text" class="input" id="username" name="username" required autocomplete="off" />
            <label for="username"><i class="fa-solid fa-user fa-lg" style="color: #ffffff;"></i> Username</label>
          </div>
          <div class="input-field">
            <input type="password" class="input" id="password" name="password" required />
            <label for="password"><i class="fa-solid fa-key fa-lg" style="color: #ffffff;"></i> Password</label>
          </div>

          <div class="container1 d-flex justify-content-center mt-3">
            <p style="color: #f5f5f5">
              Forgot your
              <a href="signup.html" style="color: #f5f5f5" onmouseover="this.style.color='#9ACD32'"
                onmouseout="this.style.color='#F5F5F5'">password?</a>
            </p>
          </div>

          <div class="container d-flex justify-content-center mt-3">
            <button type="submit" class="btn btn-default custom-btn">Sign in</button>
          </div>
        </div>
      </div>
    </form>

    <hr>

    <a href="index.html" class="btn btn-default custom-btn1">Guest Access</a>

    <div class="container1 d-flex justify-content-center mt-3">
      <p style="color: #f5f5f5">
        Don’t have an account?
        <a href="signup.html" style="color: #f5f5f5" onmouseover="this.style.color='#9ACD32'"
          onmouseout="this.style.color='#F5F5F5'">Sign up</a>
      </p>
    </div>

  </div>

  <script>
   
    <?php if (!empty($login_error)): ?>
      window.onload = function () {
        alert("<?php echo $login_error; ?>");
      };
    <?php endif; ?>
  </script>
</body>

</html>