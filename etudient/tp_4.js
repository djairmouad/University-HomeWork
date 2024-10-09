let filiere = document.getElementById("filiere");
let choix = document.getElementById("choix");

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
