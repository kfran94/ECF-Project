const menuRideau = document.querySelector('.menu-rideau');

window.addEventListener('scroll', function() {
    if (window.scrollY > 100) {
        menuRideau.classList.remove('visible');
    } else {
        menuRideau.classList.add('visible');
    }
});


