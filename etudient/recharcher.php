<?php
require_once("config.php");
$result = []; // Initialize $result to avoid potential errors

if (isset($_POST["Recharcher"]) && isset($_POST["id"])) {
    $id = $_POST["id"];
    $connection = new PDO($dsn, $db_user, $db_password);
    $sql = "SELECT * FROM etude WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(":id", $id);
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
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 80px;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
     .num_2{
        display: flex;
        justify-content: space-between;
    }
    .num_2 input[type="submit"]{
        width: 45%;
    }
    form {
        background-color: #fff;
        max-width: 400px;
        width: 100%;
        padding: 60px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .civi{
        display: flex
    }

    h3 {
        text-align: center;
        color: #333;
    }

    label {
        display: block;
        color: #555;
    }

    input,
    select {
        width: 45%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        cursor: pointer;
        padding: 12px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        width: 30%;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }


    .button {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
</style>
</head>
<body>
    <?php
    foreach ($result as $row) {
    ?>
    <form action="" method="POST">
        <div class="num">
            <label for="numero">Numero:</label>
            <div class="num_2">
            <input id="numero" type="number" name="id" value="<?php echo $row["id"]?>">
            <input type="submit" name="Recharcher" value="Recharcher" formaction="recharcher.php">
        </div>
        </div>
        
        <!-- ------------------------------------------------------------------------------------------------------------>
        <div class="civi">
            <?php $cevilite=explode(",",$row["cevilite"])?>
            <label for="cevilite">Cevilite:</label>
            <input name="cevilite[]" value="Monsieur" type="radio" <?php if(in_array("Monsieur",$cevilite)){echo "checked";}?>><label for="">Monsieur </label>
            <input name="cevilite[]" value="Madame"  type="radio" <?php if(in_array("Madame",$cevilite)){echo "checked";}?>><label for="">Madame</label>
            <!-- <input name="cevilite[]" value="Mademoiselle" type="radio" <?php if(in_array("Mademoiselle",$cevilite)){echo "checked";}?>><label for="">Mademoiselle</label> -->
        </div>
        
        <!-- ---------------------------------------------------------------------------------------------------------- -->
        <div class="name">
            <label for="nom_prenom">Nom/Prenom:</label>
            <input id="nom_prenom" type="text" name="nom_prenom" value="<?php echo $row["nom_prenom"]?>">
        </div>
        <!------------------------------------------------------------------------------------------------------------>
        
        <div class="fil">
            <?php $filiere=explode(",",$row["filiere"]) ?>
            <label for="filière">Filière:</label>
            <select id="filiere" name="filiere[]">
                <option value="3isil" <?php if(in_array("3isil",$filiere)){echo "selected";}?>>3 ISIL</option>
                <option value="3si" <?php if(in_array("3si",$filiere)){echo "selected";}?>>3 SI</option>
                <option value="1ing" <?php if(in_array("1ing",$filiere)){echo "selected";}?>>1ING</option>
            </select>
        </div>
        
        <?php } ?>
        <!-- ---------------------------------------------------------------------------------------------------------- -->
        <div class="moudule">
            <?php
            if (isset($_POST["Recharcher"]) && isset($_POST["id"])) {
                $id = $_POST["id"];
                $connection = new PDO($dsn, $db_user, $db_password);
                $sql = "SELECT * FROM module WHERE id=:id";
                $statement=$connection->prepare($sql);
                $statement->bindValue(":id",$id);
                $statement->execute();
                $result=$statement->fetchAll();
            }
            foreach($result as $row){
            ?>
            <?php
$filiere = $row["filiere"];
$module = $row["moduuule"];
$nom_prnom= $row["nom_prenom"];
?>
    <!-- ----------------------------------------------------------------------------------------------------------
 -->
 <div class="gmail">
    <label for="gmail">Gmail:</label>
    <input id="gmail" type="email" name="email" value="<?php echo $row["email"]?>">
</div>

<!------------------------------------------------------------------------------------------------------------ -->
<label for="module">Module:</label>
<select name="module[]" id="choix" >
    <?php if ($filiere === "3isil") { ?>
        <option value="GL" <?php if ($module === "GL") echo "selected"?>>GL</option>
        <option value="PAW" <?php if ($module === "PAW") echo "selected" ?>>PAW</option>
        <option value="SAD" <?php if ($module === "SAD") echo "selected" ?>>SAD</option>
        <option value="SID" <?php if ($module === "SID") echo "selected" ?>>SID</option>
    <?php } elseif ($filiere === "3si") { ?>
        <option value="IHM" <?php if ($module === "IHM") echo "selected"?>>IHM</option>
        <option value="Compilation" <?php if ($module === "Compilation") echo "selected" ?>>Compilation</option>
        <option value="ENVS" <?php if ($module === "ENVS") echo "selected" ?>>ENVS</option>
        <option value="Genie Logiciel" <?php if ($module === "Genie Logiciel") echo "selected" ?>>Genie Logiciel</option>
    <?php } else { ?>
        <option value="Base de Donnee" <?php if ($module === "Base de Donnee") echo "selected" ?>>Base de Donnee</option>
        <option value="Architacteur" <?php if ($module === "Architacteur") echo "selected" ?>>Architacteur</option>
        <option value="Analyse" <?php if ($module === "Analyse")echo "selected" ?>>Analyse</option>
        <option value="Algebre" <?php if ($module === "Algebre")echo "selected" ?>>Algebre</option>
    <?php } } ?>
</select>
        </div>
        <div class="code">
            <label for="code">Code Module:</label>
            <input type="number" name="code" value="" id="code">
        </div>
        
        <!-- ---------------------------------------------------------------------------------------------------------- -->
        <div class="coefficient">
            <label for="coefficient">Coefficient:</label>
            <input type="number" name="coefficient" value="" id="coefficient">
        </div>
        
        <!-- ---------------------------------------------------------------------------------------------------------- -->
        <div class="note">
            <label for="note">Note:</label>
            <input id="note" type="number" name="note" value="">
        </div>
        <!-- ---------------------------------------------------------------------------------------------------------- -->
        <div class="button">
            <input type="submit" name="Enregestrer" value="Enregestrer" formaction="enregestrer.php">
            <input type="submit" name="Modifier" value="Modifier" formaction="modifier.php">
            <input type="submit" name="Supprimer" value="Supprimer" formaction="Supprimer.php">
            <input type="submit" name="affichage_list" value="affichage_list" formaction="affichage_list.php">
            <input type="submit" name="bulletin" value="bulletin" formaction="bulletin.php">
            <input type="submit" name="bulletin_list" value="PV" formaction="pv.php">
            <input type="submit" name="list_users" value="list_users" formaction="list_users.php">
        </div>
    </form>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let filiere = document.getElementById("filiere");
        let name = document.getElementById('nom_prenom');
        let choix = document.getElementById('choix');
        let code = document.getElementById('code');
        let coefficient = document.getElementById('coefficient');
        let note = document.getElementById('note');

        choix.addEventListener('change', function() {
            let val = choix.value;
            let nomPrenom = name.value;  // Replace with the actual value
            let filiere = "<?php echo $filiere; ?>";  // Replace with the actual value

            if (val && nomPrenom && filiere) {
                // Make an asynchronous request to fetch module details
                let xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            let moduleData = JSON.parse(xhr.responseText);
                            console.log(moduleData);
                            if (moduleData && !moduleData.error) {
                                code.value = moduleData.CODE || "";
                                coefficient.value = moduleData.coefficient || "";
                                note.value = moduleData.note || "";
                            } else {
                                // Handle the case when there is an error
                                console.error("Error fetching module data:", moduleData.error);
                                code.value = "";
                                coefficient.value =  "";
                                note.value = "";
                            }
                        } else {
                            // Handle HTTP errors
                            console.error("HTTP error:", xhr.status);
                        }
                    }
                };

                // Send the request to a PHP script that fetches module data
                xhr.open('GET', 'data.php?module=' + encodeURIComponent(val) + '&nom_prenom=' + encodeURIComponent(nomPrenom) + '&filiere=' + encodeURIComponent(filiere), true);
                xhr.send();
            } else {
                // Handle the case when any parameter is missing
                code.value = "";
                coefficient.value = "";
                note.value = "";
            }

            console.log("Module: " + encodeURIComponent(val));
            console.log("Nom Prenom: " + encodeURIComponent(nomPrenom));
            console.log("Filiere: " + encodeURIComponent(filiere));
            console.log(moduleData.code );
            console.log(moduleData.coefficient );
            console.log(moduleData.note);
        });
        filiere.addEventListener("change", function() {
    if (filiere.value === "3isil") {
        updateChoix(["GL", "PAW", "SAD", "SID"]);
    } else if (filiere.value === "3si") {
        updateChoix(["IHM", "Compilation", "ENVS", "Genie Logiciel"]);
    } else if (filiere.value === "1ing") {
        updateChoix(["Base de Donnee", "Architacteur", "Analyse", "Algebre"]);
    }
});

function updateChoix(options) {
    choix.innerHTML = ""; // Clear existing options
    options.forEach(function(optionValue) {
        let option = document.createElement("option");
        option.value = optionValue;
        option.textContent = optionValue;
        choix.appendChild(option);
    });
}

    });
</script>









    <!-- <script src="tp_4.js"></script> -->
    <!-- <script src="search.js"></script> -->
</body>
</html>
