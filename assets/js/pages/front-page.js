showLoader();

const slider = document.querySelector('#hero-slider');
const items = slider.querySelectorAll('.slider-item');
const dots = slider.querySelectorAll('.slider-dot');
const prevBtn = document.querySelector('#prev-btn');
const nextBtn = document.querySelector('#next-btn');

document.addEventListener('DOMContentLoaded', function() {
    hideLoader();
    let currentIndex = 0;
    const totalItems = items.length;

    // Siguiente
    nextBtn.addEventListener('click', () => {
      const nextIndex = (currentIndex + 1) % totalItems;
      showSlide(nextIndex);
    });

    // Anterior
    prevBtn.addEventListener('click', () => {
      const prevIndex = (currentIndex - 1 + totalItems) % totalItems;
      showSlide(prevIndex);
    });

    // Puntos
    dots.forEach(dot => {
      dot.addEventListener('click', () => {
        const index = parseInt(dot.getAttribute('data-index'));
        showSlide(index);
      });
    });
 
    setInterval(() => {
      const nextIndex = (currentIndex + 1) % totalItems;
      showSlide(nextIndex);
    }, 10000);
});

function showSlide(index) {
    items.forEach((item, i) => {
    item.classList.toggle('opacity-100', i === index);
    item.classList.toggle('z-10', i === index);
    item.classList.toggle('opacity-0', i !== index);
    item.classList.toggle('z-0', i !== index);
    });

    // Actualizar puntos
    dots.forEach((dot, i) => {
    dot.classList.toggle('bg-white', i === index);
    dot.classList.toggle('bg-white/50', i !== index);
    }); 
    currentIndex = index;
}