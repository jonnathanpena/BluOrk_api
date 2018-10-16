<?php
class EmploymentTypes {

    private $conn;

    public $id_et;
    public $name_et;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT `id_et`, `name_et` FROM `bo_employment_types` ";
    
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }

    function readById(){
    
        $query = "SELECT `id_et`, `name_et` 
                    FROM `bo_employment_types` 
                    WHERE `id_et` = ".$this->id_et;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
