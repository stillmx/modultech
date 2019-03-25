<?php
$respuesta = $respuesta->fetchALL();
$totalregistros=$pdo->query("SELECT FOUND_ROWS() AS total");
$totalregistros=$totalregistros->fetch()['total'];
$numeropaginas=ceil($totalregistros/$regpagina);

 ?>
