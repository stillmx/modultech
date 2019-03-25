<?php
if (!isset($_GET['pagina'])) {
    include("producto.php");
} else {
    include($_GET['pagina'].".php");
}
require_once ('tiempo.php');
?>
