<?= $this->extend('layouts/main') ?>



<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Mantenimiento</h5>
            <p class="text-secondary small">Instituciones</p>
        </div>
    </div>
</div>


<div class="container mt-3" id="main-content">

    <div class="card adminuiux-card mb-4">
        <div class="card-header">
            <div class="row gx-3 gx-lg-4 align-items-center">
                <div class="col">
                    <p class="h6">Instituciones</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-theme" id="btnAdd"><i class="bi bi-person-plus vm me-2"></i> Nuevo</button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="institucionesTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>Sigla</th>
                            <th>Sector</th>
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

<!-- Modal Agregar/Editar Institución -->
<div class="modal fade" id="modalInstitucion" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Agregar Institución</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formInstitucion">
                <div class="modal-body">

                    <input type="hidden" id="institucionId" name="institucionId" value="0">
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" id="institucionTipo" name="institucionTipo" required>
                            <option value="">Selecciona un tipo</option>
                            <option value="UNIVERSIDAD">UNIVERSIDAD</option>
                            <option value="INSTITUTO">INSTITUTO</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" id="institucionNombre" name="institucionNombre" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sigla</label>
                        <input class="form-control" id="institucionSigla" name="institucionSigla" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sector</label>
                        <select class="form-select" id="institucionSector" name="institucionSector" required>
                            <option value="">Selecciona un sector</option>
                            <option value="PUBLICA">PUBLICA</option>
                            <option value="PRIVADA">PRIVADA</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-theme" id="btnGuardarInstitucion">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script defer src="js/instituciones/instituciones.js"></script>
<?= $this->endSection() ?>