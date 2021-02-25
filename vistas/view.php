<?php 

require_once '/opt/lampp/htdocs/mio/conexion.php';

try{
    $pdo     = conexion();
    $sql     = "SELECT * FROM mascotas";

    $prepare = $pdo->prepare($sql);
    $prepare->execute();
    
    $datos   = $prepare->fetchAll();

} catch(Exception $e){

    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de mascotas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
<div class="container">
 
  <h1>Tienda de mascotas</h1>
    <table class="table table-stripped table-hover">
      <thead>
         <tr>
             <th>
                <a href="./create.php">Crear</a>
             </th>
          </tr>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Raza</th>
            <th>Vacunado</th>  
            <th>Borrar</th>
            <th>Editar</th>
          </tr>
      </thead>
      <tbody>
        <?php 
           foreach($datos as $key => $mascota){
               $vacunado = $mascota['vacunado'] == 1 ? 'SI' : 'NO';
                           $id = $mascota['id'];
                           $nombre = $mascota['nombre'];
                           $raza = $mascota['raza'];
               echo "
               
               <tr > 
                   <td>$key</td>
                   <td>{$mascota['nombre']}</td>
                   <td>{$mascota['raza']}</td>
                   <td>$vacunado</td
                   <input type='hidden' value='$key' name='elemento'>
                   <td><a class='btn btn-danger' href='delete.php?id=$id&nombre=$nombre&raza=$raza'>Borrar</a></td>                    
                   <td><a class='btn btn-warning' href='edit.php?id=$id&nombre=$nombre&raza=$raza'>Editar</a></td>        
               </tr>";
           }
        ?>
      </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
</body>
</html>