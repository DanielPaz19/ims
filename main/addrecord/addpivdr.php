<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add PIVDR Records</title>
    <link rel="icon" href="img/pacclogo.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- <link rel="stylesheet" href="css/pos-page.css" /> -->
    <style>
        body {
            padding: 5%;
        }

        fieldset {
            padding: 1%;
            font-family: sans-serif;
            border: none;
            height: 97vmax;
        }

        legend {
            letter-spacing: 3px;
            font-weight: bolder;
            color: midnightblue;
            font-size: 24px;
        }

        label {
            color: black;
            font-weight: bold;
        }

        h2 {
            letter-spacing: 3px;
            font-size: xx-large;
        }

        * {
            box-sizing: border-box;
            font-family: monospace;
        }

        input[type=text],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }

        input[type=date] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
            font-size: x-large;
        }

        button {
            background-color: midnightblue;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 40%;
            font-size: larger;
        }

        button:hover {
            background-color: mediumblue;
        }

        .container {
            border-radius: 5px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {

            .col-25,
            .col-75,
            input[type=submit] {
                width: 100%;
                margin-top: 0;
            }
        }
    </style>



</head>

<body bgcolor="#F5F5F5">
    <div class="Incontainer">
        <div class="inDetails">


            <div class="container">
                <h2>PIVDR: Entering Record</h2>
                <form action="addpivdr_inc.php" method="GET">
                    <label>Customer :</label>
                    <select name="customers_id" required>
                        <option>--- Select Customer ---</option>
                        <?php
                        include "../../php/config.php";
                        $records = mysqli_query($db, "SELECT * FROM customers ORDER BY customers_name ASC");

                        while ($data = mysqli_fetch_array($records)) {
                            echo "<option value='" . $data['customers_id'] . "'>" . $data['customers_name'] . "</option>";
                        }
                        ?>
                    </select>
                    <br>

                    <label>DR No. </label>&emsp;&emsp;&emsp;
                    <input type="text" name="drNo" required>
                    <br>
                    <label>SI No. </label> &emsp;&emsp;&emsp;
                    <input type="text" name="siNo" required>
                    <br>
                    <label>OR No. </label> &emsp;&emsp;&emsp;
                    <input type="text" name="orNo" required>
                    <br>
                    <label>Remarks</label> &emsp;&emsp;&emsp;
                    <textarea name="remarks" id="" cols="30" rows="5"></textarea>
                    <br>
                    <br>
                    <label>Date</label> &emsp;&emsp;&emsp;
                    <input type="date" name="date" required>
                    <br><br>
                    <center>
                        <button name="save">Save</button>
                    </center>
                </form>


            </div>
        </div>
    </div>

</body>

</html>