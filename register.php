<?php include_once 'header.php';

if (!isset($_SESSION['user'])) {
    header("location: login.php");
    exit();
}

if ($_SESSION['level'] !== '1') {
    header("location: login.php?access=denied");
    exit();
}
?>

<div class='container--add__user'>
    <h1>ADD USER</h1>
    <form action="php/adduser-inc.php" method="POST">
        <input type="text" name='username' placeholder="Username..."></br>
        <input type="password" name='pwd' placeholder="Password..." minlength="6"></br>
        <input type="password" name='repeatpwd' placeholder="Repeat Password..."></br>
        <select name="level" id="levels">
            <option value="">Select Level...</option>
            <option value="1">master</option>
            <option value="2">admin</option>
            <option value="3">user</option>
        </select><br>
        <input type="submit" name='submit'>
    </form>
</div>

<?php include_once 'footer.php'; ?>