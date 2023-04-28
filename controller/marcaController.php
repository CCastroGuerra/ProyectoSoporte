<?php 
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class marca{
    private $idMarca;
    private $nombreMarca;
    private $categoriaMarcaId;

    public function __construct($idMarca, $nombreMarca, $categoriaMarcaId){
        $this->idMarca = $idMarca;
        $this->nombreMarca = $nombreMarca;
        $this->categoriaMarcaId = $categoriaMarcaId;
    }
    
}
?>