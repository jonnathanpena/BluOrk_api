<?php
class UserType {

    private $conn;

    public $id_usrtype;
    public $name_usrtype;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT `id_usrtype`, `name_usrtype` FROM `bo_user_type`";
    
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }

    function readById(){
    
        $query = "SELECT `id_usrtype`, `name_usrtype` 
                    FROM `bo_user_type` 
                    WHERE `id_usrtype` = ".$this->id_usrtype;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
    
}
?>
