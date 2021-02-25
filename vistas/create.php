<?php

    if($_POST['Guardar']){
        require '/opt/lampp/htdocs/mio/conexion.php';

        $vacunado =   isset($_POST['vacunado']) ? $_POST['vacunado'] : 0;
        $nombre =   isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $raza =     isset($_POST['raza']) ? $_POST['raza'] : null;
        $dueno =    isset($_POST['dueno']) ? $_POST['dueno'] : null; 


        $datos = [
            'nombre' => $nombre,
            'vacunado' => $vacunado,
            'raza' => $raza,
            'duenio' => $dueno
        ];

        $errores =  buscarErrores($datos);

        if(count($errores) > 0){
            foreach($errores as $item){
                echo $item .'<br>';
            }
            exit();
        }

        $pdo = conexion();
        $sql = "INSERT INTO mascotas(nombre, vacunado, raza, duenio_id) values ( :nombre, :vacunado, :raza, :duenio)";
        try{$prepare = $pdo->prepare($sql);
        $prepare->execute($datos);}
        catch(Exception $e){

            echo $e->getMessage();

        }
    
    }

    function buscarErrores($datos){
        $errores = [];
        $excluir = [ 'vacunado'];

        foreach($datos as $key => $item){
            if(empty($item) && !in_array($key, $excluir) ){
                $errores[] = "El/La $key es obligatorio";
            }
        }

        return $errores;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Mascota</title>
</head>
<style>

    .top{
        margin-top: 10px
    }

</style>
<a href="./view.php">Volver</a>
<br>

<body>
    <form method="post">
        <label for="nombre">Nombre</label><br>
        <input class="top" type="text" name="nombre" placeholder="Escribe el nombre de tu mascota"></br>

        <label for="vacunado">Vacunado</label>
        <input class="top" type="checkbox" name="vacunado" value="1"></br>

        <label for="raza">Raza</label><br>
        <input class="top" type="text" name="raza" placeholder="Raza de la mascota"></br>

        <label for="dueño">Dueño</label><br>
        <input class="top" type="int" name="dueno" placeholder="Nombre del dueño"></br>

        <input class="top" type="submit" value="Guardar" name="Guardar">

    </form>
</body>
</html>