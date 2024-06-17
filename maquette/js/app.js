// app.js : le fichier "principal", la porte d'entrée de notre appli JS

const app = {

    // cette propriété contient un objet (tableau associatif) qui nous permet de stocker les réglages de l'utilisateur
    //* les valeurs indiquées ici sont les valeurs par défaut, qui seront écrasées par le localStorage par la méthode loadFromLocalStorage
    userPreferences: {
        theme: "light",
        color: "theme-green",
        lang: "FR", // cette propriété ne sert à rien, c'est juste pour la démo !
        // ...
        // TODO : ajouter d'autres préfèrences si nécessaire par la suite !
    },

    /**
     * Initialisation de l'application
     */
    init: function() {
        console.log("app : init");

        // au démarrage de l'appli, on récupère les préférences utilisateur
        app.loadFromLocalStorage();

        // ici, on initialise tous les autres modules (qui nécessitent de l'être) de notre application !
        theme.init();
        destinations.init();
        newsletter.init();
        slider.init();
        reviews.init();
        // TODO : initialiser les autres modules ! (par exemple, le theme !)
    },

    /**
     * Cette méthode charge les préfèrences utilisateurs depuis le localStorage
     */
    loadFromLocalStorage: function() {
        // on récupère les préfèrences depuis le localStorage
        const json = localStorage.getItem("userPreferences");

        if (json != null){
            // si le json n'est pas null, c'est qu'il a des préférences utilisateur sauvegardées en localStorage
            // donc on charge ces préfèrences :

            // on converti (on "parse") notre JSON en objet JS !
            app.userPreferences = JSON.parse(json);
        }
    }
}

// pour que la méthode init de notre objet app soit appelée à la fin du chargement de la page,
// on ajoute un écouteur d'événement sur le document, pour surveiller l'event `DOMContentLoaded` !
document.addEventListener("DOMContentLoaded", app.init);