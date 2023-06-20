<?php

//Apartir de aqui se va almacenar en una varible html
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 18px;

        }

        h1 {
            text-align: center;
            font-size: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #000;
            color: #fff;
        }
    </style>


</head>



<body>
    <?php
    require_once("../config/conexion.php");
    // Configuración de la zona horaria
    date_default_timezone_set('America/Lima');

    $conectarObj = new Conectar(); // Crear una instancia de la clase Conectar
    $conectar = $conectarObj->Conexion();
    $sql = $conectar->prepare("SELECT codigo_productos,nombre_productos,cantidad_productos,pre.nombre_presentacion, DATE_FORMAT(p.fecha_crea, '%d/%m/%y') as Fecha FROM productos p INNER JOIN presentacion pre ON p.presentacion_productos = pre.id_presentacion WHERE esActivo = 1");
    $sql->execute();
    $listaProductos = $sql->fetchAll(PDO::FETCH_ASSOC);
    $totalProductos = count($listaProductos);
    $fechaActual = date('d/m/Y');
    $horaActual = date('H:i:s');

    ?>


    <div style="text-align: right;">
        <strong>Fecha: <?php echo $fechaActual; ?></strong>
    </div>

    <div style="text-align: right; margin-bottom: 40px;">
        <strong>Hora: <?php echo $horaActual; ?></strong>
    </div>
    <div style="text-align: center; margin-bottom: 20px; font-size: 25px;">
        <strong>HOSPITAL DE APOYO II-1 NUESTRA SEÑORA DE LAS MERCEDES DE PAITA</strong>
    </div>
    <div>
        <img src="../escudo.png" alt="">
    </div>



    <div class=" table-responsive">
        <h1>Lista de productos</h1>
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <!-- <th scope="col" class="visually-hidden"><strong>#</strong></th> -->
                    <th scope="col"><strong>Codigo</strong></th>
                    <th scope="col"><strong>Nombre</strong></th>
                    <th scope="col"><strong>Unidad</strong></th>
                    <th scope="col"><strong>Cantidad</strong></th>
                    <th scope="col"><strong>Fecha</strong></th>


                </tr>
            </thead>
            <tbody id="tbProductos">
                <?php foreach ($listaProductos as $producto) { ?>
                    <tr>
                        <td><?php echo $producto['codigo_productos'] ?></td>
                        <td><?php echo $producto['nombre_productos'] ?></td>
                        <td><?php echo $producto['nombre_presentacion'] ?></td>
                        <td><?php echo $producto['cantidad_productos'] ?></td>
                        <td><?php echo $producto['Fecha'] ?></td>

                    </tr>
                <?php } ?>

                <tr>
                    <td colspan="6" style="text-align: right;"><strong>Total de productos: <?php echo $totalProductos; ?></strong></td>
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
require_once('../libreria/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml($html);
//$dompdf->setPaper('letter');
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream("archivo.pdf", array("Attachment" => false)); //false para que no se descarge

?>