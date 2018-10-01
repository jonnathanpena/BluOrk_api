<?php
class Users {

    // conexión a la base de datos y nombre de la tabla
    private $conn;

    // Propiedades del objeto
    //Nombre igualitos a las columnas de la base de datos
    public $id_users;
    public $firstName_users;
    public $lastName_users;
    public $email_users; 
    public $password_users;
    public $createAt_users;
    public $updateAt_users;

    //constructor con base de datos como conexión
    public function __construct($db){
        $this->conn = $db;
    }

    // obtener datos usuarios
    function read(){
    
        // select all query
        $query = "SELECT `id_users`, `firstName_users`, `lastName_users`, `email_users`, `password_users`, `createAt_users`, `updateAt_users` 
                    FROM `bo_users`";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por id usuario
    function readById(){
    
        // select all query
        $query = "SELECT `id_users`, `firstName_users`, `lastName_users`, `email_users`, `password_users`, `createAt_users`, `updateAt_users` 
                    FROM `bo_users` 
                    WHERE `id_users` = ".$this->id_users;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // obtener datos por emal
    function readByEmail(){
    
        // select all query
        $query = "SELECT `id_users`, `firstName_users`, `lastName_users`, `email_users`, `password_users`, `createAt_users`, `updateAt_users` 
                    FROM `bo_users` WHERE `email_users` = '".$this->email_users."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    
    // insertar un usuario
    function insert(){
    
        // query to insert record
        $query = "INSERT INTO `bo_users`(`firstName_users`, `lastName_users`, `email_users`, `password_users`, `createAt_users`, 
                    `updateAt_users`) VALUES (
                        '".$this->firstName_users."',
                        '".$this->lastName_users."',
                        '".$this->email_users."',
                        '".$this->password_users."',
                        '".$this->createAt_users."',
                        '".$this->updateAt_users."'
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
        $query = "UPDATE `bo_users` SET 
                    `firstName_users`= '".$this->firstName_users."',
                    `lastName_users`= '".$this->lastName_users."',
                    `updateAt_users`='".$this->updateAt_users."' 
                    WHERE `id_users` = ".$this->id_users;
        
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }   
    }


    function cambioClave() {
        $query = "UPDATE `bo_users` SET 
                    `password_users`= '".$this->password_users."', 
                    `updateAt_users`= '".$this->updateAt_users."' 
                    WHERE `id_users` =  ".$this->id_users;
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }    

    
}
?>
