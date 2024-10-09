<?php 
require_once("config.php");
if(isset($_POST["Modifier"])){
    $connection = new mysqli($localhost, $db_user, $db_password, $db_name);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Sanitize and validate user input
    $id=$_POST["id"];
    if (isset($_POST["cevilite"])) {
        $ceviliteArray = $_POST["cevilite"];
        $cevilite = implode(",", $ceviliteArray);
    }
    $nom_prenom = $_POST["nom_prenom"];
    
    if (isset($_POST["filiere"])) {
        $filiereArray = $_POST["filiere"];
        $filiere = implode(",", $filiereArray);
    }
    


    $sql= "UPDATE etude SET cevilite=?,nom_prenom=?,filiere=? WHERE nom_prenom=?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("ssss", $cevilite, $nom_prenom, $filiere,$nom_prenom);

    if ($statement->execute()) {
        // Data has been inserted into the "etude" table
    } else {
        // Handle the case where the insertion failed
        echo "Error inserting data into the etude table: " . $statement->error;
    }
    if($_POST["code"]!==""){
        if (isset($_POST["module"])){
            $moduleArray = $_POST["module"];
            $module = implode(",", $moduleArray);
        }
        $code = $_POST["code"];
        $coefficient = $_POST["coefficient"];
        $note = $_POST["note"];
        $email=$_POST["email"];
    $sql = "UPDATE module SET nom_prenom=?,filiere=?,moduuule=?,CODE=?,coefficient=?,note=? ,email=? WHERE moduuule=? and nom_prenom=?";
    $statement = $connection->prepare($sql);
    $statement->bind_param("sssssssss",$nom_prenom, $filiere, $module, $code, $coefficient,$note,$email,$module,$nom_prenom);
    if ($statement->execute()) {
        // Data has been inserted into the "module" table
    } else {
        // Handle the case where the insertion failed
        echo "Error inserting data into the module table: " . $statement->error;
    }
    
    $connection->close(); // Close the database connection
}
echo "Data has been modified.";
}

?>