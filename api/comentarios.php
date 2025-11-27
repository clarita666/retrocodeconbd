<?php
/**
 * API REST de Comentarios
 * 
 * Endpoint para manejar operaciones CRUD de comentarios vía AJAX.
 * Soporta tanto GET (obtener comentarios) como POST (crear comentarios).
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 * @since 2024-01-01
 * 
 * Endpoints disponibles:
 * 
 * GET /api/comentarios.php?juego_id={id}
 * - Obtiene todos los comentarios de un juego específico
 * - Parámetros: juego_id (int) - ID del juego
 * - Respuesta: Array JSON de comentarios
 * 
 * POST /api/comentarios.php
 * - Crea un nuevo comentario
 * - Parámetros: juego_id (int), contenido (string)
 * - Respuesta: {"success": boolean, "message": string}
 * 
 * Características:
 * - Respuestas en formato JSON
 * - Validación de parámetros
 * - Manejo de errores
 * - Métodos HTTP RESTful
 * - Integración con ComentarioModel
 */

// Configurar respuesta JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Para desarrollo local
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Cargar dependencias
require_once __DIR__ . '/../functions/autoload.php';

// Inicializar modelo
$comentarioModel = new ComentarioModel();

/**
 * Manejo de peticiones POST - Crear comentario
 * 
 * Procesa la creación de un nuevo comentario para un juego específico.
 * Valida que los parámetros requeridos estén presentes.
 * 
 * Parámetros POST requeridos:
 * - juego_id: ID del juego (entero)
 * - contenido: Texto del comentario (string, máx 1000 chars)
 * 
 * Respuesta JSON:
 * - Éxito: {"success": true, "message": "Comentario guardado"}
 * - Error: {"success": false, "message": "Error al guardar"}
 */
if ($_POST && isset($_POST['juego_id']) && isset($_POST['contenido'])) {
    try {
        // Validar y sanitizar datos
        $juego_id = filter_var($_POST['juego_id'], FILTER_VALIDATE_INT);
        $contenido = trim($_POST['contenido']);
        
        // Validaciones básicas
        if ($juego_id === false || $juego_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'ID de juego inválido']);
            exit;
        }
        
        if (empty($contenido) || strlen($contenido) > 1000) {
            echo json_encode(['success' => false, 'message' => 'Contenido inválido']);
            exit;
        }
        
        // Crear comentario en la base de datos
        $resultado = $comentarioModel->crear($juego_id, $contenido);
        
        if ($resultado) {
            echo json_encode([
                'success' => true, 
                'message' => 'Comentario guardado correctamente'
            ]);
        } else {
            echo json_encode([
                'success' => false, 
                'message' => 'Error al guardar el comentario'
            ]);
        }
        
    } catch (Exception $e) {
        // Manejar errores de base de datos
        error_log('Error en API comentarios: ' . $e->getMessage());
        echo json_encode([
            'success' => false, 
            'message' => 'Error interno del servidor'
        ]);
    }
}
/**
 * Manejo de peticiones GET - Obtener comentarios
 * 
 * Recupera todos los comentarios de un juego específico.
 * Los comentarios se ordenan por fecha de creación descendente.
 * 
 * Parámetros GET requeridos:
 * - juego_id: ID del juego (entero)
 * 
 * Respuesta JSON:
 * Array de objetos comentario con estructura:
 * [
 *   {
 *     "id": int,
 *     "contenido": string,
 *     "creado_at": datetime,
 *     "juego_id": int,
 *     "nombre_usuario": string|null
 *   }
 * ]
 */
elseif ($_GET && isset($_GET['juego_id'])) {
    try {
        // Validar parámetro
        $juego_id = filter_var($_GET['juego_id'], FILTER_VALIDATE_INT);
        
        if ($juego_id === false || $juego_id <= 0) {
            echo json_encode(['error' => 'ID de juego inválido']);
            exit;
        }
        
        // Obtener comentarios del modelo
        $comentarios = $comentarioModel->obtenerPorJuego($juego_id);
        
        // Retornar comentarios (puede ser array vacío)
        echo json_encode($comentarios);
        
    } catch (Exception $e) {
        // Manejar errores de base de datos
        error_log('Error al obtener comentarios: ' . $e->getMessage());
        echo json_encode(['error' => 'Error interno del servidor']);
    }
}
/**
 * Manejo de peticiones inválidas
 * 
 * Responde con error cuando no se proporcionan los parámetros
 * requeridos o se usa un método HTTP no soportado.
 */
else {
    http_response_code(400); // Bad Request
    echo json_encode([
        'error' => 'Parámetros inválidos',
        'usage' => [
            'GET' => 'comentarios.php?juego_id={id}',
            'POST' => 'comentarios.php con juego_id y contenido'
        ]
    ]);
}

/**
 * Ejemplos de uso:
 * 
 * JavaScript (GET):
 * fetch('api/comentarios.php?juego_id=1')
 *   .then(response => response.json())
 *   .then(comentarios => console.log(comentarios));
 * 
 * JavaScript (POST):
 * const formData = new FormData();
 * formData.append('juego_id', '1');
 * formData.append('contenido', 'Excelente juego!');
 * 
 * fetch('api/comentarios.php', {
 *   method: 'POST',
 *   body: formData
 * })
 * .then(response => response.json())
 * .then(result => console.log(result));
 * 
 * cURL (GET):
 * curl "http://localhost/tpfinal/api/comentarios.php?juego_id=1"
 * 
 * cURL (POST):
 * curl -X POST \
 *   -d "juego_id=1&contenido=Gran juego" \
 *   "http://localhost/tpfinal/api/comentarios.php"
 */