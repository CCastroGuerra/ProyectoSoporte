<?php 
include('../config/conexion.php');
$conect= new conexion();
$conect = $conect->conexion();

class usuarios{
    private $idUsuarios;
    private $nombreUsuario;
    private $password;
    private $rolesId;
    private $usuarioAlta;
    private $usuarioElimina;
    private $usuarioModifica;
    private $esActivo;

    public function __construct($idUsuarios,$nombreUsuario,$password,$role,$usuarioAlta,$usuarioElimina,$usuarioModifica,$esActivo){
        $this->idUsuarios = $idUsuarios;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->rolesId = $role;
        $this->usuarioAlta = $usuarioAlta;
        $this->usuarioElimina = $usuarioElimina;
        $this->usuarioModifica = $usuarioModifica;
        $this->esActivo = $esActivo;
    }
}
?>