<?php
class Tags {

    private $conn;

    public $id_tags;
    public $name_tags;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT `id_tags`, `name_tags` FROM `bo_tags`";
    
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }

    function readById(){
    
        $query = "SELECT `id_tags`, `name_tags` FROM `bo_tags` 
                    WHERE `id_tags` = ".$this->id_tags;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
    
    function insert() {
    
        $query = "INSERT INTO `bo_tags`(`name_tags`) 
                    VALUES (
                        '".$this->name_tags."'
                    )";

        $stmt = $this->conn->prepare($query); 

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return false;
        }           
    }
    
}
?>
