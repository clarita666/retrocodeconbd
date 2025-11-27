<?php

class Serie
{
   protected $id;
   protected $nombre;
   protected $historia;

    //Metodo datos en particular

    public function get_x_id(int $id)
    {


        $conexion = (new Conexion())->getConexion();


        $query = "SELECT * FROM series WHERE id = :id";




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
    * Get the value of nombre
    */ 
   public function getNombre()
   {
      return $this->nombre;
   }

   /**
    * Get the value of historia
    */ 
   public function getHistoria()
   {
      return $this->historia;
   }

   
}
