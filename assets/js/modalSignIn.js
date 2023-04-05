var signInLink = document.getElementById("signIn-link");
var signInModal = document.getElementById("signInModal");

signInLink.addEventListener("click", function(event) {
    event.preventDefault();
    $(signInModal).modal('show');
});

$(".close, #signupModal .btn-secondary").click(function(){
    $("#signInModal").modal('hide');
});