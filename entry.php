<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
     session_start();
     if (isset($_SESSION['loggedin'])) {
        header('location: home.php');
        exit;
    }
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
         include 'dbconnect.php';
         $email = $_POST["email"];
         $password = $_POST['password'];
         $existSql = "SELECT * FROM `login_credentials` WHERE `Email` =  '$email'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        $_SESSION['email'] = $email;
        if ($numExistRows == 0) {
            echo "<script>alert('E-mail doesn't exist, Please Signup.');</script>";
            header("Location: signup.php");
        }else{
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['password'])) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    header("Location: home.php");
                    exit;
                }else{
                    echo "<script>alert('Could not log you in, Try Again!');</script>";
                    header("Location: entry.php");
                    exit;
                }
            }
        }
     }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>homepage</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet' type='text/css' href='./entry.css'>
    </head>
    <body>
        <nav class='navbar'>
            <a href='about.php' class='about'>About</a>
            <a href='signup.php' class='about'>SignUp</a>
        </nav>
        <div class='form-container'>
        <form action='' method = "post">
                <label for=''>Email</label><br>
                <input type='email' name='email' required="required"><br>
                <label for=''>Password</label><br>
                <input type='password' name = 'password' required="required"><br>
                <button type='submit'>Submit</button>
            </form>
            <a href="forgot.php" class="forgot">forgot</a>
        </div>
        <footer class='footer'>
            <p>Connect with the creator</p>
            <a href='https://www.instagram.com/_mayank_arora_25/'><i style='font-size:24px' class='fa'>&#xf16d;</i></a>
        </footer>
    </body>
</html>