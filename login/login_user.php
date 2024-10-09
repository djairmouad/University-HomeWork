<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: 'Poppins', sans-serif;
    background: #c850c0;
    background: -webkit-linear-gradient(45deg,#4158d0,#c850c0);
    background: -o-linear-gradient(45deg,#4158d0,#c850c0);
    background: -moz-linear-gradient(45deg,#4158d0,#c850c0);
    background: linear-gradient(45deg,#4158d0,#c850c0);
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
     margin: 0;
     padding: 0;
     display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    }

    .login {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        text-align: center;
        color: #333;
    }

    label {
        font-family: 'Poppins', sans-serif;
        display: block;
    margin: 10px 0;
    color: black;
    font-weight: bold;
    font-size: 20px;
    }

    input {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
        
    }

    input[type="submit"]{
        width: 100%;
        background-color: #ffffff;
        color: #080710;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
        outline: none;
    }


    input[type="submit"]:hover {
        background-color: #3c95e3;
    }


    select {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        box-sizing: border-box;
    }

    select, select option {
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>

</head>
<body>
    <form action="" method="POST">
    <div class="num">
    <label for="numero">Numero:</label>
    <input id="numero" type="number" name="id" value="">
    </div>
    <!-- <div class="bultien">
    <?php if (!empty($result)) : ?>
        <table>
            <thead>
                <tr>
                    <th>Nom Prenom: <?php echo $nomPrenom; ?></th>
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
    </div>
    <br> -->
<!-- ---------------------------------------------------------------------------------------------------------- -->
<div class="button">
            <input type="submit" name="affichage_list" value="Affichage List" formaction="../etudient//affichage_list.php">
            <input type="submit" name="login_bulletin" value="Bulletin" formaction="login_bulletin.php">
        </div>
</form>
</body>
</html>