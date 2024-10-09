<?php
require_once("config.php");
if(isset($_POST["Affichage_List_enseignant"])){
    $id = $_POST["numero"];
    $connection = new PDO($dsn, $db_user, $db_password);
    $sql = "SELECT * FROM enseignants";
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
    <div class="gradient-background">
        <div class="white-background">
            <h1>Les informations d'enseignant :</h1>
            <table>
                    <tr>
                        <th>ID</th>
                        <th>Civilité</th>
                        <th>Nom et Prénom</th>
                        <th>Adresse</th>
                        <th>Date de Naissance</th>
                        <th>Lieu de Naissance</th>
                        <th>Pays</th>
                        <th>Grade</th>
                        <th>Specialite</th>
                        <th>Image</th>

                    </tr>
                <?php
          foreach ( $result as $row ) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['civilite'] . '</td>';
            echo '<td>' . $row['nom_prenom'] . '</td>';
            echo '<td>' . $row['adresse'] . '</td>';
            echo '<td>' . $row['date_naissance'] . '</td>';
            echo '<td>' . $row['lieu_naissance'] . '</td>';
            echo '<td>' . $row['pays'] . '</td>';
            echo '<td>' . $row['grade'] . '</td>';
            echo '<td>' . $row['specialite'] . '</td>';
            echo '<td> <img width=50px height = 50px src = "http://localhost/tp-03%20-%20Copy/images/' . $row['image'] . '"/></td>';
            echo '</tr>';
          }
          ?>
            </table>
        </div>
    </div>
</body>
</html>
