<!DOCTYPE html>
<html>

<head>
  <title>Jquery Fullcalandar CRUD(Create, Read, Update, Delete) with PHP Jquery Ajax and Mysql</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

</head>

<body>
<form method='post'>
<?php
for ($i = 1; $i <= 3; $i++) {
    ?>
        <input type="radio" name="num<?php echo $i; ?>" value="one">One
        <input type="radio" name="num<?php echo $i; ?>" value="two">Two<br>
        <input type="radio" name="num<?php echo $i; ?>" value="three">Three<br>
    <?php
}
?>
<input type = 'submit' value = 'Go'>
</form>

<?php
for ($i = 1; $i <= 3; $i++) {
    echo $_POST['num' . $i];
}
?>
</body>

</html>