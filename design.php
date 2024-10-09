<?php
require_once("config.php");
$connection=new PDO($dsn,$db_user,$db_password);
$sql="SELECT cevilite, COUNT(DISTINCT nom_prenom) AS unique_name_count FROM etude GROUP BY cevilite;";
$statement=$connection->prepare($sql);
$statement->execute();
$result=$statement->fetchAll();
$json_data = json_encode($result, JSON_PRETTY_PRINT);
// Print the JSON data
echo $json_data;
?>