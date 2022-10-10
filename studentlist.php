<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List of students</title>

<header>
    <?php include("header.php") ?>
</header>

<style>
    @media(max-width:500px) {
            .btn {
 
                /* It hides the button text
                when screen size <=768px */
                display: none;
            }
        }
    h1 {text-align: center;}
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>

  <body>
    <a href="index.php">
    <button class="btn btn-primary text-center" type="submit" name="submit" style="background-color:#5EBEC4;color:black;border-color:#5EBEC4;float:left;margin-left:30px;margin-top:10px;width:100px ;">Back</button>
    </a>
    <h1 >List of Students</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Student name</th>
                <th>Location</th>
                <th>Primary</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "website";

            $connection = new mysqli($servername, $username, $password, $database);
            
            $sql = "SELECT * FROM student";
            $result = $connection->query($sql);

            while($row = $result->fetch_assoc()){
                echo "<tr>
                <td>" . $row["student_name"] . "</td>
                <td>" . $row["centre_name"] . "</td> 
                <td>" . $row["student_level"] . "</td>
                <td>
                
                    <button class='btn btn-primary text-center' type='submit' name='submit' style='background-color:#5EBEC4;color:black;border-color:#5EBEC4;' >Transfer</button>

                </td>
            </tr>";
            }
            ?>
        </tbody>
    </table>
  </body>
</html>