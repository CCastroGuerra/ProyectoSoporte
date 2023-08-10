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

        /* bordes para impresiones horizontal */
        @page {

            margin-right: 0;
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
            font-size: 12px;
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
    $sql = $conectar->prepare("SELECT e.usuario_local,e.id_equipos,e.cod_equipo, tp.nombre_tipo_equipo,CONCAT(p.nombre_personal, ' ', p.apellidos_personal) AS nombrePersonal, mar.nombre_marca, mo.nombre_modelo, e.serie, e.margesi, a.nombre_area, est.nombre_estado, DATE_FORMAT(fecha_alta, '%d/%m/%y') as Fecha from equipos e INNER JOIN tipo_equipo tp ON e.tipo_equipo_id = tp.id_tipo_equipo INNER JOIN marca mar ON mar.id_marca = e.marca_id INNER JOIN modelo mo ON mo.id_modelo = e.modelo_id INNER JOIN area a ON a.id_area = e.area_id INNER JOIN estado est ON est.id_estado = e.estado_id INNER JOIN personal p ON e.clientes_id = p.id_personal WHERE e.es_activo = 1
    ORDER BY cod_equipo; ");
    $sql->execute();
    $listaEquipos = $sql->fetchAll(PDO::FETCH_ASSOC);
    $totalEquipos = count($listaEquipos);
    $fechaActual = date('d/m/Y');
    $horaActual = date('H:i:s');

    ?>
    <?php
    require_once("../config/variables.php");
    ?>

    <div class="encabezado">
        <div id="logo">
            <img src="<?php echo logoreportes; ?>" alt="">
        </div>
        <div id="fecha-hora">
            <span>Fecha: <?php echo $fechaActual; ?></span>
            <span>Hora: <?php echo $horaActual; ?></span>
        </div>
        <!-- <h2>encabezado</h2> -->
    </div>

    <h1>Lista de equipos</h1>

    <div class="">
        <table class=" align-middle" style="width: 100%;">
            <thead>
                <tr>
                    <th scope="col"><strong>Codigo</strong></th>
                    <th scope="col"><strong>Equipo</strong></th>
                    <th scope="col"><strong>Usuario</strong></th>
                    <th scope="col"><strong>Marca</strong></th>
                    <th scope="col"><strong>Modelo</strong></th>
                    <th scope="col"><strong>Serie</strong></th>
                    <th scope="col"><strong>Margesi</strong></th>
                    <th scope="col"><strong>Area</strong></th>
                    <th scope="col"><strong>Estado</strong></th>
                    <th scope="col"><strong>F.Creación</strong></th>



                </tr>
            </thead>
            <tbody>
                <?php foreach ($listaEquipos as $equipos) { ?>
                    <tr>
                        <td><?php echo $equipos['cod_equipo'] ?></td>
                        <td><?php echo $equipos['nombre_tipo_equipo'] ?></td>
                        <td><?php echo $equipos['usuario_local'] ?></td>
                        <td><?php echo $equipos['nombre_marca'] ?></td>
                        <td><?php echo $equipos['nombre_modelo'] ?></td>
                        <td><?php echo $equipos['serie'] ?></td>
                        <td><?php echo $equipos['margesi'] ?></td>
                        <td><?php echo $equipos['nombre_area'] ?></td>
                        <td><?php echo $equipos['nombre_estado'] ?></td>
                        <td><?php echo $equipos['Fecha'] ?></td>


                    </tr>
                <?php } ?>

                <tr>
                    <td colspan="10" style="text-align: right;"><strong>Total de equipos: <?php echo $totalEquipos; ?></strong></td>
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
$dompdf->setPaper('A4', 'landscape'); // Horizontal
//$dompdf->setPaper('A4', 'portrait'); //Vertical

$dompdf->render();

$dompdf->stream("lista-equipos.pdf", array("Attachment" => false)); //false para que no se descarge


?>