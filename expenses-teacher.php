<?php
session_start();
include("check_roster.php");
include("check_teacher.php");
include("connection.php");
include("functions.php");
include("check_attendance.php");
include("insert-payslip.php");
$user_data = check_login($con);
$username=$user_data['username'];
if (isset($_POST["submit"])) {
    $username=$user_data['username'];
    $price=$_POST['price'];
    $purpose=$_POST['purpose'];
    $image = $_FILES["image"];
    $reference = random_num(15);
    $date=date("Y-m-d");
    if ($_FILES["image"]["error"] == 4) {
        echo
        "<script> alert('Image Does Not Exist'); </script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo
            "
        <script>
          alert('Invalid Image Extension');
        </script>
        ";
        } else if ($fileSize > 1000000) {
            echo
            "
        <script>
          alert('Image Size Is Too Large');
        </script>
        ";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'expenses/' . $newImageName);

            $query = "insert into expenses(name,purpose,price,image,status,reference,date) values ('$username','$purpose','$price','$newImageName','false','$reference','$date')";

            mysqli_query($con, $query);

            echo
            "
        <script>
          alert('Successfully Added');
          document.location.href = 'expenses-teacher.php';
        </script>
        ";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Submit Expenses</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<header>
    <?php include("header.php") ?>
</header>
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>

<body>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div class="container">
        <div class="card">
            <div class="card-header" >
                Expenses
            </div>
            <div class="card-body">
                <form id="form" method="POST" enctype="multipart/form-data" class="needs-validation " style="margin:auto;" autocomplete="off">
                    <div class="mb-3">
                        <label> Name Of Staff: </label>
                        <input type="text" class="form-control "disabled  id="exampleFormControlInput1" name="name" value="<?php echo$username?>" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                        <div class="invalid-tooltip">
                            Please choose a unique and valid username.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image">Proof : </label>
                        <input type="file" name="image" id="image" required accept=".jpg, .jpeg, .png" value="">
                    </div>
                    <div class="mb-3">
                        <label> Price: </label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="price"value="$" ></input>
                    </div>
                    <div class="mb-3">
                        <label> Purpose Of Purchase: </label>
                        <textarea type="text" class="form-control" id="exampleFormControlInput1" name="purpose" ></textarea>
                    </div>





                    <div class="col-lg-12">
              
                    <button class="btn text-center" type="submit" name="submit"style="font-size:15px;float:right;">Submit Expenses</button>
                    </div>
                   

                </form>
            </div>
        </div>
    </div>
</body>

</html>