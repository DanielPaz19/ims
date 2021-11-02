<html>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<title>Philippine Acrylic & Chemical Corporation </title>
<link rel="icon" href="img/pacclogo.png" type="image/x-icon">
<style>
  .con-form {
    font-family: Arial, Helvetica, sans-serif;
    border: 1px;
    padding: 40px;
    vertical-align: top;
    color: midnightblue;
    background-color: #EAEAEA;
    height: 100%;
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
    width: inherit;
    padding: 20px;
    border-radius: 5px;
  }

  .form-control {
    border: 1px solid gray;
  }
</style>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">


<!--ADD SUPLIER-->
<div class="con-form">
  <div class="center">
    <fieldset>
      <legend style="color:midnightblue;">Create New Supplier</legend>
      <form autocomplete="off" method="POST" class="form-inline" action="sup_add.php">

        <label for="name"><b>Supplier Name:</b></label>&nbsp&nbsp
        <input required="text" type="text" class="form-control" name="sup_name" size="50%">
        <br>
        <label for="name"><b>Contact Person:</b></label>&nbsp&nbsp
        <input required="text" type="text" class="form-control" name="sup_conper">
        <br>
        <label for="name"><b>Telephone:</b></label>&nbsp&nbsp
        <input required="text" type="text" class="form-control" name="sup_tel">
        <br>
        <label for="name"><b>Address:</b></label>&nbsp&nbsp
        <input required="text" type="text" class="form-control" name="sup_address" size="50%">
        <br>
        <label for="name"><b>Email:</b></label>&nbsp&nbsp
        <input type="email" class="form-control" name="sup_email">
        <br>

        <label for="name"><b>Tin</b></label>&nbsp&nbsp
        <input type="text" class="form-control" name="sup_tin">
        <br>

        <button type="submit" class="butLink" name="add_sup" style="width: 100%;"><span><b>Save</b></span></button>



      </form>
    </fieldset>
  </div>
  <!--ADD SUPLIER END-->

  </body>

</html>