<?php
  session_start();
  if (!isset($_SESSION['loggedin'])) {
    header('location: entry.php');
    exit;
}
  if ($_SERVER["REQUEST_METHOD"] == "POST") {

      include 'dbconnect.php';
      $title = $_POST['title'];
      $purpose = $_POST['purpose'];
      $candidate1 = $_POST['candidate0'];
      $candidate2 = $_POST['candidate1'];
      $candidate3 = $_POST['candidate2'] ?? '';
      $candidate4 = $_POST['candidate3'] ?? '';
      $candidate5 = $_POST['candidate4'] ?? '';
      $email = $_SESSION['email'];
      $polldate = $_POST['PollDate'];
      $nospacetitle=preg_replace('/\s+/','',$title);
      $existSql = "SELECT * FROM `poll` WHERE `title` =  '$nospacetitle'";
      $numrows = mysqli_query($conn, $existSql);
      $numExistRows = mysqli_num_rows($numrows);
      if ($numExistRows > 0) {
        echo "<script>alert('poll title already exists! Try using another one.');</script>";
        header("location: admin.php");
      }else{
        $insertSql = "INSERT INTO poll(title,question,candidate1,candidate2,candidate3,candidate4,candidate5,email,PollDate) VALUES('$title','$purpose','$candidate1','$candidate2','$candidate3','$candidate4','$candidate5','$email','$polldate');";
      $result = mysqli_query($conn, $insertSql);
      

      if ($result){  
        $createsql = "CREATE TABLE $nospacetitle (email varchar(255), candidateVoted varchar(255),timevoted TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP);";
        $create = mysqli_query($conn, $createsql);

        if($create) {
          echo "<script>alert('poll table created');</script>";
          header("location: done.php");
        }else{
          echo "<script>alert('poll not created');</script>";
        }
      }
      }
      
  }
 ?>
 <!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="admin.css" />
    <title>Admin</title>
  </head>
  <body>
    <nav class="navbar">
      <a href="home.php">home</a>
    </nav>
    <div class="form-container">
      <form action="admin.php" id="main_form" method="post">
        <label for="">Title</label><br />
        <input
          type="text"
          required="required"
          placeholder="Enter title for your poll"
          id="Title"
          name="title"
        /><br />
        <label for="">Purpose</label><br />
        <input
          type="text"
          required="required"
          placeholder="enter poll question"
          id="Purpose"
          name="purpose"
        /><br />
        <label for="">Poll Date</label><br />
        <input
          type="date"
          required="required"
          placeholder="enter poll date"
          id="PollDate"
          name="PollDate"
        /><br />

        <!-- <form action="" id="num_form"> -->
          <label for="">Number of Candidates</label>
          <input type="number" name="" id="Num" />
        <!-- </form> -->
        <div id="candidates"></div>
        <button type="submit" id="submit" name="submit">Submit</button>
      </form>
    </div>
    <div class="polls">
      <h1>CHECK YOUR POLLS HERE</h1>
      <button class="redirecter" onclick="window.location = './admin-polls.php'">POLLS</button>
    </div>
    <script src="admin.js"></script>
  </body>
</html>


