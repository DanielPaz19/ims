<?php
if (isset($_POST['submit'])) {
  $userName = $_POST['username'];
  $pwd = $_POST['pwd'];

  require_once 'php/config.php';

  $sql = "SELECT * FROM user WHERE user_name = '$userName'";
  $result = mysqli_query($db, $sql);

  // Check username and password
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      if ($pwd !== $row['user_pass']) {
        header("location: index.php?error=invalidpwd");

        exit();
      }

      session_start();
      $_SESSION['user'] = $row['user_name'];
      $_SESSION['level'] = $row['user_level'];

      header("location: home2.php");
      exit();
    }
  } else {
    header("location: index.php?error=username");
    exit();
  }
}
