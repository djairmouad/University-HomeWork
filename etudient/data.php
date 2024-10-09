
<?php
require_once("config.php");

if (isset($_GET['module']) && isset($_GET['nom_prenom']) && isset($_GET['filiere'])) {
    $module = $_GET['module'];
    $nomPrenom = $_GET['nom_prenom'];
    $filiere = $_GET['filiere'];
    $connection = new PDO($dsn, $db_user, $db_password);
    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM module WHERE moduuule = :module AND nom_prenom = :nom_prenom AND filiere = :filiere";
    $statement = $connection->prepare($sql);
    $statement->bindValue(":module", $module);
    $statement->bindValue(":nom_prenom", $nomPrenom);
    $statement->bindValue(":filiere", $filiere);
    
    if ($statement->execute()) {
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Output the result as JSON
        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        // Handle the case when the SQL query execution fails
        echo json_encode(['error' => 'SQL query execution failed']);
    }
} else {
    // Handle the case when any parameter is missing
    echo json_encode(['error' => 'Missing parameters']);
}
?>

