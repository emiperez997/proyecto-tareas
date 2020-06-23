<?php

// Incluyo la conexion
include "Conexion.class.php";



// $con = conexion($dsn);

class Task{

    public $title = null;
    public $description = null;
    
    // Configuro las variables de conexion
    public $dsn = "mysql:host=localhost;dbname=test";

    public function __construct($title, $description){
        $this->title = $title;
        $this->description = $description;
    }

    public function save(){
        $con = conexion($this->dsn);

        try{

            $stmt = $con->prepare("INSERT INTO tasks(title, description) VALUES (:title, :description)");
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->execute();

            $con = null;

            return "Hecho"; 

        }catch (PDOException $e){
            print "Error!" . $e->getMessage() . "<br>";
            die();
        }
    }

    public function toString(){
        return $this->title . " " . $this->description;
    }
}


?>