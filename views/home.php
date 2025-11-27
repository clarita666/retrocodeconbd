<?php
require_once 'functions/autoload.php';
$juegoModel = new JuegoModel();
$juegos = $juegoModel->obtenerTodos();
?>

<style>
.galeria {
  display: flex !important;
  flex-wrap: nowrap !important;
  width: 100% !important;
  height: 450px !important;
  overflow: hidden !important;
  border-radius: 15px !important;
  margin: 20px 0 !important;
  box-shadow: 0 20px 40px rgba(0,0,0,0.5) !important;
}

.galeria .item {
  flex: 1 !important;
  overflow: hidden !important;
  transition: flex 0.4s ease !important;
  min-width: 0 !important;
}

.galeria .item a {
  display: block !important;
  width: 100% !important;
  height: 100% !important;
}

.galeria .item img {
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  filter: brightness(60%) !important;
  transition: 0.4s ease !important;
  display: block !important;
}

.galeria:hover .item {
  flex: 0.5 !important;
}

.galeria .item:hover {
  flex: 3 !important;
}

.galeria .item:hover img {
  filter: brightness(100%) !important;
}

.hero-section {
  background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url('img/bannerhome.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  border-radius: 25px;
  padding: 60px 20px;
  margin: 40px 0;
  text-align: center;
  box-shadow: 0 25px 50px rgba(0,0,0,0.3);
  position: relative;
  overflow: hidden;
  min-height: 300px;
}

.hero-content {
  max-width: 600px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

.hero-title {
  font-size: 4rem;
  font-weight: bold;
  background: linear-gradient(45deg, #fff, #ff6b9d, #c44569);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 30px;
  text-shadow: 0 0 30px rgba(255,255,255,0.5);
  position: relative;
  z-index: 2;
}

.hero-text {
  font-size: 1.3rem;
  line-height: 1.8;
  color: rgba(255,255,255,0.9);
  max-width: 800px;
  margin: 0 auto;
  position: relative;
  z-index: 2;
}

.content-card {
  background: rgba(255,255,255,0.05);
  border-radius: 20px;
  padding: 40px;
  margin: 30px 0;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.content-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 30px 60px rgba(0,0,0,0.4);
}

.home-image {
  border-radius: 20px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.5);
  transition: transform 0.3s ease;
  max-width: 100%;
  height: auto;
}

.home-image:hover {
  transform: scale(1.05) rotate(2deg);
}

.cta-section {
  text-align: center;
  margin: 50px 0;
}

.cta-button {
  display: inline-block;
  transition: all 0.3s ease;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 15px 30px rgba(0,0,0,0.3);
}

.cta-button:hover {
  transform: translateY(-5px) scale(1.05);
  box-shadow: 0 25px 50px rgba(0,0,0,0.5);
}

.cta-button img {
  transition: all 0.3s ease;
  filter: brightness(0.8);
}

.cta-button:hover img {
  filter: brightness(1) saturate(1.2);
}

.section-title {
  font-size: 2.5rem;
  font-weight: bold;
  text-align: center;
  margin-bottom: 30px;
  background: linear-gradient(45deg, #fff, #ff6b9d);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
</style>

<div class="galeria">
  <?php foreach($juegos as $juego): ?>
    <div class="item">
      <a href="index.php?sec=juego&id=<?= $juego['id'] ?>">
        <img src="img/covers/<?= $juego['portada'] ?>" alt="<?= $juego['nombre'] ?>">
      </a>
    </div>
  <?php endforeach; ?>
</div>

<div class="hero-section">
  <div class="hero-content">
    <h1 class="hero-title">RETROCODE</h1>
    <p class="hero-text vt323-regular">
      Bienvenidos al universo de los videojuegos clásicos donde cada pixel cuenta una historia
    </p>
  </div>
</div>

<div class="container">
  <div class="content-card">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img class="home-image d-block mx-auto" src="img/home.jpg" alt="RetroCode Gaming">
      </div>
      <div class="col-md-6">
        <p class="vt323-regular fs-5 text-light">
          ¿Sos un apasionado de los videojuegos clásicos? ¿Te encanta recordar esos tiempos donde los gráficos eran "píxeles gordos" y la dificultad era un verdadero desafío? ¡Entonces RetroCode es tu lugar!
          <br><br>
          En RetroCode nos zambullimos de cabeza en el fascinante universo de los videojuegos retro. Desde los gloriosos días de los arcades, pasando por las consolas de 8 y 16 bits, hasta los inicios de los gráficos en 3D.
        </p>
      </div>
    </div>
  </div>

  <div class="content-card">
    <p class="vt323-regular fs-5 text-center text-light">
      Acá vas a encontrar análisis profundos, curiosidades, tops, y reflexiones sobre esos títulos que marcaron una era y que, sin duda, siguen siendo joyas hoy en día.
      <br><br>
      Revivimos la nostalgia con cada joystick, cada cartucho y cada melodía de 8-bits. Si sos de los que creen que los clásicos nunca pasan de moda, ¡sumate a la comunidad de RetroCode!
    </p>
  </div>

  <div class="cta-section">
    <h2 class="section-title">Explorá Nuestro Catálogo</h2>
    <a href="index.php?sec=todos" class="cta-button">
      <img width="400px" src="img/todos-catalogo.png" alt="Ver todos los juegos">
    </a>
  </div>
</div>
