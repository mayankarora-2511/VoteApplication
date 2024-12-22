<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        include 'dbconnect.php';
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
      
        $existSql = "SELECT * FROM `login_credentials` WHERE `Email` =  '$email'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if ($numExistRows > 0) {
            $showError = 'Email already exists';
            echo "<script>alert('E-mail already exists! Try using another one or Login into your account.');</script>";
          }else {
              $hash = password_hash($password, PASSWORD_DEFAULT);
              $insertSql = "INSERT INTO login_credentials(FirstName,LastName,Email,password) VALUES('$fname','$lname','$email','$hash');";
              $insertResult = mysqli_query($conn, $insertSql);
              if ($insertResult) {
                echo "<script>alert('Account Created');</script>";
                session_start();
                header("Location: home.php");
            }
            }
    }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel='stylesheet' href='signup.css'>
        <title>signup</title>
    </head>
    <body>
        <nav class='navbar'>
            <a href='./home.php' class='home'>Home</a>
        </nav>
        <div class='form-container'>
            <h1>Sign Up</h1>
            <form action='signup.php' method="post">
                <label for=''>First Name</label><br>
                <input type='text' required='required' name="fname" id="fname"><br>
                <label for=''>Last Name</label><br>
                <input type='text' required='required' name="lname" id="lname"><br>
                <label for=''>Email</label><br>
                <input type='email' required='required' name="email" id="email"><br>
                <label for=''>Password</label><br>
                <input type='password' name="password" id="password" required="required"><br>
                <button type='submit' name="submit" id="submit">Submit</button>
            </form>
            <p>Already have an account , <a href='./home.php'>Home!</a></p>
        </div>
    </body>
</html>