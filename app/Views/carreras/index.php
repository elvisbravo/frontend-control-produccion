<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Mantenimiento</h5>
            <p class="text-secondary small">Carreras</p>
        </div>
    </div>
</div>


<div class="container mt-3" id="main-content">

    <div class="card adminuiux-card mb-4">
        <div class="card-header">
            <div class="row gx-3 gx-lg-4 align-items-center">
                <div class="col">
                    <p class="h6">Carreras</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-theme" id="btnAddCarrera"><i class="bi bi-person-plus vm me-2"></i> Nuevo</button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="carrerasTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Institución</th>
                            <th>Nombre de la Carrera</th>
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

<!-- Modal agregar/editar carrera -->
<div class="modal fade" id="modalAgregarEditarCarrera" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCarreraTitle">Agregar Carrera</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formCarrera">
          <input type="hidden" id="carreraIdEdit" value="">
          <div class="mb-3">
            <label for="carreraInstitucion" class="form-label">Institución</label>
            <select id="carreraInstitucion" class="form-select" required>
              <option value="">Selecciona una institución</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="carreraNombre" class="form-label">Nombre de la Carrera</label>
            <input type="text" id="carreraNombre" class="form-control" placeholder="Ej: Ingeniería de Sistemas" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-theme" id="btnGuardarCarrera">Guardar</button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script defer src="js/carreras/carreras.js"></script>
<?= $this->endSection() ?>