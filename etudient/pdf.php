<?php

$email=$_SESSION["email"];
require '../Dompdf/vendor/autoload.php';
use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create a new Dompdf instance
$dompdf = new Dompdf();

// Get the HTML content from the session
$html = $_SESSION["html"];

// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper("A4", "landscape");

// Render PDF
$dompdf->render();

// Get the PDF content
$pdfContent = $dompdf->output();

require '../phpmailer/src/PHPMailer.php';  // Adjust the path accordingly
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Set mailer to use SMTP
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    
    // SMTP settings
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = '';  // Replace with your Gmail address
    $mail->Password = '';        // Replace with your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender and recipient
    $mail->setFrom('', 'djair mouad');  // Replace with your name
    $mail->addAddress($email, 'Recipient Name');  // Replace with recipient's email address

    // Subject and body
    $mail->Subject = 'Bulletin';
    $mail->Body = 'les Notes et la Moyenne:';

    // Add PDF attachment
    $mail->addStringAttachment($pdfContent, 'document.pdf', 'base64', 'application/pdf');

    // Send the email
    if ($mail->send()) {
        echo 'Email with PDF attachment has been sent successfully.';
    } else {
        echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo 'Email could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>
