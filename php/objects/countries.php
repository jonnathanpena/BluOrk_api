<?php
class Countries {

    private $conn;

    public $id_countries;
    public $name_countries;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT `id_countries`, `name_countries` FROM `bo_countries`";    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();    
        return $stmt;
    }
}
?>
