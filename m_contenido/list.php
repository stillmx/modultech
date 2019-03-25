<?php
include_once 'config.php';
if(!$_SERVER['HTTP_REFERER']){
header ('Location: error.php');
}else {
$queryResult = $pdo->query("SELECT * FROM registro");

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>php curso</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

  </head>
  <body>
    <div class="container">
    <h1>Listar Usuarios</h1>
    <a href="include.php">Inicio</a>
    <table class="table">
      <tr>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Editar</th>
        <th>Eliminar</th>
      </tr>

        <?php
         while($fila = $queryResult->fetch(PDO::FETCH_ASSOC)){
          echo '<tr><td>'.($fila['nombre']).'</td>';
          echo '<td>'.($fila['usuario']).'</td>';
          echo '<td><a href="include.php?pagina=update&id='.$fila['id'].'">Editar</a></td>';
          echo '<td><a href="include.php?pagina=borrar_usuario&id='.$fila['id'].'">Eliminar</a></td></tr>';


        }
      }
        ?>

    </table>
    </div>

  </body>
</html>
