<?php
$empresa 
?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

<?php
$item = null;
$valor = null;
$empresa = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);
foreach($empresa as $key =>$value){
?>
<meta name="title" content="<?php echo $value["nombre"] ?>">
<title><?php echo $value["nombre"] ?></title>
<link rel="shortcut icon" href="<?php echo $value["icono"] ?>" type="image/svg+xml">
<?php
}
?>

<!--  boostrap -->

<link rel="stylesheet" href="vistas/estilosA/bootstrap/css/bootstrap.min.css">
<!-- 
    - custom css link
  -->

<link rel="stylesheet" href="vistas/estilosA/assets/css/main.css">

<!-- 
    - google font link
  -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik:wght@300,400;700&display=swap" rel="stylesheet">

<!-- 
    - flaticon
  -->
<link rel="stylesheet" href="vistas/estilosA/assets/css/flaticon.min.css">

<!-- 
    - preload images
  -->
<link rel="preload" as="image" href="vistas/estilosA/assets/images/hero-banner.jpg">

<link rel="stylesheet" href="vistas/estilosA/alerta/sweetalert2.min.css">
<script src="vistas/estilosA/alerta/sweetalert2.min.js"></script>
<script src="vistas/estilosA/jquery/jquery.min.js"></script>