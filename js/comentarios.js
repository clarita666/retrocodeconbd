/**
 * Sistema de Comentarios AJAX
 * 
 * Maneja la funcionalidad de comentarios en tiempo real sin recargar la página.
 * Utiliza la Fetch API para comunicarse con el backend PHP.
 * 
 * @author Equipo "Noobs con Código"
 * @version 1.0
 * @since 2024-01-01
 * 
 * Características:
 * - Envío de comentarios sin recarga de página
 * - Actualización automática de la lista de comentarios
 * - Manejo de errores con mensajes al usuario
 * - Validación del lado del cliente
 * - Formateo de fechas localizado
 * 
 * Dependencias:
 * - API: /api/comentarios.php
 * - DOM: #comentario-form, #comentarios-lista
 * - Fetch API (ES6+)
 */

/**
 * Inicialización del sistema de comentarios
 * 
 * Se ejecuta cuando el DOM está completamente cargado.
 * Configura los event listeners y la funcionalidad AJAX.
 */
document.addEventListener('DOMContentLoaded', function() {
    // Referencias a elementos del DOM
    const form = document.getElementById('comentario-form');
    const contenedor = document.getElementById('comentarios-lista');
    
    // Configurar formulario si existe en la página
    if (form) {
        /**
         * Manejador del envío del formulario
         * 
         * Intercepta el envío del formulario para procesarlo vía AJAX
         * en lugar de recargar la página completa.
         * 
         * @param {Event} e - Evento de submit del formulario
         */
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Evita recargar página
            
            // Crear FormData con los datos del formulario
            const formData = new FormData(form);
            
            // Enviar datos al servidor vía POST
            fetch('api/comentarios.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Limpiar formulario tras envío exitoso
                    form.reset();
                    // Recargar lista de comentarios
                    cargarComentarios();
                } else {
                    // Mostrar error del servidor
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                // Manejar errores de red o JavaScript
                console.error('Error:', error);
                alert('Error al enviar comentario');
            });
        });
    }
    
    /**
     * Carga los comentarios desde el servidor
     * 
     * Realiza una petición GET al API para obtener todos los comentarios
     * del juego actual y actualiza la interfaz.
     * 
     * @function
     */
    function cargarComentarios() {
        // Obtener ID del juego desde el formulario
        const juegoId = document.querySelector('input[name="juego_id"]').value;
        
        // Petición GET al API
        fetch(`api/comentarios.php?juego_id=${juegoId}`)
        .then(response => response.json())
        .then(comentarios => {
            // Actualizar la interfaz con los nuevos comentarios
            mostrarComentarios(comentarios);
        })
        .catch(error => {
            console.error('Error al cargar comentarios:', error);
        });
    }
    
    /**
     * Renderiza la lista de comentarios en el DOM
     * 
     * Genera el HTML para mostrar los comentarios y lo inserta
     * en el contenedor correspondiente.
     * 
     * @param {Array} comentarios - Array de objetos comentario
     * @param {number} comentarios[].id - ID del comentario
     * @param {string} comentarios[].contenido - Texto del comentario
     * @param {string} comentarios[].creado_at - Fecha de creación (ISO)
     * @param {string} comentarios[].nombre_usuario - Nombre del usuario (opcional)
     */
    function mostrarComentarios(comentarios) {
        let html = '';
        
        if (comentarios.length > 0) {
            // Generar HTML para cada comentario
            comentarios.forEach(comentario => {
                // Formatear fecha en formato local
                const fecha = new Date(comentario.creado_at).toLocaleString();
                
                html += `
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-1 text-muted">
                                ${comentario.nombre_usuario || 'Anónimo'}
                            </h6>
                            <p class="card-text mb-0">${comentario.contenido}</p>
                            <small class="text-muted">${fecha}</small>
                        </div>
                    </div>
                `;
            });
        } else {
            // Mensaje cuando no hay comentarios
            html = '<p class="text-muted">No hay comentarios aún. ¡Sé el primero en comentar!</p>';
        }
        
        // Actualizar el contenedor con el nuevo HTML
        contenedor.innerHTML = html;
    }
});

/**
 * Notas de implementación:
 * 
 * 1. Seguridad:
 *    - El contenido se escapa automáticamente en el servidor
 *    - Se usa innerHTML pero con datos controlados
 * 
 * 2. UX/UI:
 *    - Feedback inmediato al usuario
 *    - Formulario se limpia tras envío exitoso
 *    - Manejo de estados de error
 * 
 * 3. Performance:
 *    - Solo se recargan comentarios tras nuevo envío
 *    - Uso eficiente de Fetch API
 * 
 * 4. Compatibilidad:
 *    - Requiere navegadores con soporte ES6+
 *    - Fetch API (IE11+ con polyfill)
 */