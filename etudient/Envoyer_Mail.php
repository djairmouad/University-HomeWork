<?php
session_start();
require_once("config.php");

if (isset($_POST["Envoyer_Mail"])) {


    $destinataire = $_SESSION["email"];
    $sujet = "Test d'envoi d'e-mail depuis PHP";
    $message = "you can do it bro beleive in yourself";
    
    // Envoi de l'e-mail
    $mail_envoye = mail($destinataire, $sujet, $message);
    
    // Vérification du succès de l'envoi
    if ($mail_envoye) {
        echo "L'e-mail a été envoyé avec succès.";
    } else {
        echo "L'envoi de l'e-mail a échoué.";
    }
}

if(isset($_POST["Envoyer_a_Gmail"])){
    require_once("pdf.php");
    
}

    ?>
