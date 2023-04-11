$('#connectedModal').on('hidden.bs.modal', function () {
    // Code à exécuter lorsque la modale est fermée
    // Vous pouvez ajouter ici les actions à réaliser, par exemple recharger la page pour se déconnecter
    window.location.reload();
});
