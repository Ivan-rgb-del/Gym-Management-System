<?php

  require_once('config.php');

  if (!isset($_SESSION['admin_id'])) {
    header("location: index.php");
    exit;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
  <link rel="stylesheet" href="page_register_trainer.css">
  <title>Register Trainer</title>
</head>
<body>

  <div class="container">

  <?php
    require_once('navigation.php');
  ?>

    <div class="row mb-5">
      <div class="col-md-6">
        <div class="box">
        <h2>Register Trainer</h2>
        <form action="register_trainer.php" method="POST">
          First Name: <input class="form-control" type="text" name="first_name"><br>
          Last Name: <input class="form-control" type="text" name="last_name"><br>
          Email: <input class="form-control" type="email" name="email"><br>
          Phone Number: <input class="form-control" type="text" name="phone_number"><br>

          <input type="hidden" name="photo_path" id="photoPathInput">
          <div id="dropzone-upload" class="dropzone"></div>

          <input class="register_btn" type="submit" value="Register Trainer">
        </form>
        </div>
      </div>
    </div>
  </div>

  <?php $conn->close(); ?>

  <!-- Dropzone -->
  <?php
    require_once('dropzone.php');
  ?>

</body>
</html>