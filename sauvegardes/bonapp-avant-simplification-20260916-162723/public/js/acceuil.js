const popup = document.getElementById("popupRecette");

// Ouvre le popup avec les infos de la recette
function ouvrirPopup(titre, ingredients, instructions, image, temps, personnes, type, niveau) {
    if (!popup) {
        return;
    }

    const popupImage = document.getElementById("popupImage");

    document.getElementById("popupTitre").innerText = titre;
    document.getElementById("popupIngredients").innerText = ingredients;
    document.getElementById("popupInstructions").innerText = instructions;
    popupImage.src = image;
    popupImage.alt = titre;

    const popupInfos = document.querySelector(".popup-infos");
    popupInfos.innerHTML = `
         <span>⏱️ ${temps}</span>
        <span>👥 ${personnes}</span>
        <span>🍽️ ${type}</span>
        <span class="niveau ${niveau.toLowerCase()}">${niveau}</span>
    `;

    popup.style.display = "flex";
    document.body.style.overflow = "hidden";
}

// Ferme le popup
function fermerPopup() {
    if (!popup) {
        return;
    }

    popup.style.display = "none";
    document.body.style.overflow = "";
}

if (popup) {
    popup.addEventListener("click", (event) => {
        if (event.target === popup) {
            fermerPopup();
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && popup.style.display === "flex") {
            fermerPopup();
        }
    });
}
