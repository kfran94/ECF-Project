var connectedButton = document.querySelector('.nav-link[data-target="#connectedModal"]');

var closeButton = document.querySelector('.modal .btn-close');

connectedButton.addEventListener('click', function(event) {
    event.preventDefault();
    $('#connectedModal').modal('show');
});

closeButton.addEventListener('click', function(event) {
    $('#connectedModal').modal('hide');
});

$('.modal').on('click', function(event) {
    if (event.target === this) {
        $('#connectedModal').modal('hide');
    }
});
