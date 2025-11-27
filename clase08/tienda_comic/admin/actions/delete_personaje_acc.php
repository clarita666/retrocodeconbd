<?php 

    require_once "../../functions/autoload.php";

    $id = $_GET['id'] ? $_GET['id'] : FALSE;

    $personaje = (new Personaje())->get_x_id($id);

   

    

    try {

            if(!empty($personaje->getImagen())){
                (new Imagen())->borrarImagen(__DIR__ .  "/../../img/personajes/" . $personaje->getImagen());
            }

            $personaje->delete();




            $personaje->edit($postData['nombre'],$postData['alias'],$postData['creador'],$postData['primera_aparicion'], $postData['bio'], $id);

            (new Alerta())->add_alerta('danger', 'Personaje se elimino correctamente');

            header('Location: ../index.php?sec=admin_personajes');

    } catch (\Exception $e) {
        die("No se pudo cargar el personaje" .  $e);
    }



?>