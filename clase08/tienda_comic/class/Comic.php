<?php

class Comic {
    protected $id;
    protected $titulo;
    protected $volumen;
    protected $numero;
    protected $publicacion;
    protected $origen;
    protected $editorial;
    protected $bajada;
    protected $portada;
    protected $precio;
    protected $id_personaje;
    protected $id_serie;
    protected $id_guionista;
    protected $id_artista;

    //METODOS

    //devuelve el catalogo de comic de un personaje en particular 

    public function catalogo_x_personaje(int $id_personaje) {
            
        $catalogo = [];

        //1-llamar a la conexion
        $conexion = (new Conexion())->getConexion();

        // 2- Query
        $query = "SELECT * FROM comics WHERE id_personaje = $id_personaje";


        //3 - Preparar la conexion

        $PDOStatament = $conexion->prepare($query);

        //4 - LLamar a la clase COMIC

        $PDOStatament->setFetchMode(PDO::FETCH_CLASS, self::class);

        //5- ejecutar la consulta

        $PDOStatament->execute();

        // 6 - Convertir lo que viene desde mysql en un array asociativo
        $catalogo = $PDOStatament->fetchAll();

        return $catalogo;
        
    }


    /* devolver los datos un comic en particular 
        :idProducto es un marcador de posicion
        No se coloca directamente en la cadena SQL para evitar que alguien pueda manipular el valor y asi evitar inyecciones SQL
    
    */
    
    public function producto_x_id(int $idProducto) {


        //1-llamar a la conexion
        $conexion = (new Conexion())->getConexion();

        // 2- Query
        $query = "SELECT * FROM comics WHERE id = :idProducto";


        //3 - Preparar la conexion

        $PDOStatament = $conexion->prepare($query);

        //4 - LLamar a la clase COMIC

        $PDOStatament->setFetchMode(PDO::FETCH_CLASS, self::class);

        //5- ejecutar la consulta

        $PDOStatament->execute(
            [
                "idProducto" => $idProducto
            ]
        );

        // 6 - Convertir lo que viene desde mysql en un array asociativo
        $result = $PDOStatament->fetch();

        if(!$result){
            return null;
        }

        return $result;
        
        

    }

    /* Traer los nombres de cada clase sin usar JOIN (con los metodos) */

    public function getSerie() {
        $serie = (new Serie())->get_x_id($this->id_personaje);
        $nombre = $serie->getNombre();
        return $nombre;
    }


    public function nombreCompleto(){
        return $this->getSerie() . " Vol:  $this->volumen #  $this->numero " ;
    }

      public function getGuion() {
        $guionista = (new Guionista())->get_x_id($this->id_guionista);
        $nombre = $guionista->getNombre_completo();
        return $nombre;
    }

     public function getArte() {
        $artista = (new Artista())->get_x_id($this->id_artista);
        $nombre = $artista->getNombre_completo();
        return $nombre;
    }

    


   



    /* GETTER */


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get the value of volumen
     */ 
    public function getVolumen()
    {
        return $this->volumen;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Get the value of publicacion
     */ 
    public function getPublicacion()
    {
        return $this->publicacion;
    }

    /**
     * Get the value of origen
     */ 
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Get the value of editorial
     */ 
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * Get the value of bajada
     */ 
    public function getBajada()
    {
        return $this->bajada;
    }

    /**
     * Get the value of portada
     */ 
    public function getPortada()
    {
        return $this->portada;
    }

    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Get the value of id_personaje
     */ 
    public function getId_personaje()
    {
        return $this->id_personaje;
    }

    

    /**
     * Get the value of id_serie
     */ 
    public function getId_serie()
    {
        return $this->id_serie;
    }

    /**
     * Get the value of id_guionista
     */ 
    public function getId_guionista()
    {
        return $this->id_guionista;
    }

    /**
     * Get the value of id_artista
     */ 
    public function getId_artista()
    {
        return $this->id_artista;
    }
}







?>