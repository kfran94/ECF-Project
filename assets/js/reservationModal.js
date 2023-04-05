
var reservationLink = document.getElementById("reservation-link");
var reservationModal = document.getElementById("reservationModal");

reservationLink.addEventListener("click", function(event) {
    event.preventDefault();
    $(reservationModal).modal('show');
});

$(document).ready(function(){
    $("#reservationModal").modal('hide');

    $(".close, #reservationModal .btn-secondary").click(function(){
        $("#reservationModal").modal('hide');
    });
});