<?php

require_once '/opt/lampp/htdocs/mio/conexion.php';

if(!empty($_POST['update'])){

    try{
    $nombre = $_POST['nombre'];
    $raza   = $_POST['raza'];
    $id     = $_POST['hidden'];

    $sql = "UPDATE mascotas SET nombre = :nombre, raza = :raza WHERE id = :id";
    $pdo = conexion();

    $prepare = $pdo->prepare($sql); 

    $prepare->execute([
        'id'     => $id,
        'nombre' => $nombre,
        'raza'   => $raza
    ]);
    header('location:view.php');
    }
    catch(Exception $e){

        echo $e;
    }
}
else{
    $id = $_GET['id'];    
    
    $sql = "SELECT * FROM mascotas WHERE id = :id";
    $pdo = conexion();

    $prepare = $pdo->prepare($sql);

    $prepare->execute([
        'id' => $id
    ]);
    
    $datos = (object) $prepare->fetch();
}

?>

<form action='edit.php' method='POST'>
    <label for='nombre'>Nombre</label></br>
    <input type='text' name='nombre' value="<?php echo $datos->nombre; ?>"></br>

    <label for='nombre'>Raza</label></br>
    <input type='text' name='raza' value="<?php echo $datos->raza; ?>"></b>
    <input type='hidden' name='hidden' value="<?php echo $datos->id; ?>">

    <input type='submit' name='update' value='Udapte'>
</form>
