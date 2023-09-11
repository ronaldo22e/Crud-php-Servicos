<?php
require_once '../Conexion.php';
class Artista {
      // Atributos SOLCICITADOS PARA REALIZAR LA CONSULTA
    private $id;
    public $nombre;
    public $genero;
    public $descripcion;
    
    public function __construct ($nombre=null,$genero=null,$descripcion = null,$id=null){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->genero=$genero;
        $this->descripcion = $descripcion;
    }
    
    public function obtenerArtistas(){
        $conexion = new Conexion();
        try{
            $query = "SELECT * FROM artistas";
            $artistas = $conexion->prepare($query);
            $artistas->execute();
            $datosArtistas = $artistas->fetchAll(PDO::FETCH_ASSOC);// Utilizar FETCH_ASSOC para obtener un arreglo asociativo
            return $datosArtistas;
        }catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function crearArtista($artista) {
        $conexion = new Conexion();
        try{
            $newArtista = $conexion->prepare("INSERT INTO artistas (nombre, genero, descripcion) VALUES (:nombre, :genero, :descripcion)");
            $newArtista->bindParam(':nombre', $artista->nombre);
            $newArtista->bindParam(':genero', $artista->genero);
            $newArtista->bindParam(':descripcion', $artista->descripcion);
            $newArtista->execute();
        }catch(Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function obtenerUnArtista($id){
        $conexion = new Conexion();
        try{
            $query = "SELECT * FROM artistas WHERE id = :id";
            $artista = $conexion->prepare($query);
            $artista->bindParam(':id', $id, PDO::PARAM_INT);
            $artista->execute();
            $datosArtista = $artista->fetch(PDO::FETCH_ASSOC);
    
            if ($datosArtista) {
                return json_encode($datosArtista);
            } else {
                // Manejar el caso en el que no se encuentra ningún registro con el ID dado.
                return json_encode(['error' => 'Artista no encontrado']);
            }
        } catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
    
    
     public function eliminarArtista($id) { 
            $conexion = new Conexion();
        try {
            $artista = $conexion->prepare("DELETE FROM artistas WHERE id = :id");
            $artista->bindParam(':id', $id);
            $artista->execute();

       } catch (PDOException $e) {
            echo "Error al eliminar Artista: " . $e->getMessage();
        }
    }
     public function actualizarArtista($id, $nombre, $genero, $descripcion){
         $conexion = new Conexion();
         try {
            $artista = $conexion->prepare("UPDATE artistas SET nombre = :nombre, genero = :genero, descripcion = :descripcion WHERE id = :id");
            $artista->bindParam(':nombre', $nombre);
            $artista->bindParam(':genero', $genero);
            $artista->bindParam(':descripcion', $descripcion);
            $artista->bindParam(':id', $id);
            $artista->execute();
         } catch (PDOException $e) {
             echo "Error al eliminar Artista: " . $e->getMessage();
         }
     }
}