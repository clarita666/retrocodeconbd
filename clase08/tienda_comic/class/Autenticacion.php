<?php

class Autenticacion {

    /* Metodo: para verificar las credenciales de usuario , y de ser correctas guardar los datos en una session
     */

    public function log_in($usuario, $password){

        //instanciar la clase usuario y comprobar si existe 
        $datosUsuario = (new Usuario)->usuario_x_username($usuario);

        if($datosUsuario){
                if(password_verify($password, $datosUsuario->getPassword())){
                        $datosLogin['username'] = $datosUsuario->getNombre_usuario();
                        $datosLogin['id'] = $datosUsuario->getId();
                        $_SESSION['loggedIn'] = $datosLogin;
                        return TRUE;
                }else{
                    (new Alerta())->add_alerta('danger', 'EL password ingresado no es correcto');
                    return FALSE;
                }
        }else{
            (new Alerta())->add_alerta('warning', 'El usuario ingresado no existe en nuestra BD');
            return FALSE;
        }
    }


    /* Metodos para el logout */

    public function log_out(){
        if(isset($_SESSION['loggedIn'])){
            unset($_SESSION['loggedIn']);
        }
    }


    /* Metodo para verificar si esta logeado */
    public function verify(){
         if(isset($_SESSION['loggedIn'])){
            return TRUE;
        }else {
            header('Location: index.php?sec=login');
        }
    }

}




?>