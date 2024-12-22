<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include 'dbconnect.php';
        $email = $_POST["email"];
        $password = $_POST['password'];
        $confirm = $_POST["confirm-password"];
        $existSql = "SELECT * FROM `login_credentials` WHERE `Email` =  '$email'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows == 0) {
            echo"<h1>You have not signed up yet,Email not found</h1>";
            header("Location: signup.php");
        }else{
            if ($password == $confirm){
                $existinsert = "UPDATE login_credentials set 'password' = '$password' where 'Email' = '$email'";
                $result1 = mysqli_query($conn, $existSql);
                header("Location: home.php");
            }else{
                echo"<script>alert('password and confirm password donot match')</script>";
                header("Location: signup.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="forgot.css">
        <title>Forgot password</title>
    </head>
    <body>
        <nav class="navbar">
            <a href="home.php">home</a>
        </nav>
        <marquee behavior="sliding" direction="left">Forgot your password, no worries!!</marquee>
        <div class="Forgot container">
            <form action="" method="post">
                <label for="">Email</label><br>
                <input type="email" name="email" required = "required"><br>
                <label for="">New Password</label><br>
                <input type="password" name="password" required = "required"><br>
                <label for="">Confirm password</label><br>
                <input type="password" name="confirm-password" required = "required"><br>
                <button type="submit">SUBMIT</button>
            </form>
        </div>
    </body>
</html>