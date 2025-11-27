<?php

class Alerta {
    /* Metodo 1: registra un alerta en el sistema , guardandola en la sesion
    tipo: danger/warning/succes
    mensaje : el contenido del alerta
    */

    public function add_alerta(string $tipo, string $mensaje){
            
        $_SESSION['alertas'][] = [
                'tipo' => $tipo,
                'mensaje' => $mensaje
        ];
    }

    /* Metodo 2 vaciar la lista de alertas */

    public function clear_alertas(){
        $_SESSION['alertas']= [];
    }


 
    // Metodo 3  Crear el alerta , incrustar HTML desde un metodo 

    public function print_alerta($alerta) : string{
        $html = "<div class='alert alert-{$alerta['tipo']} alert-dismissible fade show' role='alert'>";
        $html .= $alerta['mensaje'];
        $html .= "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
        $html .= "</div>";

        return $html;
    }


       /* Metodo 4 -  Mostrar Alerta */

    public function get_alertas(){
         if(!empty($_SESSION['alertas'])){
            $alertasActuales = "";

            foreach($_SESSION['alertas'] as $alerta) {
                $alertasActuales .= $this->print_alerta($alerta);  
            }
            $this->clear_alertas();
            return $alertasActuales;
            
        }else {
            return null;
        }
    }




}



?>