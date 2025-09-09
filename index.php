<?php
session_start();
include "db.php";

$message = "";

// Signup
if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql)) {
        $message = "Signup successful. Please login.";
    } else {
        $message = "Error: Email already exists.";
    }
}

// Signin
if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['name'];
            header("Location: welcome.php");
            exit();
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "No account found with that email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PsytechCare Auth</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #eef4f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .container {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 320px;
      text-align: center;
    }
    h2 { margin-bottom: 20px; color: #166f3a; }
    input {
      width: 90%; padding: 10px; margin: 8px 0;
      border: 1px solid #ccc; border-radius: 8px;
    }
    button {
      width: 100%; padding: 10px;
      background: #166f3a; color: white;
      border: none; border-radius: 8px;
      font-weight: bold; cursor: pointer;
      margin-top: 10px;
    }
    button:hover { background: #125c30; }
    .toggle { margin-top: 15px; color: #555; cursor: pointer; }
    .hidden { display: none; }
    .msg { color: red; margin-bottom: 10px; }

    /* Buttons (Sign In / Sign Up) */
button,
.form-container button,
.logout-btn {
  display: inline-block;
  padding: 12px 18px;
  background: #166f3a;
  color: #fff;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s ease;
  text-align: center;
}

button:hover,
.form-container button:hover,
.logout-btn:hover {
  background: #0f4f29;
}

/* Responsive Buttons */
@media (max-width: 768px) {
  button,
  .form-container button,
  .logout-btn {
    width: 100%;
    padding: 14px;
    font-size: 18px;
    margin-top: 10px;
  }
}

  </style>
  <script>
    function showSignin() {
      document.getElementById("signupForm").classList.add("hidden");
      document.getElementById("signinForm").classList.remove("hidden");
    }
    function showSignup() {
      document.getElementById("signinForm").classList.add("hidden");
      document.getElementById("signupForm").classList.remove("hidden");
    }
  </script>
</head>
<body>
  <div class="container">
    <?php if($message != "") echo "<div class='msg'>$message</div>"; ?>

    <!-- Signup Form -->
    <form id="signupForm" method="POST">
      <h2>Signup</h2>
      <input type="text" name="name" placeholder="Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="signup">Signup</button>
      <div class="toggle" onclick="showSignin()">Already have an account? Signin</div>
    </form>

    <!-- Signin Form -->
    <form id="signinForm" class="hidden" method="POST">
      <h2>Signin</h2>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="signin">Signin</button>
      <div class="toggle" onclick="showSignup()">Don’t have an account? Signup</div>
    </form>
  </div>
</body>
</html>
