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
    <form action="" method="POST">
    <div class="num">
    <label for="numero">Numero:</label>
    <div class="num_2">
    <input id="numero" type="number" name="id" value="">
    <input type="submit" name="Recharcher" value="Recharcher" formaction="recharcher.php">
    </div>
    </div>
    
<!-- ------------------------------------------------------------------------------------------------------------>
<div class="civi">
    <label for="cevilite">Cevilite:</label>
    <input name="cevilite[]" value="Monsieur" type="radio"><label for="">Monsieur </label>
    <input name="cevilite[]" value="Madame"  type="radio" ><label for="">Madame</label>
    <!-- <input name="cevilite[]" value="Mademoiselle" type="radio"><label for="">Mademoiselle</label> -->
    </div>
    
<!-- ---------------------------------------------------------------------------------------------------------- -->
<div class="name">
    <label for="nom_prenom">Nom/Prenom:</label>
    <input id="nom_prenom" type="text" name="nom_prenom" value="">
</div>
<!---------------------------------------------------------------------------------------------------------->
    <div class="fil">
    <label for="filière">Filière:</label>
    <select id="filiere" name="filiere[]">
              <option value="3isil">3 ISIL</option>
              <option value="3si">3 SI</option>
              <option value="1ing">1ING</option>
    </select>
    </div>
    
<!-- ---------------------------------------------------------------------------------------------------------- -->
<div class="moudule">
    <label for="module">Module:</label>
    <select name="module[]" id="choix">
    <?php if ($filiere === "3isil") { ?>
        <option value="GL">GL</option>
        <option value="PAW" >PAW</option>
        <option value="SAD">SAD</option>
        <option value="SID">>SID</option>
    <?php } elseif ($filiere === "3si") { ?>
        <option value="IHM" >IHM</option>
        <option value="Compilation">Compilation</option>
        <option value="ENVS">ENVS</option>
        <option value="Genie Logiciel">Genie Logiciel</option>
    <?php } else { ?>
        <option value="Base de Donnee">Base de Donnee</option>
        <option value="Architacteur">Architacteur</option>
        <option value="Analyse">Analyse</option>
        <option value="Algebre">Algebre</option>
    <?php } ?>
</select>
</div>
<div class="code">
    <label for="code">Code Module:</label>
    <input type="text" name="code" value="" id="code">
</div>

<!-- ---------------------------------------------------------------------------------------------------------- -->
<div class="coefficient">
    <label for="coefficient">Coefficient:</label>
    <input type="text" name="coefficient" value="" id="coefficient">
</div>

<!-- ---------------------------------------------------------------------------------------------------------- -->
<div class="note">
    <label for="note">Note:</label>
    <input id="note" type="text" name="note" value="">
</div>
<!-- ----------------------------------------------------------------------------------------------------------
 -->
 <div class="gmail">
    <label for="gmail">Gmail:</label>
    <input id="gmail" type="email" name="email" value="">
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
    let filiere=document.getElementById("filiere").value;
    if(filiere==="3isil"){
     <?php $filiere==="3isil" ?>
    }else if(filiere==="3si"){
        <?php $filiere==="3si" ?>
    }else{
        <?php $filiere==="1ing" ?>
    }
</script>
<script src="tp_4.js"></script>
<!-- <script src="search.js"></script> -->
</body>
</html>