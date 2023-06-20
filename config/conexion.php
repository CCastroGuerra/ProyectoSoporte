<?php


class Conectar
{
    protected $host;

    public function Conexion()
    {
        try {
            $conectar = $this->host = new PDO("mysql:local=localhost;dbname=bd_fechasyrel", "root", "");
            return $conectar;
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}


// class Conectar {
//     protected $host;
//     protected $conexion;

//     protected function Conexion(){
//         try {
//             if ($this->conexion instanceof PDO) {
//                 return $this->conexion;
//             }
//             $this->conexion = new PDO("mysql:local=localhost;dbname=bd_soporte","root","");
//             return $this->conexion;
//         } catch (Exception $e) {
//             print "¡Error BD!: " . $e->getMessage() . "<br/>";
//             die();
//         }
//     }

//     public function obtenerConexion() {
//         return $this->Conexion();
//     }

   
// }
