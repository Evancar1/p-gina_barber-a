<!-- Usuario -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <?php
    $item = null;
    $valor = null;

    $contarUsuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
    if (count($contarUsuario) <= 0) {
    ?>
      <form method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <div class="text-center">
              <h3 class="modal-title" id="exampleModalLabel">Registrarse</h3>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- entrada del nombre -->
            <div class="form-group">
              <input style="font-size: 15px;" type="text" name="nuevoNombre" class="form-control input-field" placeholder="Ingrese su nombre completo" required>
            </div>
            <!-- entrada de correo -->
            <div class="form-group">
              <input style="font-size: 15px;" type="email" name="nuevoCorreo" class="form-control input-field" placeholder="Ingrese su correo" required>
            </div>
            <!-- entrada de contraseña -->
            <div class="form-group">
              <input style="font-size: 15px;" type="password" name="nuevoPassword" class="form-control input-field" placeholder="Ingrese su contraseña" required>
            </div>
            <!-- entrada de perfil -->
            <div class="form-group">
              <select style="font-size: 15px;" class="form-select input-field" name="nuevoPerfil" id="nuevoPerfil" required>
                <option>Seleccione perfil</option>
                <option value="Administrador">Administrador</option>
              </select>
            </div>
            <!-- entrada de foto -->
            <div class="form-group text-center">
              <div class="panel">SUBIR FOTO</div>
              <input style="font-size: 15px;" type="file" class="form-control input-field nuevoFoto" name="nuevoFoto">
              <small>Peso maximo de la foto 2MB</small><br>
              <img src="vistas/img/usuarios/default/auto.png" style="border-radius: 100%;" class="previsualizarL text-center" width="100px" alt=""  >
                        
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </div>
        <?php
        $crearUsuario = new ControladorUsuarios();
        $crearUsuario->ctrCrearUsuario();
        ?>
      </form>
    <?php
    } else {
    ?>
      <form action="#" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <div class="text-center">
              <h3 class="modal-title" id="exampleModalLabel">Login</h3>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input style="font-size: 15px;" type="text" name="ingresarCorreo" class="form-control input-field" placeholder="Ingrese el usuario" required>
            </div>
            <div class="form-group">
              <input style="font-size: 15px;" type="password" name="ingresarPassword" class="form-control input-field" placeholder="Ingrese la contraseña" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
            <button type="submit" class="btn btn-primary">Ingresar</button>
          </div>
        </div>
        <?php
        $login = new ControladorUsuarios();
        $login->ctrIngresoUsuario();
        ?>
      </form>
    <?php
    }
    ?>
  </div>
</div>