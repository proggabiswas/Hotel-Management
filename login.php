<?php
require_once './components/connect.php';

if (isset($_POST['username']) && isset($_POST['password'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];

  try {
    // Prepare the SQL statement to fetch user details
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Fetch the user details
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: /HillWood/Final-Project/');
        exit;
    } else {
        // Invalid credentials
        $errMsg = "Invalid username or password.";
    }
  } catch (PDOException $e) {
    $errMsg = "Error: " . $e->getMessage();
  }
}

if (isset($_GET['msg'])) {
  $errMsg = $_GET['msg'];
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hillwood International Hotel:Login/Signup</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" >

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- custom css file link  -->
    <link rel="stylesheet" href="../Final-Project/css/login.css">
    

</head>

<body>
    <div class="wrapper">
      <form action=""  method="post">
          
      <?php
      if (isset($errMsg)) {
        echo "
        <div class='type'>
          <p class='errMsg'>$errMsg</p>
        </div>";
      }
      ?>


        <div class="input-box">
          <input type="text" placeholder="username" name="username" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <input type="password" placeholder="password" name="password" required>
          <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="remember-forgot">
          <label><input type="checkbox">Remember me</label>
           <a href="#">Forgot Password?</a>
        </div>
        <div>
         <button type="submit" name="login" class="btn">Login</button>
        </div>
        
        <div class="register-link">
         <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>

      </form>
    </div>
</body>

</html>
