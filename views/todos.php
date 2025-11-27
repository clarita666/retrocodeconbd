<?php
require_once __DIR__ . '/../models/JuegoModel.php';

$juegoModel = new JuegoModel();
$productos = $juegoModel->obtenerTodos();
?>

<style>
.todos-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 4rem 0;
    margin-bottom: 3rem;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}

.todos-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.todos-hero h1 {
    position: relative;
    z-index: 2;
    color: white;
    font-size: 3rem;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    margin: 0;
}

.games-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
    padding: 0 1rem;
}

.game-card {
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.game-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.game-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.game-card:hover img {
    transform: scale(1.1);
}

.game-info {
    padding: 1.5rem;
}

.game-company {
    color: #6c5ce7;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.game-title {
    color: #2d3436;
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.game-btn {
    background: linear-gradient(135deg, #6c5ce7, #a29bfe);
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    width: 100%;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
}

.game-btn:hover {
    background: linear-gradient(135deg, #5f3dc4, #6c5ce7);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(108, 92, 231, 0.4);
    color: white;
    text-decoration: none;
}

.no-games {
    text-align: center;
    padding: 4rem 2rem;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.no-games h2 {
    color: #636e72;
    font-size: 1.8rem;
    margin: 0;
}

@media (max-width: 768px) {
    .games-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }
    
    .todos-hero h1 {
        font-size: 2rem;
    }
}
</style>

<div class="todos-hero">
    <div class="container">
        <h1 class="text-center">Todos los Juegos</h1>
    </div>
</div>

<div class="container">
    <?php if(count($productos)): ?>
        <div class="games-grid">
            <?php foreach($productos as $juego): ?>
                <div class="game-card">
                    <img src="img/covers/<?= $juego['portada'] ?>" alt="<?= $juego['nombre'] ?>">
                    <div class="game-info">
                        <div class="game-company"><?= $juego['empresa'] ?></div>
                        <h3 class="game-title"><?= $juego['nombre'] ?></h3>
                        <a href="index.php?sec=particular&id=<?= $juego['id'] ?>" class="game-btn">
                            Ver Detalles
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-games">
            <h2>No se encontraron juegos</h2>
        </div>
    <?php endif; ?>
</div>
