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
                        <h4 class="mb-sm-0 font-size-18">Administrar SEO</h4>
                        <small>Este apartado es de vital importancia, sirve para el pocision la página web en los buscadores</small>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                <li class="breadcrumb-item active">SEO</li>
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

                            
                            $SEO = ControladorSEO::ctrMostrarSEO($item, $valor);

                            $contarRegistroSEO = count($SEO);
                            if($contarRegistroSEO > 0){
                            ?>
                               <button type="button" class="btn btn-primary waves-effect waves-light btn-rounded">Solo se permite un registro</button>
                            <?php
                            }else{
                            ?>
                                <button type="button" class="btn btn-primary waves-effect waves-light btn-rounded" data-bs-toggle="modal" data-bs-target="#nuevoSeo">Nuevos datos de SEO</button>
                            <?php
                            }                           
                            ?>
                            <h5 class="mt-4">Tabla de SEO</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive  w-100 tabla_seo">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Descripción</th>
                                        <th>Palabras clave</th>
                                        <th>Autor</th>
                                        <th>fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    
                                    $seo = ControladorSEO::ctrMostrarSEO($item, $valor);

                                    foreach ($seo as $key => $value) {
                                        echo '<tr>
                                                <td>' . ($key + 1) . '</td>';
                                        echo '<td>' . $value["meta_desc"] . '</td>';
                                        echo '<td>' . $value["meta_palabra_clave"] . '</td>';
                                        echo '<td>' . $value["meta_autor"] . '</td>';
                                        echo '<td>' . $value["fecha"] . '</td>';

                                        echo '<td class="text-center">
                                                        <button type="button" class="btn btn-sm btn-warning  btnEditarSeo" idSeo="' . $value["id_seo"] . '" data-bs-toggle="modal" data-bs-target="#editar_seo">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger  btnEliminarSeo" idSeo="' . $value["id_seo"] . '">
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

<div id="nuevoSeo" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" data-bs-scroll="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Configuración de SEO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Descripcción de la tienda</label>
                        <textarea class="form-control" name="nuevoDescripcionSeo" placeholder="Breve descripción de la tienda" cols="30" rows="10" require></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Palabras claves de la tienda</label>
                        <textarea class="form-control" name="nuevoPalabraClaveSeo" cols="30" rows="10"  placeholder="Ejemplo: Barbería, peluquería, los mejores cortes, pintado, lavado, etc. (Separar por comas)"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nombre del dueño o autor de la tienda</label>
                        <input class="form-control" type="text" name="nuevoNombreAutor" placeholder="Nombre del autor o dueño de la tienda" require>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php

                $nuevoSeo = new ControladorSEO();
                $nuevoSeo->ctrCrearSEO();
                ?>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- ====================================
MODAL EDITAR USUARIO
==================================== -->

<div id="editar_seo" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Editar SEO</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="editarIdSeo" id="editarIdSeo"require>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Descripcción de la tienda</label>
                        <textarea class="form-control" name="editarDescripcionSeo" id="editarDescripcionSeo" cols="30" rows="10"  require></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Palabras claves de la tienda</label>
                        <textarea class="form-control" name="editarPalabraClaveSeo" id="editarPalabraClaveSeo" cols="30" rows="10" require></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="example-text-input" class="form-label">Nombre del dueño o autor de la tienda</label>
                        <input class="form-control" type="text" name="editarNombreAutor" id="editarNombreAutor" require>
                    </div>
            
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
                <?php
                $editarSeo = new ControladorSEO();
                $editarSeo->ctrEditarSEO();
                ?>
            </form>
        </div>
    </div>
</div>

<!-- ===========================================
BORRAR SEO
=========================================== -->
<?php
$borrarSEO = new ControladorSEO();
$borrarSEO->ctrBorrarSEO();
?>