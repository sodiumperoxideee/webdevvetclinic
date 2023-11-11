<?php

require_once 'database.php';

Class Products{
    //attributes

    public $productID;
    public $name;
    public $category;
    public $price;
    public $availability;

    protected $db;

    function __construct()
    {
        $this->db = new Database();
    }

    //Methods

    function add(){
        $sql = "INSERT INTO products (name, category, price, availability) VALUES 
        (:name, :category, :price, :availability);";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':category', $this->category);
        $query->bindParam(':price', $this->price);
        $query->bindParam(':availability', $this->availability);

        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function edit(){
        $sql = "UPDATE products SET name=:name, category=:category, price=:price, availability=:availability WHERE productID = :productID;";

        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':name', $this->name);
        $query->bindParam(':category', $this->category);
        $query->bindParam(':price', $this->price);
        $query->bindParam(':availability', $this->availability);
        
        if($query->execute()){
            return true;
        }
        else{
            return false;
        }	
    }

    function fetch($record_id){
        $sql = "SELECT * FROM products WHERE productID = :productID;";
        $query=$this->db->connect()->prepare($sql);
        $query->bindParam(':productID', $record_id);
        if($query->execute()){
            $data = $query->fetch();
        }
        return $data;
    }

    function show(){ 
        $sql = "SELECT * FROM products ORDER BY name ASC;";
        $query=$this->db->connect()->prepare($sql);
        $data = null;
        if($query->execute()){
            $data = $query->fetchAll();
        }
        return $data;
    }
}

?>