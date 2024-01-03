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
                        <h4 class="mb-sm-0 font-size-18">Administrar Reservas</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">Reserva</li>
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
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-rounded" data-bs-toggle="modal" data-bs-target="#newReserva">Nuevo reserva</button>
                            <h5 class="mt-4">Tabla de Reserva</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive w-100 tabla_reserva">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>correo</th>
                                        <th>Teléfono</th>
                                        <th>Servicio</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Mensaje</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;

                                    $reserva = ControladorReserva::ctrMostrarReserva($item, $valor);

                                    foreach ($reserva as $key => $value) {
                                        echo '<tr>
                                                <td>' . ($key + 1) . '</td>';
                                          echo '<td>' . $value["nombre"] . '</td>';
                                          echo '<td>' . $value["correo"] . '</td>';
                                          echo '<td>' . $value["telefono"] . '</td>';
                                          echo '<td>' . $value["titulop"] . '</td>';
                                          echo '<td>' . $value["fecha"] . '</td>';
                                          echo '<td>' . $value["hora"] . '</td>';
                                          echo '<td>' . $value["mensaje"] . '</td>';

                                          echo '<td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-warning  btnEditarReserva" idReserva="' . $value["id_reserva"] . '" data-bs-toggle="modal" data-bs-target="#editar_reserva">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger  btnEliminarReserva" idReserva="' . $value["id_reserva"] . '"">
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
MODAL NUEVO PRECIO
==================================== -->

<div id="newReserva" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Nuevo Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Ingrese nombre</label>
                        <input class="form-control" type="text" name="nuevoNombreR" placeholder="Ingrese nombre" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Ingrese correo</label>
                        <input class="form-control" type="text" name="nuevoCorreoR" placeholder="Ingrese correo" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Ingrese teléfono</label>
                        <input class="form-control" type="text" name="nuevoTelefonoR" placeholder="Ingrese teléfono" require>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Selecciona el servicio</label>
                        <select class="form-select" name="nuevoPrecioR" id="">
                            <option value="">Selecciona el servicio</option>
                            <?php
                            $item = null;
                            $valor = null;
                            $precioSelect = ControladorPrecio::ctrMostrarPrecio($item, $valor);
                            foreach ($precioSelect as $key => $value) {
                                echo '<option value="' . $value["id_precio"] . '">' . $value["titulop"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Ingrese la fecha</label>
                        <input class="form-control" type="date" name="nuevoFechaR" require>
                    </div>        
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Ingrese Hora</label>
                        <input class="form-control" type="time" name="nuevoHoraR" min="8:00" max="5:00" require>
                    </div>        
                    <div class="mb-3">
                        <label for="Descripcion">Mensaje</label>
                        <textarea name="nuevoMensajeR" cols="30" rows="10" class="form-control" placeholder="Ingrese el mensaje" require></textarea>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php

                $nuevoReserva = new ControladorReserva();
                $nuevoReserva->ctrCrearReserva();
                ?>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ====================================
MODAL EDITAR PRECIO
==================================== -->

<div id="editar_reserva" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar Servicio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input class="form-control" type="text" name="editarIdReserva" id="editarIdReserva" require>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nombre</label>
                        <input class="form-control" type="text" name="editarNombreR" id="editarNombreR" require>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Correo</label>
                        <input class="form-control" type="text" name="editarCorreoR" id="editarCorreoR" require>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Teléfono</label>
                        <input class="form-control" type="text" name="editarTelefonoR" id="editarTelefonoR" require>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1">Selecciona el servicio</label>
                        <select class="form-select" name="editarReserva">
                            <option value="" id="editarReserva"></option>
                            <?php
                            $item = null;
                            $valor = null;
                            $precioSelect = ControladorPrecio::ctrMostrarPrecio($item, $valor);
                            foreach ($precioSelect as $key => $value) {
                                echo '<option value="' . $value["id_precio"] . '">' . $value["titulop"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Fecha</label>
                        <input class="form-control" type="date" name="editarFechaR" id="editarFechaR" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Hora</label>
                        <input class="form-control" type="time" name="editarHoraR" id="editarHoraR" require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Mensaje</label>
                        <textarea class="form-control" name="editarMensajeR" id="editarMensajeR" cols="30" rows="10"></textarea>
                    </div>
               
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php

                $editarReserva = new ControladorReserva();
                $editarReserva->ctrEditarReserva();

                ?>
            </form>
        </div>
    </div>
</div>

<!-- ===========================================
BORRAR SERVICIO
=========================================== -->
<?php


$borrarReserva = new ControladorReserva();
$borrarReserva->ctrBorrarReserva();

}else{
    echo '<script>
        window.location = "admin-inicio";
    </script>';
    return;
}
?>