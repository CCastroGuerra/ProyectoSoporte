<?php
include ('../controller/componentesController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarComponentes();
        break;
    
    default:
        # code...S
        break;
}
function listarComponentes(){
    global $conect;
    $sql="select * from componentes ";
    $fila=$conect->prepare($sql);
    $fila->execute();

    $resultado = $fila->fetchAll();
    if(empty($resultado)){
       $resultado = array('listado'=>'vacio');
       $jsonString = json_encode($resultado);
       echo $jsonString;
    }else{
        $json =array();
        $listado = array();
        foreach($resultado as $row) {
            $listado[]=array(
                'id' => $row['id_componentes'],
                'serie' => $row['serie'],
                'fecha_alta' => $row['fecha_alta']
               
            );
        }
        $jsonString = json_encode($listado);
        echo $jsonString;
    
    }

    public function listarSelectClaseComponente()
    {
        $conectar = parent::conexion();
        $sql = "SELECT id_clase_componentes, nombre_clase from  clase_componentes WHERE esActivo = 1 ORDER BY nombre_clase";
        $fila = $conectar->prepare($sql);
        $fila->execute();
<?php
include ('../controller/componentesController.php');
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
switch ($accion) {
    case 'listar':
        listarComponentes();
        break;
    
    default:
        # code...S
        break;
}
function listarComponentes(){
    global $conect;
    $sql="select * from componentes ";
    $fila=$conect->prepare($sql);
    $fila->execute();

        $resultado = $fila->fetchAll();
        if (empty($resultado)) {
            $resultado = array('listado' => 'vacio');
            $jsonString = json_encode($resultado);
            echo $jsonString;
        } else {
            $json = array();
            $listado = array();
            foreach ($resultado as $row) {
                $listado[] = array(
                    'id' => $row['id_clase_componentes'],
                    'nombre' => $row['nombre_clase']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarSelectModelo()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM `modelo` WHERE esActivo = 1 ORDER BY nombre_modelo ASC";
        $fila = $conectar->prepare($sql);
        $fila->execute();

        $resultado = $fila->fetchAll();
        if (empty($resultado)) {
            $resultado = array('listado' => 'vacio');
            $jsonString = json_encode($resultado);
            echo $jsonString;
        } else {
            $json = array();
            $listado = array();
            foreach ($resultado as $row) {
                $listado[] = array(
                    'id' => $row['id_modelo'],
                    'nombre' => $row['nombre_modelo']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarSelectModelo($idMarca)
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM `modelo`  WHERE marca_id = ?";
        $fila = $conectar->prepare($sql);
        $fila->bindValue(1,$idMarca);
        $fila->execute();

        $resultado = $fila->fetchAll();
        if (empty($resultado)) {
            $resultado = array('listado' => 'vacio');
            $jsonString = json_encode($resultado);
            echo $jsonString;
        } else {
            $json = array();
            $listado = array();
            foreach ($resultado as $row) {
                $listado[] = array(
                    'id' => $row['id_modelo'],
                    'nombre' => $row['nombre_modelo']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

}
?>