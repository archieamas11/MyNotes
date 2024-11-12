<!DOCTYPE html>
<html>
<<<<<<< HEAD

=======
>>>>>>> upstream/main
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <link rel="stylesheet" href="mes1.css">
</head>
<<<<<<< HEAD

<body>

    <header>
        <div class="noteit">
            <h1 class="white">Note<span class="green">IT</span></h1>
        </div>
        <nav class="navigation">
            <a href="home.php">HOME</a>
            <a href="register.php">REGISTER</a>
            <a href="index.php">SIGNIN</a>
            <!-- <a href="dashBoard.php">Services</a> -->
        </nav>
    </header>

    <div class="wrapper">
        <div class="form-box register">
            <div class="noteit">
                <h1 class="white">Note<span class="green">IT</span></h1>
            </div>
            <form action="query/insert_user.php" method="post">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon></span>
                    <input type="email" name="name" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <!-- <label><input type="checkbox">
                Remember me</label> -->
                    <!-- <a href="#">Forgot Password</a> -->
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-register">
                    <p>Already Have an Account?<a href="index.php" class="register-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
=======
<body>

<header>
    <div class="noteit">
        <h1 class="white">Note<span class="green">IT</span></h1>
    </div>
    <nav class="navigation">
        <a href="home.php">HOME</a>
        <a href="register.php">REGISTER</a>
        <a href="index.php">SIGNIN</a>
        <!-- <a href="dashBoard.php">Services</a> -->
    </nav>
</header>

<div class="wrapper">
    <div class="form-box register">
        <div class="noteit">
        <h1  class="white">Note<span class="green">IT</span></h1>
        </div>
        <form action="query/insert_user.php" method="post">
            <div class="input-box">
                <span class="icon">
                <ion-icon name="mail"></ion-icon></span>
                <input type="email" name="name" required>
                <label>Email</label>
            </div>
            <div class="input-box">
                <span class="icon">
                <ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="remember-forgot">
                <!-- <label><input type="checkbox">
                Remember me</label> -->
                <!-- <a href="#">Forgot Password</a> -->
            </div>
            <button type="submit" class="btn">Register</button>
            <div class="login-register">
                <p>Already Have an Account?<a href="#" class="register-link">Login</a></p>
            </div>
        </form>
        
    </div>
    
</div>

<script src="script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
>>>>>>> upstream/main
