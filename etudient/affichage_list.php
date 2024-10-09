<?php
if (isset($_POST["affichage_list"])){
require_once("config.php");
    $connection = new PDO($dsn, $db_user, $db_password);
    $sql = "SELECT * FROM module ";
    $statement = $connection->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        padding: 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background: #36304a;
        color: white;
    }

    th:hover {
        background-color: #3c95e3;
    }

    tbody tr:hover {
        background-color: #f5f5f5;
    }

    .resulte {
        display: flex;
        width: 50%;
        margin: 20px auto;
        justify-content: space-between;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 15px;
    }

    .resulte h3 {
        font-size: 17px;
        margin: 5px 0;
    }

    p {
        text-align: center;
        font-size: 18px;
        margin-top: 20px;
        color: #555;
    }
</style>

</head>
<body>
    <table>
        <tr>
            <th>Id</th>
            <th>Nom/Prenom</th>
            <th>Filiere</th>
            <th>Module</th>
            <th>Code</th>
            <th>Coefficient</th>
            <th>Note</th>
        </tr>
        <?php
$cheak_name = "hello";
$cheak_id = "10";
$cheak = true;
$lastAssignedId = array(); // Associative array to store the last assigned ID for each name

foreach ($result as $row) {
    echo "<tr>";
    
    // Check if the current row's name is different from the previous one
    if ($row["nom_prenom"] !== $cheak_name) {
        // If different, update $cheak_id based on the last assigned ID for this name
        $cheak_id = $lastAssignedId[$row["nom_prenom"]] ?? $row["id"];
    }

    echo "<td>" . (($cheak) ? $cheak_id : $row["id"]) . "</td>";
    echo "<td>" . $row["nom_prenom"] . "</td>";
    echo "<td>" . $row["filiere"] . "</td>";
    echo "<td>" . $row["moduuule"] . "</td>";
    echo "<td>" . $row["CODE"] . "</td>";
    echo "<td>" . $row["coefficient"] . "</td>";
    echo "<td>" . $row["note"] . "</td>";

    $cheak_name = $row["nom_prenom"];
    $lastAssignedId[$cheak_name] = $cheak_id; // Update the last assigned ID for this name
    $cheak = true; // Reset $cheak to true for the next iteration

    echo "</tr>";
}
?>





    </table>
</body>
</html>