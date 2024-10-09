<?php
try {
    require_once("config.php");
    $connection = new PDO($dsn, $db_user, $db_password);

    $sql = "SELECT role, COUNT(*) AS unique_name_count FROM users GROUP BY role";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Print the JSON data
    echo json_encode($result, JSON_PRETTY_PRINT);
} catch (PDOException $error) {
    // Handle any database connection errors
    echo json_encode(["error" => "Database connection error: " . $error->getMessage()]);
}
?>
