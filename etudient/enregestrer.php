<?php
require_once("config.php");

if (isset($_POST["Enregestrer"])) { // Corrected the button name
    $connection = new mysqli($localhost, $db_user, $db_password, $db_name);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Sanitize and validate user input
    $cevilite = "empty";
    if (isset($_POST["cevilite"])) {
        $ceviliteArray = $_POST["cevilite"];
        $cevilite = implode(",", $ceviliteArray);
    }
    $nom_prenom = $_POST["nom_prenom"];
    
    $filiere = "empty";
    if (isset($_POST["filiere"])) {
        $filiereArray = $_POST["filiere"];
        $filiere = implode(",", $filiereArray);
    }
    
    $module = "empty";
    if (isset($_POST["module"])){
        $moduleArray = $_POST["module"];
        $module = implode(",", $moduleArray);
    }
    
    $code = $_POST["code"];
    $coefficient = $_POST["coefficient"];
    $note = $_POST["note"];
    $email=$_POST["email"];

    // Create a prepared statement for the "etude" table
    $sql = "INSERT INTO etude (cevilite, nom_prenom, filiere) VALUES (?, ?, ?)";
    $statement = $connection->prepare($sql);
    $statement->bind_param("sss", $cevilite, $nom_prenom, $filiere);

    if ($statement->execute()) {
        // Data has been inserted into the "etude" table
    } else {
        // Handle the case where the insertion failed
        echo "Error inserting data into the 'etude' table: " . $statement->error;
    }

    // Create a prepared statement for the "module" table
    $sql = "INSERT INTO module (filiere,nom_prenom, moduuule, CODE, coefficient, note,email) VALUES (?, ?, ?, ?, ?, ?,?)";
    $statement = $connection->prepare($sql);
    $statement->bind_param("sssssss", $filiere,$nom_prenom, $module, $code, $coefficient, $note,$email);

    if ($statement->execute()) {
        // Data has been inserted into the "module" table
        echo "Data has been inserted.";
    } else {
        // Handle the case where the insertion failed
        echo "Error inserting data into the 'module' table: " . $statement->error;
    }
    
    $connection->close(); // Close the database connection
}
?>
