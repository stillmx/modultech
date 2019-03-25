<?php if(!$_SERVER['HTTP_REFERER']){
header ('Location: error.php');
}else { ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Manejador</title>

  </head>
  <body>

    <nav class="navbar navbar-default " role="navigation">

      <div class="container">
    <ul class="btn-group" role="group" >


      <li class="list-group-item list-group-item-success">
        <a href="include.php?pagina=producto">Agregar Productos</a>
      </li>

      <li class="list-group-item list-group-item-success">
        <a  href="include.php?pagina=list_producto">Lista de Productos</a>
      </li>
      <li class="list-group-item list-group-item-success">
      <a  href="include.php?pagina=add">Agregar Usuarios</a>
    </li>

    <li class="list-group-item list-group-item-success ">
      <a  href="include.php?pagina=list">Lista de Usuarios</a>
    </li >
    <li class="list-group-item list-group-item-success ">
      <a  href="include.php?pagina=add_familia">Agregar Familia</a>
    </li >
    <li class="list-group-item list-group-item-success ">
      <a  href="include.php?pagina=add_tipo">Agregar Tipo Familia</a>
    </li >

    </ul>
    </div>

  </body>
</html>
<?php } ?>
