<?php
class Categories {

    private $conn;

    public $id_cat;
    public $name_cat;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT `id_cat`, `name_cat` FROM `bo_categories`";
    
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }

    function readById(){
    
        $query = "SELECT `id_cat`, `name_cat` 
                    FROM `bo_categories` 
                    WHERE `id_cat` = ".$this->id_cat;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function readByName(){
    
        $query = "SELECT `id_cat`, `name_cat` 
                    FROM `bo_categories` 
                    WHERE `name_cat` = '".$this->name_cat."'";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function readLikeName(){
    
        $query = "SELECT `id_cat`, `name_cat` 
                    FROM `bo_categories` 
                    WHERE `name_cat` LIKE '%".$this->name_cat."%'";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
    
    function insert(){
    
        $query = "INSERT INTO `bo_categories`(`name_cat`) VALUES (
                        '".$this->name_cat."'
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
