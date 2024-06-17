// un module pour gérer les commentaires/reviews
const reviews = {

    // vu qu'on aura probablement des écouteurs d'event à ajouter, il nous faut une méthode init !
    init: function() {
        console.log("reviews : init");

        // on sélectionne les 3 checkboxes
        reviews.checkboxes = document.querySelectorAll('.filters input'); // permet de récupérer toutes les balises input dans un balise qui a la classe .filters
        for(const checkbox of reviews.checkboxes) {
            // on écoute l'évènement change qui se déclenche en cas de changement de valeur d'un input
            checkbox.addEventListener("change", reviews.handleFilterChange);

            //* ça marche aussi à priori avec l'event "click", mais "change" est quand-même plus approprié aux inputs
        }
    },

    handleFilterChange: function() {
        // console.log("changement des filtres !");

        for(const checkbox of reviews.checkboxes) {
            // on parcourt les 3 checkboxes, et pour chaque checkbox on vérifie si elle est cochée !

            // console.log(checkbox);
            // console.log(checkbox.value);

            if(checkbox.checked) {
                // console.log("La checkbox " + checkbox.value + " étoiles est cochée.");

                // on sélectionne toutes les reviews QUI ONT LA NOTE checkbox.value (3, 2 ou 1)
                const reviewList = document.querySelectorAll('.review[data-rating="' + checkbox.value + '"]');
                for(const review of reviewList) {
                    // alors on affiche cette review !
                    review.classList.remove('review--hidden');   
                }
            } else {
                // console.log("La checkbox " + checkbox.value + " étoiles est décochée.");

                // on sélectionne toutes les reviews QUI ONT LA NOTE checkbox.value (3, 2 ou 1)
                const reviewList = document.querySelectorAll('.review[data-rating="' + checkbox.value + '"]');
                for(const review of reviewList) {
                    // alors on cache cette review !    
                    review.classList.add('review--hidden');
                }
            }
        }
    }
};