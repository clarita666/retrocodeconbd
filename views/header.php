<?php
// Fragmento de header reutilizable
// Incluye la barra de navegación. Diseñado para ser incluido desde el front controller.
?>
<style>
.modern-nav {
  background: rgba(0, 0, 0, 0.3) !important;
  backdrop-filter: blur(20px) !important;
  border: 1px solid rgba(255, 255, 255, 0.1) !important;
  border-radius: 15px !important;
  padding: 10px 25px !important;
  margin: 15px 0 !important;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3) !important;
}

.modern-nav .logo img {
  width: 80px !important;
  border-radius: 10px !important;
  transition: transform 0.3s ease !important;
}

.modern-nav .logo img:hover {
  transform: scale(1.1) !important;
}

.modern-nav .nav {
  gap: 15px !important;
}

.modern-nav .nav-link {
  padding: 8px 16px !important;
  font-size: 0.9rem !important;
  border-radius: 10px !important;
  background: rgba(255, 255, 255, 0.05) !important;
  border: 1px solid rgba(255, 255, 255, 0.1) !important;
  color: rgba(255, 255, 255, 0.9) !important;
  font-weight: 500 !important;
}

.modern-nav .nav-link:hover {
  color: white !important;
  transform: translateY(-2px) !important;
}

/* Aventura - Gradiente dorado/naranja */
.modern-nav .nav-link[href*="aventura"]:hover {
  background: linear-gradient(135deg, #ff6b35, #f7931e, #ffb347) !important;
  box-shadow: 0 8px 25px rgba(255, 107, 53, 0.4) !important;
  border: 1px solid rgba(255, 107, 53, 0.6) !important;
}

/* Arcade - Gradiente cyan/azul neón */
.modern-nav .nav-link[href*="arcade"]:hover {
  background: linear-gradient(135deg, #00d4ff, #0099cc, #00ffff) !important;
  box-shadow: 0 8px 25px rgba(0, 212, 255, 0.4) !important;
  border: 1px solid rgba(0, 212, 255, 0.6) !important;
}

/* Terror - Gradiente rojo/negro */
.modern-nav .nav-link[href*="terror"]:hover {
  background: linear-gradient(135deg, #ff0000, #8b0000, #ff4444) !important;
  box-shadow: 0 8px 25px rgba(255, 0, 0, 0.4) !important;
  border: 1px solid rgba(255, 0, 0, 0.6) !important;
}

/* Otros enlaces mantienen un hover sutil */
.modern-nav .nav-link[href*="home"]:hover,
.modern-nav .nav-link[href*="quienes_somos"]:hover,
.modern-nav .nav-link[href*="formularios"]:hover,
.modern-nav .nav-link[href*="creditos"]:hover {
  background: rgba(255, 255, 255, 0.15) !important;
  box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1) !important;
  border: 1px solid rgba(255, 255, 255, 0.2) !important;
}
</style>

<header>
    <div class="navContainer modern-nav" style="display: flex; align-items: center; justify-content: space-between;">
        <div class="logo">
            <a href="index.php?sec=home">
                <img src="img/retrocode1.jpg" alt="RetroCode">
            </a>
        </div>
        <nav>
            <ul class="nav" style="display: flex; margin: 0; padding: 0; list-style: none;">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=quienes_somos">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=juegos&ser=aventura">Aventura</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=juegos&ser=arcade">Arcade</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=juegos&ser=terror">Terror</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=formularios">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=creditos">Créditos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/" style="background: linear-gradient(135deg, #ff6b35, #f7931e) !important; color: white !important;">Admin</a>
                </li>
            </ul>
        </nav>
    </div>
</header>