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
  <link rel="stylesheet" href="page_register_member.css">
  <title>Register Member</title>
</head>
<body>
  <div class="container">

  <?php
    require_once('navigation.php');
  ?>

    <div class="row mb-5">
      <div class="col-md-6">
        <div class="box">
        <h2>Register Member</h2>

        <form action="register_member.php" method="post" class="register_form" enctype="multipart/form-data">
          First Name: <input class="form-control" type="text" name="first_name"><br>
          Last Name: <input class="form-control" type="text" name="last_name"><br>
          Email: <input class="form-control" type="email" name="email"><br>
          Phone Number: <input class="form-control" type="text" name="phone_number"><br>

          Training Plan:
          <select class="form-control" name="training_plan_id">
            <option value="" disabled selected>Training Plan</option>

            <?php
              $sql = "SELECT * FROM training_plans";
              $run = $conn->query($sql);
              $results = $run->fetch_all(MYSQLI_ASSOC);

              foreach($results as $result) {
                echo "<option value='" . $result['plan_id'] . "'>" . $result['name'] . "</option>";
              }
            ?>

          </select><br>

          <input type="hidden" name="photo_path" id="photoPathInput">
          <div id="dropzone-upload" class="dropzone"></div>

          <input class="register_btn" type="submit" value="Register Member">
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