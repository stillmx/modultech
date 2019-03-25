<?php
session_start();
include_once 'config.php';
	if(!$_SERVER['HTTP_REFERER']){
	header ('Location: error.php');
}else {



  $result = 0;
if (!empty($_POST)) {
  $name = $_POST['name'];
  $user = $_POST['user'];
  $mx='$stelmas$%/=zeck001mx$/';
  $pass = $mx.sha1(md5($_POST['pass']));


  $nuevo_usuario="SELECT usuario FROM registro WHERE usuario=:usuario";
  $respuesta = $pdo -> prepare($nuevo_usuario);
  $respuesta -> execute([
    'usuario' => $user
  ]);

$validar_usuario = $respuesta ->fetchColumn();
  if($validar_usuario){
  	echo "<script type=\"text/javascript\">alert(\"EL USUARIO YA EXISTE, INTENTE CON OTRO!\");history.go(-1);</script>";
  }else{
  $sql = "INSERT INTO registro(nombre, usuario, pass) VALUES (:nombre, :usuario, :pass)";
  $query = $pdo->prepare($sql);

  $result = $query->execute([
    'nombre' => $name,
    'usuario' => $user,
    'pass' => $pass
  ]);

}
}
}
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
      <div class="col-sm-6">
    <h1>Agregar Usuarios</h1>
    <a href="include.php">Home</a>
    <?php
     if($result){
       echo '<div id="mx" class="alert alert-success">
        Se guardaron sus datos perfectamente!!!
      </div>';
    }else {
      echo '<div id="mx" class="alert alert-warning">
       Ya puedes registrarte!!!</div>';
    }
    echo '<script type="text/javascript">
      setTimeout(function () {
        document.getElementById("mx").className="alert alert-warning"
        document.getElementById("mx").textContent = " Ya puedes registrarte!!!"
      }, 2000);
    </script>';


    ?>
    <form class="" action="include.php?pagina=add" method="post">
      <div class="form-group">
      <label for="name">Nombre</label>
      <input class="form-control" type="text" name="name" value="" required>
      <br>
      <label for="user">Usuario</label>
      <input class="form-control" type="text" name="user" value="" required>
      <br>
      <label for="pass">Contraseña</label>
      <input class="form-control" type="password" name="pass" value="" required>
      <br>
      <input class="btn btn-primary" type="submit" value="Enviar">
      <br>
    </form>
  </div>
    </div>

  </body>
</html>
