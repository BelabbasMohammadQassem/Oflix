// objet newsletter
const newsletter = {

    forbiddenDomains: [
        '@yopmail.com',
        '@yopmail.fr',
        '@yopmail.net',
        '@cool.fr.nf',
        '@jetable.fr.nf',
        '@courriel.fr.nf',
        '@moncourrier.fr.nf',
        '@monemail.fr.nf',
        '@monmail.fr.nf',
        '@hide.biz.st',
        '@mymail.infos.st',
    ],

    init: function() {

        // écouteur d'événement sur le bouton d'affichage de la newsletter
        const newsletterButton = document.getElementById('newsletter-button');
        newsletterButton.addEventListener("click", newsletter.handleNewsletterClick);

        // écouteur d'événement sur le bouton de fermeture de la newsletter
        const newsletterCloseButton = document.querySelector('.newsletter__close');
        newsletterCloseButton.addEventListener("click", newsletter.handleNewsletterCloseClick);

        // écouteur d'événement sur la soumission du form de newsletter
        const form = document.querySelector('.newsletter form');
        form.addEventListener("submit", newsletter.handleNewsletterSubmit);

        // vu qu'on a besoin de l'encart de newsletter dans l'ensemble de nos méthodes,
        // autant le récupérer dans le init et le stocker dans une propriété de l'objet !
        newsletter.encart = document.querySelector('.newsletter');
    },

    handleNewsletterClick: function(event) {
        // pour bloquer le comportement par défaut (rechargement de la page)
        event.preventDefault();

        //console.log("click sur le bouton newsletter !");

        // on ajoute la classe newsletter--on à l'encart
        newsletter.encart.classList.add('newsletter--on');
    },

    handleNewsletterCloseClick: function() {
        // ici, pas besoin du event.preventDefault() ! (puisque l'élément n'est pas un lien de navigation <a>)

        //console.log("fermeture de l'encart de newsletter");

        // on retire la classe newsletter--on de l'encart
        newsletter.encart.classList.remove('newsletter--on');
    },

    handleNewsletterSubmit: function(event) {
        // on bloque le comportement par défaut (rechargement de la page)
        event.preventDefault();

        //console.log("formulaire soumis !");

        // on sélectionne le champ input du form 
        const input = document.querySelector('.newsletter__field');
        // pour récupérer ce qu'un utilisateur a saisi dans un champ texte, on utilise .value
        //console.log(input.value);

        // première solution : String.includes()
        // on parcourt tous les domaines interdits
        for(const forbiddenDomain of newsletter.forbiddenDomains) {
            // pour chaque domaine interdit,
            // on vérifie si l'adresse email le contient !
            if(input.value.includes(forbiddenDomain)) {
                // l'adresse saisie contient le domaine interdit, donc erreur, ça sert à rien d'aller plus loin !
                console.error("ADRESSE EMAIL INCORRECTE !");

                // on ajoute le message d'erreur à l'article
                messages.addMessageToElement("Les adresses jetables ne sont pas admises !", newsletter.encart);

                // pour stopper la boucle et la fonction, on return !
                return;
            }
        }
        // si on arrive ici,
        // si on sort de la boucle sans avoir rencontré aucune erreur,
        // c'est que l'adresse email ne contient pas de domaine interdit !
        // donc qu'elle est correcte.
        console.log("Adresse email correcte, merci pour votre inscription à la newsletter !");

        // on supprime les messages d'erreur éventuels
        messages.removeOldMessages(newsletter.encart);
    }
};