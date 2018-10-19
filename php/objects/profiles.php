<?php
class Profiles {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $id_prof;
    public $users_id;
    public $avatar_prof;
    public $phone_prof;
    public $type_prof;
    public $provider_prof;
    public $provider_id;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener datos perfiles
    function read(){
    
        // select all query
        $query = "SELECT `id_prof`, `users_id`, `avatar_prof`, `phone_prof`, `type_prof`, `provider_prof`, `provider_id` FROM `bo_profile`";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por id usuario
    function readByUser(){
    
        // select all query
        $query = "SELECT `id_prof`, `users_id`, `avatar_prof`, `phone_prof`, `type_prof`, `provider_prof`, 
                    `provider_id` FROM `bo_profile` 
                    WHERE `users_id` = ".$this->users_id;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
    // insertar un usuario
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `bo_profile`(`users_id`, `avatar_prof`, `phone_prof`, `type_prof`, `provider_prof`, `provider_id`) 
                    VALUES (
                        ".$this->users_id.",
                        '".$this->avatar_prof."',
                        '".$this->phone_prof."',
                        ".$this->type_prof.",
                        '".$this->provider_prof."',
                        ".$this->provider_id."
                    )";
        // prepara la sentencia del query
        $stmt = $this->conn->prepare($query); 

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return false;
        }           
    }

    function update() {
        $query = "UPDATE `bo_profile` SET 
                    `avatar_prof`= '".$this->avatar_prof."',
                    `phone_prof`= '".$this->phone_prof."'
                    WHERE `id_prof` = ".$this->id_prof;
        
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }   
    }
    
    function delete() {
        $query = "DELETE FROM `bo_profile` WHERE `id_prof` = ".$this->id_prof;
        
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }   
    }

    
}
?>
