<?php
include 'query/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; // Assuming the email is stored in the email field
    $password = $_POST['password'];

    try {
        // Check if the user exists
        $checkUserSql = "SELECT * FROM table_user WHERE name = :email"; 
        $checkUserStmt = $conn->prepare($checkUserSql);
        $checkUserStmt->bindParam(':email', $email);

        $checkUserStmt->execute();

        $user = $checkUserStmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            echo '<script>alert("Invalid Credentials"); window.location.href="login.php";</script>';
            exit();
        }

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Redirect to the dashboard with additional data
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: dashboard_page.php");
            exit();
        } else {
            echo '<script>alert("Invalid Credentials"); window.location.href="login.php";</script>';
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if ($conn) {
            $conn = null;
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="mes1.css">
</head>
<body>
    <header>
        <div class="noteit">
        <h1  class="white">Note<span class="green">IT</span></h1>
        </div>
        <nav class="navigation">
            <a href="home.php">HOME</a>
            <a href="register.php">REGISTER</a>
            <a href="login.php">SIGNIN</a>
            <!-- <a href="dashBoard.php">Services</a> -->
        </nav>
    </header>
    <div class="wrapper">
        <div class="form-box login">
            <div class="noteit">
                <h1 class="white">Note<span class="green">IT</span></h1>
            </div>
            <form action="login.php" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="email" required>
                    <!-- <div> -->
                    <label>Email</label>
<!-- </div> -->
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#">Forgot Password</a>
                </div>
                <button type="submit" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't Have an Account? <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
