<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
<style>
    body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
}

.group{
    width: 100%;
    display: flex;
    justify-content: space-between;
}
.gradient-background {
    background: linear-gradient(to right, #3498db, #2c3e50);
    color: #fff;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.white-background {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h3 {
    text-align: center;
    color: #3498db;
}

form {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.input-group {
    margin: 10px 0;
    display: flex;
    flex-direction: column;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
    color: black;
}

input,
textarea,
select {
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
}

.civilite {
    display: flex;
}

.civilite label {
    margin-right: 10px;
}

.bottom-elements {
    display: flex;
    justify-content: space-between;
}

button {
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.deleted-account-message {
    color: red;
    text-align: center;
    margin-top: 10px;
}

.img {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
}

.image-input {
    margin-top: 10px;
}

#selectedImage {
    border-radius: 50%;
}

/* Add more styles as needed */

</style>
</head>

<body>
    <div class="gradient-background">
        <div class="white-background">
            <div class="h3">
                <h3>Formulaire d'enseignant</h3>
            </div>
            <form method="post" action="">
                <div class="input-group">
                    <label>Numéro : </label>
                    <input id="numero" value="" type="number" name="numero" placeholder="Enter numero d'utilisateur" />
                    <div class="recherche">
                        <input type="submit"  id="recherche" value="Recherche" name="enseignant_recherche" formaction="enseignant_recherche.php">
                    </div>
                </div>

                <div class="input-group">
                    <label>Civilite :</label>
                    <div class="civilite">
                        <input type="radio" checked class="civilite" name="civilite" id="Monsieur" value="Monsieur" />
                        <label>Monsieur</label>
                        <input type="radio" class="civilite" name="civilite" id="Madame" value="Madame" />
                        <label>Madame</label>
                        <input type="radio" class="civilite" name="civilite" id="Mademoiselle" value="Mademoiselle" />
                        <label>Mademoiselle</label>
                    </div>
                </div>
                <div class="input-group">
                    <label>Nom / Prenom :</label>
                    <input type="text" placeholder="Saisiz votre nom et prenom"  id="nom-prenom" name="nom-prenom" />
                </div>
                <div class="input-group">
                    <label>Adresse :</label>
                    <textarea placeholder="Saisiz votre nom et Adresse "  id="Adresse" cols="30" name="adresse" rows="4"></textarea>
                </div>
                <div class="input-group">
                    <label>Date de Naissance</label>
                    <input type="date" id="date-de-naissance" name="date-de-naissance" />
                </div>
                <div class="input-group">
                    <label>Lieu de Naissance</label>
                    <input type="text" id="lieu-de-naissance" name="lieu-de-naissance" />
                </div>
                <div class="group">
                <div class="input-group">
                    <label>Pays :</label>
                    <select id="pays" name="pays">
              <option value="Algerie ">Algerie</option>
              <option value="Marroc ">Marroc</option>
              <option value="France ">France</option>
              <option value="Allemgne ">Allemgne</option>
              <option value="USA ">USA</option>
            </select>
                </div>
                
                <div class="input-group">
                    <label>Grade :</label>
                    <select name="grade" id="grade">
              <option value="assistant ">Assistant</option>
              <option value="mab ">MAB</option>
              <option value="maa ">MAA</option>
              <option value="mcb ">MCB</option>
              <option value="mca ">MCA</option>
              <option value="professeur ">Professeur</option>
            </select>
                </div>
                <div class="input-group">
                    <label>Spécialité :</label>
                    <select id="specialite" name="specialite">
              <option value="informatique ">Informatique</option>
              <option value="mathematiques ">Mathématiques</option>
              <option value="anglais ">Anglais</option>
              <option value="autres ">Autres</option>
            </select>
                </div>
                </div>
                <div class="bottom-elements">
                    <div class="deleted-account-message" hidden>
                        <p>Enseignant non trouvé !</p>
                    </div>
                    <div class="affichage-list">
                        
                        <button type="submit" name="enregistrer_enseignant" formaction="enseignant_bd.php">Enregistrer</button>
                        <button type="submit" name="modifier_enseignant" formaction="enseignant_bd.php">Modifier</button>
                        <button type="submit" name="supprimer_enseignant" formaction="enseignant_bd.php">Supprimer</button>
                        <button type="submit" name="Affichage_List_enseignant" formaction="enseignant_list.php">Affichage List</button>
                        
              >
            </div>
          </div>

          <div class="img">
            <img
              height="200"
              width="200"
              style="background-size: cover"
              id="selectedImage"
              alt="ajouter une photo"
              src="../../images/person.png"
      />
            <input
              class="image-input"
              type="file"
              id="image-input"
              name="image-input"
              accept="image/*"
            />
          </div>
        </form>
      </div>
    </div>
  </body>
</html>