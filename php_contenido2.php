<?php

include_once 'm_contenido/config.php';





$a_response=array("success"=>false, "num_rows"=>-1, "error"=>"No se encontro nada", "rows"=>array());
switch($_POST['oper']){
	case 'second_filter':
$filtro = $_POST['filtro'];

	$busqueda = $pdo ->prepare("SELECT tipo_busqueda, valor_busqueda FROM busqueda_tipo WHERE valor_busqueda_familia =$filtro");
	$busqueda ->execute();
	foreach($busqueda as $busca):
			$a_response['rows'][$busca["valor_busqueda"]]=$busca["tipo_busqueda"];

		endforeach;

		$a_response['num_rows']=count($a_response['rows']);
	break;
	default:

	$busqueda = $pdo ->prepare("SELECT tipo_busqueda, valor_busqueda FROM busqueda");
	$busqueda ->execute();
	foreach($busqueda as $busca):
		$a_response['rows'][$busca["valor_busqueda"]]=$busca["tipo_busqueda"];

	endforeach;

	$a_response['num_rows']=count($a_response['rows']);
}
echo json_encode($a_response);
?>
