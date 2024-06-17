// un objet theme
const theme = {

    init: function() {
        // pour debug
        console.log("theme : init");

        // on sélectionne le bouton "lune" et on ajoute un écouteur d'événement dessus
        const button = document.getElementById("theme-switch"); // ou document.querySelector("#theme-switch")
        button.addEventListener("click", theme.changeTheme);

        // au démarrage, on vérifie les préférences utilisateur :
        if(app.userPreferences.theme === "dark") {
            // l'utilisateur avait choisi le dark-theme, on ajoute la classe au body !
            document.body.classList.add('theme-dark');
        } else {
            // l'utilisateur avait choisi le light-theme, on retive la classe au body !
            document.body.classList.remove('theme-dark');
        }

        // on charge le thème de couleur sauvegardé dans le localStorage
        theme.changeColorTheme(app.userPreferences.color);

        // gestion du thème de couleur : ajout des écouteurs d'événements
        const pastilles = document.querySelectorAll(".theme-button");
        for(const pastille of pastilles) {
            pastille.addEventListener("click", theme.handleThemeColorClick);
        }
    },

    changeTheme: function() {
        // on sélectionne le body
        const body = document.querySelector('body');

        // on va conditionner l'ajout ou la suppression en fonction du thème actuel
        if(body.classList.contains('theme-dark')) {
            // la classe `theme-dark` est présente sur le body, donc on l'enlève !
            body.classList.remove('theme-dark');

            // on modifie les préfèrences de notre utilisateur
            app.userPreferences.theme = "light";

            // on sauvegarde les modifications
            // vu que le localStorage permet de stocker que du texte, on convertit notre objet userPreferences en JSON !
            const json = JSON.stringify(app.userPreferences);
            // on sauvegarde le JSON dans le localStorage !
            localStorage.setItem("userPreferences", json);

        } else {
            // la classe `theme-dark` n'est pas présente, donc on l'ajoute !
            body.classList.add('theme-dark');

            // on modifie les préfèrences de notre utilisateur
            app.userPreferences.theme = "dark";

            // on sauvegarde les modifications
            // vu que le localStorage permet de stocker que du texte, on convertit notre objet userPreferences en JSON !
            const json = JSON.stringify(app.userPreferences);
            // on sauvegarde le JSON dans le localStorage !
            localStorage.setItem("userPreferences", json);
        }

        // ou avec .toggle()
        //body.classList.toggle('theme-dark');
    },

    handleThemeColorClick: function(event) {
        console.log("changement du thème de couleur !");

        // on récupère l'id de la pastille sur laquelle on a cliqué
        const pastille = event.currentTarget;
        console.log(pastille);
        const id = pastille.id;

        // on appelle changeColorTheme pour changer la couleur du thème !
        theme.changeColorTheme(id);

        // on modifie les préfèrences de notre utilisateur
        app.userPreferences.color = id;

        // on sauvegarde les modifications
        // vu que le localStorage permet de stocker que du texte, on convertit notre objet userPreferences en JSON !
        const json = JSON.stringify(app.userPreferences);
        // on sauvegarde le JSON dans le localStorage !
        localStorage.setItem("userPreferences", json);
    },

    changeColorTheme: function(color) {
        console.log("nouveau thème sélectionné : " + color);

        // on supprime tous les thèmes éventuellement existants
        // document.body.classList.remove("theme-red");
        // document.body.classList.remove("theme-green");
        // document.body.classList.remove("theme-blue");
        // ou en une ligne :
        document.body.classList.remove("theme-red", "theme-green", "theme-blue");

        // on ajoute la classe color au body
        document.body.classList.add(color);

        // changement du logo
        // 1ère étape : on reconstruit le nom du fichier à charger
        const fileName = "img/logo-" + color + ".png";
        console.log(fileName);
        // 2ème étape : on sélectionne la balise img
        const img = document.querySelector('.logo__image');
        // 3ème étape : on modifier l'attribut src !
        img.src = fileName;

    }
};