<?php
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php?sec=admin_juegos');
    exit;
}

$juego = new Juego();
$datosJuego = $juego->juego_x_id($id);

if (!$datosJuego) {
    header('Location: index.php?sec=admin_juegos&error=not_found');
    exit;
}
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">🗑️ Eliminar Juego</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php?sec=admin_juegos" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver a la lista
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">
                    <i class="bi bi-exclamation-triangle"></i>
                    Confirmar Eliminación
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    <strong>⚠️ Advertencia:</strong> Esta acción no se puede deshacer. 
                    El juego y su imagen serán eliminados permanentemente.
                </div>

                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="../img/covers/<?= $datosJuego['portada'] ?>" 
                             alt="<?= htmlspecialchars($datosJuego['nombre']) ?>" 
                             class="img-fluid rounded shadow-sm mb-3" 
                             style="max-height: 200px;">
                    </div>
                    <div class="col-md-8">
                        <h4><?= htmlspecialchars($datosJuego['nombre']) ?></h4>
                        <p><strong>Empresa:</strong> <?= htmlspecialchars($datosJuego['empresa']) ?></p>
                        <p><strong>Categoría:</strong> <?= $datosJuego['categoria_nombre'] ?? 'Sin categoría' ?></p>
                        <p><strong>Precio:</strong> 
                            <?php if ($datosJuego['precio'] && is_numeric($datosJuego['precio'])): ?>
                                $<?= number_format($datosJuego['precio'], 2) ?>
                            <?php elseif ($datosJuego['precio'] === 'pago.png'): ?>
                                Pago
                            <?php else: ?>
                                Gratis
                            <?php endif; ?>
                        </p>
                        <?php if ($datosJuego['bajada']): ?>
                            <p><strong>Descripción:</strong></p>
                            <p class="text-muted"><?= htmlspecialchars($datosJuego['bajada']) ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <a href="index.php?sec=admin_juegos" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                    
                    <form action="actions/delete_juego_acc.php" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $datosJuego['id'] ?>">
                        <input type="hidden" name="portada" value="<?= $datosJuego['portada'] ?>">
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('¿Estás seguro de que quieres eliminar este juego? Esta acción no se puede deshacer.')">
                            <i class="bi bi-trash"></i> Eliminar Definitivamente
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>