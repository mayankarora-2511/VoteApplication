<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('location: entry.php');
    exit;
}
include "dbconnect.php";
$date = date("Y-m-d");
$sql = "SELECT * FROM poll where password is null and PollDate <= '$date';";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="voter.css">
    <title>Vote</title>
</head>
<body>
    <nav class="navbar">
        <a href="home.php">home</a>
    </nav>
    <div class="main">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '
                    <div class="vote">
                        <form action="" method="post">
                        <input type="hidden" value="'.$row["title"].'" name="title">
                        <input type="hidden" value="'.$row["email"].'" name="email">
                        <h1>' . $row["title"] . '</h1>
                        <label for="options"><h3>' . $row["question"] . '</h3></label>
                        <h4>Date hosted: ' . $row["PollDate"] . '</h4></label>
                        <select id="options" name="options">
                            <option value="'.$row["candidate1"].'">' . $row["candidate1"] . '</option>
                            <option value="'.$row["candidate2"].'">' . $row["candidate2"] . '</option>
                            <option value="'.$row["candidate3"].'">' . $row["candidate3"] . '</option>
                            <option value="'.$row["candidate4"].'">' . $row["candidate4"] . '</option>
                            <option value="'.$row["candidate5"].'">' . $row["candidate5"] . '</option>
                        </select>
                        <br>
                        <button type="submit" name="submit" id="btn">Submit</button>
                        </form>
                    </div>';
            }}
            ?>
    </div>
        </body>
        </html>

<?php

$sql = "SELECT * FROM poll;";
$result = mysqli_query($conn, $sql);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $nospacetitle = preg_replace('/\s+/','',$title);
    $email = $_SESSION['email'];
    $check = "SELECT * FROM $nospacetitle WHERE email='$email';";
    $voted = mysqli_query($conn , $check);
    $number = mysqli_num_rows($voted);
    $selected = $_POST['options'];
    
    if ($number > 0){
        echo"<script>alert('YOU HAVE ALREADY VOTED ONCE')</script>";
    }else{
        $query = "INSERT INTO $nospacetitle (email, candidateVoted) VALUES('$email', '$selected');";
        $inserted = mysqli_query($conn , $query);
        if (!$inserted) {
            echo "Error: " . $conn->error;
        }else{
            header("location: done.php");
        }
    
}
}
?>
