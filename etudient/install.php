<?php 
if (isset($_POST['afiche'])){
    $mysqli = new mysqli('localhost', 'root', '', 'btp9g3b2');
    if ($mysqli->connect_errno) {
    echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
    exit();
    } 
    // Retrieve data from the table
        $requete = "SELECT * FROM notes   ";
        $result = mysqli_query($mysqli, $requete );
    // Generate HTML table to display the data
        if (mysqli_num_rows($result) > 0) {
            echo"le bulten";
            echo "<table border=1><tr><th>nom module</th><th>filiere</th><th>cofficient</th><th> note</th><th>code module </th><th>nom </th></tr>";
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".$row["nom_module"]."</td><td>".$row["filiere"]."</td><td>".$row["cofficient"]."</td><td>".$row["note"]."</td><td>".$row["code_module"]."</td><td>".$row["nam"]."</td></tr>";
            }
            echo "</table>";         
        } else {
            echo "0 results";
        }
    // Close the database connection
    mysqli_close($mysqli);

}
if (isset($_POST['pv'])) { // Changed 'bulten' to 'pv'
    $mysqli = new mysqli('localhost', 'root', '', 'btp9g3b2');
    if ($mysqli->connect_errno) {
        echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
        exit();
    } 
    // Retrieve data from the table
    $requete = "SELECT nam, SUM(cofficient * note) / SUM(cofficient) AS moyenne FROM notes GROUP BY nam";
    $result = mysqli_query($mysqli, $requete);

    if (mysqli_num_rows($result) > 0) {
        echo "Moyen of each etudiant";
        echo "<table border=1><tr><th>nom</th><th>moyenne</th></tr>";

        $allAverages = array(); // Array to store all averages

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['nam'] . "</td>";
            echo "<td>" . number_format($row['moyenne'], 2) . "</td>";
            echo "</tr>";

            $allAverages[] = $row['moyenne']; // Adding each average to the array
        }
        echo "</table>";

        // Calculate and display maximum and minimum moyens among all moyennes
        $maxMoyen = max($allAverages);
        $minMoyen = min($allAverages);
        $overallAverage = array_sum($allAverages) / count($allAverages);

        echo "<p>Max Moyen: " . number_format($maxMoyen, 2) . "</p>";
        echo "<p>Min Moyen: " . number_format($minMoyen, 2) . "</p>";
        echo "<p>Moyen General: " . number_format($overallAverage, 2) . "</p>";

    } else {
        echo "0 results";
    }

    mysqli_close($mysqli);
}








if (isset($_POST['bulten'])){
    $mysqli = new mysqli('localhost', 'root', '', 'btp9g3b2');
    if ($mysqli->connect_errno) {
    echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
    exit();
    } 
    // Retrieve data from the table
    $pre=$_POST['nom'];
        $requete = "SELECT * FROM notes  where   notes.nam='$pre' ";
        $result = mysqli_query($mysqli, $requete );
    // Generate HTML table to display the data
    if (mysqli_num_rows($result) > 0) {
        $totalCofficients = 0; // لحساب مجموع المعاملات
        $totalMoyenne = 0; // لحساب المعدل الكلي
        $totalCoefficientNoteSum = 0;
        echo "le bulten de personne";
        echo "<table border=1><tr><th>nom module</th><th>filiere</th><th>cofficient</th><th>note</th><th>code module</th><th>nom</th><th>moyenne</th></tr>";
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><input name='module' value='" . $row['nom_module'] . "' readonly></td>";
            echo "<td><input name='filiere' value='" . $row['filiere'] . "' readonly></td>";
            echo "<td><input name='coff' value='" . $row['cofficient'] . "' readonly></td>";
            echo "<td><input name='note' value='" . $row['note'] . "' readonly></td>";
            echo "<td><input name='codemodule' value='" . $row['code_module'] . "' readonly></td>";
            echo "<td><input name='nom' value='" . $row['nam'] . "' readonly></td>";
            echo "<td><input name='moyenne' onclick='updateMoyenne()' readonly></td>";
            echo "</tr>";

            $totalCofficients += $row['cofficient'];
            $totalMoyenne += ($row['cofficient'] * $row['note']);
            $totalCoefficientNoteSum += ($row['cofficient'] * $row['note']);

        }
        echo "</table>";

        if ($totalCofficients > 0) {
            $totalAverage = $totalMoyenne / $totalCofficients;
            echo "<p> Moyen Total " . number_format($totalAverage, 2) . "</p>";
            echo "<p> Somme de Coeffiecients: " . number_format($totalCofficients, 2) . "</p>";
            echo "<p> Somme coef * notes   : " . number_format($totalCoefficientNoteSum, 2) . "</p>";


        }
    
   
    ?>                     
         <script>
      function updateMoyenne() {
    var coff = document.querySelectorAll("input[name='coff']");
    var note = document.querySelectorAll("input[name='note']");
    var moyenne = document.querySelectorAll("input[name='moyenne']");
    
    for (var i = 0; i < coff.length; i++) {
        moyenne[i].value = coff[i].value * note[i].value;
    }
}
function genral(){
var totalCofficients = 0;
    var totalMoyenne = 0;
    var coff = document.querySelectorAll("input[name='coff']");
    var note = document.querySelectorAll("input[name='note']");
    var moyenne = document.querySelectorAll("input[name='moyenne']");

    for (var i = 0; i < coff.length; i++) {
        totalCofficients += parseFloat(coff[i].value);
        totalMoyenne += parseFloat(moyenne[i].value);
    }

    var totalAverage = totalMoyenne / totalCofficients;
    var totalMoyenneInput = document.getElementById("totalMoyenne");
    totalMoyenneInput.value = totalAverage.toFixed(2);


}
            </script>
            <!-- إضافة خانة للمعدل الكلي -->
<label for="totalMoyenne">المعدل الكلي: </label>
<input name="totalMoyenne" id="totalMoyenne" onclick='genral()' readonly>

            
          
              
          <?php
          } else {
            echo "0 results";
        }
    // Close the database connection
    mysqli_close($mysqli);

}



if (isset($_POST['modifier'])) {

    if(isset($_POST['id']))      $id=$_POST['id'];
    else      $id="";

    
    if(isset($_POST['note']))      $note=$_POST['note'];
    else      $note="";
  
   
  

    if(empty($note) ){
        echo '<font color="red"> <b>Note non Saisie  </b> </font>'; 
    }
    else{
        $db=mysqli_connect("localhost","root","","btp9g3b2");
        if(!$db) die("connect failed ,".mysqli_connect_error());{
        $sql = "UPDATE notes SET note='$note' where num_etudiant='$id'"; 
        mysqli_query($db, $sql) or die('Erreur SQL !'.$sql.'<br>'.mysqli_error($mysqli)); 

        
        }
        echo 'Vos infos on été modifiées.'; 
        mysqli_close($db); 
        }
     }

    if (isset($_POST['supprimer'])) {

    if(isset($_POST['id']))      $id=$_POST['id'];
    else      $id="";

    $db=mysqli_connect("localhost","root","","btp9g3b2");
    if(!$db) die("connect failed ,".mysqli_connect_error());
    $sql = "DELETE  from notes where num_etudiant='$id'"; 
    mysqli_query($db, $sql) or die('Erreur SQL !'.$sql.'<br>'.mysqli_error($mysqli)); 
    echo "létudient $id a été supprimées."; 
    mysqli_close($db); 
        
    } 
    
?>
<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btp9g3b2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST["Enregistrer"])) {
      
          $id=$_POST['ide'];

          $codemoudle=$_POST['codemodule'];

    

      $answer=$_POST['module'];
 
    
    $nome=$_POST['cofficient'];

    $nam=$_POST['nom'];
    
 
    
    $emplacement = $_POST["note"];
   
    
    $platforme = $_POST["filier"];
  
    $nom = $_POST["id"];

        
    
          

        // Préparez la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO notes (cofficient,code_module,nom_module,note,filiere,num_etudiant,nam) VALUES ('$nome','$codemoudle','$answer','$emplacement','$platforme','$nom','$nam')");
        $stmt->execute();
       
        echo "Formulaire enregistré avec succès.";
    }
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
}

$conn = null;
?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btp9g3b2";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من أن الاتصال تم بنجاح
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}



if (isset($_POST['recherche'])) {
    $id = $_POST['ide']; 
     
    $nom_pre = $_POST['nom'];
    // استعلام SQL لاسترجاع المعلومات من قاعدة البيانات بناءً على الرقم التسلسلي
    $sql = "SELECT * FROM personne JOIN  notes
        
    WHERE  personne.id='$id'";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // استعراض البيانات في النموذج
        $row = $result->fetch_assoc();
     
        



        ?>
        <!DOCTYPE html>
        <html>
        <head>
        <meta charset="UTF-8">

     <style>  body {
    font-family: Arial, sans-serif;
    padding: 20px;
}

.form-all {
    display: flex;
    justify-content: space-between;
}



form {
    padding: 10px;
    border: 1px solid #ccc;
    background-color: #f5f5f5;
    border-radius: 5px;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, td {
    border: 1px solid #ccc;
    padding: 5px;
}

input[type="number"], input[type="text"], input[type="date"], textarea {
    width: 100%;
    padding: 5px;
}



select {
    width: 100%;
    padding: 5px;
}

input[type="submit"] {
    background-color: #0074D9;
    color: #fff;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
}
</style>
<script type="text/javascript">
        function afficherValeurs() {
            var ide = document.getElementById("id").value;
            var nom = document.getElementById("nom").value;
            var civilite = document.querySelector('input[name="answer"]:checked').value;
            var filiere = document.getElementById("filier").value;
            var module = document.getElementById("module").value;
            var cofficient = document.getElementById("cofficient").value;
            var codemodule = document.getElementById("codemodule").value;
            var note = document.getElementById("note").value;
            
            var result = "Numero: " + ide + "\n" +
                         "Nom: " + nom + "\n" +
                         "Civilité: " + civilite + "\n" +
                         "Filière: " + filiere + "\n" +
                         "Module: " + module + "\n" +
                         "Cofficient: " + cofficient + "\n" +
                         "Code Module: " + codemodule + "\n" +
                         "Note: " + note;
            
            alert("le bulten : \n"+result);
        }
    </script>
</head>
<body>

      <table border="1">          
   
<form method="POST" action="note.php">
    <tr>
         <td>numero:</td>
        <td>
        <input type="number" value="ide" name="ide"  >
         <input type="submit" value=" recherche" name="recherche" ></td>
</tr>

</from>

<br><br>
<tr>

         <td>Numero_etudiant :</td>
                                    <td>
                                    <input type="text" type="hidden" id="id" name="id"  value="<?php echo $row['id'];  ?>" >                                    
                                     </td>
</tr>
<br><br>

<form method="post" action="note.php" >

         <td>

         <label for="nom"> NOM :</label></td>
       <td> <input type="text" name="nom" id="nom" value="<?php echo $row['nom_pre']; ?>"></td>

</tr>

<tr>
                <td>Civilité :</td>
                <td>
                    <input  name="answer" type="radio" value="monsieur" <?php if ($row['civilité'] === 'monsieur') echo 'checked'; ?> />Monsieur
                    <input name="answer" type="radio" value="madame" <?php if ($row['civilité'] === 'madame') echo 'checked'; ?> /> Madame
                    <input name="answer" type="radio" value="mademoiselle" <?php if ($row['civilité'] === 'mademoiselle') echo 'checked'; ?> /> Mademoiselle
                </td>
            </tr>
<div id="ff" >

<td>    
<label for="filiere">Filière :</label></td>
<td>
        <select name="filier" id="filier"  onchange="chargerModules()">
    

            <option value="TC"<?php if ($row['filier'] === 'TC') echo 'selected'; ?>>TC</option>
            <option value="2 SC" <?php if ($row['filier'] === '2 SC') echo 'selected'; ?>>2 SC</option>
            <option value="3 ISIL"<?php if ($row['filier'] === '3 ISIL') echo 'selected'; ?>>3 ISIL</option>
            <option value="3SI"<?php if ($row['filier'] === '3SI') echo 'selected'; ?>>3SI</option>
            <option value="M1"<?php if ($row['filier'] === 'M1') echo 'selected'; ?>>M1</option>
            <option value="M2ISI"<?php if ($row['filier'] === 'M2ISI') echo 'selected'; ?>>M2ISI</option>
            <option value="M2WIC"<?php if ($row['filier'] === 'M2WIC') echo 'selected'; ?>>M2WIC</option>
            <option value="M2RSSI"<?php if ($row['filier'] === 'M2RSSI') echo 'selected'; ?>>M2RSSI</option>
            <option value="1ING"<?php if ($row['filier'] === '1ING') echo 'selected'; ?>>1ING</option>
            <option value="2ING"<?php if ($row['filier'] === '2ING') echo 'selected'; ?>>2ING</option>
        </select></td>
</tr><br><br>


    

<tr>
        <td> <label for="module">Modules :</label></td>
        <td>  <select id="module" name="module"  onchange="verifierNote()">
            
         
         </select></td>

</div>
<br><br>
<tr>
    <td>
        <label for="cofficient">cofficient :</label></td>
        <td>
        <input type="text" name="cofficient" id="cofficient"  readonly ></td>
</tr>
<br><br>
<tr>
    <td>
        <label for="codemodule">code module :</label></td>
        <td>
        <input type="text" name="codemodule" id="codemodule" readonly  ></td>
</tr>
<tr>
    <td>
        <label for="NOTE"> NOTE :</label></td>
        <td>
        <input type="text" name="note" id="note"  ></td>
</tr>
<br><br>
<div id="result"></div>



        
        
<tr>
        <td>bouton </td>
                            <td>
                                
                            <input type="submit" value="modifier " id="modifier" name="modifier">
                            <input type="submit" value=" supprimer" name="supprimer">
                            <input type="submit" value="Enregistrer" name="Enregistrer" >
                            <input type="submit" value="bulten" name="bulten" >
                            <input type="submit" value="pv" name="pv" >
                            <input type="submit" value="statistiques" name="statistiques" >

                           

                           <input type="submit" value="afiche" name="afiche" >
                           <!--<input type="button" value="Afficher les valeurs" name="AFFICHE BULTEN" onclick="afficherValeurs()">
    -->
                        </td>
</tr>


</table>

  






   
    <script>


function verifierNote() {
    const numeroEtudiant = document.getElementById("id").value;
    const nomModule = document.getElementById("module").value;

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "note3.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Débogage de la réponse
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.error) {
                    document.getElementById("cofficient").value = ""; // Efface le contenu
                    document.getElementById("codemodule").value = ""; // Efface le contenu
                    document.getElementById("note").value = ""; // Efface le contenu
                   
                    window.alert( response.error);
                } else {

                    document.getElementById("cofficient").value = response.cofficient;
                    document.getElementById("codemodule").value = response.code_module;
                    document.getElementById("note").value = response.note;


                    
                   
                }
            } catch (error) {
                console.error("Erreur lors de la conversion JSON : " + error);
            }
        }
    };

    const data = `id=${encodeURIComponent(numeroEtudiant)}&module=${encodeURIComponent(nomModule)}`;
    xhr.send(data);
   
}














                document.getElementById("module").innerHTML = "";

        function chargerModules() {
            var filiere = document.getElementById("filier").value;
            var moduleSelect = document.getElementById("module");

            // Effectuer une requête AJAX pour récupérer les modules en fonction de la filière
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "note4.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var modules = JSON.parse(xhr.responseText);
                    moduleSelect.innerHTML = "";

                    for (var i = 0; i < modules.length; i++) {
                        var option = document.createElement("option");
                        option.value = modules[i];
                        option.text = modules[i];
                        moduleSelect.appendChild(option);
                    }
                }
            };
            xhr.send("filier=" + filiere);
        }

        // Appelez la fonction au chargement de la page pour remplir la liste déroulante au début
        chargerModules();
    </script>
    
      </body>
     </html>
    <script>
   /* function remplirListeDeroulante() {
        var filiereSelect = document.getElementById("filiere");
        var modulesSelect = document.getElementById("modules");
        modulesSelect.innerHTML = "";

        var filiere = filiereSelect.value;

        if (filiere === "2 SC") {
            // Remplir la liste déroulante avec des modules informatiques
            var options = ["Programmation", "Bases de données", "Réseaux"];
        } else if (filiere === "TC") {
            // Remplir la liste déroulante avec des modules de mathématiques
            var options = ["Algèbre linéaire", "Analyse mathématique", "Statistiques"];
        } else if (filiere === "3 ISIL") {
            // Remplir la liste déroulante avec des modules de physique
            var options = ["algorthimique", "architacture", "base de donne","programmation avancee de wev"];
        }else if (filiere === "3SI") {
            // Remplir la liste déroulante avec des modules de physique
            var options = ["se2", "asi", "ihm"];
        }else if (filiere === "M1") {
            // Remplir la liste déroulante avec des modules de physique
            var options = ["se3", "tm", "resaux"];
        }else if (filiere === "M2ISI") {
            // Remplir la liste déroulante avec des modules de physique
            var options = ["se", "algo3", "structur","GL3","STRCTUR"];
        }else if (filiere === "M2WIC") {
            // Remplir la liste déroulante avec des modules de physique
            var options = ["se", "thl", "lm"];
        }else if (filiere === "M2RSSI") {
            // Remplir la liste déroulante avec des modules de physique
            var options = ["algo", "paw", "daw"];
        }else if (filiere === "1ING") {
            // Remplir la liste déroulante avec des modules de physique
            var options = ["daw", "algorithmiqui", "thl"];
        }else if (filiere === "2ING") {
            // Remplir la liste déroulante avec des modules de physique
            var options = ["Mécanique", "Électromagnétisme", "Thermodynamique"];
        }

        for (var i = 0; i < options.length; i++) {
            var option = document.createElement("option");
            option.text = options[i];
            modulesSelect.add(option);
        }
    }

*/


</script>
    <?php
           

        } else {
            echo "Etudiant Inéxistant  ";
        }
    
        // إغلاق الاتصال بقاعدة البيانات
        $conn->close();
    }
    ?>
  

 


  <?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btp9g3b2";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من  أن الاتصال تم بنجاح
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}



if (isset($_POST['bb'])) {
    $id = $_POST['nom']; 
     
    
    // استعلام SQL لاسترجاع المعلومات من قاعدة البيانات بناءً على الرقم التسلسلي
    $sql = "SELECT * FROM personne JOIN  notes
        
    WHERE  notes.nam='$id'";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // استعراض البيانات في النموذج
        $row = $result->fetch_assoc();
     
        



echo  "<center> la nom ".$row['nom_pre'];"</center>";
echo  "<center> la civilité ".$row['civilité'];"</center>";
echo  "<center> la filiere ".$row['filier'];"</center>";
echo  "<center> la module ".$row['nom_module'];"</center>";
echo  "<center> le code module ".$row['code_module'];"</center>";
echo  "<center> le cofficient ".$row['cofficient'];"</center>";
echo  "<center> la note ".$row['note'];"</center>";
















  
           

        } else {
            echo "buletn non sesie  ";
        }
    
        // إغلاق الاتصال بقاعدة البيانات
        $conn->close();
    }
    ?>