<?php
require_once("config.php");

if(isset($_POST["login_enregestrer"])){
    $email = $_POST["email"];
    $mdp = $_POST["password"];
    $role = $_POST["role"];

    // if(isset()){
    //     $rolearray = $_POST["role"];
    //     $role = explode(",", $rolearray);
    // }

    $connection = new PDO($dsn, $db_user, $db_password);

    // Hash the password before storing it
    // $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(email, mdp, role) VALUES (:email, :mdp, :role)";
    $statement = $connection->prepare($sql);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":mdp", $mdp);
    $statement->bindValue(":role", $role);
    if ($statement->execute()) {
        // Data has been inserted into the "module" table
        echo "Data has been inserted.";
    } else {
        // Handle the case where the insertion failed
        echo "Error inserting data into the 'Users' table: " . $statement->errorCode();
    }
}
?>
