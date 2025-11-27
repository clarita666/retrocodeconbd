<?php
/**
 * Componente de Comentarios
 * 
 * Componente reutilizable para mostrar y gestionar comentarios de juegos.
 * Incluye formulario de envío, lista de comentarios existentes y estilos dinámicos.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 * @since 2024-01-01
 * 
 * Características:
 * - Colores dinámicos por juego
 * - Comentarios de ejemplo si no hay comentarios reales
 * - Formulario AJAX para nuevos comentarios
 * - Estilos glassmorphism responsivos
 * - Scroll personalizado para lista de comentarios
 * 
 * Variables requeridas:
 * @var int $juego_id - ID del juego actual
 * @var array $comentarios - Array de comentarios de la base de datos
 */

// Paleta de colores específica para cada juego
$colores_juegos = [
    1 => '#A0616A', 2 => '#8B7EC8', 3 => '#7A8B8B', 4 => '#9B7EBD', 5 => '#B8956D',
    6 => '#E6C79C', 7 => '#D4A574', 8 => '#7FCDCD', 9 => '#8FBC8F', 10 => '#D8A7CA',
    11 => '#90B494', 12 => '#8FA4D3', 13 => '#A68B5B', 14 => '#C5B358', 15 => '#B8956D'
];
$color_actual = $colores_juegos[$juego_id] ?? '#8B7EC8';

/**
 * Comentarios de ejemplo por juego
 * 
 * Array asociativo que contiene comentarios predefinidos para cada juego.
 * Se usa como fallback cuando no hay comentarios reales en la base de datos.
 * 
 * Estructura:
 * [juego_id => [
 *   ['nombre' => string, 'contenido' => string, 'fecha' => datetime]
 * ]]
 */
$comentarios_ejemplo = [
    1 => [ // Resident Evil
        ['nombre' => 'RetroGamer92', 'contenido' => '¡Qué juegazo! Los sustos que me pegué la primera vez que lo jugué. Un clásico del survival horror que nunca pasa de moda.', 'fecha' => '2024-01-15 14:30:00'],
        ['nombre' => 'ZombieHunter', 'contenido' => 'La atmósfera de este juego es increíble. Cada puerta que abrías era una ruleta rusa. Capcom hizo historia con este título.', 'fecha' => '2024-01-14 20:15:00']
    ],
    2 => [ // Silent Hill
        ['nombre' => 'HorrorFan88', 'contenido' => 'Silent Hill 2 es una obra maestra psicológica. La historia de James es brutal y la atmósfera es única.', 'fecha' => '2024-01-16 16:45:00'],
        ['nombre' => 'FoggyTown', 'contenido' => 'La banda sonora de Akira Yamaoka es simplemente perfecta. Me da escalofríos cada vez que la escucho.', 'fecha' => '2024-01-15 11:20:00']
    ],
    6 => [ // Pac-Man
        ['nombre' => 'ArcadeKing', 'contenido' => '¡El rey de los arcades! Horas y horas jugando en las máquinas de los 80s. Simple pero adictivo.', 'fecha' => '2024-01-17 09:30:00'],
        ['nombre' => 'DotEater', 'contenido' => 'Un diseño de juego perfecto que nunca pasa de moda. La estrategia detrás de la simplicidad es genial.', 'fecha' => '2024-01-16 18:00:00']
    ],
    11 => [ // Minecraft
        ['nombre' => 'BlockBuilder', 'contenido' => 'Minecraft cambió mi vida. La creatividad que permite es infinita. Llevo años jugando y sigo descubriendo cosas.', 'fecha' => '2024-01-18 12:00:00'],
        ['nombre' => 'CrafterPro', 'contenido' => 'Desde 2009 jugando y sigue siendo mi juego favorito. ¡Viva Minecraft! La comunidad es increíble.', 'fecha' => '2024-01-17 15:30:00']
    ]
];

/**
 * Determina qué comentarios mostrar
 * Prioriza comentarios reales de la BD, sino usa ejemplos
 */
$comentarios_mostrar = count($comentarios) > 0 ? $comentarios : ($comentarios_ejemplo[$juego_id] ?? []);
?>

<style>
/**
 * Estilos CSS dinámicos para el componente de comentarios
 * 
 * Características del diseño:
 * - Glassmorphism con backdrop-filter
 * - Colores dinámicos basados en el juego actual
 * - Efectos hover y transiciones suaves
 * - Scrollbar personalizado
 * - Responsive design
 */
/* Contenedor principal con efecto glassmorphism */
.comments-section {
  background: linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
  border-radius: 25px;
  padding: 40px;
  margin: 40px 0;
  backdrop-filter: blur(15px);
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 20px 40px rgba(0,0,0,0.3);
}

.comments-title {
  color: <?= $color_actual ?>;
  font-size: 2.2rem;
  font-weight: bold;
  margin-bottom: 30px;
  text-align: center;
}

.comment-form {
  background: rgba(255,255,255,0.05);
  border-radius: 20px;
  padding: 30px;
  margin-bottom: 30px;
  border: 1px solid rgba(255,255,255,0.1);
}

.comment-input {
  background: rgba(255,255,255,0.1) !important;
  border: 2px solid rgba(255,255,255,0.2) !important;
  border-radius: 15px !important;
  color: white !important;
  padding: 15px !important;
  transition: all 0.3s ease !important;
}

.comment-input:focus {
  background: rgba(255,255,255,0.15) !important;
  border-color: <?= $color_actual ?> !important;
  box-shadow: 0 0 0 0.2rem rgba(<?= implode(',', sscanf($color_actual, '#%02x%02x%02x')) ?>, 0.25) !important;
  color: white !important;
  transform: translateY(-2px);
}

.comment-input::placeholder {
  color: rgba(255,255,255,0.6) !important;
}

.comment-btn {
  background: linear-gradient(135deg, <?= $color_actual ?>, <?= $color_actual ?>88);
  border: none;
  border-radius: 15px;
  padding: 12px 30px;
  font-weight: bold;
  color: white;
  transition: all 0.3s ease;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.comment-btn:hover {
  transform: translateY(-3px) scale(1.05);
  box-shadow: 0 10px 25px rgba(0,0,0,0.4);
  color: white;
}

.comment-card {
  background: rgba(255,255,255,0.08);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 15px;
  padding: 20px;
  margin-bottom: 15px;
  transition: all 0.3s ease;
}

.comment-card:hover {
  background: rgba(255,255,255,0.12);
  transform: translateX(5px);
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.comment-author {
  color: <?= $color_actual ?>;
  font-weight: bold;
  font-size: 1rem;
  margin-bottom: 8px;
}

.comment-text {
  color: rgba(255,255,255,0.9);
  line-height: 1.6;
  margin-bottom: 10px;
}

.comment-date {
  color: rgba(255,255,255,0.6);
  font-size: 0.85rem;
}

.comments-list {
  max-height: 400px;
  overflow-y: auto;
  padding-right: 10px;
}

.comments-list::-webkit-scrollbar {
  width: 6px;
}

.comments-list::-webkit-scrollbar-track {
  background: rgba(255,255,255,0.1);
  border-radius: 10px;
}

.comments-list::-webkit-scrollbar-thumb {
  background: <?= $color_actual ?>;
  border-radius: 10px;
}

.no-comments {
  text-align: center;
  color: rgba(255,255,255,0.6);
  padding: 40px;
  background: rgba(255,255,255,0.03);
  border-radius: 15px;
  border: 1px dashed rgba(255,255,255,0.2);
}

.comment-stats {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding: 15px;
  background: rgba(<?= implode(',', sscanf($color_actual, '#%02x%02x%02x')) ?>, 0.1);
  border-radius: 10px;
  border: 1px solid rgba(<?= implode(',', sscanf($color_actual, '#%02x%02x%02x')) ?>, 0.2);
}
</style>

<!-- 
    SECCIÓN DE COMENTARIOS
    
    Estructura:
    1. Título con estadísticas
    2. Formulario de nuevo comentario
    3. Lista de comentarios existentes
    
    Funcionalidad AJAX:
    - Envío sin recarga de página
    - Actualización automática de la lista
    - Validación en tiempo real
-->
<div class="comments-section">
    <h3 class="comments-title">💬 Comentarios de la Comunidad</h3>
    
    <div class="comment-stats">
        <span class="text-light">👥 <?= count($comentarios_mostrar) ?> comentarios</span>
        <span class="text-light opacity-75">🎮 Comparte tu experiencia</span>
    </div>
    
    <!-- Formulario para nuevos comentarios -->
    <div class="comment-form">
        <h5 class="text-light mb-3">✍️ Dejá tu comentario</h5>
        <!-- Formulario procesado por AJAX (js/comentarios.js) -->
        <form id="comentario-form">
            <input type="hidden" name="juego_id" value="<?= $juego_id ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control comment-input" name="nombre" id="nombre" placeholder="👤 Tu nombre" required>
                </div>
                <div class="col-md-12 mb-3">
                    <textarea class="form-control comment-input" name="contenido" id="comentario" rows="4" placeholder="💬 ¿Qué opinas sobre este juego? Comparte tu experiencia..." required></textarea>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="comment-btn">🚀 Publicar Comentario</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Lista de comentarios con scroll personalizado -->
    <div class="comments-list" id="comentarios-lista">
        <?php if (count($comentarios_mostrar) > 0): ?>
            <?php foreach ($comentarios_mostrar as $comentario): ?>
                <div class="comment-card">
                    <div class="comment-author">👤 <?= htmlspecialchars($comentario['nombre'] ?? 'Gamer Anónimo') ?></div>
                    <div class="comment-text"><?= htmlspecialchars($comentario['contenido']) ?></div>
                    <div class="comment-date">🕒 <?= isset($comentario['creado_at']) ? date('d/m/Y H:i', strtotime($comentario['creado_at'])) : date('d/m/Y H:i', strtotime($comentario['fecha'])) ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-comments">
                <h5>🎮 ¡Sé el primero en comentar!</h5>
                <p>Comparte tu experiencia con este juego clásico</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Script AJAX para manejo de comentarios en tiempo real -->
<script src="js/comentarios.js"></script>