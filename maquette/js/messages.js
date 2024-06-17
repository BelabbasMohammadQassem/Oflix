// un module messages pour gérer les messages d'erreur
const messages = {
    
    //! pas besoin de méthode init dans ce module, il n'y a rien à faire dès le chargement de la page.

    /**
     * Cette méthode permet d'ajouter un message d'erreur avec comme contenu text dans l'élément HTML element
     * @param {String} text - le texte à ajouter dans le message d'erreur
     * @param {*} element - l'élément HTML dans lequel ajouter le message
     */
    addMessageToElement: function(text, element) {
        // AVANT d'ajouter un nouveau message, on supprime les anciens !
        messages.removeOldMessages(element);

        // on créé un nouvel élément p
        let p = document.createElement('p');
        // on lui ajoute la classe `message`
        p.classList.add('message');
        // on définit son contenu texte
        p.textContent = text;
        // pour finir, on doit ajouter cet élément p à la page !
        element.prepend(p);
    },

    /**
     * Permet de supprimer tous les messages d'erreur à l'intérieur d'un element
     * @param {*} element - l'élément duquel il faut supprimer tous les messages
     */
    removeOldMessages: function(element) {
        // 1ère étape : on sélectionne TOUS les messages à l'intérieur de notre élement
        const messages = element.querySelectorAll('.message');
        //* element.querySelectorAll('.message') permet de sélectionner tous les messages À L'INTÉRIEUR DE L'ÉLÉMENT element !
        // on veut maintenant retirer chaque message du DOM :
        for(const message of messages) {
            // on supprime !
            message.remove();
        }
    }
};