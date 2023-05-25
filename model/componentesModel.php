<?php

class Componente extends Conectar
{

    public function listarComponentes()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM tipo_componentes WHERE esActivo = 1";
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
                    'id' => $row['id_tipo_componentes'],
                    'nombre' => $row['nombre_tipo_componente']


                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarSelectClaseComponente()
    {
        $conectar = parent::conexion();
        $sql = "SELECT id_clase_componentes, nombre_clase from  clase_componentes WHERE esActivo = 1 ORDER BY nombre_clase";
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
                    'id' => $row['id_clase_componentes'],
                    'nombre' => $row['nombre_clase']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarSelectEstado()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM estado ";
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
                    'id' => $row['id_estado'],
                    'nombre' => $row['nombre_estado']
                );
            }
            $jsonString = json_encode($listado);
            echo $jsonString;
        }
    }

    public function listarSelectMarca()
    {
        $conectar = parent::conexion();
        $sql = "SELECT * from marca WHERE esActivo = 1";
        $fila = $conectar->prepare($sql);
        // $fila->bindValue(1,$idMarca);

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
                    'id' => $row['id_marca'],
                    'nombre' => $row['nombre_marca']
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
        $fila->bindValue(1, $idMarca);
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