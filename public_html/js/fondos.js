const images = [
    '/storage/img/playa.jpg',
    '/storage/img/playa_2.png',
    '/storage/img/playa_3.jpg',
  ];

    // Índice inicial
    let currentIndex = 0;

    // Función para cambiar la imagen de fondo
    function changeBackgroundImage() {
      const welcomeDiv = document.getElementById('matie');
      currentIndex = (currentIndex + 1) % images.length;
      welcomeDiv.style.backgroundImage = `url('${images[currentIndex]}')`;
    }
  
    // Cambiar la imagen cada 4 segundos
    setInterval(changeBackgroundImage, 6000);