<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Mantenimiento</h5>
            <p class="text-secondary small">Tareas</p>
        </div>
    </div>
</div>


<div class="container mt-3" id="main-content">

    <div class="card adminuiux-card mb-4">
        <div class="card-header">
            <div class="row gx-3 gx-lg-4 align-items-center">
                <div class="col">
                    <p class="h6">Tareas</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-theme" id="btnAdd"><i class="bi bi-person-plus vm me-2"></i> Nuevo</button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tareasTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Categoría</th>
                            <th>Nombre de la Tarea</th>
                            <th>Horas Estimadas</th>
                            <th>Roles</th>
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

    <!-- Card de Categorías -->
    <div class="card adminuiux-card mb-4">
        <div class="card-header">
            <div class="row gx-3 gx-lg-4 align-items-center">
                <div class="col">
                    <p class="h6">Categorías</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-theme btn-sm" id="btnAddCategoria"><i class="bi bi-plus-circle vm me-2"></i> Nuevo</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row" id="categoriasContainer">
                <!-- Las categorías se cargarán aquí -->
            </div>
        </div>
    </div>

</div>

<!-- Modal para agregar/editar tarea -->
<div class="modal fade" id="modalAgregarEditarTarea" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTareaTitle">Agregar Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formTarea">
                <div class="modal-body">

                    <input type="hidden" id="tareaId" name="tareaId" value="0">

                    <!-- Categoría -->
                    <div class="mb-3">
                        <label for="tareaCategoria" class="form-label">Categoría</label>
                        <select class="form-select" id="tareaCategoria" name="tareaCategoria" required>
                        </select>
                    </div>

                    <!-- Nombre de la Tarea -->
                    <div class="mb-3">
                        <label for="tareaNombre" class="form-label">Nombre de la Tarea</label>
                        <input type="text" class="form-control" id="tareaNombre" name="tareaNombre" placeholder="Ingresa el nombre" required>
                    </div>

                    <!-- Horas Estimadas -->
                    <div class="mb-3">
                        <label for="tareasHoras" class="form-label">Horas Estimadas</label>
                        <input type="text" class="form-control" id="tareasHoras" name="tareasHoras" placeholder="Ej: 8:00" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Roles</label>
                        <div class="input-group mb-2">
                            <select class="form-select" id="selectRolNuevo">
                                <option value="">Seleccionar Rol...</option>
                                <?php foreach ($roles as $rol) : ?>
                                    <option value="<?= $rol['id'] ?>" data-nombre="<?= $rol['nombre'] ?>"><?= $rol['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="input-group-text">
                                <input class="form-check-input mt-0 me-2" type="checkbox" id="checkPrimaria" value="1">
                                <span class="small">Es Primaria</span>
                            </div>
                            <button class="btn btn-outline-theme" type="button" id="btnAddRolToList">
                                <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>

                        <div id="rolesListContainer" class="list-group list-group-flush border rounded p-2" style="min-height: 50px; max-height: 200px; overflow-y: auto; background-color: var(--adminuiux-card-bg);">
                            <!-- Los roles agregados aparecerán aquí -->
                            <p class="text-muted small mb-0 text-center py-2" id="noRolesMsg">No hay roles agregados</p>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-theme" id="btnGuardarTarea">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para agregar/editar categoría -->
<div class="modal fade" id="modalAgregarEditarCategoria" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCategoriaTitle">Agregar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formCategoria">
                <div class="modal-body">

                    <input type="hidden" id="categoriaId" name="categoriaId" value="">

                    <!-- Nombre de Categoría -->
                    <div class="mb-3">
                        <label for="categoriaNombre" class="form-label">Nombre de la Categoría</label>
                        <input type="text" class="form-control" id="categoriaNombre" name="categoriaNombre" placeholder="Ej: Desarrollo, Testing, etc." required>
                    </div>

                    <!-- Color de Categoría -->
                    <div class="mb-3">
                        <label for="categoriaColor" class="form-label">Color</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="categoriaColor" name="categoriaColor" value="#007bff" required>
                            <span class="input-group-text" id="colorPreview" style="background-color: #007bff;"></span>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-theme" id="btnGuardarCategoria">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script defer src="js/tareas/tareas.js"></script>
<?= $this->endSection() ?>