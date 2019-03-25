<?php
if (!isset($_GET['pagina'])) {
    include("contenido.php");
} else {
    include($_GET['pagina']);
}

?>
