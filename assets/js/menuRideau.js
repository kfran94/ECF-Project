

    window.addEventListener('scroll', function() {
    const menuRideau = document.querySelector('.menu-rideau');
    if (window.scrollY > 100) {
    menuRideau.classList.add('invisible');
} else {
    menuRideau.classList.remove('invisible');
}
});

