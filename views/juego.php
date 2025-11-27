<?php

require_once __DIR__ . '/../functions/autoload.php';

$id = isset($_GET['id']) ? $_GET['id'] : FALSE;

$juegoModel = new JuegoModel();
$comentarioModel = new ComentarioModel();
$juegos = $juegoModel->obtenerPorId($id);
$comentarios = $comentarioModel->obtenerPorJuego($id);

// Colores por juego - Paleta más sutil y natural
$colores_juegos = [
    1 => '#A0616A',   // Resident Evil - Rosa apagado
    2 => '#8B7EC8',   // Silent Hill - Lavanda suave
    3 => '#7A8B8B',   // Alone in the Dark - Gris azulado
    4 => '#9B7EBD',   // Clock Tower - Púrpura suave
    5 => '#B8956D',   // Sweet Home - Beige cálido
    6 => '#E6C79C',   // Pacman - Amarillo suave
    7 => '#D4A574',   // Final Fight - Naranja apagado
    8 => '#7FCDCD',   // Tron - Cian suave
    9 => '#8FBC8F',   // Space Invaders - Verde salvia
    10 => '#D8A7CA', // Tetris - Rosa pálido
    11 => '#90B494',  // Minecraft - Verde musgo
    12 => '#8FA4D3',  // Terraria - Azul grisáceo
    13 => '#A68B5B',  // The Last of Us - Marrón tierra
    14 => '#C5B358',  // Skyrim - Dorado apagado
    15 => '#B8956D'   // Tomb Raider - Beige arena
];

// array para los png de los juegos 
$png_juegos = [
    1 => 'residentevilpng.png',
    2 => 'silenthillpng.png',
    3 => 'aloneinthedark.webp',
    4 => 'clocktowerpng.webp',
    5 => 'sweethomepng.png',
    6 => 'pacmanpng.png',
    7 => 'finalfightpng.png',
    8 => 'tronpng.png',
    9 => 'spaceinvaderspng.webp',
    10 => 'tetrispng.png',
    11 => 'minecraftong.png',
    12 => 'terrariapng.png',
    13 => 'thelostpng.png',
    14 => 'skyrimpng.webp',
    15 => 'tombraiderpng.png'
];

$color_actual = $colores_juegos[$id] ?? '#333333';

$png_actual = $png_juegos[$id] ?? 'default.png';

// Obtener juegos de la misma categoría para el slider
$juegos_categoria = $juegoModel->obtenerPorCategoria($juegos['categoria']);

?>
<style>
.parent {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  grid-template-rows: repeat(5, 1fr);
  grid-column-gap: 8px;
  grid-row-gap: 8px;
  height: 90vh;
  margin: 20px 0;
}

.div1 { grid-area: 1 / 1 / 4 / 3; }
.div2 { grid-area: 1 / 3 / 4 / 5; }
.div3 { grid-area: 1 / 5 / 4 / 6; }
.div4 { grid-area: 4 / 3 / 6 / 6; }
.div5 { grid-area: 4 / 1 / 6 / 3; }

.grid-item {
  background: rgba(255,255,255,0.05);
  border-radius: 20px;
  padding: 20px;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.1);
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  overflow: hidden;
}

.png-item {
  background: transparent;
  border: none;
  padding: 0;
  backdrop-filter: none;
  display: flex;
  justify-content: center;
  align-items: center;
}

.png-container {
  position: relative;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.game-png {
  max-width: 80%;
  height: auto;
  filter: drop-shadow(0 0 30px <?= $color_actual ?>);
  animation: float 6s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

.cover-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 15px;
}

.info-grid {
  text-align: left;
  width: 100%;
}

.info-item {
  margin-bottom: 15px;
  color: white;
}

.info-label {
  color: <?= $color_actual ?>;
  font-weight: bold;
}

.platforms {
  display: flex;
  gap: 10px;
  justify-content: center;
  margin-top: 10px;
}

.platform-icon {
  font-size: 1.5rem;
  color: <?= $color_actual ?>;
}

.description-area {
  text-align: justify;
  overflow-y: auto;
  max-height: 100%;
}

.description-area::-webkit-scrollbar {
  width: 6px;
}

.description-area::-webkit-scrollbar-thumb {
  background: <?= $color_actual ?>;
  border-radius: 10px;
}
</style>

<h1 class="text-center my-4" style="background: linear-gradient(45deg, <?= $color_actual ?>, <?= $color_actual ?>88); padding: 20px; border-radius: 15px; color: white;"><?= $juegos['nombre'] ?></h1>

<div class="parent">
  <div class="div1 png-item">
    <div class="png-container">
      <img src="img/<?= $png_actual ?>" class="game-png" alt="<?= $juegos['nombre'] ?>" onerror="this.src='img/default-game.png'">
    </div>
  </div>
  
  <div class="div2 grid-item">
    <img src="img/covers/<?= $juegos['portada'] ?>" class="cover-img" alt="<?= $juegos['nombre'] ?>">
  </div>
  
  <div class="div3 grid-item">
    <h3 style="color: <?= $color_actual ?>; margin-bottom: 20px; font-size: 1.5rem;"><?= $juegos['nombre'] ?></h3>
    <div class="info-grid">
      <div class="info-item">
        <span class="info-label">Empresa:</span><br><?= $juegos['empresa'] ?>
      </div>
      <div class="info-item">
        <span class="info-label">Año:</span><br><?= $juegos['publicacion'] ?>
      </div>
      <div class="info-item">
        <span class="info-label">Jugabilidad:</span><br><?= $juegos['jugabilidad'] ?>
      </div>
      <div class="platforms">
        <i class="<?= $juegos['plataforma1'] ?> platform-icon"></i>
        <i class="<?= $juegos['plataforma2'] ?> platform-icon"></i>
        <i class="<?= $juegos['plataforma3'] ?> platform-icon"></i>
        <i class="<?= $juegos['plataforma4'] ?> platform-icon"></i>
      </div>
    </div>
  </div>
  
  <div class="div4 grid-item">
    <div class="ratio ratio-16x9" style="width: 100%;">
      <iframe src="https://www.youtube.com/embed/<?= $juegos['link'] ?>?autoplay=1&mute=1"
        frameborder="0"
        allow="autoplay; encrypted-media"
        allowfullscreen>
      </iframe>
    </div>
  </div>
  
  <div class="div5 grid-item">
    <div class="description-area">
      <h4 style="color: <?= $color_actual ?>; margin-bottom: 15px;">Descripción</h4>
      <p class="text-light" style="line-height: 1.6;"><?= $juegos['bajada'] ?></p>
    </div>
  </div>
</div>


<style>
.category-slider {
  background: linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
  border-radius: 25px;
  padding: 40px;
  margin: 40px 0;
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

.category-title {
  color: <?= $color_actual ?>;
  font-size: 2rem;
  font-weight: bold;
  margin-bottom: 30px;
  text-align: center;
  position: relative;
}

.category-title::after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 60px;
  height: 3px;
  background: <?= $color_actual ?>;
  border-radius: 2px;
}

.games-scroll {
  display: flex;
  gap: 20px;
  overflow-x: auto;
  padding: 10px 0 20px 0;
  scroll-behavior: smooth;
}

.games-scroll::-webkit-scrollbar {
  height: 8px;
}

.games-scroll::-webkit-scrollbar-track {
  background: rgba(255,255,255,0.1);
  border-radius: 10px;
}

.games-scroll::-webkit-scrollbar-thumb {
  background: <?= $color_actual ?>;
  border-radius: 10px;
}

.category-game-card {
  min-width: 160px;
  background: rgba(255,255,255,0.05);
  border-radius: 15px;
  padding: 15px;
  transition: all 0.3s ease;
  border: 2px solid transparent;
  backdrop-filter: blur(10px);
}

.category-game-card:hover {
  transform: translateY(-10px) scale(1.05);
  background: rgba(255,255,255,0.1);
  border-color: <?= $color_actual ?>;
  box-shadow: 0 15px 35px rgba(0,0,0,0.4);
}

.category-game-card.active {
  border-color: <?= $color_actual ?>;
  background: rgba(<?= implode(',', sscanf($color_actual, '#%02x%02x%02x')) ?>, 0.2);
  box-shadow: 0 10px 25px rgba(<?= implode(',', sscanf($color_actual, '#%02x%02x%02x')) ?>, 0.4);
}

.category-game-img {
  width: 130px;
  height: 170px;
  object-fit: cover;
  border-radius: 10px;
  transition: all 0.3s ease;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.category-game-card:hover .category-game-img {
  box-shadow: 0 10px 25px rgba(0,0,0,0.5);
}

.category-game-title {
  color: white;
  font-size: 0.9rem;
  font-weight: bold;
  text-align: center;
  margin-top: 10px;
  line-height: 1.2;
  transition: color 0.3s ease;
}

.category-game-card:hover .category-game-title {
  color: <?= $color_actual ?>;
}

.category-game-card.active .category-game-title {
  color: <?= $color_actual ?>;
}
</style>

<!-- Slider de juegos de la categoría -->
<div class="category-slider">
    <h3 class="category-title">🎮 Más Juegos de <?= ucfirst($juegos['categoria']) ?></h3>
    <div class="games-scroll">
        <?php foreach ($juegos_categoria as $juego_cat): ?>
            <div class="category-game-card <?= $juego_cat['id'] == $id ? 'active' : '' ?>">
                <a href="index.php?sec=juego&id=<?= $juego_cat['id'] ?>" class="text-decoration-none">
                    <img src="img/covers/<?= $juego_cat['portada'] ?>" class="category-game-img" alt="<?= $juego_cat['nombre'] ?>">
                    <div class="category-game-title"><?= $juego_cat['nombre'] ?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php 
// Incluir componente de comentarios
$juego_id = $id;
include __DIR__ . '/comentarios.php';
?>