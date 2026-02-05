<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Seguridad</h5>
            <p class="text-secondary small">Usuarios</p>
        </div>
    </div>
</div>


<div class="container mt-3" id="main-content">

    <div class="card adminuiux-card mb-4">
        <div class="card-header">
            <div class="row gx-3 gx-lg-4 align-items-center">
                <div class="col">
                    <p class="h6">Usuarios</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-theme" id="btnAdd"><i class="bi bi-person-plus vm me-2"></i> Nuevo</button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="usuariosTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tipo Documento</th>
                            <th>Documento</th>
                            <th>Nombre Completo</th>
                            <th>Celular</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTable cargará aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal para agregar/editar usuario -->
<div class="modal fade" id="modalAgregarEditarUsuario" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formUsuario">
                <div class="modal-body">

                    <input type="hidden" id="usuarioIdEdit" value="">

                    <!-- Fila 1: Tipo de Documento y Número de Documento -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="tipoDocumento" class="form-label">Tipo de Documento</label>
                                <select class="form-select" id="tipoDocumento" required>
                                    <option value="DNI">D.N.I.</option>
                                    <option value="CARNET">Carné de Extranjería</option>
                                    <option value="PASAPORTE">Pasaporte</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="numeroDocumento" class="form-label">Número de Documento</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="numeroDocumento" placeholder="Ingresa el número" required>
                                    <button class="btn btn-outline-secondary" type="button" id="btnBuscarDocumento">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fila 2: Nombres y Apellidos -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" placeholder="Ingresa los nombres" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" placeholder="Ingresa los apellidos" required>
                            </div>
                        </div>
                    </div>

                    <!-- Fila 3: Fecha de Nacimiento y Carrera -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" id="fechaNacimiento" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="celular" class="form-label">Número de Celular</label>
                                <input type="tel" class="form-control" id="celular" placeholder="51987456321" pattern="[0-9]{9}" required>
                            </div>
                        </div>

                    </div>

                    <!-- Fila 6: Dirección -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="direccion" id="direccion">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Rol</label>
                                <select name="rol_id" id="rol_id" class="form-control">
                                    <option value="">Seleccione...</option>
                                    <option value="2">ADMINISTRADOR</option>
                                    <option value="3">JEFE DE PRODUCCION</option>
                                    <option value="4">AUXILIAR</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Fila 7: Correo -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" placeholder="usuario@example.com" required>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-theme" id="btnGuardarUsuario">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script defer src="js/usuarios/usuario.js"></script>
<?= $this->endSection() ?>