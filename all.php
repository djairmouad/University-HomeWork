<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
    /* Reset some default styles for better consistency */
body,
h1,
h2,
h3,
p,
margin,
padding,
button {
  margin: 0;
  padding: 0;
  border: 0;
}

body {
  font-family: Arial, sans-serif; /* Choose a suitable font family */
}

.gradient-background {
  background: linear-gradient(to right, #4e54c8, #8f94fb); /* Choose gradient colors */
  height: 100vh; /* Set the height to the full viewport height */
  display: flex;
  align-items: center;
  justify-content: center;
}

.white-background {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  width: 60%;
}

.buttons {
  display: flex;
  justify-content: space-around;
  width: 100%;
}

.etudiant-button,
.enseignant-button,
.list_users {
  background-color: #3498db; /* Choose button background color */
  padding: 10px 20px;
  border-radius: 5px;
  text-align: center;
}
.list_users{
  padding: 0;
}

.etudiant-button a,
.enseignant-button a,
input[type="submit"] {
  text-decoration: none;
  color: #fff; /* Choose button text color */
  font-weight: bold;
}
input[type="submit"] {
border: none;
    background-color: transparent;
    padding: 13px 20px;
    border-radius: 5px;
  text-align: center;
  }
  input[type="submit"]:hover{
    cursor: pointer;
    background-color: #2980b9;
  }
/* Optional: Add hover effects for better user interaction */
.etudiant-button:hover,
.enseignant-button:hover {
  background-color: #2980b9; /* Adjust hover background color */
}
</style>
  </head>

  <body>
    <div class="gradient-background">
      <div class="white-background">
        <div class="buttons">
          <div class="etudiant-button">
            <a href="./etudient/tp_4.php">Etudiants</a>
          </div>
          <div class="enseignant-button">
            <a href="./enseignant/enseignant.php"
              >Enseignants</a
            >
            </div>
            <div class="list_users">
              <form action="" method="post">
              <input type="submit" value="list_users" name="list_users" id="list_users" formaction="list_users.php">
              </form>
            <!-- <a href="list_users.php" value="list_users" name="list_users">List Users</a> -->
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
