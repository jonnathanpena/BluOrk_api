<?php
class PayRate {

    private $conn;

    public $id_payrate;
    public $name_payrate;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT `id_payrate`, `name_payrate` FROM `bo_payrate` ";
    
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }

    function readById(){
    
        $query = "SELECT `id_payrate`, `name_payrate` 
                    FROM `bo_payrate` 
                    WHERE `id_payrate` = ".$this->id_payrate;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
