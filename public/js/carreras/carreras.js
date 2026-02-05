"use strict";

let carrerasTable;

// Muestra de instituciones (puedes sincronizar con `institucionesData` del otro script o con backend)
const institucionesList = [
    { id: 1, nombre: 'Universidad Nacional' },
    { id: 2, nombre: 'Instituto Superior ABC' },
    { id: 3, nombre: 'Universidad Privada XYZ' }
];

let carrerasData = [
    { id: 1, institucionId: 1, nombre: 'Ingeniería de Sistemas' },
    { id: 2, institucionId: 2, nombre: 'Administración' },
    { id: 3, institucionId: 3, nombre: 'Marketing' }
];

document.addEventListener('DOMContentLoaded', function() {
    poblarSelectInstituciones();
    initDataTable();
    inicializarEventosCarreras();
});

function poblarSelectInstituciones() {
    const select = document.getElementById('carreraInstitucion');
    if (!select) return;
    select.innerHTML = '<option value="">Selecciona una institución</option>' + institucionesList.map(i => `<option value="${i.id}">${i.nombre}</option>`).join('');
}

function initDataTable() {
    if (typeof $ === 'undefined') {
        setTimeout(initDataTable, 100);
        return;
    }

    carrerasTable = $('#carrerasTable').DataTable({
        data: carrerasData,
        columns: [
            {
                data: 'institucionId',
                render: function(data, type, row) {
                    const inst = institucionesList.find(i => i.id == data);
                    return inst ? inst.nombre : 'Sin institución';
                }
            },
            { data: 'nombre' },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <div class="btn-group btn-group-sm" role="group">
                            <button class="btn btn-outline-primary btn-editar-carrera" data-id="${row.id}"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-outline-danger btn-eliminar-carrera" data-id="${row.id}"><i class="bi bi-trash"></i></button>
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

    document.addEventListener('click', function(e) {
        const editar = e.target.closest('.btn-editar-carrera');
        const eliminar = e.target.closest('.btn-eliminar-carrera');
        if (editar) editarCarrera(editar.getAttribute('data-id'));
        if (eliminar) eliminarCarrera(eliminar.getAttribute('data-id'));
    });
}

function inicializarEventosCarreras() {
    const btnAdd = document.getElementById('btnAddCarrera');
    const btnGuardar = document.getElementById('btnGuardarCarrera');

    if (btnAdd) btnAdd.addEventListener('click', abrirModalAgregarCarrera);
    if (btnGuardar) btnGuardar.addEventListener('click', guardarCarrera);
}

function abrirModalAgregarCarrera() {
    document.getElementById('modalCarreraTitle').textContent = 'Agregar Carrera';
    document.getElementById('carreraIdEdit').value = '';
    document.getElementById('formCarrera').reset();
    poblarSelectInstituciones();
    const modal = new bootstrap.Modal(document.getElementById('modalAgregarEditarCarrera'));
    modal.show();
}

function editarCarrera(id) {
    const carrera = carrerasData.find(c => c.id == id);
    if (!carrera) { alert('Carrera no encontrada'); return; }
    document.getElementById('modalCarreraTitle').textContent = 'Editar Carrera';
    document.getElementById('carreraIdEdit').value = carrera.id;
    document.getElementById('carreraInstitucion').value = carrera.institucionId;
    document.getElementById('carreraNombre').value = carrera.nombre;
    const modal = new bootstrap.Modal(document.getElementById('modalAgregarEditarCarrera'));
    modal.show();
}

function eliminarCarrera(id) {
    const carrera = carrerasData.find(c => c.id == id);
    if (!carrera) { alert('No encontrada'); return; }
    const nombre = carrera.nombre;
    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: '¿Eliminar carrera?',
            text: `¿Eliminar ${nombre}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar'
        }).then(res => {
            if (res.isConfirmed) {
                const idx = carrerasData.findIndex(c => c.id == id);
                if (idx > -1) { carrerasData.splice(idx,1); carrerasTable.clear().rows.add(carrerasData).draw(); }
                Swal.fire('Eliminada','Carrera eliminada','success');
            }
        });
    } else {
        if (confirm(`Eliminar ${nombre}?`)) {
            const idx = carrerasData.findIndex(c => c.id == id);
            if (idx > -1) { carrerasData.splice(idx,1); carrerasTable.clear().rows.add(carrerasData).draw(); }
            alert('Carrera eliminada');
        }
    }
}

function guardarCarrera() {
    const form = document.getElementById('formCarrera');
    if (!form.checkValidity()) { form.reportValidity(); return; }
    const idEdit = document.getElementById('carreraIdEdit').value;
    const institucionId = parseInt(document.getElementById('carreraInstitucion').value);
    const nombre = document.getElementById('carreraNombre').value.trim();
    if (!institucionId) { alert('Selecciona una institución'); return; }

    if (idEdit) {
        const carrera = carrerasData.find(c => c.id == idEdit);
        if (carrera) { Object.assign(carrera, { institucionId, nombre }); carrerasTable.clear().rows.add(carrerasData).draw(); }
        mensaje = `La carrera "${nombre}" ha sido actualizada.`;
    } else {
        const nuevoId = Math.max(...carrerasData.map(c=>c.id),0)+1;
        carrerasData.push({ id: nuevoId, institucionId, nombre });
        carrerasTable.clear().rows.add(carrerasData).draw();
        mensaje = `La carrera "${nombre}" ha sido creada.`;
    }

    if (typeof Swal !== 'undefined') {
        Swal.fire('¡Éxito!', mensaje, 'success').then(()=>{
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarEditarCarrera'));
            if (modal) modal.hide();
        });
    } else {
        alert(mensaje);
        const modal = bootstrap.Modal.getInstance(document.getElementById('modalAgregarEditarCarrera'));
        if (modal) modal.hide();
    }
}
