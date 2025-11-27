<?php
require_once 'functions/autoload.php';

$serieSeleccionada = isset($_GET['ser']) ? $_GET['ser'] : FALSE;
$juegoModel = new JuegoModel();
$productos = $juegoModel->obtenerPorCategoria($serieSeleccionada);
$miTituloBonito = $serieSeleccionada ? ucwords($serieSeleccionada) : FALSE;

// Configuración de estilos por categoría
$estilos = [
    'aventura' => [
        'gradient' => 'linear-gradient(135deg, #ff6b35, #f7931e)',
        'shadow' => 'rgba(255, 107, 53, 0.3)',
        'icon' => '🏹',
        'bg_pattern' => 'linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url("img/banner03.jpg")',
        'bg_size' => 'cover',
        'bg_position' => 'center'
    ],
    'arcade' => [
        'gradient' => 'linear-gradient(135deg, #00d4ff, #0099cc)',
        'shadow' => 'rgba(0, 212, 255, 0.3)',
        'icon' => '🕹️',
        'bg_pattern' => 'linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url("img/banner02.webp")',
        'bg_size' => 'cover',
        'bg_position' => 'center'
    ],
    'terror' => [
        'gradient' => 'linear-gradient(135deg, #ff0000, #8b0000)',
        'shadow' => 'rgba(255, 0, 0, 0.3)',
        'icon' => '👻',
        'bg_pattern' => 'linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url("img/banner01.jpg")',
        'bg_size' => 'cover',
        'bg_position' => 'center'
    ]
];

$estilo_actual = $estilos[$serieSeleccionada] ?? $estilos['aventura'];
?>

<style>
.category-hero {
    background: <?= $estilo_actual['bg_pattern'] ?>;
    background-size: <?= $estilo_actual['bg_size'] ?>;
    background-position: <?= $estilo_actual['bg_position'] ?>;
    border-radius: 25px;
    padding: 60px 40px;
    margin: 40px 0;
    text-align: center;
    box-shadow: 0 25px 50px <?= $estilo_actual['shadow'] ?>;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    position: relative;
    overflow: hidden;
}

.category-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: <?= $estilo_actual['gradient'] ?>;
    opacity: 0.1;
    animation: rotate 30s linear infinite;
}

.category-title {
    font-size: 3.5rem;
    font-weight: bold;
    background: <?= $estilo_actual['gradient'] ?>;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
}

.game-card-modern {
    background: rgba(255,255,255,0.05);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    overflow: hidden;
}

.game-card-modern:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px <?= $estilo_actual['shadow'] ?>;
    border: 1px solid rgba(255,255,255,0.2);
}

.game-image {
    border-radius: 15px;
    transition: transform 0.3s ease;
}

.game-card-modern:hover .game-image {
    transform: scale(1.05);
}

.btn-modern {
    background: <?= $estilo_actual['gradient'] ?>;
    border: none;
    border-radius: 15px;
    padding: 12px 25px;
    font-weight: bold;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px <?= $estilo_actual['shadow'] ?>;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px <?= $estilo_actual['shadow'] ?>;
}
</style>

<div class="category-hero">
    <h1 class="category-title"><?= $estilo_actual['icon'] ?> <?= $miTituloBonito ?></h1>
    <p class="text-light fs-5 opacity-75">Descubre los mejores juegos de <?= strtolower($miTituloBonito) ?></p>
</div>


<div class="row">
  <?php if(count($productos)) { ?>
    <?php foreach($productos as $juegos) { ?>
      <div class="col-12 mb-4">
        <div class="game-card-modern p-4">
          <div class="row align-items-center">
            
            <!-- Imagen -->
            <div class="col-md-3">
              <img src="img/covers/<?= $juegos['portada'] ?>" 
                   class="game-image w-100"
                   alt="<?= $juegos['nombre'] ?>" 
                   style="height: 250px; object-fit: cover; cursor: pointer;"
                   data-bs-toggle="modal" 
                   data-bs-target="#modalProducto<?= $juegos['id'] ?>">
            </div>

            <!-- Contenido -->
            <div class="col-md-9">
              <div class="d-flex flex-column h-100 justify-content-between">
                <div>
                  <p class="fs-6 fw-bold text-light mb-2 opacity-75"><?= $juegos['empresa'] ?></p>
                  <h3 class="text-light mb-3" style="font-size: 2rem; font-weight: bold;"><?= $juegos['nombre'] ?></h3>
                  <p class="text-light opacity-90 fs-5 mb-4"><?= substr($juegos['bajada'], 0, 200) ?>...</p>
                </div>
                
                <!-- Botón -->
                <div class="d-flex justify-content-end">
                  <a href="index.php?sec=juego&id=<?= $juegos['id'] ?>" class="btn btn-modern text-white">Explorar Juego</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>


   

<!-- Modal -->
<div class="modal fade" id="modalProducto<?= $juegos['id'] ?>" tabindex="-1" aria-labelledby="previewLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalProducto"><?=  $juegos['nombre'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center">
        <img width="400px" src="img/covers/<?=  $juegos['portada'] ?>" class="img-fluid mb-3" alt="Producto">
        <p><?= $juegos['nombre'] ?></p>
      </div>
    </div>
  </div>
</div>

    <?php } ?>

    <?php }else{ ?>
        <div class="col-12">
            <h2 class="text-center text-danger mb-5"> No se encontraron los juegos para esta categoria</h2>
        </div>
    
    <?php } ?>   

</div>
