<?php

function conexion($dsn, $user = "root", $password = "") {
    try{

        $pdo = new PDO($dsn, $user, $password);
        // echo "Conectado!";
    
        // foreach($pdo->query("SELECT * FROM tasks") as $fila) {
        //    print_r($fila);
        // }
        
        return $pdo;
    
    }catch (PDOException $error){
        print "Error! " . $error->getMessage() . "<br>";
        die(); 
    }
}


?>