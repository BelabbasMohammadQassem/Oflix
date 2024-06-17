// objet destinations
const destinations = {

    init: function() {
        // la fonction init sera lancée à l'initialisation/au chargement de notre objet
        console.log("destinations : init");

        // on sélectionne TOUS les boutons like des destinations
        const likeButtons = document.querySelectorAll(".btn__like");

        // on boucle sur tous ces boutons
        for(const button of likeButtons) {
            // pour chaque bouton, on ajoute un écouteur d'évènement dessus !
            button.addEventListener("click", destinations.handleLikeClick);
        }
    },

    handleLikeClick: function(event) {
        console.log("click sur like !");

        // on récupère le bouton sur lequel on a cliqué
        const button = event.currentTarget;
        console.log(button);

        // on récupère le grand-père du bouton (c'est à dire la balise article)
        const article = button.parentNode.parentNode;
        console.log(article);

        // autre solution : on peut utiliser .closest()
        //const article = button.closest("article"); // closest() utilise les sélecteurs CSS, comme querySelector()
        //console.log(article);

        // on ajoute le message d'erreur à l'article
        messages.addMessageToElement("Vous devez être connecté pour gérer vos favoris !", article);
    }
};