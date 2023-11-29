document.addEventListener("DOMContentLoaded", function () {
  let currentIndex = 0;
  const intervalTime = 10000; // 5 segundos
  const carousel = document.getElementById('myCarousel');
  const pointsContainer = document.getElementById('points-container');

  // Crear puntos
  for (let i = 0; i < 5; i++) {
    const point = document.createElement('div');
    point.classList.add('point');
    point.addEventListener('click', () => showSlide(i));
    pointsContainer.appendChild(point);
  }

  const points = document.querySelectorAll('.point');
  let interval;

  function showSlide(index) {
    currentIndex = index;
    updateCarousel();
    resetInterval();
  }

  function updateCarousel() {
    const translateValue = -currentIndex * 100 + '%';
    document.querySelector('.carousel-inner').style.transform = `translateX(${translateValue})`;

    // Actualizar clase 'active' en los puntos
    points.forEach((point, index) => {
      if (index === currentIndex) {
        point.classList.add('active');
      } else {
        point.classList.remove('active');
      }
    });
  }

  function resetInterval() {
    clearInterval(interval);
    interval = setInterval(nextSlide, intervalTime);
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % 5;
    updateCarousel();
  }

  interval = setInterval(nextSlide, intervalTime);
});
