// Récupérer l'élément du bouton dans la navbar
var connectedButton = document.querySelector('.nav-link[data-target="#connectedModal"]');

// Récupérer l'élément du bouton de fermeture dans la modal
var closeButton = document.querySelector('.modal .btn-close');

// Ajouter un écouteur d'événement au clic sur le bouton
connectedButton.addEventListener('click', function(event) {
    event.preventDefault(); // Empêcher le comportement par défaut du lien
    $('#connectedModal').modal('show'); // Activer la modal avec jQuery (assurez-vous d'avoir la bibliothèque jQuery incluse dans votre projet)
});

// Ajouter un écouteur d'événement au clic sur le bouton de fermeture
closeButton.addEventListener('click', function(event) {
    $('#connectedModal').modal('hide'); // Fermer la modal avec jQuery
});

// Ajouter un écouteur d'événement pour fermer la modal en cliquant en dehors de la modal
$('.modal').on('click', function(event) {
    if (event.target === this) {
        $('#connectedModal').modal('hide'); // Fermer la modal avec jQuery
    }
});
