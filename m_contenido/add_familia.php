<?php
include_once 'config.php';
  if(!$_SERVER['HTTP_REFERER']){
    header ('Location: error.php');
  }
  else {
    $result = 0;
    if (!empty($_POST)) {
      $tipo_busqueda = $_POST['familia'];
      $sql1="SELECT tipo_busqueda FROM busqueda WHERE tipo_busqueda=:tipo_busqueda";
      $respuesta = $pdo -> prepare($sql1);
      $respuesta -> execute(['tipo_busqueda' => $tipo_busqueda]);
      $validar_tipo_busqueda = $respuesta ->fetchColumn();
      if($validar_tipo_busqueda){
      	echo "<script type=\"text/javascript\">alert(\"EL NOMBRE O REGISTRO YA EXISTE, INTENTE CON OTRO!\");history.go(-1);</script>";
      }
      else{
        $sql2="SELECT valor_busqueda FROM busqueda ORDER BY valor_busqueda DESC LIMIT 1";
        $respuesta = $pdo -> prepare($sql2);
        $respuesta -> execute();
        $fila = $respuesta->fetch(PDO::FETCH_ASSOC);
        $valor_busqueda =$fila['valor_busqueda'];
        $valor_busqueda +=1;
        $sql = "INSERT INTO busqueda(tipo_busqueda, valor_busqueda) VALUES(:tipo_busqueda, :valor_busqueda)";
        $query = $pdo->prepare($sql);
        $result = $query->execute(['tipo_busqueda' => $tipo_busqueda, 'valor_busqueda' =>$valor_busqueda]);
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
  <h1>Agregar Familia</h1>
  <a href="include.php">Inicio</a>
  <?php
   if($result){
     echo '<div id="mx" class="alert alert-success"> Se guardaron sus datos perfectamente!!! </div>';
    }
    else {
      echo '<div id="mx" class="alert alert-warning">Agregar familia</div>';
    }
    echo '<script type="text/javascript">setTimeout(function(){
      document.getElementById("mx").className="alert alert-warning"
      document.getElementById("mx").textContent = " Ya puedes agregar familia de productos!!!"
      }, 2000);</script>';
  ?>
  <form class="" action="include.php?pagina=add_familia" method="post">
  <div class="form-control">
    <br>
    <label for="user">Tipo Familia</label>
    <input class="form-control" type="text" name="familia" value=""required>
    <br>
    <input class="btn btn-primary" type="submit" value="Enviar">
    <br>
  </div>
  </form>
  </div>
  </div>
</body>
</html>
