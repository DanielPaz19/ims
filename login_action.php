<?php
include("log_connect.php"); 
$tbl_name="user_levels"; 

$username=$_POST['username']; 
$password=$_POST['password']; 

$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($dbhandle,$username);
$password = mysqli_real_escape_string($dbhandle,$password);

$result = mysqli_query($dbhandle, "SELECT * FROM $tbl_name WHERE username='$username' AND password='$password'");

if(mysqli_num_rows($result) != 1){
      echo "<script>alert('Invalid Username or Password ');
      window.location='index.php';
      </script>";
     }else{
      $row = mysqli_fetch_assoc($result); 
      if($row['userlevel'] == 1)
      {
        echo "<script>alert('Account Login Successfully !');
      window.location='home.php';
      </script>";
      
      }else if($row['userlevel'] == 2 ){
       echo "<script>alert('Account Login Successfully !');
      window.location='home2.php';
      </script>";

      }else if($row['userlevel'] == 3 ){
       echo "<script>alert('Account Login Successfully !');
      window.location='../pos/index.html';
      </script>";
      }
      else if($row['userlevel'] == 4 ){
      echo "<script>alert('Login Successful ! ');
      window.location='user-item.php';
      </script>";
      }
      else{
       echo "<script>alert('Invalid Username  or Password !');
      window.location='index.php';
      </script>";
      }
     }

?>