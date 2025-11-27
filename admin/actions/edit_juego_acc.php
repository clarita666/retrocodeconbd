<?php
/**
 * Acción para editar juego
 * 
 * Procesa el formulario de edición de juego.
 */

session_start();
require_once "../../functions/autoload.php";

// Verificar autenticación
(new Autenticacion)->verify();

if ($_POST) {
    try {
        $id = $_POST['id'] ?? null;
        $portadaActual = $_POST['portada_actual'] ?? '';
        
        if (!$id) {
            throw new Exception("ID de juego no válido.");
        }
        
        // Validar datos
        $nombre = trim($_POST['nombre'] ?? '');
        $empresa = trim($_POST['empresa'] ?? '');
        $categoria = $_POST['categoria'] ?? '';
        $precio = $_POST['precio'] ?? null;
        $descripcion = trim($_POST['descripcion'] ?? '');
        
        if (empty($nombre) || empty($empresa) || empty($categoria)) {
            throw new Exception("Todos los campos obligatorios deben ser completados.");
        }
        
        // Manejar imagen (opcional en edición)
        $nombreImagen = $portadaActual; // Mantener imagen actual por defecto
        
        if (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {
            $archivo = $_FILES['portada'];
            
            // Validar tipo
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($archivo['type'], $tiposPermitidos)) {
                throw new Exception("Tipo de archivo no permitido. Use JPG, PNG o WEBP.");
            }
            
            // Validar tamaño
            if ($archivo['size'] > 2 * 1024 * 1024) {
                throw new Exception("El archivo es demasiado grande. Máximo 2MB.");
            }
            
            // Generar nombre único
            $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
            $nombreImagen = time() . '_' . uniqid() . '.' . $extension;
            
            // Subir nueva imagen
            $directorioDestino = "../../img/covers/";
            $rutaDestino = $directorioDestino . $nombreImagen;
            
            if (!move_uploaded_file($archivo['tmp_name'], $rutaDestino)) {
                throw new Exception("Error al subir la nueva imagen.");
            }
            
            // Eliminar imagen anterior si existe y es diferente
            if ($portadaActual && $portadaActual !== $nombreImagen) {
                $rutaAnterior = $directorioDestino . $portadaActual;
                if (file_exists($rutaAnterior)) {
                    unlink($rutaAnterior);
                }
            }
        }
        
        // Preparar datos
        $datosJuego = [
            'nombre' => $nombre,
            'empresa' => $empresa,
            'portada' => $nombreImagen,
            'precio' => $precio ? floatval($precio) : null,
            'categoria' => intval($categoria),
            'descripcion' => $descripcion
        ];
        
        // Actualizar en base de datos
        $juego = new Juego();
        if ($juego->edit($id, $datosJuego)) {
            Alerta::success('Juego actualizado correctamente');
            header('Location: ../index.php?sec=admin_juegos');
            exit;
        } else {
            throw new Exception("Error al actualizar el juego.");
        }
        
    } catch (Exception $e) {
        Alerta::error($e->getMessage());
        header('Location: ../index.php?sec=edit_juego&id=' . ($id ?? ''));
        exit;
    }
} else {
    header('Location: ../index.php?sec=admin_juegos');
    exit;
}
?>