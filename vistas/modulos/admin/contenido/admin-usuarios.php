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
                        <h4 class="mb-sm-0 font-size-18">Administrar Usuarios</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">Usuarios</li>
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
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-rounded" data-bs-toggle="modal" data-bs-target="#nuevoUsuario">Nuevo usuario</button>
                            <h5 class="mt-4">Tabla de usuarios</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100 tabla_usuario">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Foto</th>
                                        <th>Perfil</th>
                                        <th>Estado</th>
                                        <th>Último login</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;

                                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                    foreach ($usuarios as $key => $value) {
                                        echo '<tr>
                                                <td>' . ($key + 1) . '</td>
                                                <td>' . $value["nombre_usuario"] . '</td>
                                                <td>' . $value["correo_usuario"] . '</td>';
                                        if ($value["foto_usuario"] != "") {
                                            echo '<td><img src="' . $value["foto_usuario"] . '" class="rounded  rounded-circle" width="50" alt=""></td>';
                                        } else {
                                            echo '<td><img src="vistas/img/usuarios/default/automatico.png" class="rounded  rounded-circle" width="50" alt=""></td>';
                                        }
                                        echo '<td>' . $value["perfil_usuario"] . '</td>';
                                        if ($value["estado_usuario"] != 0) {
                                            echo '<td><button class="btn btn-success btn-sm btnActivar" idUsuario="' . $value["id_usuario"] . '" estadoUsuario="0">Activado</button></td>';
                                        } else {
                                            echo '<td><button class="btn btn-danger btn-sm btnActivar" idUsuario="' . $value["id_usuario"] . '" estadoUsuario="1">Desactivado</button></td>';
                                        }
                                        echo '<td>' . $value["ultimo_login_usuario"] . '</td>';

                                        echo '<td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-warning  btnEditarUsuario" idUsuario="' . $value["id_usuario"] . '" data-bs-toggle="modal" data-bs-target="#editar_usuario">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger  btnEliminarUsuario" idUsuario="' . $value["id_usuario"] . '" fotoUsuario="' . $value["foto_usuario"] . '" correo="' . $value["correo_usuario"] . '">
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

<div id="nuevoUsuario" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Nuevo usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Nombre completo</label>
                        <input class="form-control" type="text" name="nuevoNombre" placeholder="Nombre completo">
                    </div>
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Correo electrónico</label>
                        <input class="form-control" type="text" name="nuevoCorreo" placeholder="Correo electrónico">
                    </div>
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Contraseña</label>
                        <input class="form-control" type="password" name="nuevoPassword" placeholder="Contraseña">
                    </div>
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Perfil</label>
                        <select class="form-select" name="nuevoPerfil" id="">
                            <option value="">Seleccione</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Ayudante">Ayudante</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="example-text-input" class="form-label">Subir Foto</label>
                        <input class="form-control nuevoFoto" type="file" accept="image/*" capture="camera" name="nuevoFoto">
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/usuarios/default/automatico.png" style="border-radius: 100%;" class="previsualizar" width="150px">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                $nuevoUsuario = new ControladorUsuarios();
                $nuevoUsuario->ctrCrearUsuario();
                ?>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ====================================
MODAL EDITAR USUARIO
==================================== -->

<div id="editar_usuario" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre completo</label>
                        <input type="text" class="form-control" name="editarNombre" id="editarNombre" placeholder="Ingrese su nombre completo">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Dirección de correo electrónico</label>
                        <input type="email" class="form-control" name="editarCorreo" id="editarCorreo" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Contraseña</label>
                        <input type="password" class="form-control" name="editarPassword" id="editarPassword" placeholder="Ingrese la nueva contraseña">
                        <input type="hidden" id="passwordActual" name="passwordActual">
                    </div>

                    <div class="form-group">
                        <label>Perfil</label>
                        <select class="form-select" name="editarPerfil">
                            <option id="editarPerfil"></option>
                            <option value="Administrador">Administrador</option>
                            <option value="Ayudante">Ayudante</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Subir foto</label>
                        <input type="file" accept="image/*" capture="camera" class="form-control nuevaFoto" name="editarFoto">
                        <div class="text-center">
                            <small class="help-block">Peso máximo de la foto 2MB</small><br><br>
                            <img src="vistas/img/usuarios/default/automatico.png" style="border-radius: 100%;" class="previsualizarEditar" width="150px">
                        </div>
                        <input type="hidden" name="fotoActual" id="fotoActual">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                 $editarUsuario = new ControladorUsuarios();
                 $editarUsuario -> ctrEditarUsuario();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- ===========================================
BORRAR USUARIO
=========================================== -->
<?php
$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();
?>