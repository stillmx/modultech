<?php
	include_once 'config.php';
	$usuario=$_SESSION['usuario_entrar'];

	$resultado=$pdo->prepare("SELECT usuario FROM registro where usuario = :usuario");

$resultado->execute([
	'usuario' => $usuario
]);

	while ($fila=$resultado->fetch(PDO::FETCH_ASSOC)) {
		echo"<div>Bienvenid@: "."<b>"
	." ".$fila['usuario']."</b>"." "."</div>";

	}


	?>
