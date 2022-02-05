<?php
if (isset($_POST['submit'])) {
    $userName = $_POST['username'];
    $pwd = $_POST['pwd'];

    require_once 'config.php';

    $sql = "SELECT user.user_id, user.user_name, user.user_pass, user.user_level, employee_tb.emp_name, employee_tb.emp_id
          FROM user 
          INNER JOIN employee_tb ON user.emp_id = employee_tb.emp_id
          WHERE user_name = '$userName'";


    $result = mysqli_query($db, $sql);

    // Check username and password
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($pwd !== $row['user_pass']) {
                header("location: ../../login-page.php?error=invalidpwd");

                exit();
            }

            session_start();
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['empName'] = $row['emp_name'];
            $_SESSION['user'] = $row['user_name'];
            $_SESSION['level'] = $row['user_level'];

            if ($_SESSION['level'] == 1) {
                header('location: ../../index.php');
                exit();
            }
            if ($_SESSION['level'] == 2) {
                header("Location: ../pos/index.php");
                exit();
            }

            if ($_SESSION['level'] == 3) {
                header("Location: ../pos/test1.php");
                exit();
            }

            if ($_SESSION['level'] == 99) {
                header("Location: ../endday/index.html");
                exit();
            }

            // else{
            //  echo "<script>alert('Invalid Username  or Password !');
            // window.location='index.php';
            // </script>";
            // }



            exit();
        }
    } else {
        header("location: ../login-page.php?error=username");
        exit();
    }
}
