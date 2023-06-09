<?php
require_once("../config/conexion.php");
$conectarObj = new Conectar(); // Crear una instancia de la clase Conectar
$conectar = $conectarObj->Conexion();
$idTrabajps = (isset($_GET['id'])) ? $_GET['id'] : "";
//echo $idTrabajps;

$consulta = "SELECT t.id_trabajos,
        CONCAT('N°', LPAD(id_trabajos, 6, '0')) AS codigo_correlativo,
        t.equipo_id,
        te.id_tipo_equipo,
        te.nombre_tipo_equipo,
        eq.serie,
        mar.nombre_marca,
        mo.nombre_modelo,
        eq.margesi,
        t.responsable_id,
        CONCAT(p.nombre_personal, ' ', p.apellidos_personal) NombreResponsable,
        t.area_id,
        a.nombre_area,
        t.tecnico_id,
        ts.servicio_id,
        s.nombre_servicios,
        t.falla,
        t.solucion,
        t.recomendacion,
        CONCAT(per.nombre_personal, ' ', per.apellidos_personal) NombreTecnico,
        DATE_FORMAT(t.fecha_alta, '%d/%m/%y') as Fecha
        FROM trabajos t
        INNER JOIN personal per ON t.tecnico_id = per.id_personal
        INNER JOIN personal p ON p.id_personal = t.responsable_id
        INNER JOIN equipos eq ON eq.id_equipos = t.equipo_id
        INNER JOIN area a ON a.id_area = t.area_id
        INNER JOIN trabajo_servicio ts ON ts.trabajo_id = t.id_trabajos
        INNER JOIN servicios s ON s.id_servicios = ts.servicio_id
        INNER JOIN tipo_equipo te ON te.id_tipo_equipo = eq.tipo_equipo_id
        INNER JOIN marca mar ON eq.marca_id = mar.id_marca
        INNER JOIN modelo mo ON mo.id_modelo = eq.modelo_id
        WHERE t.es_activo = 1
        AND ts.`esActivo` = 1
        AND id_trabajos = '$idTrabajps'";

$consulta = $conectar->prepare($consulta);
$consulta->execute();

// Obtener los resultados de la consulta
$resultado = $consulta->fetch(PDO::FETCH_ASSOC);

$codigoCorrelativo = $resultado['codigo_correlativo'];
$equipoId = $resultado['equipo_id'];
$tipoEquipoId = $resultado['id_tipo_equipo'];
$nombreTipoEquipo = $resultado['nombre_tipo_equipo'];
$serie = $resultado['serie'];
$margesi = $resultado['margesi'];
$nombrePersonalId = $resultado['responsable_id'];
$nombreResponsable = $resultado['NombreResponsable'];
$tipoEquipo = $resultado['nombre_tipo_equipo'];
$nombreArea = $resultado['nombre_area'];
$areaID = $resultado['area_id'];
$nombreMarca = $resultado['nombre_marca'];
$nombreModelo = $resultado['nombre_modelo'];
$falla = $resultado['falla'];
$nombreTecnico = $resultado['tecnico_id'];
$solucion = $resultado['solucion'];
$recomendacion = $resultado['recomendacion'];
$fecha = $resultado['Fecha'];

// Consulta para servicios
$consulta2 = "SELECT GROUP_CONCAT(s.nombre_servicios SEPARATOR ', ') AS servicios
        FROM trabajos t
        INNER JOIN personal per ON t.tecnico_id = per.id_personal
        INNER JOIN personal p ON p.id_personal = t.responsable_id
        INNER JOIN equipos eq ON eq.id_equipos = t.equipo_id
        INNER JOIN area a ON a.id_area = t.area_id
        INNER JOIN trabajo_servicio ts ON ts.trabajo_id = t.id_trabajos
        INNER JOIN servicios s ON s.id_servicios = ts.servicio_id
        INNER JOIN tipo_equipo te ON te.id_tipo_equipo = eq.tipo_equipo_id
        INNER JOIN marca mar ON eq.marca_id = mar.id_marca
        INNER JOIN modelo mo ON mo.id_modelo = eq.modelo_id
        WHERE t.es_activo = 1
        AND ts.`esActivo` = 1
        AND id_trabajos = ?";

$consulta2 = $conectar->prepare($consulta2);
$consulta2->bindValue(1, $idTrabajps);
$consulta2->execute();

$resultado2 = $consulta2->fetch(PDO::FETCH_ASSOC);
$servicios = $resultado2['servicios'];
//echo $servicios



?>


<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template" />
    <meta name="author" content="Łukasz Holeczek" />
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard" />
    <link rel="apple-touch-icon" sizes="60x60" href="../assets/favicon/apple-icon-60x60.png" />
    <title>Soporte Técnico</title>
    <link rel="apple-touch-icon" sizes="57x57" href="../assets/favicon/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="../assets/favicon/apple-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="../assets/favicon/apple-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/favicon/apple-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="../assets/favicon/apple-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="../assets/favicon/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="../assets/favicon/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="../assets/favicon/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="../assets/favicon/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png" />
    <link rel="manifest" href="../assets/favicon/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="../assets/favicon/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />

    <!-- Vendors styles-->
    <link rel="stylesheet" href="../vendors/simplebar/css/simplebar.css" />
    <link rel="stylesheet" href="../css/vendors/simplebar.css" />
    <!-- Main styles for this application-->
    <link href="../css/style.css" rel="stylesheet" />
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css" />
    <link href="../css/examples.css" rel="stylesheet" />
    <!--   stylo de paginacion -->
    <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/paginador.css" />

    <!-- Datables -->

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" /> -->
    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        #enres {
            background-color: gray;
        }

        .cellcort#enres {
            padding-top: 0;
            padding-bottom: 0;
            padding-right: 0;
            width: 25%;
        }

        /*---- checkbox----*/
        /*
            * Ocultarlo siendo accesible
            */
        .form-check-input {
            clip: rect(1px 1px 1px 1px);
            clip: rect(1px, 1px, 1px, 1px);
            position: absolute;
        }

        .form-check-input+label {
            position: relative;
            padding-left: 30px;
        }

        .form-check-input+label:before {
            content: "";
            display: inline-block;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-weight: bold;
            font-size: 18px;
            width: 13px;
            height: 13px;
            line-height: 4px;
            text-align: center;
            position: absolute;
            left: 0;
            top: 50%;
            margin-top: -6.2px;
            background: white;
            background-image: -webkit-gradient(linear,
                    50% 0%,
                    50% 100%,
                    color-stop(0%, #ffffff),
                    color-stop(100%, #dddddd));
            background-image: -webkit-linear-gradient(#ffffff, #dddddd);
            background-image: -moz-linear-gradient(#ffffff, #dddddd);
            background-image: -o-linear-gradient(#ffffff, #dddddd);
            background-image: linear-gradient(#ffffff, #dddddd);
            zoom: 1;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#ffffff, endColorstr=#dddddd);
            -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dddddd')";
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            -o-border-radius: 3px;
            border-radius: 3px;
            border: 1px solid #aaa;
        }

        /*
            * Fondo para cuando se pasa el ratón por encima
            */
        .form-check-input+label:hover:before {
            background: #fafafa;
        }

        /*
            * Fondo para cuando se está haciendo click
            * Con filtros para ie9
            */
        .form-check-input+label:active:before {
            background: #f2f2f2;
            background-image: -webkit-gradient(linear,
                    50% 0%,
                    50% 100%,
                    color-stop(0%, #dddddd),
                    color-stop(100%, #ffffff));
            background-image: -webkit-linear-gradient(#dddddd, #ffffff);
            background-image: -moz-linear-gradient(#dddddd, #ffffff);
            background-image: -o-linear-gradient(#dddddd, #ffffff);
            background-image: linear-gradient(#dddddd, #ffffff);
            zoom: 1;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#dddddd, endColorstr=#ffffff);
            -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#dddddd', endColorstr='#ffffff')";
        }

        .form-check-input:focus+label:before {
            outline: 1px dotted;
        }

        .form-check-input:checked+label:before {
            content: "\2713";
        }

        /*---- /checkbox---*/

        @media print {
            body {
                writing-mode: sideways-lr;
            }

            @page {
                size: portrait;
            }

            #enres {
                box-shadow: inset 0 0 0 1000px gray;
            }

            .contenidovisible {
                height: 95vh;
                font-size: 10px;
            }

            .tbcontainer {
                margin-bottom: 6px;
            }

            .subtbcontainer {
                margin-bottom: 0px;
            }

            .footer {
                height: 5vh;
            }

            .cellcort#enres {
                padding-top: 0;
                padding-bottom: 0;
                padding-right: 0;
                width: 25%;
            }

            td.cellcort {
                padding-top: 0;
                padding-bottom: 0;
            }

            td.lista {
                height: 140px !important;
                width: 100%;
                display: flex;
                justify-content: space-around;
                flex-direction: row;
                flex-wrap: wrap;
                align-content: flex-start;
                align-items: baseline;
            }

            #imprimir {
                display: none;
            }
        }
    </style>
</head>

<body>
    <input type="button" id="imprimir" name="imprimir" value="Imprimir" onclick="window.print();" />

    <div class="col-md-12 col-lg-12 contenidovisible">
        <div class="row">
            <div class="col-xs-1-12">
                <div class="card">
                    <div class="card-body">
                        <div class="ALLS">
                            <table class="border border-0" style="display: inline-block; height: fit-content">
                                <tr>
                                    <td scope="col" style="padding: 0">
                                        <div>
                                            <img src="../img/banner.png" style="height: 40px" />
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="table table-bordered tbcontainer">
                            <table class="table border border-dark align-middle text-center">
                                <thead>
                                    <tr>
                                        <th scope="col" style="padding-top: 0; padding-bottom: 0">
                                            <span class="align-middle"><strong>FICHA DE PROCEDIMIENTOS INFORMÁTICOS</strong></span>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="table-bordered align-middle tbcontainer">
                            <table class="table table-bordered border border-dark align-middle text-center subtbcontainer">
                                <thead>
                                    <tr>
                                        <th scope="col" style="
                          border-bottom-style: hidden;
                          border-top-style: hidden;
                          border-left-style: hidden;
                        ">
                                            <span class="align-middle"><strong>HOSPITAL DE APOYO II-1 NUESTRA SEÑORA DE LAS
                                                    MERCEDES DE PAITA</strong></span>
                                        </th>

                                        <div class="row table table-bordered align-middle" style="margin-bottom: 0px">
                                            <div class="col-lg-5 col-sm-4" style="margin-bottom: 0px">
                                                <th id="enres"><strong>HLMSP-ST</strong></th>
                                            </div>
                                            <div class="col-lg-auto col-sm-4" style="margin-bottom: 0px">
                                                <th style="color: red"><?php echo $codigoCorrelativo ?></th>
                                            </div>
                                        </div>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="table table-borderless tbcontainer">
                            <table class="table table-borderless align-middle text-center subtbcontainer">
                                <tbody>
                                    <tr>
                                        <td scope="col" class="w-75" style="
                          padding-top: 0;
                          padding-bottom: 0;
                          padding-left: 0;
                        ">
                                            <table class="border border-dark" style="width: 100%">
                                                <thead>
                                                    <tr class="border border-dark">
                                                        <th id="enres" scope="col">
                                                            <strong>NOMBRES Y APELLIDOS</strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            <span name="nombre" id="nombre"><?php echo $nombreResponsable; ?></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td scope="col" class="w-25" style="
                          padding-top: 0;
                          padding-bottom: 0;
                          padding-left: 0;
                          padding-right: 0%;
                        ">
                                            <table class="border border-dark" style="width: 100%">
                                                <thead>
                                                    <tr class="border border-dark">
                                                        <th id="enres" scope="col">
                                                            <strong>FECHA DE RECEPCIÓN</strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;"><span name="fechaRec"><?php echo $fecha ?></span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table table-borderless tbcontainer">
                            <table class="table table-borderless align-middle text-center subtbcontainer">
                                <tr>
                                    <td scope="col" class="w-75" style="padding-top: 0; padding-bottom: 0; padding-left: 0">
                                        <div>
                                            <table class="border border-dark" style="width: 100%">
                                                <thead>
                                                    <tr class="border border-dark">
                                                        <th id="enres" scope="col">
                                                            <strong>DATOS DEL EQUIPO</strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="container" style="
                                  display: flex;
                                  justify-content: space-evenly;
                                ">
                                                            <div>
                                                                <input class="form-check-input" type="checkbox" id="checkCPU" <?php if ($tipoEquipoId == 2) echo 'checked'; ?> />
                                                                <label class="form-check-label" for="checkCPU">
                                                                    CPU</label>
                                                            </div>
                                                            <div>
                                                                <input class="form-check-input" type="checkbox" id="checkImpr" <?php if ($tipoEquipoId == 3) echo 'checked'; ?> />
                                                                <label class="form-check-label" for="checkImpr">
                                                                    Impresora</label>
                                                            </div>
                                                            <div>
                                                                <input class="form-check-input" type="checkbox" id="checkLaptop" <?php if ($tipoEquipoId == 1) echo 'checked'; ?> />
                                                                <label class="form-check-label" for="checkLaptop">
                                                                    Laptop</label>
                                                            </div>
                                                            <div>
                                                                <input class="form-check-input" type="checkbox" id="checkOtros" <?php if ($tipoEquipoId == 4) echo 'checked'; ?> />
                                                                <label class="form-check-label" for="checkOtros">
                                                                    Otros</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                    <td scope="col" class="w-25" style="
                        padding-top: 0;
                        padding-bottom: 0;
                        padding-left: 0;
                        padding-right: 0;
                      ">
                                        <div class>
                                            <table class="border border-dark" style="width: 100%">
                                                <thead>
                                                    <tr class="border border-dark">
                                                        <th id="enres" scope="col">
                                                            <strong>OFICINA/SERVICIO</strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">
                                                            <span name="oficServ" id="oficServ"><?php echo $nombreArea; ?></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="table table-border border-dark tbcontainer">
                            <table class="table table-bordered border-dark align-middle tbcontainer">
                                <tr>
                                    <th class="cellcort" id="enres"><strong>MARCA</strong></th>
                                    <td class="cellcort">
                                        <span name="marca" id="marca"><?php echo $nombreMarca; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="cellcort" id="enres"><strong>MODELO</strong></th>
                                    <td class="cellcort">
                                        <span name="modelo" id="modelo"><?php echo $nombreModelo ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="cellcort" id="enres">
                                        <strong>N° DE SERIE</strong>
                                    </th>
                                    <td class="cellcort">
                                        <span name="nroserie" id="nroserie"><?php echo $serie ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="cellcort" id="enres">
                                        <strong>MARQUESI</strong>
                                    </th>
                                    <td class="cellcort">
                                        <span name="marquesi" id="marquesi"><?php echo $margesi ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="cellcort" id="enres">
                                        <strong>PROCEDIMIENTO</strong>
                                    </th>
                                    <td class="cellcort">
                                        <span name="proced" id="proced"><?php echo $servicios ?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="table table-bordered tbcontainer">
                            <table class="table table-bordered border-dark align-middle tbcontainer">
                                <thead>
                                    <tr>
                                        <th class="cellcort lista text-center" id="enres">
                                            <strong>FALLAS EN EQUIPO INFORMATICO</strong>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="cellcort lista">
                                            <span name="fallas" id="fallas"><?php echo $falla ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table table-bordered tbcontainer">
                            <table class="table table-bordered border-dark align-middle tbcontainer">
                                <thead>
                                    <tr>
                                        <th class="cellcort text-center" id="enres">
                                            <strong>SOLUCIÓN O REPARACIÓN</strong>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="cellcort lista">
                                            <span name="solrep" id="solrep"><?php echo $solucion ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table table-bordered tbcontainer">
                            <table class="table table-bordered border-dark align-middle">
                                <thead>
                                    <tr>
                                        <th class="cellcort text-center" id="enres">
                                            <strong>RECOMENDACIONES</strong>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="cellcort lista">
                                            <span name="recom" id="recom"><?php echo $recomendacion ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<div class="footer" style="width: 100%; margin: 0px; position: relative; clear: both">
    <div class="copyright" style="width: inherit">
        <div class="container-fluid">
            <table class="table table-borderless" style="margin: 0%">
                <tr style="width: 100%">
                    <td class="w-75" style="padding-top: 0; padding-bottom: 0">
                        <div class="row">
                            <div class="col-lg-12 col-sm-6">
                                <b>(E) Soporte Técnico e Informático</b>
                            </div>
                        </div>
                    </td>
                    <td class="w-auto" style="padding-top: 0; padding-bottom: 0">
                        <div class="row">
                            <div class="col-lg-12 col-sm-4 text-end">
                                <strong>(E) Servicio / Oficina</strong>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="text-center">
                <span style="font-size: 10px">AL FIRMAR ESTA FICHA, EL RESPONSABLE DEL SERVICIO U OFICINA
                    CERTIFICA QUE ESTA CONFORME CON EL TRABAJO REALIZADO</span>
            </div>
        </div>
    </div>
</div>

<script src="../js/limpiarForm.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- CoreUI and necessary plugins-->

<script src="../vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
<script src="../vendors/simplebar/js/simplebar.min.js"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 -->

</html>
<?php

?>