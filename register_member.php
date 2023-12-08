<?php

  require_once('config.php');
  require_once('fpdf/fpdf.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $photo_path = $_POST['photo_path'];
    $training_plan_id = $_POST['training_plan_id'];
    $trainer_id = 0;
    $access_card_pdf_path = "";

    $sql = "INSERT INTO members
    (first_name, last_name, email, phone_number, photo_path, training_plan_id, trainer_id, access_card_pdf_path)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $run = $conn->prepare($sql);
    $run->bind_param("sssssiis", $first_name, $last_name, $email, $phone_number, $photo_path, $training_plan_id, $trainer_id, $access_card_pdf_path);
    $run->execute();

    $member_id = $conn->insert_id; // id od kreiranog membera

    $pdf = new FPDF(); // ucitavamo biblioteku fpdf
    $pdf->AddPage(); // pravimo novu stranicu u pdf fajlu
    $pdf->SetFont('Arial', 'B', 16);

    // pisemo podatke gde ce da upise nase informacije o ovom clanu
    $pdf->Cell(40, 10, 'Access Card:'); // Na vrhu pdf dokumenta pisace Access Card
    $pdf->Ln(); //nova linija
    $pdf->Cell(40, 10, 'Member ID: ' . $member_id); // sad upisujemo podatke
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Name: ' . $first_name . " " . $last_name);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Email: ' . $email);
    $pdf->Ln();

    $filename = 'access_cards/access_card_' . $member_id . '.pdf'; // gde cemo da sacuvamo; 1) prvo kreiramo folder
    $pdf->Output('F', $filename);

    $sql = "UPDATE members SET access_card_pdf_path = '$filename' WHERE members_id = $member_id";
    $conn->query($sql); // query za izvrsavanje
    $conn->close();

    $_SESSION['success_message'] = "Clan teretane uspesno dodat!";
    header('location: admin_dashboard.php');
    exit;
  }

?>