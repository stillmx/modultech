<?php
include_once 'config.php';
if(!$_SERVER['HTTP_REFERER']){
header ('Location: error.php');
}else {
$result = false;

if (!empty($_POST)) {
    $id = $_POST['id'];
    $newName = $_POST['name'];
    $newUsuario = $_POST['usuario'];

    $sql = "UPDATE registro SET nombre=:nombre, usuario=:usuario WHERE id=:id";
    $query = $pdo->prepare($sql);

    $result = $query->execute([
        'id' => $id,
        'nombre' => $newName,
        'usuario' => $newUsuario
    ]);

    $nameValue = $newName;
    $usuarioValue = $newUsuario;
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM registro WHERE id=:id";
    $query = $pdo->prepare($sql);

    $query->execute([
        'id' => $id
    ]);

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $nameValue = $row['nombre'];
    $usuarioValue = $row['usuario'];
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
    <h1>Actualizar Usuarios</h1>
    <a href="include.php?pagina=list">Back</a>
    <?php
    if ($result) {
        echo '<div class="alert alert-success">Success!!!</div>';
    }
    ?>
    <form action="include.php?pagina=update" method="post">
        <div class="form-control">
          <label for="name">Nombre</label>
          <input class="form-control" type="text" name="name" id="name" value="<?php echo $nameValue; ?>">
          <br>
          <label for="usuario">Usuario</label>
          <input class="form-control" type="text" name="usuario" id="usuario" value="<?php echo $usuarioValue; ?>">
          <br>
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <input class="btn btn-primary" type="submit" value="Actualizar" >
        </div>

    </form>
</div>
</body>
</html>
<?php } ?>
