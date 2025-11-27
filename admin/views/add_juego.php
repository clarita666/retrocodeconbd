<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">➕ Agregar Nuevo Juego</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="index.php?sec=admin_juegos" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver a la lista
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Información del Juego</h6>
            </div>
            <div class="card-body">
                <form action="actions/add_juego_acc.php" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre del Juego *</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="empresa" class="form-label">Empresa/Desarrollador *</label>
                            <input type="text" class="form-control" id="empresa" name="empresa" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="categoria" class="form-label">Categoría *</label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="">Seleccionar categoría</option>
                                <option value="1">Aventura</option>
                                <option value="2">Arcade</option>
                                <option value="3">Terror</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label">Precio (opcional)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="precio" name="precio" 
                                       step="0.01" min="0" placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="portada" class="form-label">Imagen de Portada *</label>
                        <input type="file" class="form-control" id="portada" name="portada" 
                               accept="image/*" required>
                        <div class="form-text">Formatos permitidos: JPG, PNG, WEBP. Tamaño máximo: 2MB</div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" 
                                  rows="4" placeholder="Descripción del juego..."></textarea>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php?sec=admin_juegos" class="btn btn-secondary me-md-2">
                            <i class="bi bi-x-circle"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Guardar Juego
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-info">💡 Consejos</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Usa nombres descriptivos y únicos
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Las imágenes deben ser de buena calidad
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Selecciona la categoría correcta
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Agrega una descripción atractiva
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>