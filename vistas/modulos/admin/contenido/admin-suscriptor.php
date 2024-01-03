<?php
if ($_SESSION["perfil_usuario"] == "Ayudante" || $_SESSION["perfil_usuario"] == "Administrador") {
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Administrar Suscriptores</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">Suscriptor</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mt-4">Tabla de suscriptores</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive w-100 tabla_suscriptor">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;

                                    $suscriptor = ControladorSuscriptor::ctrMostrarSuscriptor($item, $valor);

                                    foreach ($suscriptor as $key => $value) {
                                        echo '<tr>
                                                <td>' . ($key + 1) . '</td>';
                                          echo '<td>' . $value["correo"] . '</td>';

                                          echo '<td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-danger  btnEliminarSuscriptor" idSuscriptor="' . $value["id"] . '">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>';
                                        echo '</tr>';
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end cardaa -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Minia.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by <a href="#!" class="text-decoration-underline">Themesbrand</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>


<!-- ===========================================
BORRAR SUSCRIPTOR
=========================================== -->
<?php


$borrarSuscriptor = new ControladorSuscriptor();
$borrarSuscriptor->ctrBorrarSuscriptor();

}else{
    echo '<script>
        window.location = "admin-inicio";
    </script>';
    return;
}
?>