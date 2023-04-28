var carouselImages = document.querySelectorAll('.carousel-image');
carouselImages.forEach(function(image) {
    image.addEventListener('mouseover', function() {
        var altText = image.getAttribute('alt');
        var altElement = document.createElement('div');
        altElement.innerText = altText;
        altElement.classList.add('carousel-alt');
        image.parentNode.appendChild(altElement);
    });
    image.addEventListener('mouseout', function() {
        var altElement = image.parentNode.querySelector('.carousel-alt');
        if (altElement) {
            altElement.remove();
        }
    });
});