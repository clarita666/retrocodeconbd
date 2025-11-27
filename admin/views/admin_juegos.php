<?php
$juego = new Juego();
$juegos = $juego->catalogo_completo();
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">🎮 Administración de Juegos</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php?sec=add_juego" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Agregar Juego
        </a>
    </div>
</div>

<?php if (isset($_GET['msg'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i>
        <?php
        switch ($_GET['msg']) {
            case 'add':
                echo 'Juego agregado correctamente.';
                break;
            case 'edit':
                echo 'Juego actualizado correctamente.';
                break;
            case 'delete':
                echo 'Juego eliminado correctamente.';
                break;
        }
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Lista de Juegos (<?= count($juegos) ?> total)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Portada</th>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($juegos as $item): ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td>
                                <img src="../img/covers/<?= $item['portada'] ?>" 
                                     alt="<?= $item['nombre'] ?>" 
                                     class="img-thumbnail" 
                                     style="width: 50px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($item['nombre']) ?></strong>
                            </td>
                            <td><?= htmlspecialchars($item['empresa']) ?></td>
                            <td>
                                <span class="badge bg-secondary"><?= $item['categoria_nombre'] ?? 'Sin categoría' ?></span>
                            </td>
                            <td>
                                <?php if ($item['precio'] && is_numeric($item['precio'])): ?>
                                    <span class="text-success">$<?= number_format($item['precio'], 2) ?></span>
                                <?php elseif ($item['precio'] === 'pago.png'): ?>
                                    <span class="text-warning">Pago</span>
                                <?php else: ?>
                                    <span class="text-muted">Gratis</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="../index.php?sec=particular&id=<?= $item['id'] ?>" 
                                       class="btn btn-sm btn-outline-info" 
                                       target="_blank" 
                                       title="Ver en sitio web">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="index.php?sec=edit_juego&id=<?= $item['id'] ?>" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="index.php?sec=delete_juego&id=<?= $item['id'] ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>