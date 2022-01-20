<?php include_once 'header.php'; ?>

<div class="container--login">
  <h1>LOG-IN</h1>
  <form action="php/login-inc.php" method="POST">
    <input type="text" name="username" placeholder="Username..."> <br>
    <input type="password" name="pwd" placeholder="Password..."> <br>
    <input type="submit" name="submit">
  </form>
</div>

<?php include_once 'footer.php'; ?>