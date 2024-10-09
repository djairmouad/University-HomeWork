<?php
if (isset($_POST["login_bulletin"])) {
    require_once("config.php");
    $id = $_POST["id"];
    $connection = new PDO($dsn, $db_user, $db_password);
    $sql = "SELECT * FROM module WHERE id = :id";
     
    $statement = $connection->prepare($sql);
    $statement->bindValue(":id", $id);
    $statement->execute();
    $result = $statement->fetchAll();
     foreach ($result as $row) : 
             $filiere=$row["filiere"] ;
             $nom_prenom=$row["nom_prenom"] ;
     endforeach;
     $statement->closeCursor();
    // --------------------
    $sql = "SELECT * FROM module WHERE nom_prenom = :nom_prenom AND filiere = :filiere";
    $statement = $connection->prepare($sql);
    $statement->bindValue(":nom_prenom", $nom_prenom);
    $statement->bindValue(":filiere", $filiere);
    $statement->execute();
    $result = $statement->fetchAll();
}

$Somme_coefficient = 0;
$Somme_coef_note = 0;
$Moyenne = 0;

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
    th:hover{
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
    <?php if (!empty($result)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Nom Prenom: <?php echo $nom_prenom; ?></th>
                </tr>
                <tr>
                    <th>Filiere: <?php echo $filiere; ?></th>
                </tr>
                <tr>
                    <th>N°Etudiant: <?php echo $id; ?></th>
                </tr>
                <tr>
                    <th>CODE</th>
                    <th>Module</th>
                    <th>Coefficient</th>
                    <th>Note</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) : ?>
                    <tr>
                        <td><?php echo $row["CODE"] ?></td>
                        <td><?php echo $row["moduuule"] ?></td>
                        <td><?php echo $row["coefficient"] ?></td>
                        <td><?php echo $row["note"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        foreach ($result as $row) {
            $Somme_coefficient += $row["coefficient"];
            $Somme_coef_note += ($row["coefficient"] * $row["note"]);
        }
        $Moyenne = ($Somme_coefficient !== 0) ? $Somme_coef_note / $Somme_coefficient : 0;
        ?>
        <div class="resulte">
            <h3>Somme Coefficient: <?php echo $Somme_coefficient; ?></h3>
            <h3>Somme Coef*Note: <?php echo $Somme_coef_note; ?></h3>
            <h3>Moyenne: <?php echo number_format($Moyenne, 2) ; ?></h3>
        </div>
    <?php else : ?>
        <p>No data found.</p>
    <?php endif; ?>
</body>

</html>
