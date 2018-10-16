<?php
class Cities {

    private $conn;

    public $id_cities;
    public $states_id;
    public $name_cities;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT `id_cities`, `states_id`, `name_cities` FROM `bo_cities`";
    
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }

    function readById(){
    
        $query = "SELECT `id_cities`, `states_id`, `name_cities` 
                    FROM `bo_cities` 
                    WHERE `id_cities` = ".$this->id_cities;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function readByState(){
    
        $query = "SELECT `id_cities`, `states_id`, `name_cities` 
                    FROM `bo_cities` 
                    WHERE `states_id` = ".$this->states_id;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
