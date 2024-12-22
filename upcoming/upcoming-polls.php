<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('location: entry.php');
  exit;
}
include '../dbconnect.php';
$date = date("Y-m-d");
$query = "SELECT * FROM poll WHERE PollDate > '$date' AND PollDate != '$date';";
$response = mysqli_query($conn , $query);
?>
<html>
    <head>
        <link rel="stylesheet" href="upcoming.css">
        <title>Upcoming polls</title>
    </head>
    <body>
    <nav class="navbar">
      <a href="../home.php">home</a>
    </nav>
    <?php
        if (mysqli_num_rows($response) > 0) {
            while ($row = mysqli_fetch_assoc($response)) {
                $password = $row['password'];
                echo '
                    <div class="vote">
                        <marquee><h1>' . $row["title"] . '</h1></marquee>
                        <h3>DATE: ' . $row["PollDate"] . '</h3>
                        <h4>Following candidates are going to appear for the ' . $row["title"] . '</h4>
                        <ul>
                            <li>' . $row["candidate1"] . '</li>
                            <li>' . $row["candidate2"] . '</li>
                            <li>' . $row["candidate3"] . '</li>
                            <li>' . $row["candidate4"] . '</li>
                            <li>' . $row["candidate5"] . '</li>
                        </ul>
                        ';
                        if ($password != null){
                            echo '<p class = "password">***Password will be required***</p>';
                        };
                    echo'
                    </div>';
            }}
            ?>
    </body>
</html>