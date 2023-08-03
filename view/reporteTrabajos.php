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
            margin-left: 1cm;
            margin-right: 1cm;
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
    //     $sql = $conectar->prepare("SELECT id_trabajo_servicio,
    //     te.nombre_tipo_equipo,
    //     a.nombre_area,
    //     CONCAT(
    //         per2.nombre_personal,
    //         ' ',
    //         per2.apellidos_personal
    //     ) NombreTecnico,
    //     ser.nombre_servicios,
    //     DATE_FORMAT(ts.create_time, '%d/%m/%y') as Fecha
    // from trabajo_servicio ts
    //     INNER JOIN equipos eq ON ts.equipo_id = ts.equipo_id
    //     INNER JOIN area a ON eq.area_id = a.id_area
    //     INNER JOIN trabajos t ON t.id_trabajos = ts.trabajo_id
    //     INNER JOIN personal per on eq.clientes_id = per.id_personal
    //     INNER JOIN personal per2 on t.tecnico_id = per2.id_personal
    //     INNER JOIN servicios ser on ts.servicio_id = ser.id_servicios
    //     INNER JOIN tipo_equipo te ON te.id_tipo_equipo = eq.tipo_equipo_id
    //     WHERE ser.`esActivo` = 1;");
    $sql = $conectar->prepare("SELECT
    t.id_trabajos,
    te.nombre_tipo_equipo,
    a.nombre_area,
    CONCAT(per.nombre_personal, ' ', per.apellidos_personal) AS NombreTecnico,
    GROUP_CONCAT(s.nombre_servicios SEPARATOR ', ') AS servicios,
    DATE_FORMAT(ts.create_time, '%d/%m/%y') AS Fecha
FROM trabajos t
INNER JOIN trabajo_servicio ts ON t.id_trabajos = ts.trabajo_id
INNER JOIN personal per ON t.tecnico_id = per.id_personal
INNER JOIN equipos eq ON eq.id_equipos = t.equipo_id
INNER JOIN area a ON a.id_area = t.area_id
INNER JOIN servicios s ON s.id_servicios = ts.servicio_id
INNER JOIN tipo_equipo te ON te.id_tipo_equipo = eq.tipo_equipo_id
WHERE ts.esActivo = 1 AND t.es_activo = 1
GROUP BY t.id_trabajos, eq.id_equipos
ORDER BY id_trabajos asc;");
    $sql->execute();
    $listaTrabajos = $sql->fetchAll(PDO::FETCH_ASSOC);
    $totalTrabajos = count($listaTrabajos);
    $fechaActual = date('d/m/Y');
    $horaActual = date('H:i:s');

    ?>


    <div class="encabezado">
        <div id="logo">
            <img src="http://localhost/ProyectoSoporte/img/banner.png" alt="">
        </div>
        <div id="fecha-hora">
            <span>Fecha: <?php echo $fechaActual; ?></span>
            <span>Hora: <?php echo $horaActual; ?></span>
        </div>
        <!-- <h2>encabezado</h2> -->
    </div>

    <h1>Lista de trabajos</h1>

    <div class="">
        <table class=" align-middle" style="border: 2px solid red ;">
            <thead>
                <tr>
                    <th scope="col"><strong>#</strong></th>
                    <th scope="col"><strong>Equipo</strong></th>
                    <th scope="col"><strong>Área</strong></th>
                    <th scope="col"><strong>Técnico</strong></th>
                    <th scope="col"><strong>Trabajos realizados</strong></th>
                    <th scope="col"><strong>Fecha</strong></th>


                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaTrabajos as $trabajo) { ?>
                    <tr>
                        <td><?php echo $trabajo['id_trabajos'] ?></td>
                        <td><?php echo $trabajo['nombre_tipo_equipo'] ?></td>
                        <td><?php echo $trabajo['nombre_area'] ?></td>
                        <td><?php echo $trabajo['NombreTecnico'] ?></td>
                        <td><?php echo $trabajo['servicios'] ?></td>
                        <td><?php echo $trabajo['Fecha'] ?></td>

                    </tr>
                <?php } ?>

                <tr>
                    <td colspan="6" style="text-align: right;"><strong>Total de trabajos: <?php echo $totalTrabajos; ?></strong></td>
                </tr>
            </tbody>
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