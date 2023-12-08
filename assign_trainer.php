<?php

  require_once('config.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $members_id = $_POST['member'];
    $trainer_id = $_POST['trainer'];

    $sql = "UPDATE members SET trainer_id = ? WHERE members_id = ?";
    $run = $conn->prepare($sql);
    $run->bind_param('ii', $trainer_id, $members_id);
    $run->execute();

    $_SESSION['success_message'] = "Trener je uspesno dodeljen clanu!";

    header("location: admin_dashboard.php");
    exit;
  }

?>