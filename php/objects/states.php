<?php
class States {

    private $conn;

    public $id_states;
    public $country_id;
    public $name_states;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT `id_states`, `country_id`, `name_states` FROM `bo_states`";
    
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }

    function readById(){
    
        $query = "SELECT `id_states`, `country_id`, `name_states` 
                    FROM `bo_states` 
                    WHERE `id_states` = ".$this->id_states;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function readByCountry(){
    
        $query = "SELECT `id_states`, `country_id`, `name_states` 
                    FROM `bo_states` 
                    WHERE `country_id` = ".$this->country_id;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
