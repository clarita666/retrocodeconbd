<?php

class  Personaje {
    protected $id;
    protected $nombre;
    protected $alias;
    protected $biografia;
    protected $creador;
    protected $primera_aparicion;
    protected $imagen;


    //METODOS

     public function lista_completa() {
            
        $resultado = [];

      
        $conexion = (new Conexion())->getConexion();

        
        $query = "SELECT * FROM personajes";


        $PDOStatament = $conexion->prepare($query);
        $PDOStatament->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatament->execute();

      
        $resultado = $PDOStatament->fetchAll();

        return $resultado;
        
    }



    //Metodo datos en particular

      public function get_x_id(int $id) {


        $conexion = (new Conexion())->getConexion();

        
        $query = "SELECT * FROM personajes WHERE id = :id";


    

        $PDOStatament = $conexion->prepare($query);
        $PDOStatament->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatament->execute(
            [
                "id" => $id
            ]
        );

    
        $result = $PDOStatament->fetch();

        if(!$result){
            return null;
        }

        return $result;
        
        

    }

    
    /* Metodo: devuelve el nombre de un personaje y su alias entre parentesis */

    public function getTitulo($aliasPrimero = False){

        if($aliasPrimero){
            $result = "$this->alias ($this->nombre)";
        } else {
            $result = "$this->nombre ($this->alias)";
        }

        return $result;

    }

    /* Metodo para insertar un nuevo personaje a la BD */

    public function insert($nombre,$alias,$creador,$primera_aparicion,$biografia,$imagen){

         $conexion = (new Conexion())->getConexion();

         $query = "INSERT INTO personajes(id,nombre,alias,biografia,creador,primera_aparicion,imagen) VALUES(NULL,:nombre,:alias, :biografia, :creador, :primera_aparicion, :imagen) " ;

         $PDOStatament = $conexion->prepare($query);
         $PDOStatament->execute(
            [
                'nombre' => $nombre,
                'alias' => $alias,
                'biografia' => $biografia,
                'creador' => $creador,
                'primera_aparicion' => $primera_aparicion,
                'imagen' => $imagen
            ]
        );

    }


    public function edit($nombre,$alias,$creador,$primera_aparicion,$biografia, $id){

         $conexion = (new Conexion())->getConexion();

         $query = "UPDATE personajes SET nombre = :nombre, alias = :alias, biografia = :biografia, creador = :creador, primera_aparicion = :primera_aparicion WHERE id = :id " ;

         $PDOStatament = $conexion->prepare($query);
         $PDOStatament->execute(
            [
                'id' => $id,
                'nombre' => $nombre,
                'alias' => $alias,
                'biografia' => $biografia,
                'creador' => $creador,
                'primera_aparicion' => $primera_aparicion,
                
            ]
        );

    }

  public function reemplazar_imagen($imagen, $id){

         $conexion = (new Conexion())->getConexion();

         $query = "UPDATE personajes SET imagen = :imagen WHERE id = :id " ;

         $PDOStatament = $conexion->prepare($query);
         $PDOStatament->execute(
            [
                'id' => $id,
                'imagen' => $imagen
                
            ]
        );

    }


      public function delete(){

         $conexion = (new Conexion())->getConexion();

         $query = "DELETE FROM personajes WHERE id = :id" ;

         $PDOStatament = $conexion->prepare($query);
         $PDOStatament->execute(
            [
                
                'id' => $this->id
                
            ]
        );

    }


    


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of alias
     */ 
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Get the value of biografia
     */ 
    public function getBiografia()
    {
        return $this->biografia;
    }

    /**
     * Get the value of creador
     */ 
    public function getCreador()
    {
        return $this->creador;
    }

    /**
     * Get the value of primera_aparicion
     */ 
    public function getPrimera_aparicion()
    {
        return $this->primera_aparicion;
    }

    /**
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }
}







?>