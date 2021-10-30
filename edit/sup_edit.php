<?php

include('../php/config.php');

if (isset($_POST['sup_submit'])) {
  $id = $_POST['id'];
  $sup_name = mysqli_real_escape_string($db, $_POST['sup_name']);
  $sup_conper = mysqli_real_escape_string($db, $_POST['sup_conper']);
  $sup_tel = mysqli_real_escape_string($db, $_POST['sup_tel']);
  $sup_address = mysqli_real_escape_string($db, $_POST['sup_address']);
  $sup_email = mysqli_real_escape_string($db, $_POST['sup_email']);
  $sup_tin = mysqli_real_escape_string($db, $_POST['sup_tin']);




  mysqli_query($db, "UPDATE sup_tb SET sup_name='$sup_name', sup_conper='$sup_conper' ,sup_tel='$sup_tel' ,sup_address='$sup_address' ,sup_email='$sup_email', sup_tin='$sup_tin' WHERE sup_id='$id'");

  header("Location:../sup_main.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

  $id = $_GET['id'];
  $result = mysqli_query($db, "SELECT * FROM sup_tb WHERE sup_id=" . $_GET['id']);

  $row = mysqli_fetch_array($result);

  if ($row) {

    $id = $row['sup_id'];
    $sup_name = $row['sup_name'];
    $sup_conper = $row['sup_conper'];
    $sup_tel = $row['sup_tel'];
    $sup_address = $row['sup_address'];
    $sup_email = $row['sup_email'];
    $sup_tin = $row['sup_tin'];
  } else {
    echo "No results!";
  }
}
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<style>
  .con-form {
    font-family: Arial, Helvetica, sans-serif;
    border: 1px;
    color: midnightblue;
  }

  .butLink {

    background-color: midnightblue;
    border-radius: 4px;
    color: white;
    padding: 7px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
  }

  .center {
    margin: auto;
    width: 100%;
    height: 1050px;
    padding: 100px;
    border-radius: 5px;
    background-color: #EAEAEA;
  }
</style>
<title>Edit Supplier</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body bgcolor="green">
  <div class="con-form">
    <div class="center">
      <a href="../sup_main.php"><i class="fa fa-close" style="font-size:24px; float:right; color:red;"></i><a>
          <div class="con-form">
            <h2>Edit Supplier Records</h2>
            <form method="post">
              <input type="hidden" name="id" value="<?php echo $id; ?>" />

              <table width="100%">
                <tr>
                  <td width="179"><b>
                      <font color='midnightblue'>Supplier Name<em>*</em></font>
                    </b></td>
                  <td width="80%"><label>
                      <input type="text" class="form-control" size="80%" name="sup_name" value="<?php echo $sup_name; ?>" />
                    </label></td>
                </tr>

                <tr>
                  <td width="179"><b>
                      <font color='midnightblue'>Contact Person<em>*</em></font>
                    </b></td>
                  <td><label>
                      <input type="text" class="form-control" name="sup_conper" value="<?php echo $sup_conper; ?>" />
                    </label></td>
                </tr>

                <tr>
                  <td width="179"><b>
                      <font color='midnightblue'>Telephone<em>*</em></font>
                    </b></td>
                  <td><label>
                      <input type="text" class="form-control" name="sup_tel" value="<?php echo $sup_tel; ?>">
                    </label></td>
                </tr>


                <tr>
                  <td width="179"><b>
                      <font color='midnightblue'>Address<em>*</em></font>
                    </b></td>
                  <td><label>
                      <input type="text" class="form-control" name="sup_address" value="<?php echo $sup_address; ?>" />
                    </label></td>
                </tr>

                <tr>
                  <td width="179"><b>
                      <font color='midnightblue'>Email<em>*</em></font>
                    </b></td>
                  <td><label>
                      <input type="email" class="form-control" name="sup_email" value="<?php echo $sup_email; ?>" />
                    </label></td>
                </tr>


                <tr>
                  <td width="179"><b>
                      <font color='midnightblue'>Tin<em>*</em></font>
                    </b></td>
                  <td><label>
                      <input type="text" class="form-control" name="sup_tin" value="<?php echo $sup_tin; ?>" />
                    </label></td>
                </tr>


                <tr>
                  <td width="179"><input type="submit" class="butLink" name="sup_submit" value="Update"></td>
                  <td><label>
                    </label></td>
                </tr>


              </table>
            </form>
</body>

</html>