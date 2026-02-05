"use strict";

let institucionesTable;
const institucionesData = [
  { id:1, tipo: 'Universidad', nombre: 'Universidad Nacional', ubigeo: '150101' },
  { id:2, tipo: 'Privada', nombre: 'Instituto Superior ABC', ubigeo: '150102' },
  { id:3, tipo: 'Privada', nombre: 'Universidad Privada XYZ', ubigeo: '150103' }
];

document.addEventListener('DOMContentLoaded', function() {
    initDataTable();
    inicializarEventosInstituciones();
});

function initDataTable() {
    if (typeof $ === 'undefined') {
        setTimeout(initDataTable, 100);
        return;
    }

    institucionesTable = $("#institucionesTable").DataTable({
        data: institucionesData,
        columns: [
          { data: 'tipo' },
          { data: 'nombre' },
          { data: 'ubigeo' },
          {
            data: null,
            render: function(data, type, row) {
              return `
                <div class="btn-group btn-group-sm" role="group">
                  <button class="btn btn-outline-primary btn-editar-institucion" data-id="${row.id}"><i class="bi bi-pencil-square"></i></button>
                  <button class="btn btn-outline-danger btn-eliminar-institucion" data-id="${row.id}"><i class="bi bi-trash"></i></button>
                </div>
              `;
            }
          }
        ],
        responsive: true,
        language: { url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json" },
        paging: true,
        pageLength: 10
    });

    // Delegated click handlers
    document.addEventListener('click', function(e) {
        const editarBtn = e.target.closest('.btn-editar-institucion');
        const eliminarBtn = e.target.closest('.btn-eliminar-institucion');
        if (editarBtn) {
            const id = editarBtn.getAttribute('data-id');
            abrirModalEditarInstitucion(id);
        }
        if (eliminarBtn) {
            const id = eliminarBtn.getAttribute('data-id');
            eliminarInstitucion(id);
        }
    });
}

function inicializarEventosInstituciones() {
    const btnAdd = document.getElementById('btnAdd');
    if (btnAdd) btnAdd.addEventListener('click', abrirModalAgregarInstitucion);
}

function abrirModalAgregarInstitucion() {
        const modalHtml = `
    <div class="modal fade" id="modalInstitucionX" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Agregar Institución</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="formInstitucion">
              <input type="hidden" id="institucionId" value="">
              <div class="mb-3"><label class="form-label">Tipo</label>
                <select class="form-select" id="institucionTipo">
                  <option value="Universidad">Universidad</option>
                  <option value="Privada">Privada</option>
                  <option value="Nacional">Nacional</option>
                </select>
              </div>
              <div class="mb-3"><label class="form-label">Nombre</label><input class="form-control" id="institucionNombre" required></div>
              <div class="mb-3"><label class="form-label">Ubigeo</label><input class="form-control" id="institucionUbigeo" placeholder="Ej: 150101"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-theme" id="btnGuardarInstitucion">Guardar</button>
          </div>
        </div>
      </div>
    </div>`;

    // append modal to body
    const wrapper = document.createElement('div');
    wrapper.innerHTML = modalHtml;
    document.body.appendChild(wrapper);

    const modalEl = document.getElementById('modalInstitucionX');
    const modal = new bootstrap.Modal(modalEl);
    modal.show();

    // Handle save
    document.getElementById('btnGuardarInstitucion').addEventListener('click', function() {
    const tipo = document.getElementById('institucionTipo').value;
    const nombre = document.getElementById('institucionNombre').value.trim();
    const ubigeo = document.getElementById('institucionUbigeo').value.trim();
    if (!nombre) { alert('Ingrese el nombre'); return; }
    const nuevoId = Math.max(...institucionesData.map(i=>i.id),0)+1;
    institucionesData.push({ id: nuevoId, tipo, nombre, ubigeo });
        institucionesTable.clear().rows.add(institucionesData).draw();
        modal.hide();
        // remove modal from DOM after hidden
        modalEl.addEventListener('hidden.bs.modal', ()=> wrapper.remove(), { once: true });
    });
}

function abrirModalEditarInstitucion(id) {
    const inst = institucionesData.find(i=>i.id==id);
    if (!inst) { alert('Institución no encontrada'); return; }

    const modalHtml = `
    <div class="modal fade" id="modalInstitucionX" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Institución</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <form id="formInstitucion">
              <input type="hidden" id="institucionId" value="${inst.id}">
              <div class="mb-3"><label class="form-label">Tipo</label>
                <select class="form-select" id="institucionTipo">
                  <option value="Universidad">Universidad</option>
                  <option value="Privada">Privada</option>
                  <option value="Nacional">Nacional</option>
                </select>
              </div>
              <div class="mb-3"><label class="form-label">Nombre</label><input class="form-control" id="institucionNombre" value="${inst.nombre}" required></div>
              <div class="mb-3"><label class="form-label">Ubigeo</label><input class="form-control" id="institucionUbigeo" value="${inst.ubigeo || ''}"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-theme" id="btnGuardarInstitucion">Guardar</button>
          </div>
        </div>
      </div>
    </div>`;

    const wrapper = document.createElement('div');
    wrapper.innerHTML = modalHtml;
    document.body.appendChild(wrapper);

    const modalEl = document.getElementById('modalInstitucionX');
    const modal = new bootstrap.Modal(modalEl);
    // set selected tipo
    modalEl.addEventListener('shown.bs.modal', ()=>{
        document.getElementById('institucionTipo').value = inst.tipo;
    }, { once: true });
    modal.show();

    document.getElementById('btnGuardarInstitucion').addEventListener('click', function() {
    const tipo = document.getElementById('institucionTipo').value;
    const nombre = document.getElementById('institucionNombre').value.trim();
    const ubigeo = document.getElementById('institucionUbigeo').value.trim();
    if (!nombre) { alert('Ingrese el nombre'); return; }
    Object.assign(inst, { tipo, nombre, ubigeo });
        institucionesTable.clear().rows.add(institucionesData).draw();
        modal.hide();
        modalEl.addEventListener('hidden.bs.modal', ()=> wrapper.remove(), { once: true });
    });
}

function eliminarInstitucion(id) {
    const inst = institucionesData.find(i=>i.id==id);
    if (!inst) { alert('No encontrado'); return; }
    const nombre = inst.nombre;
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '¿Eliminar institución?',
            text: `¿Eliminar ${nombre}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar'
        }).then((res)=>{
            if (res.isConfirmed) {
                const idx = institucionesData.findIndex(i=>i.id==id);
                if (idx>-1) { institucionesData.splice(idx,1); institucionesTable.clear().rows.add(institucionesData).draw(); }
                Swal.fire('Eliminada','Institución eliminada','success');
            }
        });
    } else {
        if (confirm(`Eliminar ${nombre}?`)) {
            const idx = institucionesData.findIndex(i=>i.id==id);
            if (idx>-1) { institucionesData.splice(idx,1); institucionesTable.clear().rows.add(institucionesData).draw(); }
            alert('Institución eliminada');
        }
    }
}
