<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Seguridad</h5>
            <p class="text-secondary small">Permisoss</p>
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
                    <div class="roles-list">
                        <!-- Rol 1 -->
                        <div class="role-item p-3 border-bottom">
                            <div class="row align-items-center gx-0">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input rol-radio" type="radio" name="rolSeleccionado" id="rol_1" value="1" data-rol-name="Administrador">
                                        <label class="form-check-label" for="rol_1">
                                            Administrador
                                        </label>
                                    </div>
                                </div>
                                <div class="col ms-auto text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-link btn-sm no-caret p-0" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item btn-editar-rol" href="javascript:void(0)" data-rol-id="1">Editar</a></li>
                                            <li><a class="dropdown-item text-danger btn-eliminar-rol" href="javascript:void(0)" data-rol-id="1">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rol 2 -->
                        <div class="role-item p-3 border-bottom">
                            <div class="row align-items-center gx-0">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input rol-radio" type="radio" name="rolSeleccionado" id="rol_2" value="2" data-rol-name="Supervisor">
                                        <label class="form-check-label" for="rol_2">
                                            Supervisor
                                        </label>
                                    </div>
                                </div>
                                <div class="col ms-auto text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-link btn-sm no-caret p-0" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item btn-editar-rol" href="javascript:void(0)" data-rol-id="2">Editar</a></li>
                                            <li><a class="dropdown-item text-danger btn-eliminar-rol" href="javascript:void(0)" data-rol-id="2">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rol 3 -->
                        <div class="role-item p-3 border-bottom">
                            <div class="row align-items-center gx-0">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input rol-radio" type="radio" name="rolSeleccionado" id="rol_3" value="3" data-rol-name="Vendedor">
                                        <label class="form-check-label" for="rol_3">
                                            Vendedor
                                        </label>
                                    </div>
                                </div>
                                <div class="col ms-auto text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-link btn-sm no-caret p-0" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item btn-editar-rol" href="javascript:void(0)" data-rol-id="3">Editar</a></li>
                                            <li><a class="dropdown-item text-danger btn-eliminar-rol" href="javascript:void(0)" data-rol-id="3">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rol 4 -->
                        <div class="role-item p-3">
                            <div class="row align-items-center gx-0">
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input rol-radio" type="radio" name="rolSeleccionado" id="rol_4" value="4" data-rol-name="Usuario">
                                        <label class="form-check-label" for="rol_4">
                                            Usuario
                                        </label>
                                    </div>
                                </div>
                                <div class="col ms-auto text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-link btn-sm no-caret p-0" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item btn-editar-rol" href="javascript:void(0)" data-rol-id="4">Editar</a></li>
                                            <li><a class="dropdown-item text-danger btn-eliminar-rol" href="javascript:void(0)" data-rol-id="4">Eliminar</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                                </h6>
                            </div>
                            <div class="submodulos-list ps-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_dashboard_ver" value="dashboard_ver">
                                    <label class="form-check-label" for="perm_dashboard_ver">
                                        Ver Dashboard
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_dashboard_exportar" value="dashboard_exportar">
                                    <label class="form-check-label" for="perm_dashboard_exportar">
                                        Exportar Reportes
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Módulo: Clientes -->
                        <div class="modulo-item mb-4">
                            <div class="modulo-header mb-3">
                                <h6 class="mb-0">
                                    <i class="bi bi-people me-2"></i>Clientes
                                </h6>
                            </div>
                            <div class="submodulos-list ps-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_clientes_ver" value="clientes_ver">
                                    <label class="form-check-label" for="perm_clientes_ver">
                                        Ver Clientes
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_clientes_crear" value="clientes_crear">
                                    <label class="form-check-label" for="perm_clientes_crear">
                                        Crear Clientes
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_clientes_editar" value="clientes_editar">
                                    <label class="form-check-label" for="perm_clientes_editar">
                                        Editar Clientes
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_clientes_eliminar" value="clientes_eliminar">
                                    <label class="form-check-label" for="perm_clientes_eliminar">
                                        Eliminar Clientes
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Módulo: Ventas -->
                        <div class="modulo-item mb-4">
                            <div class="modulo-header mb-3">
                                <h6 class="mb-0">
                                    <i class="bi bi-cart me-2"></i>Ventas
                                </h6>
                            </div>
                            <div class="submodulos-list ps-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_ventas_ver" value="ventas_ver">
                                    <label class="form-check-label" for="perm_ventas_ver">
                                        Ver Ventas
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_ventas_crear" value="ventas_crear">
                                    <label class="form-check-label" for="perm_ventas_crear">
                                        Crear Venta
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_ventas_aprobar" value="ventas_aprobar">
                                    <label class="form-check-label" for="perm_ventas_aprobar">
                                        Aprobar Ventas
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

                        <!-- Módulo: Configuración -->
                        <div class="modulo-item mb-4">
                            <div class="modulo-header mb-3">
                                <h6 class="mb-0">
                                    <i class="bi bi-gear me-2"></i>Configuración
                                </h6>
                            </div>
                            <div class="submodulos-list ps-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_config_ver" value="config_ver">
                                    <label class="form-check-label" for="perm_config_ver">
                                        Ver Configuración
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_config_editar" value="config_editar">
                                    <label class="form-check-label" for="perm_config_editar">
                                        Editar Configuración
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="perm_config_usuarios" value="config_usuarios">
                                    <label class="form-check-label" for="perm_config_usuarios">
                                        Gestionar Usuarios
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




<!-- Modal para agregar/editar rol -->
<div class="modal fade" id="modalAgregarEditarRol" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Agregar Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formRol">
                    <input type="hidden" id="rolIdEdit" value="">
                    <div class="mb-3">
                        <label for="nombreRol" class="form-label">Nombre del Rol</label>
                        <input type="text" class="form-control" id="nombreRol" placeholder="Ej: Supervisor" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcionRol" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcionRol" rows="3" placeholder="Describe los permisos generales del rol"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-theme" id="btnGuardarRol">Guardar</button>
            </div>
        </div>
    </div>
</div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script defer src="js/permisos/permisos.js"></script>
<?= $this->endSection() ?>