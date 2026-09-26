// ===========================
// RECETTES DEPUIS LA BASE
// ===========================
const grilleRecettes = document.querySelector(".grille-recettes");
const categories = document.querySelectorAll(".categorie-item");
const barreRecherche = document.getElementById("barreRecherche");
let filtreActuel = "tous";
let cartes = document.querySelectorAll(".carte-recette");

chargerRecettesDepuisBase();

categories.forEach((cat) => {
    cat.addEventListener("click", () => {
        categories.forEach((categorie) => categorie.classList.remove("actif"));
        cat.classList.add("actif");
        filtreActuel = cat.dataset.filtre;
        appliquerFiltreEtRecherche();
    });
});

if (barreRecherche) {
    barreRecherche.addEventListener("input", appliquerFiltreEtRecherche);
}

async function chargerRecettesDepuisBase() {
    if (!grilleRecettes) {
        return;
    }

    try {
        const response = await fetch("api/recettes.php");

        if (!response.ok) {
            throw new Error("La base de donnees n'est pas encore disponible.");
        }

        const data = await response.json();

        if (!data.success || !Array.isArray(data.recettes)) {
            throw new Error("Les recettes n'ont pas pu etre chargees.");
        }

        grilleRecettes.innerHTML = "";

        if (data.recettes.length === 0) {
            grilleRecettes.innerHTML = '<p class="text-center text-muted grid-column-full">Aucune recette enregistree pour le moment.</p>';
        } else {
            data.recettes.forEach((recette) => {
                grilleRecettes.appendChild(creerCarteRecette(recette));
            });
        }

        cartes = document.querySelectorAll(".carte-recette");
        appliquerFiltreEtRecherche();
    } catch (error) {
        afficherMessageRecettes(error.message);
        cartes = document.querySelectorAll(".carte-recette");
    }
}

function creerCarteRecette(recette) {
    const carte = document.createElement("article");
    const niveau = normaliserNiveau(recette.niveau);

    carte.className = "carte-recette";
    carte.dataset.type = recette.categories || recette.type || "";
    carte.tabIndex = 0;

    carte.innerHTML = `
        <div class="badge-niveau ${niveau}">${majuscule(niveau)}</div>
        <img src="${echapperAttribut(recette.image)}" class="img-carte" alt="${echapperAttribut(recette.titre)}">
        <div class="contenu-carte">
            <h3 class="titre-carte"></h3>
            <p class="description-carte"></p>
            <div class="infos-carte">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    `;

    carte.querySelector(".titre-carte").textContent = recette.titre;
    carte.querySelector(".description-carte").textContent = recette.description;

    const infos = carte.querySelectorAll(".infos-carte span");
    infos[0].textContent = recette.temps;
    infos[1].textContent = recette.personnes;
    infos[2].textContent = recette.type;

    const ouvrir = () => {
        ouvrirPopup(
            recette.titre,
            recette.ingredients,
            recette.instructions,
            recette.image,
            recette.temps,
            recette.personnes,
            recette.type,
            niveau
        );
    };

    carte.addEventListener("click", ouvrir);
    carte.addEventListener("keydown", (event) => {
        if (event.key === "Enter" || event.key === " ") {
            event.preventDefault();
            ouvrir();
        }
    });

    return carte;
}

function appliquerFiltreEtRecherche() {
    const texteRecherche = (barreRecherche?.value || "").toLowerCase();

    cartes.forEach((carte) => {
        const titre = (carte.querySelector(".titre-carte")?.innerText || "").toLowerCase();
        const type = (carte.dataset.type || "").toLowerCase();
        const correspondRecherche = titre.includes(texteRecherche);
        const correspondFiltre = filtreActuel === "tous" || type.includes(filtreActuel.toLowerCase());

        carte.style.display = correspondRecherche && correspondFiltre ? "block" : "none";
    });
}

function afficherMessageRecettes(message) {
    const zoneMessage = document.getElementById("messageRecettes");

    if (zoneMessage) {
        zoneMessage.textContent = `${message} Les recettes statiques restent affichees.`;
        zoneMessage.classList.remove("d-none");
    }
}

function normaliserNiveau(niveau) {
    const valeur = String(niveau || "facile").toLowerCase();

    if (["facile", "moyen", "difficile"].includes(valeur)) {
        return valeur;
    }

    return "facile";
}

function majuscule(texte) {
    return texte.charAt(0).toUpperCase() + texte.slice(1);
}

function echapperAttribut(valeur) {
    return String(valeur || "")
        .replace(/&/g, "&amp;")
        .replace(/"/g, "&quot;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;");
}
