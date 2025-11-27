<?php
/**
 * Clase Alerta
 * 
 * Sistema de mensajes flash para mostrar notificaciones al usuario.
 * Utiliza sesiones para persistir mensajes entre redirecciones.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 */

class Alerta {
    
    /**
     * Tipos de alerta disponibles
     */
    const SUCCESS = 'success';
    const ERROR = 'danger';
    const WARNING = 'warning';
    const INFO = 'info';
    
    /**
     * Agrega una alerta a la sesión
     * 
     * @param string $mensaje Texto del mensaje
     * @param string $tipo Tipo de alerta (success, danger, warning, info)
     */
    public static function add($mensaje, $tipo = self::INFO) {
        if (!isset($_SESSION['alertas'])) {
            $_SESSION['alertas'] = [];
        }
        
        $_SESSION['alertas'][] = [
            'mensaje' => $mensaje,
            'tipo' => $tipo,
            'timestamp' => time()
        ];
    }
    
    /**
     * Obtiene todas las alertas y las limpia de la sesión
     * 
     * @return array Array de alertas
     */
    public static function getAll() {
        $alertas = $_SESSION['alertas'] ?? [];
        unset($_SESSION['alertas']);
        return $alertas;
    }
    
    /**
     * Verifica si hay alertas pendientes
     * 
     * @return bool True si hay alertas
     */
    public static function hasAlertas() {
        return !empty($_SESSION['alertas']);
    }
    
    /**
     * Renderiza las alertas en HTML Bootstrap
     * 
     * @return string HTML de las alertas
     */
    public static function render() {
        $alertas = self::getAll();
        $html = '';
        
        foreach ($alertas as $alerta) {
            $html .= '<div class="alert alert-' . $alerta['tipo'] . ' alert-dismissible fade show" role="alert">';
            $html .= htmlspecialchars($alerta['mensaje']);
            $html .= '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
            $html .= '</div>';
        }
        
        return $html;
    }
    
    /**
     * Métodos de conveniencia para tipos específicos
     */
    public static function success($mensaje) {
        self::add($mensaje, self::SUCCESS);
    }
    
    public static function error($mensaje) {
        self::add($mensaje, self::ERROR);
    }
    
    public static function warning($mensaje) {
        self::add($mensaje, self::WARNING);
    }
    
    public static function info($mensaje) {
        self::add($mensaje, self::INFO);
    }
}
?>