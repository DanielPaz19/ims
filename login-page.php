<?php include_once 'header.php' ?>

<div class="loading">
  <div class="circle light"></div>
  <div class="circle dark"></div>
  <div class="branding"></div>

</div>
<center>
  <h2 style="color: white; letter-spacing: 2px;">PACC IMS</h2>
</center><br>

<div class="login">
  <form action="php/login_action.php" method="POST">
    <input type="text" id="login-username" name="username" placeholder="👤 Username" required="required" />
    <input type="password" id="login-password" name="pwd" placeholder="🔑 Password" required="required" />
    <button type="submit" name="submit" class="btn btn-primary btn-block btn-large">Login</button>
  </form>
</div>


<?php include_once 'footer.php' ?>