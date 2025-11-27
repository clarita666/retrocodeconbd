<?php

class Guionista
{
    protected $id;
    protected $nombre_completo;
    protected $biografia;
    protected $foto_perfil;

    //Metodo datos en particular

    public function get_x_id(int $id)
    {


        $conexion = (new Conexion())->getConexion();


        $query = "SELECT * FROM guionistas WHERE id = :id";




        $PDOStatament = $conexion->prepare($query);
        $PDOStatament->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatament->execute(
            [
                "id" => $id
            ]
        );


        $result = $PDOStatament->fetch();

        if (!$result) {
            return null;
        }

        return $result;
    }


   

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of nombre_completo
     */ 
    public function getNombre_completo()
    {
        return $this->nombre_completo;
    }

    /**
     * Get the value of biografia
     */ 
    public function getBiografia()
    {
        return $this->biografia;
    }

    /**
     * Get the value of foto_perfil
     */ 
    public function getFoto_perfil()
    {
        return $this->foto_perfil;
    }
}
