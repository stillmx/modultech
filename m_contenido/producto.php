  <?php
  include_once 'config.php';
  if(!$_SERVER['HTTP_REFERER']){
	header ('Location: error.php');
}else {
  $result = 0;
if(!empty($_POST) && !empty($_FILES)) {
  $titulo = $_POST['titulo'];
  //$imagen = $_POST['imagen'];
  $tipo_prod = $_POST['seleccion'];
  $tipo_prod2 = $_POST['seleccion2'];

  $marca = $_POST['marca'];
  $familia = $_POST['familia'];
  $descripcion = $_POST['descripcion'];

  $imagen = $_FILES['imagen']['name'];
  $tipo = $_FILES['imagen']['type'];
  $tamano = $_FILES['imagen']['size'];

  //Si existe imagen y tiene un tamaño correcto
  if (($imagen == !NULL) && ($_FILES['imagen']['size'] <= 2000000))
  {
     //indicamos los formatos que permitimos subir a nuestro servidor
     if (($_FILES["imagen"]["type"] == "image/gif")
     || ($_FILES["imagen"]["type"] == "image/jpeg")
     || ($_FILES["imagen"]["type"] == "image/jpg")
     || ($_FILES["imagen"]["type"] == "image/png"))
     {
       $dir_subida ='productos/';
       $fichero_subido = $dir_subida . basename($imagen);
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
     if($imagen == !NULL) echo "La imagen es demasiado grande ";
}

  $sql = "INSERT INTO producto(titulo, tipo, tipo_2, imagen, marca, familia, descripcion) VALUES(:titulo, :tipo_prod, :tipo_prod2, :imagen, :marca, :familia, :descripcion)";
  $query = $pdo->prepare($sql);

  $result = $query->execute([
    'titulo' => $titulo,
    'tipo_prod' =>$tipo_prod,
    'tipo_prod2' =>$tipo_prod2,
    'imagen' => $fichero_subido,
    'marca' => $marca,
    'familia' => $familia,
    'descripcion' => $descripcion
  ]);

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
    <h1>Agregar Productos</h1>
    <a href="include.php">Inicio</a>
    <?php
     if($result){
       echo '<div id="mx" class="alert alert-success">
        Se guardaron sus datos perfectamente!!!
      </div>';
    }else {
      echo '<div id="mx" class="alert alert-warning">
       Agregar producto</div>';
    }
    echo '<script type="text/javascript">
      setTimeout(function () {
        document.getElementById("mx").className="alert alert-warning"
        document.getElementById("mx").textContent = " Ya puedes agregar productos!!!"
      }, 2000);
    </script>';
    ?>
    <form class="" action="include.php?pagina=producto" enctype="multipart/form-data" method="post">
      <div class="form-control">
          <label for="name">Producto</label>
          <input class="form-control" type="text" name="titulo" value="" required>
          <br>
          <label for="name">Familia</label>

            <select id="select" class="form-control" name="seleccion" style="border-radius:5px; margin-right: 15px;">
             <option value="" >Seleccionar...</option>
            </select>
            <br>
            <label for="name">Tipo de Familia</label>

              <select id="select2" class="form-control" name="seleccion2" style="border-radius:5px; margin-right: 15px;">
               <option value="" >Seleccionar...</option>
              </select>



          <br>
          <label for="user">Imagen</label>
          <input class="form-control" id="imagen" type="file" name="imagen" size="30" required>
          <br><label for="user">Marca</label>
          <input class="form-control" type="text" name="marca" value="" required>
          <br><label for="user">Tipo Producto</label>
          <input class="form-control" type="text" name="familia" value=""required>
          <br><label for="user">Descripción</label>
          <textarea class="form-control" name="descripcion" rows="8" cols="40" type="text" maxlength="700" required></textarea>
          <br>
          <input class="btn btn-primary" type="submit" value="Enviar">
          <br>
        </div>
    </form>
  </div>
    </div>

    <script src="../js/jquery.js" charset="utf-8"></script>
    <script type="text/javascript">
        (function(){
    		$.ajax('../php_contenido2.php', {
    			type:'POST',
    			dataType:'json',
    			data:{oper:'first_select'},
    			success:function(data, textStatus, jqXHR){
    				if(data.num_rows>0){
    					$.each(data.rows, function(i, e){
    						$("#select").append($("<option>", {value:i, text:e}));
    					})
    				}
    			}
    		});
    		$("#select").bind("change", function(){
    		var _t=$(this);
    		$.ajax('../php_contenido2.php',{
    			data:{oper:'second_filter', filtro:$(_t).val()}, type:'POST', dataType:'json',
    			beforeSend:function(){
    				$("#select2 > option:not(:first)").remove();
    			},
    			success:function(data, textStatus, jqXHR){
    				if(data.num_rows>0){
    					$.each(data.rows, function(i, e){
    						$("#select2").append($("<option>", {value:i, text:e}));
    					})
    				}
    			}
    		});
    		})
        })();

    </script>

  </body>
</html>
<?php } ?>
