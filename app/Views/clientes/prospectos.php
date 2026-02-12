<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Clientes</h5>
            <p class="text-secondary small">Prospectos</p>
        </div>
    </div>
</div>


<div class="container mt-3" id="main-content">

    <div class="card adminuiux-card mb-4">
        <div class="card-header">
            <div class="row gx-3 gx-lg-4 align-items-center">
                <div class="col">
                    <p class="h6">Potenciales Clientes</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-theme" id="btnAdd"><i class="bi bi-person-plus vm me-2"></i> Agregar</button>
                </div>
            </div>
        </div>
        <div class="card-body">

            <!-- data table -->
            <div class=" mb-4">
                <table class="table w-100 nowrap" id="prospectoTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="xs sm">Fecha Ingreso</th>
                            <th class="xs sm md">Contacto</th>
                            <th class="xs sm">Nivel</th>
                            <th class="all">Carrera</th>
                            <th class="xs sm">Universidad</th>
                            <th class="xs sm">Estado</th>
                            <th class="xs sm">Fecha Entrega</th>
                            <th class="all">Acción</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- modal-lg Modal -->
<div class="modal fade" id="modalPotencial" tabindex="-1" aria-labelledby="lgmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title h5" id="lgmodalLabel">Agregar Potencial Cliente</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPotencialCliente">
                <div class="modal-body">
                    <input type="hidden" id="prospecto_id" name="prospecto_id" value="0">
                    <!-- Datos del Cliente -->
                    <div class="mb-4 pb-4 border-bottom">
                        <h6 class="mb-3">
                            <span class="badge bg-secondary">Información del Cliente</span>
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nivelAcademico" class="form-label">Nivel Académico</label>
                                <select class="form-select" id="nivelAcademico" name="nivelAcademico">
                                    <option value="">-- Seleccione un nivel --</option>
                                    <option value="1">Pregrado</option>
                                    <option value="2">Maestría</option>
                                    <option value="3">Doctorado</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="universidad" class="form-label">Universidad</label>
                                <select class="form-select" id="universidad" name="universidad">
                                    <option value="">-- Seleccione una universidad --</option>
                                    <option value="UNSM">UNSM - Universidad Nacional de San Martín</option>
                                    <option value="UNMSM">UNMSM - Universidad Nacional Mayor de San Marcos</option>
                                    <option value="PUCP">PUCP - Pontificia Universidad Católica del Perú</option>
                                    <option value="UNI">UNI - Universidad Nacional de Ingeniería</option>
                                    <option value="UPAO">UPAO - Universidad Privada Antenor Orrego</option>
                                    <option value="USMP">USMP - Universidad San Martín de Porres</option>
                                    <option value="UPC">UPC - Universidad Peruana de Ciencias Aplicadas</option>
                                    <option value="USFX">USFX - Universidad San Francisco Javier</option>
                                    <option value="OTRO">Otra</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="carrera" class="form-label">Carrera Universitaria</label>
                                <select class="form-select" id="carrera" name="carrera">
                                    <option value="">-- Seleccione una carrera --</option>
                                    <option value="ADMINISTRACION">Administración</option>
                                    <option value="CONTABILIDAD">Contabilidad</option>
                                    <option value="ECONOMIA">Economía</option>
                                    <option value="INGENIERIA_SISTEMAS">Ingeniería de Sistemas</option>
                                    <option value="INGENIERIA_CIVIL">Ingeniería Civil</option>
                                    <option value="INGENIERIA_INDUSTRIAL">Ingeniería Industrial</option>
                                    <option value="DERECHO">Derecho</option>
                                    <option value="PSICOLOGIA">Psicología</option>
                                    <option value="EDUCACION">Educación</option>
                                    <option value="MARKETING">Marketing</option>
                                    <option value="OTRO">Otro</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="fechaEntrega" class="form-label">Fecha de Entrega Tentativa</label>
                                <input type="date" class="form-control" id="fechaEntrega" name="fechaEntrega">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="origenId" class="form-label">Origen</label>
                                <select class="form-select" id="origenId" name="origenId">
                                    <option value="">-- Seleccione un origen de contacto --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Contactos -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-secondary">Contactos</span>

                            <button type="button" class="btn btn-outline-theme btn-sm" id="btnAgregarContacto">
                                <i class="bi bi-plus-circle me-1"></i> Agregar más contactos
                            </button>
                        </div>

                        <small class="text-secondary" id="contadorContactos">1 contacto</small>

                        <!-- Contenedor de contactos -->
                        <div id="contactosContainer">
                            <!-- Primer contacto (siempre visible) -->
                            <div class="contacto-block mb-4 pb-4 border-bottom" data-contacto="1">
                                <h6 class="mb-1">
                                    <span class="badge bg-theme">Contacto 1</span>
                                </h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nombre_1" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre_1" name="nombres[]" placeholder="Ingrese nombre">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="apellido_1" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="apellido_1" name="apellidos[]" placeholder="Ingrese apellido">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="celular_1" class="form-label">Celular</label>
                                        <input type="tel" class="form-control" id="celular_1" name="celular[]" placeholder="Ej: 51922502947" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contenedor para contactos adicionales -->
                        <div id="contactosAdicionalesContainer"></div>
                    </div>

                    <div class="row mt-3">
                        <h6 class="mb-3">
                            <span class="badge bg-secondary">Seleccione el Rol y las tareas</span>
                        </h6>
                        <div class="col-md-6 mb-3">
                            <label for="selectRoleValoracion" class="form-label">Roles</label>
                            <select class="form-select" id="selectRoleValoracion" name="selectRoleValoracion" required>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tareaRealizar" class="form-label">Tareas</label>
                            <select class="form-select" id="tareaRealizar" name="tareaRealizar" required>
                                <option value="">-- Seleccionar tarea --</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="personal" class="form-label">Personal</label>
                            <select class="form-select" id="personal" name="personal" required>
                                <option value="">-- Seleccionar personal --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12 mb-3">
                            <label for="editor" class="form-label">Apuntes</label>
                            <div id="editor" style="height:300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-theme">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal para ver detalles del cliente -->
<div class="modal fade" id="modalDetalleCliente" tabindex="-1" aria-labelledby="detalleClienteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title h5" id="detalleClienteLabel">Detalle del Cliente</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Información del Cliente -->
                <div class="mb-4 pb-4 border-bottom">
                    <h6 class="mb-3">
                        <span class="badge bg-secondary">Información del Cliente</span>
                    </h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nivel Académico</label>
                            <p id="detalle-nivelAcademico" class="text-secondary">-</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Universidad</label>
                            <p id="detalle-universidad" class="text-secondary">-</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Carrera</label>
                            <p id="detalle-carrera" class="text-secondary">-</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Fecha de Entrega</label>
                            <p id="detalle-fechaEntrega" class="text-secondary">-</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Fecha de Ingreso</label>
                            <p id="detalle-fechaIngreso" class="text-secondary">-</p>
                        </div>
                    </div>
                </div>

                <!-- Contactos -->
                <div class="mb-4">
                    <h6 class="mb-3">
                        <span class="badge bg-secondary">Contactos</span>
                    </h6>
                    <div id="detalle-contactos">
                        <p class="text-secondary">Sin contactos registrados</p>
                    </div>
                </div>

                <!-- Estado -->
                <div class="mb-4">
                    <h6 class="mb-3">
                        <span class="badge bg-secondary">Estado y Valoración</span>
                    </h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="detalleEstado" class="form-label fw-bold">Estado Actual</label>
                            <select class="form-select" id="detalleEstado" name="detalleEstado">
                                <option value="NUEVO">Nuevo</option>
                                <option value="CONTACTADO">Contactado</option>
                                <option value="INTERESADO">Interesado</option>
                                <option value="EN_SEGUIMIENTO">En Seguimiento</option>
                                <option value="DESCARTADO">Descartado</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jefe de Valoración</label>
                            <p id="detalle-jefeValoracion" class="text-secondary">-</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-theme" id="btnGuardarEstado">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal para Ficha de Enfoque -->
<div class="modal fade" id="modalFichaEnfoque" tabindex="-1" aria-labelledby="fichaEnfoqueLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title h5" id="fichaEnfoqueLabel">Ficha de Enfoque</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formFichaEnfoque">
                <input type="hidden" id="fichaClienteId" value="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="titulotrabajo" class="form-label">Título del Trabajo</label>
                        <input type="text" class="form-control" id="titulotrabajo" name="titulotrabajo" placeholder="Ingrese el título del trabajo" required>
                    </div>

                    <div class="mb-3">
                        <label for="variables" class="form-label">Variables</label>
                        <textarea class="form-control" id="variables" name="variables" rows="3" placeholder="Ingrese las variables del trabajo" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="objetivos" class="form-label">Objetivos</label>
                        <textarea class="form-control" id="objetivos" name="objetivos" rows="3" placeholder="Ingrese los objetivos del trabajo" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Ingrese la descripción del trabajo" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-theme">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Simulador de Disponibilidad para Prospectos -->
<div class="modal fade" id="modalSimuladorProspectos" tabindex="-1" aria-labelledby="simuladorProspectosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title h5" id="simuladorProspectosLabel">Simulador de Disponibilidad</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="prospectoIdSimular" value="">

                <div class="mb-3">
                    <label class="form-label fw-bold">¿Quién puede realizar este trabajo? (Selecciona uno o más)</label>
                    <div id="listadoDisponiblesProspectos">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <label class="form-label fw-bold">Estado General del Equipo</label>
                    <div id="reporteCargaProspectos">
                        <small class="text-secondary">Cargando reporte...</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnAsignarSeleccionados" style="display:none;">
                    <i class="bi bi-check-circle me-1"></i>Asignar Seleccionados
                </button>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
<script defer src="js/prospectos/potenciales.js"></script>
<?= $this->endSection() ?>