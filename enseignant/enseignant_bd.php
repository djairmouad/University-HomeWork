<?php
require_once("config.php");
if(isset($_POST["enregistrer_enseignant"])){
    $civilite = $_POST['civilite'];
$nom_prenom = $_POST['nom-prenom'];
$adresse = $_POST['adresse'];
$date_naissance = $_POST['date-de-naissance'];
$lieu_naissance = $_POST['lieu-de-naissance'];
$pays = $_POST['pays'];
$grade = $_POST['grade'];
$specialite = $_POST['specialite'];
$image = $_POST['image-input'];
$connection = new mysqli($localhost, $db_user, $db_password, $db_name);
$sql =  "INSERT INTO enseignants(civilite,nom_prenom,adresse,date_naissance,lieu_naissance,pays,grade,specialite,image) VALUES ('$civilite','$nom_prenom','$adresse','$date_naissance','$lieu_naissance','$pays','$grade','$specialite','$image')";
if ($connection->query($sql) === TRUE) {
    
    echo "Data has been inserted";
} else {
    echo "Error inserting data into the 'enseignant' ";
}
}
if(isset($_POST["supprimer_enseignant"])){
    $id = $_POST['numero'];
    $connection = new mysqli($localhost, $db_user, $db_password, $db_name);
$sql = "DELETE FROM enseignants WHERE id=" . $id;
if ($connection->query($sql) === TRUE) {
    echo "data have deleted";
} else {
    echo "Error inserting data into the 'enseignant'";
}
}
if(isset($_POST["modifier_enseignant"]) && isset($_POST["numero"])){
    $id= $_POST['numero'];
    $civilite = $_POST['civilite'];
    $nom_prenom = $_POST['nom-prenom'];
    $adresse = $_POST['adresse'];
    $date_naissance = $_POST['date-de-naissance'];
    $lieu_naissance = $_POST['lieu-de-naissance'];
    $pays = $_POST['pays'];
    $grade = $_POST['grade'];
    $specialite = $_POST['specialite'];
    $image = $_POST['image-input'];
    $connection = new mysqli($localhost, $db_user, $db_password, $db_name);
    if ($image == 'http://localhost/tp-03%20-%20Copy/images/' || strlen($image) == 0) {
        $sql =  "UPDATE enseignants SET civilite= '$civilite',nom_prenom= '$nom_prenom',adresse= '$adresse',lieu_naissance = '$lieu_naissance',date_naissance= '$date_naissance',pays= '$pays',grade= '$grade',specialite= '$specialite' WHERE id =" . $id;
    
    }
    else {
        $sql =  "UPDATE enseignants SET civilite= '$civilite',nom_prenom= '$nom_prenom',adresse= '$adresse',lieu_naissance = '$lieu_naissance',date_naissance= '$date_naissance',pays= '$pays',grade= '$grade',specialite= '$specialite', image = '$image' WHERE id =" . $id;
    
    }
    if ($connection->query($sql) === TRUE) {
      echo "Data has been modified.";
    } else {
        echo "Error inserting data into the 'enseignant'";
    }
}
?>