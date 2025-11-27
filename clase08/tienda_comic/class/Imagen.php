<?php   


class Imagen {
    
        public function subirImagen($directorio, $datosArchivo){
            if(!empty($datosArchivo['tmp_name'])){

                //vamos a dar un nombre a la imagen

                $og_name = (explode(".", $datosArchivo['name']));
                $extension = end($og_name);
                $filename = time() . ".$extension";

                //C:\xampp\tmp\phpE595.tmp   -> personajes/123214211.jpg

                $fileUpload = move_uploaded_file($datosArchivo['tmp_name'], "$directorio/$filename");
                
                if(!$fileUpload ){
                    throw new Exception("No se pudo subir la imagen");
                }else {
                    return $filename;
                }
            }
        }


        /* Metodo para borrar la imagen de mi servidor */

        public function borrarImagen($archivo){
            if(file_exists($archivo)){
                $fileDelete = unlink($archivo);

                if(!$fileDelete){
                    throw new Exception("No se pudo borrar la imagen");
                }else {
                    return TRUE;
                }
            } else {
                return FALSE;
            }
        }


}






?>
