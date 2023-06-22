<?php

//Apartir de aqui se va almacenar en una varible html
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 100%;
        }

        @page {
            /*margin: 180px 50px;
             margin-left: 0.5cm;
            margin-right: 0; */
            margin-bottom: 1cm;
            margin-top: 5cm;
            margin-left: 2.5cm;
            margin-right: 0.5cm;
        }

        .encabezado {
            /* display: flex;
            justify-content: space-evenly;
            align-items: center;
            margin-top: 20px; */
            position: fixed;
            left: 0;
            top: -140px;
            right: 0px;
            height: 150px;

        }


        #logo img {
            width: 350px;

            /* Agrega aquí el estilo de tu logo */
            float: left;
        }

        /* #fecha-hora {
            text-align: right;
            /* Agrega aquí el estilo de la fecha y hora 
        }*/

        #fecha-hora span {
            display: flex;
            font-size: 14px;
            font-weight: bold;
            text-align: right;
        }

        h1 {
            text-align: center;
            /* font-size: 17px; */
            margin-top: -50px;
            text-transform: uppercase;

        }

        /* table {
            width: 100%;
            /* border-collapse: collapse;
            border: 1px solid #000;
            border-collapse: collapse;
            border: black 5px solid;

        }
    

        th,
        td {
            /* border: 1px solid #000;
            padding: 10px;
            text-align: left; 

            border: 1px solid #000;
            padding: 8px;

        } */
        /* table {
            width: 100%;
            border-collapse: collapse;
            /* border: black 5px solid; 
        }*/

        table {
            width: 100%;
            /* border: 1px solid #000; */
            /* border-right: 2px solid red; */
            /*border-collapse: collapse;*/

            border: 1px solid #000 !important;
            border-spacing: 0;

        }

        tbody {
            width: auto;
            /* border-right: 2px solid red; */

        }

        td {
            /* border: 1px solid #000; */
            padding: 8px;
            border: 1px solid #000;
        }

        thead {
            background-color: #000;
            color: #fff;
        }

        th {
            background-color: #000;
            color: #fff;
            font-size: medium;
            padding: 5px;
        }

        /* tr {
            border: 1px solid red;
        } */
    </style>
</head>

<body>
    <?php
    require_once("../config/conexion.php");
    // Configuración de la zona horaria
    date_default_timezone_set('America/Lima');

    $conectarObj = new Conectar(); // Crear una instancia de la clase Conectar
    $conectar = $conectarObj->Conexion();
    $sql = $conectar->prepare("SELECT m.id_movimientos,
    p.nombre_productos,
    m.cantidad,tipo_movimientos,
    CASE
        WHEN tipo_movimientos = 1 THEN 'ENTRADA'
        WHEN tipo_movimientos = 2 THEN 'SALIDA' 
    END AS estado
from movimientos m
    INNER JOIN productos p ON p.id_productos = m.producto_id");
    $sql->execute();
    $listaInventario = $sql->fetchAll(PDO::FETCH_ASSOC);
    $totalInventario = count($listaInventario);
    $fechaActual = date('d/m/Y');
    $horaActual = date('H:i:s');

    //Consulta total de entradas
    $sql2 = $conectar->prepare("SELECT COUNT(id_movimientos) totalEntradas FROM movimientos WHERE tipo_movimientos = 1;
    ");
    $sql2->execute();
    $cantidadEntradas = $sql2->fetch(PDO::FETCH_LAZY);


    //Consulta total de salidas
    $sql3 = $conectar->prepare("SELECT COUNT(id_movimientos) totalSalidas FROM movimientos WHERE tipo_movimientos = 2;
    ");
    $sql3->execute();
    $cantidadSalidas = $sql3->fetch(PDO::FETCH_LAZY);

    ?>


    <div class="encabezado">
        <div id="logo">
            <img src="http://localhost/ProyectoSoporte/banner.png" alt="">
        </div>
        <div id="fecha-hora">
            <span>Fecha: <?php echo $fechaActual; ?></span>
            <span>Hora: <?php echo $horaActual; ?></span>
        </div>
        <!-- <h2>encabezado</h2> -->
    </div>

    <h1>Reporte Inventario</h1>

    <div class="">
        <table class=" align-middle" style="border: 2px solid red ;">
            <thead>
                <tr>
                    <th scope="col"><strong>Producto</strong></th>
                    <th scope="col"><strong>Cantidad</strong></th>
                    <th scope="col"><strong>Acción</strong></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaInventario as $inventario) { ?>
                    <tr>
                        <td><?php echo $inventario['nombre_productos'] ?></td>
                        <td><?php echo $inventario['cantidad'] ?></td>
                        <td><?php echo $inventario['estado'] ?></td>

                    </tr>
                <?php } ?>







            </tbody>
        </table>
        <table>
            <tr>
                <td>
                    <strong>Total de movimientos:</strong>
                </td>
                <td colspan="0" style="text-align: right;">
                    <strong> <?php echo $totalInventario; ?></strong>
                </td>
                <td>
                    <strong>Total de Entradas:</strong>
                </td>
                <td colspan="0" style="text-align: right;">
                    <strong> <?php echo $cantidadEntradas['totalEntradas']; ?></strong>
                </td>
                <td>
                    <strong>Total de Salidas:</strong>
                </td>
                <td colspan="0" style="text-align: right;">
                    <strong> <?php echo $cantidadSalidas['totalSalidas']; ?></strong>
                </td>

            </tr>

        </table>
    </div>
</body>



</html>

<?php
$html = ob_get_clean(); //archivo html
//echo $html;

//incluyendo libreia DOMpdf
require_once('../librerias/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

//Para cargar imagenes
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
//$dompdf->setPaper('letter');
//$dompdf->setPaper('A4', 'landscape'); // Horizontal
$dompdf->setPaper('A4', 'portrait'); //Vertical

$dompdf->render();

$dompdf->stream("lista-trabajos.pdf", array("Attachment" => false)); //false para que no se descarge


?>