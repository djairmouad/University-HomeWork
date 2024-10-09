<?php
 require_once("config.php");
if(isset($_POST["login_valider"])){
$email=$_POST["email"];
$mdp=$_POST["password"];
 $connection=new PDO($dsn,$db_user,$db_password);
 $sql="SELECT role FROM users WHERE email=:email and mdp=:mdp";
 $statement=$connection->prepare($sql);
 $statement->bindValue(":email",$email);
 $statement->bindValue(":mdp",$mdp);
 $statement->execute();
 $result = $statement->fetchAll();
 if(!empty($result)){
 foreach($result as $row){
$type=$row["role"];
}
 // ---------------------------------------------------------------------------------------------------
if($type==="Admin"){
    header("Location: ../all.php");
    // header("Location: ll.php");
}else{
    ?>
    <?php
if (isset($_POST["email"])) {
    require_once("config.php");

    $email = $_POST["email"];
    $connection = new PDO($dsn, $db_user, $db_password);
    $sql = "SELECT * FROM module WHERE email = :email";
    $statement = $connection->prepare($sql);
    $statement->bindValue(":email", $email);
    $statement->execute();
    $result = $statement->fetchAll();
}

$Somme_coefficient = 0;
$Somme_coef_note = 0;
$Moyenne = 0;
$html = "
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Student Results</title>
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

        th,
        td {
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

<body>";

$html .= "
    <table>
        <tr>
            <th>Nom Prenom</th>
            <th>Filiere</th>
            <th>N°Etudiant</th>
        </tr>";

// Display only the first row
if (!empty($result) && count($result) > 0) {
    $row = $result[0]; // Use the first row
    $nom_prenom = $row["nom_prenom"];
    $filiere = $row["filiere"];
    $id = $row["id"];

    $html .= "
        <tr>
            <td>{$nom_prenom}</td>
            <td>{$filiere}</td>
            <td>{$id}</td>
        </tr>";
}

$html .= "
        <tr>
            <th>CODE</th>
            <th>Module</th>
            <th>Coefficient</th>
            <th>Note</th>
        </tr>";

foreach ($result as $row) {
    $html .= "
        <tr>
            <td>{$row["CODE"]}</td>
            <td>{$row["moduuule"]}</td>
            <td>{$row["coefficient"]}</td>
            <td>{$row["note"]}</td>
        </tr>";

    $Somme_coefficient += $row["coefficient"];
    $Somme_coef_note += ($row["coefficient"] * $row["note"]);
}

$Moyenne = ($Somme_coefficient !== 0) ? $Somme_coef_note / $Somme_coefficient : 0;

$html .= "
    </table>
    <div class='resulte'>
        <h3>Somme Coefficient: {$Somme_coefficient}</h3>
        <h3>Somme Coef*Note: {$Somme_coef_note}</h3>
        <h3>Moyenne: " . number_format($Moyenne, 2) . "</h3>
    </div>";

session_start();
$_SESSION["email"] = $email;

$html .= "
</body>

</html>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        form{
            position: absolute;
            bottom: 100px;
        }
    </style>
</head>
<body>
    
<form action='Envoyer_Mail.php' method='post'>
        <input type='submit' name='Envoyer_Mail' value='Envoyer'>
        <input type='submit' name='Envoyer_a_Gmail' value='Envoyer à Gmail'>
    </form>
</body>
</html>
<?php

echo $html;
$_SESSION["html"] = $html;
$_SESSION["email"]=$email;
}
// ---------------------------------------------------------------------------------------------------
}else{
    echo "User Inexistant. Inscrivez vous";
}
}
?>