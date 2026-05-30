<?php
// deze dependencies laden we hadnamtig in
use phpmailer\PHPMailer\PHPMailer;
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';
// deze functie stuurt mail via Gmail
function mailen ($ontvangerStraat, $ontvangerNaam, $onderwerp, $bericht)
   
$mail = new PHPMailer();
// gmail instellen voor Gmail SMTP server
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    
    $mail->Username = 'xxxxx@gmail.com';
    $mail->password = 'xxxxx';

// hier stellen we de email in en sturen we deze naar de ontvanger
    $mail->setFrom('xxxxx@gmail.com ', 'Naam');
    $mail->Subject = $onderwerp;
    $mail->charset = 'UTF-8';
    $bericht = "<body style='font-family: Arial, sans-serif; background-color: #000000;'>" . $bericht . "</body></html>";
    $mail->Body = $bericht;
    $mail->addAddress($ontvangerStraat, $ontvangerNaam);

    //Stuur de email en controleer of het gelukt is
    if ($mail->send()) {
        echo 'Email is verzonden';
    } else {
        echo 'Email kon niet worden verzonden. Fout: ' . $mail->ErrorInfo;
    }

    ?>