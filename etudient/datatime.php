<?php
require_once("config.php");
$connection = new PDO($dsn, $db_user, $db_password);
$sql = "SELECT * FROM module WHERE  filiere =:filiere AND module =:module";
$statement = $connection->prepare($sql);
$statement->bindValue(":filiere", $filiere);
$statement->bindValue(":module", $module);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
$json_data = json_encode($result, JSON_PRETTY_PRINT);
// Print the JSON data
echo $json_data;

// Alternatively, you can use the data in your PHP script or send it to a client

