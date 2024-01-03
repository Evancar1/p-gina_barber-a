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
                        <h4 class="mb-sm-0 font-size-18">Administrar Galeria</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">Galería</li>
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
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-rounded" data-bs-toggle="modal" data-bs-target="#newGaleria">Nuevo Galería</button>
                            <h5 class="mt-4">Tabla de Galería</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive w-100 tabla_galeria">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Código</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;

                                    $galeria = ControladorGaleria::ctrMostrarGaleria($item, $valor);

                                    foreach ($galeria as $key => $value) {
                                        echo '<tr>
                                                <td>' . ($key + 1) . '</td>';
                                          echo '<td>' . $value["codigo"] . '</td>';

                                         if($value["imagen"] != "") {
                                          echo '<td class="text-center" ><img src="' . $value["imagen"] . '" style="border-radius: 5px;" width="150" alt=""></td>';
                                        } else {
                                            echo '<td class="text-center" ><img src="vistas/img/galeria/default/default.jpg" class="rounded  rounded-circle" width="100" alt=""></td>';
                                        }

                                          echo '<td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-warning  btnEditarGaleria" idGaleria="' . $value["id"] . '" data-bs-toggle="modal" data-bs-target="#editar_galeria">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger  btnEliminarGaleria" idGaleria="' . $value["id"] . '" imagen="' . $value["imagen"] . '" codigo="' . $value["codigo"] . '">
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


<!-- ====================================
MODAL NUEVO GALERIA
==================================== -->

<div id="newGaleria" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Nuevo Precio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <?php
                            $item = null;
                            $valor = null;
                            $codigoG = ControladorGaleria::ctrMostrarGaleria($item, $valor);
                            $contador = count($codigoG);
                            $ultimoDato = end($codigoG);
                            if($contador == 0){
                                echo '<label for="codigo">Ingrese el código:</label><small>(A001)</small>';
                            }else{
                                foreach($codigoG as $key => $value){
                                    if($ultimoDato == $value) {
                                        echo '<label for="codigo">Ingrese el código que sigue a:  </label>  <small class="bg-success" style="border-radius:2px 2px; color: white;">   ('.$value["codigo"].')</small>';

                                    }
                                }    
                            }
                            ?>
                        <input class="form-control" type="text" name="nuevoCodigoG" placeholder="A001, A002, A003, ..." require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Subir foto de Precio</label>
                        <input class="form-control nuevoFotoG" type="file" name="nuevoFotoG" accept="image/*" capture="camera" require>
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/galeria/default/default.png" class="previsualizarG" width="200px" style="border-radius: 5px;">
                        </div>
                    </div>                 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                $nuevoGaleria = new ControladorGaleria();
                $nuevoGaleria->ctrCrearGaleria();
                ?>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ====================================
MODAL EDITAR GALERIA
==================================== -->

<div id="editar_galeria" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar Galeria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input class="form-control" type="text" name="editarIdGaleria" id="editarIdGaleria" require>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="editarCodigoG" id="editarCodigoG" require>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Foto de Precio</label>
                        <input type="file" class="form-control EditarFotoG" name="editarFotoG" accept="image/*" capture="camera">
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/galeria/default/default.png" class="previsualizarEditarG" width="200px" style="border-radius: 5px;">
                        </div>
                        <input type="hidden" name="fotoActualP" id="fotoActualG">
                    </div>
               
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php

                $editarGaleria = new ControladorGaleria();
                $editarGaleria->ctrEditarGaleria();

                ?>
            </form>
        </div>
    </div>
</div>

<!-- ===========================================
BORRAR GALERIA
=========================================== -->
<?php

$borrarGaleria = new ControladorGaleria();
$borrarGaleria->ctrBorrarGaleria();

}else{
    echo '<script>
        window.location = "admin-inicio";
    </script>';
    return;
}
?>