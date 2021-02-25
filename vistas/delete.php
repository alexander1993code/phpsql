<?php

$elemento = $_POST['elemento'];
$id       = $_GET['id'];


if(isset($_GET['id'])){
    
    require '/opt/lampp/htdocs/mio/conexion.php';

    try {
        $pdo = conexion();
        $sql = "DELETE FROM `mascotas` WHERE id = :id ";

        $prepare = $pdo->prepare($sql);

        $prepare->execute([

        'id' =>$id
    ]);
        header('location:view.php');
        
    } catch (Exception $e) {
        echo $e;
    }
    

}

?>