var signupLink = document.getElementById("signup-link");
var signupModal = document.getElementById("signupModal");

signupLink.addEventListener("click", function(event) {
    event.preventDefault();
    $(signupModal).modal('show');
});

$(".close, #signupModal .btn-secondary").click(function(){
    $("#signupModal").modal('hide');
});