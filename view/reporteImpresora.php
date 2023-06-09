<?php
// require_once("../config/conexion.php");
// $conectarObj = new Conectar(); // Crear una instancia de la clase Conectar
// $conectar = $conectarObj->Conexion();
// $idTrabajps = (isset($_GET['id'])) ? $_GET['id'] : "";
// //echo $idTrabajps;

// $consulta = "";

// $consulta = $conectar->prepare($consulta);
// $consulta->execute();

// // Obtener los resultados de la consulta
// $resultado = $consulta->fetch(PDO::FETCH_ASSOC);

// $codigoCorrelativo = $resultado['codigo_correlativo'];
// $equipoId = $resultado['equipo_id'];
// $tipoEquipoId = $resultado['id_tipo_equipo'];
// $nombreTipoEquipo = $resultado['nombre_tipo_equipo'];
// $serie = $resultado['serie'];
// $margesi = $resultado['margesi'];
// $nombrePersonalId = $resultado['responsable_id'];
// $nombreResponsable = $resultado['NombreResponsable'];
// $tipoEquipo = $resultado['nombre_tipo_equipo'];
// $nombreArea = $resultado['nombre_area'];
// $areaID = $resultado['area_id'];
// $nombreMarca = $resultado['nombre_marca'];
// $nombreModelo = $resultado['nombre_modelo'];
// $falla = $resultado['falla'];
// $nombreTecnico = $resultado['tecnico_id'];
// $solucion = $resultado['solucion'];
// $recomendacion = $resultado['recomendacion'];
// $fecha = $resultado['Fecha'];


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
            box-shadow: inset 0 0 0 1000px rgba(151, 141, 141, 0.521);
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
            font-size: 25px;
            width: 18px;
            height: 18px;
            line-height: 11px;
            text-align: center;
            position: absolute;
            left: 0;
            top: 50%;
            margin-top: -8.5px;
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
                writing-mode: lr;
            }

            @page {
                size: landscape;
            }

            #enres {
                box-shadow: inset 0 0 0 1000px rgba(151, 141, 141, 0.521);
            }

            .contenidovisible {
                height: 90vh;
                font-size: 18px;
            }

            .tbcontainer {
                margin-bottom: 6px;
            }

            .subtbcontainer {
                margin-bottom: 0px;
            }

            .footer {
                height: 10vh;
                width: 100%;
                margin: 0px;
                position: absolute;
                clear: both;
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
                height: 230px;
                display: flex;
                justify-content: space-around;
                flex-direction: row;
                flex-wrap: wrap;
                align-content: center;
                align-items: flex-start;
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
                                            <span class="align-middle"><strong>FICHA CAMBIO DE TONER/TINTA/CINTA</strong></span>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <table class="table table-borderless align-middle text-center">
                            <thead>
                                <tr>
                                    <th scope="col" style="
                        border-bottom-style: hidden;
                        border-top-style: hidden;
                        border-left-style: hidden;
                      " class="align-middle">
                                        <span class="align-middle"><strong>HOSPITAL DE APOYO II-1 NUESTRA SEÑORA DE LAS MERCEDES
                                                DE PAITA</strong></span>
                                    </th>

                                    <div class="row table table-bordered align-middle" style="margin-bottom: 0px">
                                        <div class style="margin-bottom: 0px">
                                            <th class="w-25" style="
                            margin: 0 0;
                            padding: 0 0;
                            border: none;
                            border-style: none;
                          ">
                                                <table class="table table-bordered border-dark" style="
                              margin: 0 0;
                              padding: 0 0;
                              border: none;
                              border-style: none;
                            ">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" colspan="3" id="enres" style="padding: 0 0">
                                                                <strong>FECHA</strong>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="padding: 0 0">
                                                                <span name="fechaDia" id="fechaDia">16</span>
                                                            </td>
                                                            <td style="padding: 0 0">
                                                                <span name="fechaMes" id="fechaMes">06</span>
                                                            </td>
                                                            <td style="padding: 0 0">
                                                                <span name="fechaAño" id="fechaAño">23</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </th>
                                        </div>
                                    </div>
                                </tr>
                            </thead>
                        </table>

                        <table class="table table-borderless border-dark align-center" style="margin: 0%">
                            <tbody>
                                <tr>
                                    <td class="tbcontainer" style="width: 60%; padding: 0%">
                                        <table class="table table-bordered border-dark align-middle text-center tbcontainer" style="width: 80%">
                                            <tr>
                                                <th class="cellcort" id="enres" style="width: 30%">
                                                    <strong>MARCA</strong>
                                                </th>
                                                <td class="cellcort">
                                                    <span name="marca" id="marca">Marca1</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="cellcort" id="enres">
                                                    <strong>MODELO</strong>
                                                </th>
                                                <td class="cellcort">
                                                    <span name="modelo" id="modelo">Modelo 1</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="cellcort" id="enres">
                                                    <strong>MARQUESI</strong>
                                                </th>
                                                <td class="cellcort">
                                                    <span name="marquesi" id="marquesi">313546494891</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="cellcort" id="enres">
                                                    <strong>CONSUMIBLE</strong>
                                                </th>
                                                <td class="cellcort">
                                                    <span name="consumible" id="consumible">Consumible 1</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="cellcort" id="enres">
                                                    <strong>IMPRESIONES</strong>
                                                </th>
                                                <td class="cellcort">
                                                    <span name="impresiones" id="inpresiones">1254</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="padding: 0 0; border: none">
                                        <table class="table table-bordered" style>
                                            <tr style="border: none">
                                                <td style="
                              border: none;
                              padding-right: 0;
                              padding-left: 0;
                            ">
                                                    <table class="border border-dark text-center" style="width: 100%">
                                                        <thead>
                                                            <tr class="border border-dark">
                                                                <th id="enres" scope="col">
                                                                    <strong>NOMBRE Y APELLIDO DE RESPONSABLE</strong>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <span id="nombreRes" name="nombreRes">Cristiam Viera Burneo</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr style="border: none">
                                                <td style="
                              border: none;
                              padding-right: 0;
                              padding-left: 0;
                            ">
                                                    <table class="border border-dark text-center" style="width: 100%">
                                                        <thead>
                                                            <tr class="border border-dark">
                                                                <th id="enres" scope="col">
                                                                    <strong>OFICINA/SERVICIO</strong>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <span name="ofServ" id="ofServ">Oficina 1</span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-borderless" style="width: 80%; padding: 0 0; margin: 0%">
                            <tbody>
                                <tr>
                                    <td class="container" style="display: flex; justify-content: space-evenly">
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkToner" style="accent-color: white" />
                                            <label class="form-check-label" for="checkToner">
                                                Toner</label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkCinta" />
                                            <label class="form-check-label" for="checkCinta">
                                                CINTA</label>
                                        </div>
                                        <div>
                                            <input class="form-check-input" type="checkbox" id="checkTinta" />
                                            <label class="form-check-label" for="checkTinta">
                                                TINTA</label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="table table-bordered tbcontainer">
                            <table class="table table-bordered border-dark align-middle tbcontainer">
                                <thead>
                                    <tr>
                                        <th class="cellcort lista text-center" id="enres">
                                            FALLAS EN EQUIPO INFORMATICO
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="cellcort lista" style="font-size: 15px" name="fallas" id="fallas">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Praesent id congue nunc. Integer eu lobortis turpis. In
                                            mollis sem luctus turpis sodales, sed faucibus odio
                                            egestas. Quisque id faucibus ligula. Sed vestibulum
                                            faucibus libero, in consequat nulla eleifend nec. Nullam
                                            ultrices fringilla laoreet. Mauris sed risus quis lorem
                                            dictum luctus ut eu metus. Etiam interdum tincidunt
                                            lacinia. Curabitur finibus ornare enim nec mattis. Donec
                                            sit amet ultricies enim. Nunc iaculis vel ipsum vitae
                                            lacinia.Mauris sed risus quis lorem dictum luctus ut eu
                                            metus. Etiam interdum tincidunt lacinia. Curabitur
                                            finibus ornare enim nec mattis. Donec sit amet ultricies
                                            enim. Nunc iaculis vel ipsum vitae lacinia.Mauris sed
                                            risus quis lorem dictum luctus ut eu metus. Etiam
                                            interdum tincidunt lacinia. Curabitur finibus ornare
                                            enim nec mattis. Donec sit amet ultricies enim. Nunc
                                            iaculis vel ipsum vitae lacinia.
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

<div class="footer" style="
      width: 100%;
      margin: 0px;
      position: relative;
      clear: both;
      padding: 0 0;
      line-height: 8px;
    ">
    <div class="copyright" style="width: inherit">
        <div class="container-fluid">
            <table class="table table-borderless" style="margin: 0%">
                <tr style="width: 100%; padding: 0 0px; font-size: 15px">
                    <td class="w-75" style="padding-top: 0; padding-bottom: 0">
                        <div class="row">
                            <div class="col-lg-12 col-sm-6">
                                <b>(E) Soporte Técnico e Informático</b>
                            </div>
                        </div>
                    </td>
                    <td class="w-auto" style="padding-top: 0; padding-bottom: 0">
                        <div class="row">
                            <div class="text-end">
                                <strong>(E) Servicio / Oficina</strong>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-center" colspan="2">
                        <span style="font-size: 15px"><strong>AL FIRMAR ESTA FICHA, EL RESPONSABLE DEL SERVICIO U OFICINA
                                CERTIFICA QUE ESTA CONFORME CON EL TRABAJO REALIZADO</strong></span>
                    </td>
                </tr>
            </table>
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