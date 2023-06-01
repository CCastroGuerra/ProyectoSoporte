<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<!-- Breadcrumb-->
<html lang="es">
<?php include('../templates/sesion.php'); ?>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
  <meta name="author" content="Łukasz Holeczek">
  <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
  <link rel="apple-touch-icon" sizes="60x60" href="../assets/favicon/apple-icon-60x60.png">
  <title>Soporte Técnico</title>
  <link rel="apple-touch-icon" sizes="57x57" href="../assets/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="../assets/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="../assets/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="../assets/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="../assets/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="../assets/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="../assets/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="../assets/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../assets/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="../assets/favicon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="../assets/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <!-- Vendors styles-->
  <link rel="stylesheet" href="../vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="../css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="../css/style.css" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
  <link href="../css/examples.css" rel="stylesheet">
  <!--   stylo de paginacion -->
  <link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/paginador.css">

  <!-- Datables -->

  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" /> -->
  <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
  
  

  <!-- Global site tag (gtag.js) - Google Analytics-->
  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    // Shared ID
    gtag('config', 'UA-118965717-3');
    // Bootstrap ID
    gtag('config', 'UA-118965717-5');
  </script>


  <!-- <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.js"></script> -->
  <!-- prueba script datatables -->
  <!-- <script>
    $(document).ready(function() {
       $("Table").DataTable({
         language: {
           decimal: ".",
           emptyTable: "No hay datos disponibles en esta tabla",
           info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
           infoEmpty: "Mostrando 0 de 0 de 0 entradas",
           infoFiltered: "(Filtrado de _MAX_ total entradas)",
           "infoPostFix": "",
           thousands: ",",
           lengthMenu: "Mostrar _MENU_ Entradas",
           loadingRecords: "Cargando...",
           processing: "Procesando...",
           search: "Buscar:",
           zeroRecords: "Sin resultados encontrados",
           paginate: {
             first: "Primero",
             last: "Ultimo",
             next: ">",
             previous: "<"
           },
           search: "_INPUT_",
           searchPlaceholder: "Buscar..."
         },
         pagingType: "full_numbers",
         pagingTag: "button",
       "columnDefs": [{
          "targets": [-1],

      "searchable": false,

        }]
       });

      $("#tableModal").DataTable({
        destroy: true,
        lengthMenu: false,
        lengthChange: false,
        search: false,
        searching: false,
        paging: false,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json"
        },

      });

    });
  </script>  -->

  <!-- <link href="../vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet"> -->
</head>

<body>
  <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
      <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
        <use xlink:href="../assets/brand/coreui.svg#signet"></use>
      </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item"><a class="nav-link" href="../view/dashboardView.php">
          <svg class="nav-icon">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
          </svg> Dashboard<span class="badge badge-sm bg-info ms-auto">NEW</span></a>
      </li>
      <!--item almacen-->
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-storage"></use>
          </svg> Almacén</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="../view/productosView.php">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-airplay"></use>
              </svg> Productos</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../view/componentesview.php">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-memory"></use>
              </svg> Componentes</a></li>

          <li class="nav-item"><a class="nav-link" href="../view/inventarioView.php">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-chart"></use>
              </svg>
              Inventario</a></li>
          <li class="nav-item"><a class="nav-link" href="../view/bajasView.php">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
              </svg> Bajas</a></li>
          <li class="nav-item nav-group"><a class="nav-link nav-group-toggle" href="#">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-applications-settings"></use>
              </svg> Parámetros</a>
            <ul class="nav-group-items">
              <li class="nav-item"><a class="nav-link" href="../view/marcaView.php" target="_top">
                  <svg class="nav-icon">
                    <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-aperture"></use>
                  </svg> Marcas</a></li>
              <li class="nav-item"><a class="nav-link" href="../view/modeloView.php" target="_top">
                  <svg class="nav-icon">
                    <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-apps"></use>
                  </svg> Modelos</a></li>

            </ul>
          </li>
        </ul>
      </li>
      <!--fin almacen-->
      <!--item Equipos-->
      <li class="nav-item"><a class="nav-link" href="../view/equiposview.php">
          <svg class="nav-icon">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-devices"></use>
          </svg> Equipos</a>
      </li>
      <!--/item Equipos-->
      <!--item Trabajos-->
      <li class="nav-item"><a class="nav-link" href="../view/trabajosView.php">
          <svg class="nav-icon">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-task"></use>
          </svg> Trabajos</a>
      </li>
      <!--/item Trabajos-->
      <!--item almacen-->
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
          </svg> Configuración</a>
        <ul class="nav-group-items">

          <li class="nav-item"><a class="nav-link" href="../view/areaView.php">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-book"></use>
              </svg> Áreas</a></li>
          <li class="nav-item"><a class="nav-link" href="../view/rolesView.php">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-briefcase"></use>
              </svg> Roles</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="../view/serviciosView.php">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-browser"></use>
              </svg> Servicios</a></li>

        </ul>
      </li>
      <!--fin almacen-->
      <!-- gestion de personal -->
      <li class="nav-divider"></li>
      <li class="nav-title">Gestión del Personal</li>
      <li class="nav-item"><a class="nav-link" href="../view/asignarolesView.php">
          <svg class="nav-icon">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-pin"></use>
          </svg> Asignar Roles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../view/personalView.php">
          <svg class="nav-icon">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-people"></use>
          </svg> Personal</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="../view/usuariosView.php">
          <svg class="nav-icon">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-user-plus"></use>
          </svg> Usuario</a>
      </li>

      <!-- /gestion de personal -->


      <!--Reportes-->
      <li class="nav-divider"></li>
      <li class="nav-title">Reportes</li>
      <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-star"></use>
          </svg> Pages</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="login.html" target="_top">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
              </svg> Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.html" target="_top">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
              </svg> Register</a></li>
          <li class="nav-item"><a class="nav-link" href="404.html" target="_top">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-bug"></use>
              </svg> Error 404</a></li>
          <li class="nav-item"><a class="nav-link" href="500.html" target="_top">
              <svg class="nav-icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-bug"></use>
              </svg> Error 500</a></li>
        </ul>
      </li>

      <li class="nav-item"><a class="nav-link" href="../view/trabajosView.php">
          <svg class="nav-icon">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
          </svg> Trabajos</a>
      </li>
      <!--fin Reportes-->

    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
  </div>


  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <header class="header header-sticky mb-4">
      <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
          <svg class="icon icon-lg">
            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button><a class="header-brand d-md-none" href="#">
          <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="../assets/brand/coreui.svg#full"></use>
          </svg></a>
        <ul class="header-nav d-none d-md-flex">
          <li class="nav-item"><a class="nav-link" href="../view/dashboardView.php">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="../view/personalView.php">Usuarios</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Configuración</a></li>

        </ul>
        <ul class="header-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="#">
              <svg class="icon icon-lg">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
              </svg></a></li>
          <li class="nav-item"><a class="nav-link" href="#">
              <svg class="icon icon-lg">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-list-rich"></use>
              </svg></a></li>
          <li class="nav-item"><a class="nav-link" href="#">
              <svg class="icon icon-lg">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
              </svg></a></li>
        </ul>
        <ul class="header-nav ms-3">
          <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <div><?php echo $_SESSION['nombre'] ?></div>
              <!-- <div class="avatar avatar-md"><img class="avatar-img" src="../assets/img/avatars/8.jpg" alt="user@email.com"></div> -->
            </a>
            <div class="dropdown-menu dropdown-menu-end pt-0">
              <div class="dropdown-header bg-light py-2">
                <div class="fw-semibold">Account</div>
              </div><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
                </svg> Updates<span class="badge badge-sm bg-info ms-2">42</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
                </svg> Messages<span class="badge badge-sm bg-success ms-2">42</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-task"></use>
                </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-comment-square"></use>
                </svg> Comments<span class="badge badge-sm bg-warning ms-2">42</span></a>
              <div class="dropdown-header bg-light py-2">
                <div class="fw-semibold">Settings</div>
              </div><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                </svg> Profile</a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                </svg> Settings</a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-credit-card"></use>
                </svg> Payments<span class="badge badge-sm bg-secondary ms-2">42</span></a><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                </svg> Projects<span class="badge badge-sm bg-primary ms-2">42</span></a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
                <svg class="icon me-2">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>

                </svg> Lock Account</a>
              <a class="dropdown-item" href="../logout.php">
                <svg class="icon me-2">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
                </svg> Logout</a>
            </div>
          </li>
        </ul>
      </div>
      <div class="header-divider"></div>
      <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
              <!-- if breadcrumb is single--><span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Dashboard</span></li>
          </ol>
        </nav>
      </div>
    </header>
    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
        <div class="row">