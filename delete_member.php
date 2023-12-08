<?php

  require_once('config.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = $_POST['members_id'];

    $sql = 'DELETE FROM members WHERE members_id = ?';
    $run = $conn->prepare($sql);
    $run->bind_param('i', $member_id);
    $message = '';

    if ($run->execute()) {
      $message = "Clan je obrisan!";
    } else {
      $message = "Clan nije obrisan!";
    }

    $_SESSION['success_message'] = $message;
    header('location: admin_dashboard.php');
    exit;
  };

?>