<?php
class DetSubcat {

    private $conn;

    public $id_detsubcat;
    public $category_id;
    public $subcategory_id;

    public function __construct($db){
        $this->conn = $db;
    }
    
    function insert(){
    
        $query = "INSERT INTO `bo_detsubcat`(`category_id`, `subcategory_id`) 
                    VALUES (
                        ".$this->category_id.",
                        ".$this->subcategory_id."
                    )";

        $stmt = $this->conn->prepare($query); 

        if($stmt->execute()){
            return $this->conn->lastInsertId();
        }else{
            return false;
        }           
    }

    function readById() {

        $query = "SELECT `id_detsubcat`, `category_id`, `subcategory_id` 
                    FROM `bo_detsubcat` 
                    WHERE `id_detsubcat` = ".$this->id_detsubcat;

        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;

    }

    function delete() {
        $query = "DELETE FROM `bo_detsubcat` WHERE `id_detsubcat` = ".$this->id_detsubcat;
        $stmt = $this->conn->prepare($query);
        if($stmt->exceute()) {
            return true;
        } else {
            return false;
        }
    }
    
}
?>
