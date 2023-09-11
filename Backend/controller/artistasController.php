<?php
require_once '../model/Artista.php';
// //LEER
 $artista=new Artista();
 $datosArtistas=$artista->obtenerArtistas();
 echo (json_encode($datosArtistas));
// //CREAR
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     if (isset($_POST)) {
         $dataForm = (object)[
             'nombre' => $_POST['nombre'],
             'genero' => $_POST['genero'],
             'descripcion' => $_POST['descripcion']
         ];
         $artista = new Artista();
         $datosArtista = $artista->crearArtista($dataForm);
     }
 }
 //ELIMINAR
 if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
     if (isset($_GET['id'])) {
         $artista = new Artista();
         $artista->eliminarArtista($_GET['id']);   
     }
 }


if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input_data = file_get_contents("php://input"); // Obtener el cuerpo de la solicitud PUT

    
    $data = json_decode($input_data, true);

    if ($data !== null) {
        // Ahora $data contiene los datos en un arreglo asociativo
        // Puedes acceder a los valores individualmente, por ejemplo:

        $id = $data['id'];
        $nombre = $data['nombre'];
        $genero = $data['genero'];
        $descripcion = $data['descripcion'];

        // Luego, puedes utilizar estos valores para realizar la actualización en tu base de datos

        $artista = new Artista();
        $datosArtista = $artista->actualizarArtista($id, $nombre, $genero, $descripcion);
    } else {
        // Manejar el caso en el que no se pudoo decodificar el JSON correctamente
        echo json_encode(['error' => 'Datos JSON no válidos']);
    }
}

