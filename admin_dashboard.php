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
  <link rel="stylesheet" href="admin_dashboard.css">
  <title>Admin Dashboard</title>
</head>
<body>

<div class="container">

  <!-- Message -->
  <?php if (isset($_SESSION['success_message'])) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php
        echo $_SESSION['success_message'];
        unset($_SESSION['success_message']);
      ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- Navigation -->
  <?php
    require_once('navigation.php');
  ?>

    <div class="row">
      <!-- Table for members -->
      <div class="col-md-12">
        <?php
          require_once('member_list.php');
        ?><br><br>
      </div>

      <!-- Table for trainers -->
      <div class="col-md-12">
        <?php
          require_once('trainer_list.php');
        ?>
      </div>
    </div>

    <!-- Assing trainer list -->
    <div class="list">
      <div class="row">
        <div class="col-md-6">
          <?php
            require_once('assign_trainer_list.php');
          ?>
        </div>
      </div>
    </div>
</div>

  <?php $conn->close(); ?>

</body>
</html>