<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Recursos Humanos</h5>
            <p class="text-secondary small">Solicitud de Permisos</p>
        </div>
    </div>
</div>

<div class="container mt-3" id="main-content">

    <div class="row">
        <div class="col-md-4">
            <div class="card adminuiux-card mb-4">
                <div class="card-header">
                    <div class="row gx-3 gx-lg-4 align-items-center">
                        <div class="col">
                            <p class="h6">Roles</p>
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-theme" id="btnAdd"><i class="bi bi-person-plus vm me-2"></i> Nuevo</button>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <!-- Lista de roles -->
                    <div class="roles-list" id="roles-list">

                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card adminuiux-card mb-4">
                <div class="card-header">
                    <div class="row gx-3 gx-lg-4 align-items-center">
                        <div class="col">
                            <p class="h6">Permisos asignar</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Módulos y Permisos -->
                    <div id="permisosContainer" class="modulos-list">
                        <p class="text-secondary mb-4">Selecciona un rol para editar sus permisos</p>

                        <!-- Módulo: Dashboard -->
                        <div class="modulo-item mb-4">
                            <div class="modulo-header mb-3">
                                <h6 class="mb-0">
                                    <i class="bi bi-speedometer2 me-2"></i>Gestion de clientes
                                </h6>
                            </div>
                            <div class="submodulos-list ps-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_dashboard_ver" value="dashboard_ver">
                                    <label class="form-check-label" for="perm_dashboard_ver">
                                        Prospectos/potenciales
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_dashboard_exportar" value="dashboard_exportar">
                                    <label class="form-check-label" for="perm_dashboard_exportar">
                                        Trabajos
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Módulo: Clientes -->
                        <div class="modulo-item mb-4">
                            <div class="modulo-header mb-3">
                                <h6 class="mb-0">
                                    <i class="bi bi-people me-2"></i>Mantenimiento
                                </h6>
                            </div>
                            <div class="submodulos-list ps-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_clientes_ver" value="clientes_ver">
                                    <label class="form-check-label" for="perm_clientes_ver">
                                        Tareas
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_clientes_crear" value="clientes_crear">
                                    <label class="form-check-label" for="perm_clientes_crear">
                                        Universidad/instituto
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_clientes_editar" value="clientes_editar">
                                    <label class="form-check-label" for="perm_clientes_editar">
                                        Carreras
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_clientes_eliminar" value="clientes_eliminar">
                                    <label class="form-check-label" for="perm_clientes_eliminar">
                                        Feriados
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Módulo: Ventas -->
                        <div class="modulo-item mb-4">
                            <div class="modulo-header mb-3">
                                <h6 class="mb-0">
                                    <i class="bi bi-cart me-2"></i>Seguridad
                                </h6>
                            </div>
                            <div class="submodulos-list ps-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_ventas_ver" value="ventas_ver">
                                    <label class="form-check-label" for="perm_ventas_ver">
                                        Usuarios
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_ventas_crear" value="ventas_crear">
                                    <label class="form-check-label" for="perm_ventas_crear">
                                        Permisos
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_ventas_aprobar" value="ventas_aprobar">
                                    <label class="form-check-label" for="perm_ventas_aprobar">
                                        Modulos
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Módulo: Reportes -->
                        <div class="modulo-item mb-4">
                            <div class="modulo-header mb-3">
                                <h6 class="mb-0">
                                    <i class="bi bi-file-text me-2"></i>Reportes
                                </h6>
                            </div>
                            <div class="submodulos-list ps-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_reportes_ver" value="reportes_ver">
                                    <label class="form-check-label" for="perm_reportes_ver">
                                        Ver Reportes
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_reportes_generar" value="reportes_generar">
                                    <label class="form-check-label" for="perm_reportes_generar">
                                        Generar Reportes
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_reportes_exportar" value="reportes_exportar">
                                    <label class="form-check-label" for="perm_reportes_exportar">
                                        Exportar Reportes
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Botón Guardar -->
                    <div class="mt-4 pt-4 border-top">
                        <button type="button" class="btn btn-theme" id="btnGuardarPermisos">
                            <i class="bi bi-check-circle me-2"></i> Guardar Permisos
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal para agregar/editar rol -->
<div class="modal fade" id="modalAgregarEditarRol" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Agregar Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formRol">
                <div class="modal-body">

                    <input type="hidden" id="rolId" name="rolId" value="0">
                    <div class="mb-3">
                        <label for="nombreRol" class="form-label">Nombre del Rol</label>
                        <input type="text" class="form-control" id="nombreRol" name="nombreRol" placeholder="Ej: Supervisor" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-theme" id="btnGuardarRol">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script defer src="js/permisos/permisos.js"></script>
<?= $this->endSection() ?>