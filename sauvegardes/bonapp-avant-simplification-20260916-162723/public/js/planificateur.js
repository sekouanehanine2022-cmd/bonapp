const recettesPlanificateur = [
    {
        titre: "Pâtes à la Carbonara",
        type: "Plat",
        temps: 25,
        niveau: "facile",
        ambiance: ["rapide", "gourmand", "convivial"],
        description: "Un grand classique italien crémeux et savoureux, parfait pour un dîner efficace sans sacrifier le plaisir.",
        raison: "Idéal quand tu veux quelque chose de réconfortant, rapide à servir et apprécié par tout le monde.",
        image: "image/recette1.jpg",
        ingredients: ["Spaghetti", "Pancetta", "Œufs", "Parmesan", "Poivre noir"]
    },
    {
        titre: "Salade Caesar Fraîche",
        type: "Entree",
        temps: 15,
        niveau: "facile",
        ambiance: ["rapide", "healthy"],
        description: "Une salade fraîche, croquante et légère qui fonctionne aussi très bien en déjeuner express.",
        raison: "Très bon choix si tu veux manger vite, avec quelque chose de frais et sans cuisson longue.",
        image: "image/recette3.jpg",
        ingredients: ["Laitue romaine", "Parmesan", "Croûtons", "Anchois", "Citron"]
    },
    {
        titre: "Poulet Grillé aux Herbes",
        type: "Plat",
        temps: 45,
        niveau: "facile",
        ambiance: ["healthy", "convivial"],
        description: "Un plat simple, parfumé et équilibré qui passe très bien pour un repas familial ou meal prep.",
        raison: "Parfait si tu veux un repas rassurant, protéiné et facile à accompagner de légumes.",
        image: "image/recette4.jpg",
        ingredients: ["Poulet", "Thym", "Romarin", "Citron", "Paprika"]
    },
    {
        titre: "Pain Perdu Gourmand",
        type: "Petit-Dejeuner",
        temps: 25,
        niveau: "facile",
        ambiance: ["gourmand", "convivial"],
        description: "Une idée douce et généreuse pour un brunch ou un petit-déjeuner qui fait plaisir immédiatement.",
        raison: "Très bon match pour un moment cocooning ou un brunch improvisé le week-end.",
        image: "image/recette6.jpg",
        ingredients: ["Pain de mie ou brioche", "Œufs", "Lait", "Cannelle", "Sirop d'érable"]
    },
    {
        titre: "Soupe de Tomates Maison",
        type: "Entree",
        temps: 40,
        niveau: "facile",
        ambiance: ["healthy", "rapide"],
        description: "Une soupe maison douce et veloutée, parfaite quand tu veux quelque chose de simple et réconfortant.",
        raison: "Bonne option pour un dîner léger ou une entrée chaude sans technique compliquée.",
        image: "image/recette7.jpg",
        ingredients: ["Tomates", "Oignon", "Ail", "Bouillon de légumes", "Basilic"]
    },
    {
        titre: "Gâteau au Chocolat Fondant",
        type: "Dessert",
        temps: 45,
        niveau: "moyen",
        ambiance: ["gourmand", "convivial"],
        description: "Un dessert très chocolaté, moelleux et généreux, parfait pour finir un repas sur une note forte.",
        raison: "Le bon choix si tu veux faire plaisir facilement avec une valeur sûre.",
        image: "image/recette2.jpg",
        ingredients: ["Chocolat noir", "Beurre", "Sucre", "Œufs", "Farine"]
    },
    {
        titre: "Citronnade Maison Rafraîchissante",
        type: "Boisson",
        temps: 15,
        niveau: "facile",
        ambiance: ["rapide", "healthy"],
        description: "Une boisson fraîche et acidulée qui accompagne très bien un déjeuner ensoleillé ou un goûter.",
        raison: "Très utile quand tu veux quelque chose de léger, rapide et rafraîchissant.",
        image: "image/recette11.jpg",
        ingredients: ["Citrons", "Sucre", "Eau", "Menthe", "Glaçons"]
    },
    {
        titre: "Smoothie Tropical Vitaminé",
        type: "Boisson",
        temps: 5,
        niveau: "facile",
        ambiance: ["healthy", "rapide"],
        description: "Un smoothie frais, coloré et énergisant qui marche aussi bien au petit-déjeuner qu'en pause légère.",
        raison: "Parfait si tu veux une option express, fruitée et pleine d'énergie.",
        image: "image/recette12.jpg",
        ingredients: ["Mangue", "Banane", "Ananas", "Lait de coco", "Citron vert"]
    },
    {
        titre: "Paella aux Fruits de Mer",
        type: "Plat",
        temps: 85,
        niveau: "difficile",
        ambiance: ["convivial", "gourmand"],
        description: "Une recette généreuse et festive pour les grands repas où l'on veut créer un vrai moment de partage.",
        raison: "À choisir quand tu as plus de temps et l'envie de cuisiner quelque chose qui impressionne.",
        image: "image/recette10.jpg",
        ingredients: ["Riz à paella", "Crevettes", "Moules", "Calamars", "Safran"]
    }
];

const plannerForm = document.getElementById("plannerForm");
const surpriseBtn = document.getElementById("surpriseBtn");
const retryBtn = document.getElementById("retryBtn");
const chips = document.querySelectorAll(".planner-chip");
const etatVide = document.getElementById("etatVide");
const etatAucunResultat = document.getElementById("etatAucunResultat");
const carteResultat = document.getElementById("carteResultat");

let ambianceActive = "toutes";
let derniereSelection = null;

chips.forEach((chip) => {
    chip.addEventListener("click", () => {
        chips.forEach((item) => item.classList.remove("active"));
        chip.classList.add("active");
        ambianceActive = chip.dataset.ambiance;
    });
});

function filtrerRecettes() {
    const type = document.getElementById("typeRepas").value;
    const tempsMax = Number(document.getElementById("tempsMax").value);
    const niveau = document.getElementById("niveauChoisi").value;

    return recettesPlanificateur.filter((recette) => {
        const correspondType = type === "tous" || recette.type === type;
        const correspondTemps = recette.temps <= tempsMax;
        const correspondNiveau = niveau === "tous" || recette.niveau === niveau;
        const correspondAmbiance =
            ambianceActive === "toutes" || recette.ambiance.includes(ambianceActive);

        return correspondType && correspondTemps && correspondNiveau && correspondAmbiance;
    });
}

function choisirRecette(collection) {
    if (!collection.length) {
        return null;
    }

    const pool = collection.filter((recette) => recette !== derniereSelection);
    const choix = pool.length ? pool : collection;
    return choix[Math.floor(Math.random() * choix.length)];
}

function afficherEtat(type) {
    etatVide.classList.add("d-none");
    etatAucunResultat.classList.add("d-none");
    carteResultat.classList.add("d-none");

    if (type === "vide") {
        etatVide.classList.remove("d-none");
    }

    if (type === "aucun") {
        etatAucunResultat.classList.remove("d-none");
    }

    if (type === "carte") {
        carteResultat.classList.remove("d-none");
    }
}

function afficherRecette(recette) {
    document.getElementById("resultImage").src = recette.image;
    document.getElementById("resultImage").alt = recette.titre;
    document.getElementById("resultType").textContent = recette.type.replace("-", " ");
    document.getElementById("resultTime").textContent = `${recette.temps} min`;
    document.getElementById("resultLevel").textContent = recette.niveau.charAt(0).toUpperCase() + recette.niveau.slice(1);
    document.getElementById("resultTitle").textContent = recette.titre;
    document.getElementById("resultDescription").textContent = recette.description;
    document.getElementById("resultReason").textContent = recette.raison;

    const listeIngredients = document.getElementById("resultIngredients");
    listeIngredients.innerHTML = "";

    recette.ingredients.forEach((ingredient) => {
        const item = document.createElement("li");
        item.textContent = ingredient;
        listeIngredients.appendChild(item);
    });

    derniereSelection = recette;
    afficherEtat("carte");
}

function lancerSuggestion(options = {}) {
    const collection = options.surprise ? recettesPlanificateur : filtrerRecettes();
    const recette = choisirRecette(collection);

    if (!recette) {
        afficherEtat("aucun");
        return;
    }

    afficherRecette(recette);
}

plannerForm.addEventListener("submit", (event) => {
    event.preventDefault();
    lancerSuggestion();
});

surpriseBtn.addEventListener("click", () => {
    lancerSuggestion({ surprise: true });
});

retryBtn.addEventListener("click", () => {
    lancerSuggestion();
});
