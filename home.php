<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('location: entry.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>homepage</title>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link rel='stylesheet' type='text/css' href='home.css'>
        <?php
        require 'nav.php';
        ?>
    </head>
    <body>
        <div class='button-container'>
            <button onclick="window.location = './admin.php'" class='password'>Admin</button><br>
            <button onclick="window.location = './voter.php'" class='password'>Voter</button>
            <button onclick="window.location='./password/password.php'" class="password">Password-Protected-poll</button>
            <button onclick="window.location='./password/password-protected.php'" class="password">Password-Protected-vote</button>
            <button onclick="window.location='./upcoming/upcoming-polls.php'" class="password">Upcoming-polls</button>
        </div>
        <footer class='footer'>
            <p>Connect with the creator</p>
            <a href='https://www.instagram.com/_mayank_arora_25/'><i style='font-size:24px' class='fa'>&#xf16d;</i></a>
        </footer>
    </body>
</html>



