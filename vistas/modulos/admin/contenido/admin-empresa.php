<?php
if ($_SESSION["perfil_usuario"] == "Ayudante") {
    echo '<script>
        window.location = "admin-inicio";
    </script>';
    return;
}
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Administrar Empresa</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">Empresa</li>
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
                            <?php
                            $item = null;
                            $valor = null;

                            
                            $empresa = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);

                            $contarRegistroE = count($empresa);
                            if($contarRegistroE > 0){
                            ?>
                               <button type="button" class="btn btn-primary waves-effect waves-light btn-rounded">Solo se permite un registro</button>
                            <?php
                            }else{
                            ?>
                                <button type="button" class="btn btn-primary waves-effect waves-light btn-rounded" data-bs-toggle="modal" data-bs-target="#nuevoEmpresa">Nuevos datos de la empresa</button>
                            <?php
                            }                           
                            ?>
                            <h5 class="mt-4">Tabla de Empresa</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 tabla_empresa">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Icono</th>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Horario</th>
                                        <th>Correo</th>
                                        <th>Facebook</th>
                                        <th>Youtube</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;

                                    
                                    $empresa = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);
                                    foreach ($empresa as $key => $value) {
                                        echo '<tr>
                                                <td>' . ($key + 1) . '</td>';
                                        if ($value["icono"] != "") {
                                            echo '<td><img src="' . $value["icono"] . '" class="rounded  rounded-circle" width="50" alt=""></td>';
                                        } else {
                                            echo '<td><img src="vistas/img/usuarios/default/automatico.png" class="rounded  rounded-circle" width="50" alt=""></td>';
                                        }
                                        echo '<td>' . $value["nombre"] . '</td>';
                                        echo '<td>' . $value["telefono"] . '</td>';
                                        echo '<td>' . $value["direccion"] . '</td>';
                                        echo '<td>' . $value["horario"] . '</td>';
                                        echo '<td>' . $value["correo"] . '</td>';
                                        echo '<td>' . $value["link_facebook"] . '</td>';
                                        echo '<td>' . $value["link_youtube"] . '</td>';
                                        

                                        echo '<td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-warning  btnEditarEmpresa" idEmpresa="' . $value["id"] . '" data-bs-toggle="modal" data-bs-target="#editar_empresa">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger  btnEliminarEmpresa" idEmpresa="' . $value["id"] . '" fotoEmpresa="' . $value["icono"] . '" nombre="' . $value["nombre"] . '">
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
MODAL NUEVO USUARIO
==================================== -->

<div id="nuevoEmpresa" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Configuración de empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Subir foto de Icono de empresa o tienda</label>
                        <input class="form-control nuevoFotoE" type="file" accept="image/*" capture="camera" name="nuevoFotoE" require>
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/empresa/default/icono.png" class="previsualizarE" width="40px">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nombre empresa o tienda</label>
                        <input class="form-control" type="text" name="nuevoNombreE" placeholder="Nombre de la empresa o tienda" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Telefono de la tienda o empresa</label>
                        <input class="form-control" type="text" name="nuevoTelefonoE" placeholder="Telefono de la empresa o tienda" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Dirección de la empresa o tienda</label>
                        <input class="form-control" type="text" name="nuevoDireccionE" placeholder="Ejemplo: 7528 Roberts Ave. Palm Bay, FL 32907" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Horario de la empresa o tienda</label>
                        <input class="form-control" type="text" name="nuevoHorarioE" placeholder="Ejemplo: Horario de atención: Domingo - Viernes, 08 am - 09 pm" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Correo de la empresa o tienda</label>
                        <input class="form-control" type="text" name="nuevoCorreoE" placeholder="Correo electrónico" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Link de Facebook de la empresa o tienda</label>
                        <input class="form-control" type="text" name="nuevoLinkFacebookE" placeholder="https://web.facebook.com/">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Link de Youtube de la empresa o tienda</label>
                        <input class="form-control" type="text" name="nuevoLinkYoutubeE" placeholder="https://www.youtube.com/">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                $nuevoEmpresa = new ControladorEmpresa();
                $nuevoEmpresa->ctrCrearEmpresa();
                ?>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ====================================
MODAL EDITAR USUARIO
==================================== -->

<div id="editar_empresa" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input class="form-control" type="hidden" name="editarIdEmpresa" id="editarIdEmpresa" require>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto de icono de empresa</label>
                        <input type="file" class="form-control EditarFotoE" name="editarFotoE" accept="image/*" capture="camera">
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/usuarios/default/automatico.png" style="border-radius: 100%;" class="previsualizarEditarE" width="40px">
                        </div>
                        <input type="hidden" name="fotoActualE" id="fotoActualE">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nombre empresa o tienda</label>
                        <input class="form-control" type="text" name="editarNombreE" id="editarNombreE" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Telefono de la tienda o empresa</label>
                        <input class="form-control" type="text" name="editarTelefonoE" id="editarTelefonoE" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Dirección de la empresa o tienda</label>
                        <input class="form-control" type="text" name="editarDireccionE" id="editarDireccionE" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Horario de la empresa o tienda</label>
                        <input class="form-control" type="text" name="editarHorarioE" id="editarHorarioE" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Correo de la empresa o tienda</label>
                        <input class="form-control" type="text" name="editarCorreoE" id="editarCorreoE" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Link de Facebook de la empresa o tienda</label>
                        <input class="form-control" type="text" name="editarLinkFacebookE" id="editarLinkFacebookE">
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Link de Youtube de la empresa o tienda</label>
                        <input class="form-control" type="text" name="editarLinkYoutubeE" id="editarLinkYoutubeE">
                    </div>                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                $editarEmpresa = new ControladorEmpresa();
                $editarEmpresa->ctrEditarEmpresa();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- ===========================================
BORRAR USUARIO
=========================================== -->
<?php
$borrarEmpresa = new ControladorEmpresa();
$borrarEmpresa->ctrBorrarEmpresa();
?>