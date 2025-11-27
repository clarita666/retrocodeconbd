<?php
/**
 * Acción para agregar juego
 * 
 * Procesa el formulario de agregar juego y maneja la subida de imágenes.
 */

session_start();
require_once "../../functions/autoload.php";

// Verificar autenticación
(new Autenticacion)->verify();

if ($_POST) {
    try {
        // Validar datos requeridos
        $nombre = trim($_POST['nombre'] ?? '');
        $empresa = trim($_POST['empresa'] ?? '');
        $categoria = $_POST['categoria'] ?? '';
        $precio = $_POST['precio'] ?? null;
        $descripcion = trim($_POST['descripcion'] ?? '');
        
        if (empty($nombre) || empty($empresa) || empty($categoria)) {
            throw new Exception("Todos los campos obligatorios deben ser completados.");
        }
        
        // Manejar subida de imagen
        $nombreImagen = '';
        if (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {
            $archivo = $_FILES['portada'];
            
            // Validar tipo de archivo
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($archivo['type'], $tiposPermitidos)) {
                throw new Exception("Tipo de archivo no permitido. Use JPG, PNG o WEBP.");
            }
            
            // Validar tamaño (2MB máximo)
            if ($archivo['size'] > 2 * 1024 * 1024) {
                throw new Exception("El archivo es demasiado grande. Máximo 2MB.");
            }
            
            // Generar nombre único
            $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
            $nombreImagen = time() . '_' . uniqid() . '.' . $extension;
            
            // Crear directorio si no existe
            $directorioDestino = "../../img/covers/";
            if (!is_dir($directorioDestino)) {
                mkdir($directorioDestino, 0755, true);
            }
            
            // Mover archivo
            $rutaDestino = $directorioDestino . $nombreImagen;
            if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                throw new Exception("Error al subir la imagen.");
            }
        } else {
            throw new Exception("Debe seleccionar una imagen de portada.");
        }
        
        // Preparar datos para insertar
        $datosJuego = [
            'nombre' => $nombre,
            'empresa' => $empresa,
            'portada' => $nombreImagen,
            'precio' => $precio ? floatval($precio) : null,
            'categoria' => intval($categoria),
            'descripcion' => $descripcion
        ];
        
        // Insertar en base de datos
        $juego = new Juego();
        if ($juego->insert($datosJuego)) {
            Alerta::success('Juego agregado correctamente');
            header('Location: ../index.php?sec=admin_juegos');
            exit;
        } else {
            throw new Exception("Error al guardar el juego en la base de datos.");
        }
        
    } catch (Exception $e) {
        // En caso de error, eliminar imagen si se subió
        if (!empty($nombreImagen) && file_exists("../../img/covers/" . $nombreImagen)) {
            unlink("../../img/covers/" . $nombreImagen);
        }
        
        Alerta::error($e->getMessage());
        header('Location: ../index.php?sec=add_juego');
        exit;
    }
} else {
    header('Location: ../index.php?sec=add_juego');
    exit;
}
?>