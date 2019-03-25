<?php
session_start();
include_once 'config.php';
$row = null;
//::::::::: "limpiamos" los campos del formulario de posibles códigos maliciosos::::::::::
if (!empty($_POST)){
$us_entrada = addslashes($_POST['usuario']);
$cl_entrada  = addslashes($_POST['pass']);
//::::::::::Encriptamos clave::::::::
$usuario = $us_entrada;
$mx='$stelmas$%/=zeck001mx$/';
$clave = $mx.sha1(md5($cl_entrada));

// :::::::::::::::Consultando numero de acceso:::::::
$sql1="SELECT n_intentos,nombre FROM registro WHERE usuario =	:usuario";
$resultado = $pdo -> prepare($sql1);
$resultado -> execute([
	'usuario'=> $usuario
]);

$fila = $resultado->fetch(PDO::FETCH_ASSOC);

if($fila['n_intentos']==3){
header("location: error2.php");
exit();
}
$filas=$resultado->rowCount();
if($filas ==0){
	header("location: error.php");
	exit();
}

//:::::::::Consultando Base de Datos::::::::::::

$sql= "SELECT usuario,pass FROM registro WHERE usuario =:usuario AND pass=:clave";
$resultado = $pdo ->prepare($sql);
$resultado -> execute([
	'usuario' => $usuario,
	'clave' => $clave
]);

//::::::::::Comparando Datos:::::::::::
if($row = $resultado->fetch(PDO::FETCH_ASSOC)){
	//::::::::::Creamos la Sesion::::::::::
$_SESSION['usuario_entrar']= $usuario;
$_SESSION['pass']= $clave;

//$_SESSION['ingresar']=$ingresar;
//:::::::::::Validando la sesion:::::::::::::::
if(isset($_SESSION['usuario_entrar'])) {
	//$_SESSION["tiempo"]= time();
	$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
}
	header ('Location: include.php');
}
else {

    	$contador = $fila['n_intentos']+1;
			$sql = "UPDATE registro SET n_intentos=:contador WHERE usuario=:usuario";
			$resultado = $pdo -> prepare($sql);
			$resultado -> execute([
				'contador' => $contador,
				'usuario' => $usuario
			]);
    	if($contador ==1){
    		$mens='INTENTO';
    	}else{
    		$mens='INTENTOS, A LA TERCERA SERA BLOQUEADO';
    	}
    	if($contador==3){
    		header('Location: error2.php');
    		exit();
    	}

    	echo '<script type="text/javascript">
	       alert("EL USUARIO O CLAVE ES INCORRECTA, USTED LLEVA  '.$contador . " ".$mens.'");</script>';

        echo" <SCRIPT LANGUAGE='javascript'>location.href = './';</SCRIPT>";


		}


}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body style="background-image: url(../images/servicios/2.jpg); background-size: 100%; " >
		<div class="panel panel-primary"style="margin:10% 30%;">

	  <form action="index.php" method="post" name="ingreso" style="margin:20%;">
			<div class="form-group">

		  <h5>Ingresar Manejador de Contenidos</h5>
			<div class="panel-heading">
			</div>
      <input id="usuario" class="form-control" type="text" name="usuario" maxlength="20" size="20" placeholder="Usuario" required><br>
      <input id="contraseña" class="form-control" type="password" name="pass" maxlength="20" size="20" placeholder="Contraseña" required><br>
      <!-- <input class="campos ingreso" type="text" name="captcha" maxlength="5" size="20" placeholder="Ingresa el código" required/>
      <center><img src="captcha/captcha.php" border="0" width="200"/></center> -->
      <input class="btn btn-primary" type="submit" name="enviar" value="Entrar"><br>
		</div>
    </form>

</div>
		<script type="text/javascript" src="../js/bootstrap.js"></script>
  </body>
</html>
