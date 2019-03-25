<?php
include_once 'config.php';
if(!$_SERVER['HTTP_REFERER']){
header ('Location: error.php');
}else {
$result = false;

if (!empty($_POST)) {
    $id = $_POST['id'];
    $newTitulo = $_POST['titulo'];
    // $newImagen = $_POST['imagen'];
    $newMarca = $_POST['marca'];
    $newFamilia = $_POST['familia'];
    $newdescripcion = $_POST['descripcion'];
    $newImagen = $_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];
    $tamano = $_FILES['imagen']['size'];


    //Si existe imagen y tiene un tamaño correcto
    if (($newImagen == !NULL) && ($_FILES['imagen']['size'] <= 2000000))
    {
       //indicamos los formatos que permitimos subir a nuestro servidor
       if (($_FILES["imagen"]["type"] == "image/gif")
       || ($_FILES["imagen"]["type"] == "image/jpeg")
       || ($_FILES["imagen"]["type"] == "image/jpg")
       || ($_FILES["imagen"]["type"] == "image/png"))
       {
         $dir_subida ='productos/';
         $fichero_subido = $dir_subida . basename($newImagen);
         // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
       //  move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido))
        move_uploaded_file($_FILES['imagen']['tmp_name'],'../'.$fichero_subido);

        }
        else
        {
           //si no cumple con el formato
           echo "No se puede subir una imagen con ese formato ";
        }
    }
    else
    {
       //si existe la variable pero se pasa del tamaño permitido
       if($newImagen == !NULL) echo "La imagen es demasiado grande ";
    }



    $sql = "UPDATE producto SET titulo=:titulo, imagen=:imagen, marca=:marca, familia=:familia, descripcion=:descripcion WHERE id=:id";
    $query = $pdo->prepare($sql);

    $result = $query->execute([
        'id' => $id,
        'titulo' => $newTitulo,
        'imagen' => $fichero_subido,
        'marca' => $newMarca,
        'familia' => $newFamilia,
        'descripcion' => $newdescripcion
    ]);

    $tituloValue = $newTitulo;
    $imagenValue = $newImagen;
    $marcaValue = $newMarca;
    $familiaValue = $newFamilia;
    $descripcionvalue = $newdescripcion;

} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM producto WHERE id=:id";
    $query = $pdo->prepare($sql);
    $query->execute([
        'id' => $id
    ]);

    $row = $query->fetch(PDO::FETCH_ASSOC);
    $tituloValue = $row['titulo'];
    $imagenValue = $row['imagen'];
    $marcaValue = $row['marca'];
    $familiaValue = $row['familia'];
    $descripcionValue = $row['descripcion'];

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
    <a href="include.php?pagina=list_producto">Atrás</a>
    <?php
    if ($result) {
        echo '<div class="alert alert-success">Success!!!</div>';
        echo" <SCRIPT LANGUAGE='javascript'>location.href = 'include.php?pagina=list_producto';</SCRIPT>";
        }
    ?>
    <form action="include.php?pagina=update_producto" method="post" enctype="multipart/form-data">
<div class="form-control">
        <label for="titulo">Título</label>
        <input class="form-control" type="text" name="titulo" id="titulo" value="<?php echo $tituloValue; ?>">
        <br>
        <label for="name">Familia</label>
        <select class="form-control" name="seleccion" style="border-radius:5px;" required>
          <option selected disabled>Seleccionar</option>
          <?php

            $busqueda = $pdo ->prepare("SELECT tipo_busqueda FROM busqueda");
            $busqueda ->execute();
            foreach($busqueda as $busca):
              echo'<option value="'.$busca["valor_busqueda"].'">'.$busca["tipo_busqueda"].'</option>';

              endforeach
          ?>
        </select>
        <br>
        <label for="imagen">Imagen</label>
        <input class="form-control" type="file" name="imagen" id="imagen" value="<?php echo $imagenValue; ?>">
        <br>
        <label for="marca">Marca</label>
        <input class="form-control" type="text" name="marca" id="marca" value="<?php echo $marcaValue; ?>">
        <br>
        <label for="familia">Tipo</label>
        <input class="form-control" type="text" name="familia" id="fmilia" value="<?php echo $familiaValue; ?>">
        <br>
        <label for="user">Descripción</label>
        <textarea class="form-control" name="descripcion" rows="8" cols="40" type="text" maxlength="700" required><?php if(isset($descripcionValue)){echo $descripcionValue;} ?></textarea>
        <br>
        <input class="form-control" type="hidden" name="id" value="<?php echo $id ?>">
        <input class="btn btn-primary" type="submit" value="Actualizar" >
      </div>
    </form>
</div>
</body>
</html>
<?php } ?>
