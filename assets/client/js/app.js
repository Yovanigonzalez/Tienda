document.addEventListener("DOMContentLoaded", function () {
  const signUpButton = document.getElementById('signUp');
  const signInButton = document.getElementById('signIn');
  const container = document.getElementById('container');
  const navbar = document.getElementById('navbar');
  
  //Variable de ScrollNavBar
  let prevScrollPos = window.scrollY;

  function pageLoaded() {
    let loaderSection = document.querySelector('.loader-section');       loaderSection.classList.add('loaded');
  }
   
  document.onload = pageLoaded();

  // Configuración de NavBar
  window.onscroll = function() {
    let currentScrollPos = window.scrollY;

    if (prevScrollPos > currentScrollPos) {
      // Muestra el navbar al desplazarse hacia arriba
      navbar.style.top = "0";
    } else {
      // Oculta el navbar al desplazarse hacia abajo
      navbar.style.top = "-100px"; // Puedes ajustar la cantidad de píxeles que deseas ocultar
    }
    prevScrollPos = currentScrollPos;
  }

  // Control de botones de Inicio y Registro de sesión
  signUpButton.onclick = function () {
    container.classList.add('right-panel-active');
  };

  signInButton.onclick = function () {
    container.classList.remove('right-panel-active');
  };

  // Control de mensaje de suscripción
  setTimeout(function() {
    var successMessage = document.querySelector('.successful-subscription');
    if (successMessage) {
      successMessage.style.display = 'none';
    }
  }, 5000);
});