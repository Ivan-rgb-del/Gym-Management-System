<?php

  // Konektovanje na bazu podataka iz fajla config.php
  require_once('config.php');

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT admin_id, password FROM admins WHERE username = ?";
    $run = $conn->prepare($sql); // pripremimo za izvrsenje
    $run->bind_param("s", $username); // string oznacava s i username se na neki nacin vezuje sa username iz sql upita
    $run->execute(); // izvrsimo

    $results = $run->get_result(); // uzmemo rezultate

    if ($results->num_rows == 1) {
      $admin = $results->fetch_assoc(); // u variablu admin iz resultsa koje smo dobili da ucitamo podatke iz baze u formi ascocijativnog niza

      if (password_verify($password, $admin['password'])) { // proveravamo paswword koji smo uneli sa hesovanim passowordom iz baze podataka!
        $_SESSION['admin_id'] = $admin['admin_id'];
        $conn->close();
        header("location: admin_dashboard.php");
      } else {
        $_SESSION['error'] = "Netacan password!";
        $conn->close();
        header('location: index.php');
        exit; // uvek posle redirecta treba da izadjemo iz egzekucije(sessije)
      }
    } else {
      $_SESSION['error'] = "Netacan username!";
      $conn->close();
      header('location: index.php');
      exit; // uvek posle redirecta treba da izadjemo iz egzekucije(sessije)
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Admin Login</title>
</head>
<body>
  <form action="" method="POST" class="form">
    <h2>Welcome back Admin</h2>

    <p class="error">
      <?php
        if (isset($_SESSION['error'])) {
          echo $_SESSION['error'] . "<br>";
          unset($_SESSION['error']);
        }
      ?>
    </p>

    <p class="paragraph">Please log in</p>
    <div class="usernameInputDiv">
      <input placeholder="Username" type="text" name="username">
      <i class='bx bxs-user'></i>
    </div>

    <div class="passwordInputDiv">
      <input placeholder="Password" type="password" name="password">
      <i class='bx bxs-lock-alt'></i>
    </div>

    <button type="submit" class="btn">Login</button>
  </form>
</body>
</html>