<?php
class Subcategories {

    private $conn;

    public $id_subcat;
    public $name_subcat;
    public $id_detsubcat;
    public $category_id;
    public $subcategory_id;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){

        $query = "SELECT `id_subcat`, `name_subcat` FROM `bo_subcategories`";
    
        $stmt = $this->conn->prepare($query);

        $stmt->execute();
    
        return $stmt;
    }

    function readById(){
    
        $query = "SELECT `id_subcat`, `name_subcat` 
                    FROM `bo_subcategories` 
                    WHERE `id_subcat` = ".$this->id_subcat;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }

    function readByCategory(){
    
        $query = "SELECT det.`id_detsubcat`, det.`category_id`, det.`subcategory_id`, subcat.`id_subcat`, subcat.`name_subcat`
                    FROM `bo_detsubcat` as det
                    JOIN `bo_subcategories` as subcat ON (det.`subcategory_id` = subcat.`id_subcat`)
                    WHERE det.`category_id` = ".$this->category_id;
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
    
        return $stmt;
    }
    
    function insert(){
    
        $query = "INSERT INTO `bo_subcategories`(`name_subcat`) 
                    VALUES (
                        '".$this->name_subcat."'
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
