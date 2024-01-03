<!doctype html>
<html lang="es">


<head>

    <meta charset="utf-8" />
    
    <?php
    $item = null;
    $valor = null;
    $empresa = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);
    foreach($empresa as $key =>$value){
    ?>
    <meta name="title" content="<?php echo $value["nombre"] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $value["nombre"] ?></title>
    <link rel="shortcut icon" href="<?php echo $value["icono"] ?>">
    <?php
    }
    ?>

    <?php
    $item = null;
    $valor = null;

    $seo = ControladorSEO::ctrMostrarSEO($item, $valor);
    foreach($seo as $key => $value){
    ?>
    <meta name="autor" content="<?php echo $value["meta_autor"] ?>">
    <meta name="description" content="<?php echo $value["meta_desc"] ?>">
    <meta name="keywords" content="<?php echo $value["meta_palabra_clave"] ?>"/>
    <meta name="robots" content="index,nofollow" />
    <meta name="robots" content="index,follow" />
    <meta name="robots" content="noindex,nofollow" />
    <?php
    }
    ?>

    <!-- App favicon -->

    <!-- plugin css -->
    <link href="vistas/estilosB/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link rel="stylesheet" href="vistas/estilosB/alerta/sweetalert2.min.css">

    <!-- DataTables -->
    <link href="vistas/estilosB/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="vistas/estilosB/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="vistas/estilosB/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- preloader css -->
    <link rel="stylesheet" href="vistas/estilosB/assets/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="vistas/estilosB/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="vistas/estilosB/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="vistas/estilosB/assets/css/estilos.css" id="app-style" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="vistas/estilosB/chart.js/Chart.min.css">

    <script src="vistas/estilosB/alerta/sweetalert2.min.js"></script>



</head>

<body>