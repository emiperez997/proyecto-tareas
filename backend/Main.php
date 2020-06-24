<?php

include "Task.class.php";

# Enviar datos y borrar datos
if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if(isset($_POST['id']) && isset($_POST['title']) && isset($_POST['desc'])){
        $task = new Task($_POST['title'], $_POST['desc']);
        $resultado = $task->update($_POST['id']);
        echo $resultado;

    }else if(isset($_POST['title']) && isset($_POST['desc'])){
        $task = new Task($_POST['title'], $_POST['desc']);
        $resultado = $task->save();
        echo $resultado;
    }else if(isset($_POST['id'])){
        $id = $_POST['id'];
        $res = Task::delete($id);
        echo $res;
    }
}

# Obtener datos
if ($_SERVER['REQUEST_METHOD'] == "GET"){

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $task = Task::findById($id);
        var_dump($task);
    }else{
        $tasks = Task::find();
        var_dump($tasks);
    }
    
}



?>