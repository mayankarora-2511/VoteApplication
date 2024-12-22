<?php
session_start();
include "dbconnect.php";
$email = $_SESSION['email'];
$sql = "SELECT * FROM poll WHERE email='$email';";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="admin-polls.css" />
    <title>Admin</title>
  </head>
  <body>
  <div class="main">
    <form action="" method="post">
  <select id="options" name="options">
  <?php
  if (mysqli_num_rows($result) > 0){
    while ($row_num = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row_num["title"].'" name = "title">' . $row_num["title"] . '</option>';
    }}
            ?>
            </select><br>
            <input type="submit" value="submit" name="submit" class='btn'></input>
            <input type="submit" value="delete" name="delete" class='btn'></input>
            </form>
    </div>
    <div class="results">
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['submit'])){
        $title = $_POST['options'];
    $nospacetitle = preg_replace('/\s+/','',$title);
    $responses = "SELECT * FROM $nospacetitle;";
    $responses_rows = mysqli_query($conn , $responses);
    if (mysqli_num_rows($responses_rows) == 0) {
        echo "<h1>No responses for the $title</h1>";
    }else{
        echo '<table>';
        echo '<tr>
                <th>Email</th>
                <th>candidate voted</th>
                <th>time</th>
            </tr>';
        while ($row = mysqli_fetch_assoc($responses_rows)){
            echo '<tr>
            <td>'.$row['email'].'</td>
            <td>'.$row['candidateVoted'].'</td>
            <td>'.$row['timevoted'].'</td>
        </tr>';
        }
        echo '</table>';
    }
    }else if (isset($_POST['delete'])){
        $title = $_POST['options'];
        $nospacetitle = preg_replace('/\s+/','',$title);
        $delete = "DELETE FROM poll where title = '$title'";
        $tabledrop = "DROP TABLE $nospacetitle;";
        $result1 = mysqli_query($conn , $tabledrop);
        $result2 = mysqli_query($conn , $delete);
        if ($result2 && $result1){
            header("location: done.php");
        }
    }
}
?>
</div>
    <footer class="footer">
        <a href="admin.php">admin</a><br>
        <a href = "./password/password.php">password protected poll</a>
    </footer>
  </body>
  </html>

