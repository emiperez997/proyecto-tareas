<?php

function conexion($dsn, $user = "root", $password = "") {
    try{

        $pdo = new PDO($dsn, $user, $password);
        // echo "Conectado!";
        
        return $pdo;
    
    }catch (PDOException $error){
        print "Error! " . $error->getMessage() . "<br>";
        die(); 
    }
}


?>