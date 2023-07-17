<?php
require_once("../config/conexion.php");
$conectarObj = new Conectar(); // Crear una instancia de la clase Conectar
$conectar = $conectarObj->Conexion();
$idMovimientos = (isset($_GET['id'])) ? $_GET['id'] : "";
// consulta fecha
$consultaFecha = "SELECT DISTINCT  DATE_FORMAT(fecha, '%d/%m/%y') as Fecha from translado;";
$consultaFecha = $conectar->prepare($consultaFecha);
$consultaFecha->execute();
$resultadoFecha = $consultaFecha->fetch(PDO::FETCH_ASSOC);
$fechaRegistro = $resultadoFecha['Fecha'];

$consulta1 = "SELECT te.nombre_tipo_equipo,
        m.nombre_marca,
        mo.nombre_modelo,
        e.serie,
        e.margesi,
        es.nombre_estado FROM detalles_translado dt
        INNER JOIN equipos e on dt.equipo_id = e.cod_equipo
            INNER JOIN marca m ON e.marca_id = m.id_marca
            INNER JOIN modelo mo ON e.modelo_id = mo.id_modelo
            INNER JOIN estado es ON es.id_estado = e.estado_id
            INNER JOIN tipo_equipo te ON te.id_tipo_equipo = e.tipo_equipo_id
        WHERE id_translado = '$idMovimientos'";
$consulta1 = $conectar->prepare($consulta1);
$consulta1->execute();
$resultado1 = $consulta1->fetchAll(PDO::FETCH_ASSOC);
$cantidadFilas = count($resultado1);
$fechaActual = date('d/m/Y');
// echo $cantidadFilas;
//print_r($resultado1);
$equipo1 = [];
$equipo2 = [];
if ($cantidadFilas == 2) {
    for ($i = 0; $i <= $cantidadFilas; $i++) {
        if ($i == 0) {
            array_push($equipo1, $resultado1[$i]);
        } else if ($i == 1) {
            array_push($equipo2, $resultado1[$i]);
        }
    }
    // print_r($equipo1);
    // print_r($equipo2);
}

// $consulta = "SELECT te.nombre_tipo_equipo,
// m.nombre_marca,
// mo.nombre_modelo,
// e.serie,
// e.margesi,
// es.nombre_estado FROM detalles_translado dt
// INNER JOIN equipos e on dt.equipo_id = e.cod_equipo
//     INNER JOIN marca m ON e.marca_id = m.id_marca
//     INNER JOIN modelo mo ON e.modelo_id = mo.id_modelo
//     INNER JOIN estado es ON es.id_estado = e.estado_id
//     INNER JOIN tipo_equipo te ON te.id_tipo_equipo = e.tipo_equipo_id
//  WHERE id_translado = '$idTranslado' ORDER BY equipo_id ASC -- AND equipo_id = '$codEquipo';";

// $consulta = $conectar->prepare($consulta);
// $consulta->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACTA DE ENTREGA Y RETIRO</title>
</head>
<style>
    .año {
        text-align: center;
    }

    .titulo {
        text-transform: uppercase;
        text-align: center;
        padding: 10px 10px;
    }

    .fecha {
        text-align: right;
        padding-right: 10px;
        font-weight: bold;
    }

    /* .tabla {
            width: 100%;
            padding: 0px 170px;
            border: 1px solid #000;
        } */
    /* .p-tabla {
            text-transform: uppercase;
            font-weight: bold;
            padding: 0px 170px;

        } */

    /* .firmas {
        display: flex;
        text-align: center;
        padding: 10px 170px;
    } */

    .firmas {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

    .firma {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 10px;
    }

    .firma span {
        margin-bottom: 5px;
    }

    .p-firma {
        margin: 0;
        text-transform: uppercase;
        font-weight: bold;
    }

    section {
        padding: 20px 0px;
    }

    .tabla {
        border-collapse: collapse;
        width: 100%;
        margin-top: 15px
    }

    .tabla th,
    .tabla td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .tabla th {
        box-shadow: inset 0 0 0 1000px rgba(151, 141, 141, 0.521);
    }

    .tabla tr:hover {
        background-color: #f5f5f5;
    }

    .p-tabla {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .firma {

        padding: 0px 10px;
    }

    /* #imprimir {
        display: none;
    } */

    .firma_baja {
        padding-top: 100px;
    }

    textarea {
        border: 0px;
        resize: none;
        text-align: center;
        font-size: 14px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    body {
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }

    @media print {
        body {
            margin: 0;
            padding: 20px;

        }

        #imprimir {
            display: none;
        }
    }
</style>

<body>
    <input type="button" id="imprimir" name="imprimir" value="Imprimir" onclick="window.print();" />
    <div>
        <textarea name="año" id="" cols="1" style="width: 100%; font-weight: bold;">"Año del Fortalecimiento de la Soberanía Nacional"</textarea>
    </div>
    <!-- <div class="año">
        <h3>"Año del Fortalecimiento de la Soberanía Nacional"</h3>
    </div> -->
    <!-- <div class=" titulo">
        <h3>acta de entrega y/o retiro de bienes patrimoniales del hospital de apoyo ii-1 nuestra señora de las mercedes paita - 2023 </h3>
    </div> -->
    <div>
        <textarea name="año" id="" cols="1" style="width: 100%; font-weight: bold;" class="titulo">acta de entrega y/o retiro de bienes patrimoniales del hospital de apoyo ii-1 nuestra señora de las mercedes paita - 2023</textarea>
    </div>
    <div class="fecha">
        <p>Fecha Actual: <?php echo $fechaActual; ?></p>
        <p>Fecha de registro: <?php echo $fechaRegistro; ?></p>
    </div>
    <section>
        <p class="p-tabla">bien patrimonial instalado</p>
        <table class="tabla" border="default">
            <tr>
                <th>UD</th>
                <th>EQUIPO</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>SERIE</th>
                <th>MARGESI</th>
                <th>ESTADO</th>
            </tr>
            <tr>
                <?php foreach ($equipo1 as $equipo) { ?>
                    <td>01</td>
                    <td><?php echo $equipo['nombre_tipo_equipo'] ?></td>
                    <td><?php echo $equipo['nombre_marca'] ?></td>
                    <td><?php echo $equipo['nombre_modelo'] ?></td>
                    <td><?php echo $equipo['serie'] ?></td>
                    <td><?php echo $equipo['margesi'] ?></td>
                    <td><?php echo $equipo['nombre_estado'] ?></td>
            </tr>
        <?php } ?>
        </table>
    </section>
    <section>
        <p class="p-tabla">bien patrimonial retirado</p>
        <table class="tabla" border="default">
            <tr>
                <th>UD</th>
                <th>EQUIPO</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>SERIE</th>
                <th>MARGESI</th>
                <th>ESTADO</th>
            </tr>
            <tr>
                <?php foreach ($equipo2 as $equipo) { ?>
                    <td>01</td>
                    <td><?php echo $equipo['nombre_tipo_equipo'] ?></td>
                    <td><?php echo $equipo['nombre_marca'] ?></td>
                    <td><?php echo $equipo['nombre_modelo'] ?></td>
                    <td><?php echo $equipo['serie'] ?></td>
                    <td><?php echo $equipo['margesi'] ?></td>
                    <td><?php echo $equipo['nombre_estado'] ?></td>
            </tr>
        <?php } ?>
        </table>
    </section>
    <section class="firmas">
        <div class="firma">
            <span>_________________________</span>
            <p class="p-firma">entregué conforme</p>
        </div>
        <div class="firma firma_baja">
            <span>_____________________________</span>
            <p class="p-firma">control patrimonial</p>
        </div>
        <div class="firma">
            <span>______________________</span>
            <p class="p-firma">recibí comforme</p>
        </div>

    </section>
</body>

</html>