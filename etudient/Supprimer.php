<?php
require_once("config.php");

if (isset($_POST["Supprimer"])) {
    $connection = new PDO($dsn, $db_user, $db_password);

    if (isset($_POST["module"])) {
        $moduleArray = $_POST["module"];
        $module = implode(",", $moduleArray);
    }

    $code = $_POST["code"];
    $coefficient = $_POST["coefficient"];
    $note = $_POST["note"];

    // Update specific columns to NULL
    $sqlUpdate = "UPDATE module SET CODE = NULL, coefficient = NULL, note = NULL WHERE moduuule = :module";
    $statementUpdate = $connection->prepare($sqlUpdate);
    $statementUpdate->bindValue(":module", $module);
    $statementUpdate->execute();

    // Delete the entire row if needed
    // $sqlDelete = "DELETE FROM module WHERE moduuule = :module";
    // $statementDelete = $connection->prepare($sqlDelete);
    // $statementDelete->bindValue(":module", $module);
    // $statementDelete->execute();

    echo "data have deleted";
}
?>
