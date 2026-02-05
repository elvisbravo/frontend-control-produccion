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
                            <th>Estado</th>
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
            <div class="modal-body">
                <form id="formTarea">
                    <input type="hidden" id="tareaIdEdit" value="">

                    <!-- Categoría -->
                    <div class="mb-3">
                        <label for="tareaCategoria" class="form-label">Categoría</label>
                        <select class="form-select" id="tareaCategoria" required>
                            <option value="">Selecciona una categoría</option>
                        </select>
                    </div>

                    <!-- Nombre de la Tarea -->
                    <div class="mb-3">
                        <label for="tareaNombre" class="form-label">Nombre de la Tarea</label>
                        <input type="text" class="form-control" id="tareaNombre" placeholder="Ingresa el nombre" required>
                    </div>

                    <!-- Horas Estimadas -->
                    <div class="mb-3">
                        <label for="tareasHoras" class="form-label">Horas Estimadas</label>
                        <input type="number" class="form-control" id="tareasHoras" placeholder="Ej: 8" min="0.5" step="0.5" required>
                    </div>

                    <!-- Estado -->
                    <div class="mb-3">
                        <label for="tareaEstado" class="form-label">Estado</label>
                        <select class="form-select" id="tareaEstado" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="En Progreso">En Progreso</option>
                            <option value="Completada">Completada</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-theme" id="btnGuardarTarea">Guardar</button>
            </div>
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
            <div class="modal-body">
                <form id="formCategoria">
                    <input type="hidden" id="categoriaIdEdit" value="">

                    <!-- Nombre de Categoría -->
                    <div class="mb-3">
                        <label for="categoriaNombre" class="form-label">Nombre de la Categoría</label>
                        <input type="text" class="form-control" id="categoriaNombre" placeholder="Ej: Desarrollo, Testing, etc." required>
                    </div>

                    <!-- Color de Categoría -->
                    <div class="mb-3">
                        <label for="categoriaColor" class="form-label">Color</label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color" id="categoriaColor" value="#007bff" required>
                            <span class="input-group-text" id="colorPreview" style="background-color: #007bff;"></span>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-theme" id="btnGuardarCategoria">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script defer src="js/tareas/tareas.js"></script>
<?= $this->endSection() ?>