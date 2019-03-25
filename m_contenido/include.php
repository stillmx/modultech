<?php
//:: No permite ingreso a enlaces directos
session_start();
if(!$_SERVER['HTTP_REFERER']){
header ('Location: error.php');
}else{
//::: LLamado de los includes
?>

<div id='contenedor'>
	<div id='encabezado'>
		<?php
			require ('includes/encabezado.php');
			echo"<div class='' style='text-align:right; padding:10px;'>Bienvenid@: "."<b>".$_SESSION['usuario_entrar']."</b>"." ".
			"<a href='salir.php'><button class='btn btn-primary' type='submit'> Salir</button></a></div>";
		?>

	</div>

	<div id='menu'>
		<?php


			require ('indice.php');


		?>
	</div>

	<div id='contenido'>

		<?php

		 require ('includes/paginas.php');

		 ?>
		<br style='clear:both;'/>
	</div>

	<div id='pie'>
		<?php require ('includes/pie.php');?>
	</div>
</div>
<?php }?>
