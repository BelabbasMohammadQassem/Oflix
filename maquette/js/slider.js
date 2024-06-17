// un objet slider
const slider = {
    // propriétés :

    // une propriété pour stocker la position ACTUELLE dans le slider
    // par défaut, première image donc position 0
    position: 0,

    // un tableau pour stocker toutes les images à charger
    images: [
        'road.jpg',
        'canyon.jpg',
        'ocean.jpg',
        'ski.jpg',
        'city.jpg',
        'nature.jpg'
    ],

    // méthodes :
    init: function() {
        // pour debug
        console.log("slider : init");

        // dès le chargement de la page, on veut charger les images dans le slider,
        // donc on appelle notre méthode !
        slider.loadImages();

        // on ajoute des écouteurs d'événements sur nos deux boutons
        const previousButton = document.querySelector("#previous-button");
        previousButton.addEventListener("click", slider.handlePreviousClick);

        const nextButton = document.querySelector("#next-button");
        nextButton.addEventListener("click", slider.handleNextClick);
    },

    loadImages: function() {
        // 1. on sélectionne le parent / l'emplacement dans lequel on veut ajouter notre balise
        const sliderElement = document.querySelector('.slider');

        // pour charger toutes les images dans le tableau, on va boucler sur le tableau !
        for(const image of slider.images) {

            // on créé une nouvelle balise img avec createElement
            const img = document.createElement('img');

            // on lui ajoute la classe slider__img
            img.classList.add('slider__img');

            // on remplit son attribut src
            img.src = "img/" + image;

            // 2. on ajoute notre baliser à l'élément sélectionné !
            //slider.append(img);
            // append ajoute à la fin du parent (après tous les enfants existants)
            // si on veut ajouter au début du parent, on peut utiliser prepend !
            sliderElement.prepend(img);
        }

        // en dernier, après avoir ajouté toutes les images, 
        // on sélectionne l'une d'entres-elles et on ajoute la classe slider__img--current
        // pour sélectionner la première image, on peut utiliser querySelector('.slider__img')
        const firstImage = document.querySelector('.slider__img');
        firstImage.classList.add('slider__img--current');
    }, 

    handlePreviousClick: function() {
        // on a cliqué sur le bouton précédent, on passe à l'image précédente ! (sliderPosition-1)
        // SEULEMENT SI sliderPosition > 0
        if(slider.position > 0) {
            slider.position--;
        } else {
            // si on est à la première position (0), on va à la fin !
            slider.position = slider.images.length - 1;
        }
        
        // on sélectionne l'image actuellement affichée
        const currentImage = document.querySelector('.slider__img--current');
        // on lui retire la classe `slider__img--current` !
        currentImage.classList.remove("slider__img--current");

        // on ajoute la classe à l'image N°sliderPosition !
        // pour ça, on récupère toutes les images avec querySelectorAll
        const images = document.querySelectorAll('.slider__img');
        // on ajoute la classe `slider__img--current` sur l'image N°sliderPosition
        images[slider.position].classList.add("slider__img--current");
    },

    handleNextClick: function() {
        // on a cliqué sur le bouton suivante, on passe à l'image suivante ! (sliderPosition+1)
        // SEULEMENT SI sliderPosition < 4
        if(slider.position < slider.images.length - 1) {
            slider.position++;
        } else {
            // si on est à la dernière position (4), on revient au début !
            slider.position = 0;
        }
        
        // on sélectionne l'image actuellement affichée
        const currentImage = document.querySelector('.slider__img--current');
        // on lui retire la classe `slider__img--current` !
        currentImage.classList.remove("slider__img--current");

        // on ajoute la classe à l'image N°sliderPosition !
        // pour ça, on récupère toutes les images avec querySelectorAll
        const images = document.querySelectorAll('.slider__img');
        // on ajoute la classe `slider__img--current` sur l'image N°sliderPosition
        images[slider.position].classList.add("slider__img--current");
    }
};