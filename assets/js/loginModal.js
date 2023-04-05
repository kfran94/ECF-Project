var loginLink = document.getElementById("login-link");
var loginModal = document.getElementById("loginModal");

loginLink.addEventListener("click", function(event) {
    event.preventDefault();
    $(loginModal).modal('show');
});

$(document).ready(function(){
    $(".close, #loginModal .btn-secondary").click(function(){
        $("#loginModal").modal('hide');
    });
});