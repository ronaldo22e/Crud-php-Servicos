<?php
require_once '../model/Artista.php';
//UN ARTISTA
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
       $artista = new Artista();
       $resultado = $artista->obtenerUnArtista($_GET['id']);
        echo $resultado;
    }
}

?>