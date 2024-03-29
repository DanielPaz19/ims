<?php

include_once 'header.php';
if (isset($_SESSION['user'])) {
  header("location: php/logout-inc.php");
}
?>

<style>
  @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,600,700);

  *,
  *:after,
  *:before {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    font-weight: normal;
    margin: 0;
    outline: 0 none;
    font-family: "Open Sans";
    padding: 0;
  }

  /* body {
      background: #007CC8;
      font-family: "Open Sans";
    } */

  .loading {
    margin: 10% auto 15px;
    position: relative;

    height: 40px;
    width: 40px;
  }

  .loading .circle {
    border-radius: 100%;
    position: absolute;
  }

  .loading .circle.dark {
    background-color: #1F5BA9;
    height: 22px;
    left: 1px;
    top: 10px;
    width: 22px;
  }

  .loading .circle.light {
    background-color: #61B5E4;
    height: 25px;
    right: 1px;
    top: 8px;
    width: 25px;
  }

  .loading .branding {
    background: url("https://s18.postimg.org/8a4d3vj3p/db_loader.png") repeat scroll 0 0 transparent;
    height: 40px;
    width: 40px;
    position: absolute;
  }

  .login {
    width: 300px;
    margin: 0 auto;
  }

  .login form {
    width: 100%;
  }

  input {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-radius: 4px 4px 4px 4px;
    box-shadow: 0 -5px 45px rgba(100, 100, 100, 0.2) inset, 0 1px 1px rgba(255, 255, 255, 0.2);
    color: #FFFFFF;
    font-size: 13px;
    margin-bottom: 10px;
    outline: medium none;
    padding: 10px;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
    width: 100%;
  }

  ::placeholder {
    color: white;
    letter-spacing: 2px;
  }

  button.btn-primary {
    background: linear-gradient(to bottom, midnightblue 0px, #0075BC 100%) repeat scroll 0 0 transparent;
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-bottom: 1px solid rgba(0, 0, 0, 0.55);
    border-radius: 6px 6px 6px 6px;
    box-shadow: 0 1px 0 #E6F5FF inset;
    color: #FFFFFF;
    cursor: pointer;
    display: block;
    margin: 0 auto;
    padding: 10px 25px;
    text-shadow: 0 1px rgba(0, 0, 0, 0.3);
    width: 100%;
    letter-spacing: 3px;
  }
</style>

<div class="loading">
  <div class=""></div>
  <div class=""></div>
  <div class="branding"></div>

</div>
<center>
  <img src="img/pacclogo.png" style="width: 85px; height: 80px">
  <h2 style="color: midnightblue; letter-spacing: 2px; text-shadow: 1px 1px midnightblue;">PACC IMS</h2>
</center><br>

<div class="login">
  <form autocomplete="off" action="php/login-inc.php" method="POST">
    <input type="text" id="login-username" name="username" placeholder="👤 Username" required="required" />
    <input type="password" id="login-password" name="pwd" placeholder="🔑 Password" required="required" />
    <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Login</button>
  </form>
</div>