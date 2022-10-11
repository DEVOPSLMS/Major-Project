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
            
            $sql = "SELECT * FROM student WHERE status='Enrolled'";
            $result = $connection->query($sql);

            while($row = $result->fetch_assoc()){
                echo "<tr>
                <td>" . $row["student_name"] . "</td>
                <td>" . $row["centre_name"] . "</td> 
                <td>" . $row["student_level"] . "</td>
                <td>
                    <button class='btn btn-success editbtn' type='submit' name='submit' style='background-color:#5EBEC4;color:black;border-color:#5EBEC4;' >Transfer</button>
                    <button class='btn btn-success deletebtn' type='submit' name='submit' style='background-color:#5EBEC4;color:black;border-color:#5EBEC4;' >Remove</button>
                </td>
            </tr>";
            }
            ?>
        </tbody>
    </table>
  </body>

    <!-- Transfer student modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Transfer student </h5>
                </div>

                <form action="transferstudent.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="update_id" id="update_id">
                        <div class="form-group">

                        <label> Location </label>
                            <select class="col-sm-10 form-select" id="centre_name" name="centre_name" required>
                                <option selected></option>
                                <option value="Hougang Centre">Hougang Centre</option>
                                <option value="Sengkang Centre">Sengkang Centre</option>
                                <option value="Punggol Centre">Punggol Centre</option>
                                <option value="Fernvale Centre">Fernvale Centre</option>
                                <option value="Teck Ghee Centre">Teck Ghee Centre</option>
                                <option value="Kolam Ayer Centre">Kolam Ayer Centre</option>

                    </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class='btn btn-success' type="submit" name="updatedata" name='submit' style='background-color:#5EBEC4;color:black;border-color:#5EBEC4;'>Update centre</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

        <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
        <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Remove student data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="removestudent.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4>Are you sure you want to remove student data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button class='btn btn-success' type="submit" name="updatedata" name='submit' style='background-color:#5EBEC4;color:black;border-color:#5EBEC4;'>Remove</button>
                    </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#centre_name').val(data[1]);
            });
        });
    </script>

<script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>

</html>