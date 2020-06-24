<?php

// Incluyo la conexion
include "Conexion.class.php";

$dsn = "mysql:host=localhost;dbname=test";

// $con = conexion($dsn);

class Task{

    public $title = null;
    public $description = null;
    
    // Configuro las variables de conexion
    # public $dsn = "mysql:host=localhost;dbname=test";

    public function __construct($title, $description){
        $this->title = $title;
        $this->description = $description;
    }

    public function save(){
        global $dsn;
        $con = conexion($dsn);

        try{

            $stmt = $con->prepare("INSERT INTO tasks(title, description) VALUES (:title, :description)");
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->execute();

            $con = null;

            return "Tarea Insertada"; 

        }catch (PDOException $e){
            print "Error!" . $e->getMessage() . "<br>";
            return "Error!";
        }
    }

    public function update($id){
        global $dsn;
        $con = conexion($dsn);

        try{

            $stmt = $con->prepare("UPDATE tasks SET title = :title, description = :description WHERE id = :id");
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $con = null;

            return "Tarea Actualizada"; 

        }catch (PDOException $e){
            print "Error!" . $e->getMessage() . "<br>";
            return "Error!";
        }
    }

    public function delete($id){
        global $dsn;
        $con = conexion($dsn);

        try{

            $stmt = $con->prepare("DELETE FROM tasks WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $con = null;

            return "Tarea Borrada"; 

        }catch (PDOException $e){
            print "Error!" . $e->getMessage() . "<br>";
            return "Error!";
        }
    }

    public function find(){
        global $dsn;
        $con = conexion($dsn);

        try{

            $stmt = $con->prepare("SELECT * FROM tasks");
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $con = null;

            return $results; 

        }catch (PDOException $e){
            print "Error!" . $e->getMessage() . "<br>";
            return "Error!";
        }
    }

    public function findById($id){
        global $dsn;
        $con = conexion($dsn);

        try{

            $stmt = $con->prepare("SELECT * FROM tasks WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $con = null;

            return $results; 

        }catch (PDOException $e){
            print "Error!" . $e->getMessage() . "<br>";
            return "Error!";
        }
    }

    public function toString(){
        return $this->title . " " . $this->description;
    }
}


?>