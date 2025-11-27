<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-lg border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h2 class="text-primary">🎮 RetroCode</h2>
                    <p class="text-muted">Panel de Administración</p>
                </div>

                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle"></i>
                        Credenciales incorrectas. Inténtalo de nuevo.
                    </div>
                <?php endif; ?>

                <form action="actions/auth_login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" 
                                   placeholder="admin@retrocode.com" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Ingresa tu contraseña" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <small class="text-muted">
                        <strong>Credenciales de prueba:</strong><br>
                        Email: admin@retrocode.com<br>
                        Contraseña: admin123
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>