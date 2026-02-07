"use strict";

// Variables globales
let tareasTable;
let categoriasCache = {}; // Cache de categorías

// Inicializar cuando DOM esté listo
document.addEventListener("DOMContentLoaded", function () {
    cargarCategorias();
    initDataTable();
    inicializarEventosTareas();
});

// Función para inicializar DataTable
function initDataTable() {
    if (typeof $ === "undefined") {
        setTimeout(initDataTable, 100);
        return;
    }

    tareasTable = $("#tareasTable").DataTable({
        ajax: {
            url: "tareas/get-all",
            type: "GET",
            dataSrc: "result",
        },
        columns: [
            {
                data: "tipo",
                render: function (data, type, row) {

                    return `<span class="badge rounded-pill" style="background-color: ${row.color};">${data}</span>`;
                }
            },
            { data: "nombre" },
            {
                data: "horas_estimadas",
                render: function (data, type, row) {
                    return data + " hrs";
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary btn-editar-tarea" data-tarea-id="${row.id}" onclick="editarTarea(${row.id}, '${row.nombre}', '${row.horas_estimadas}', ${row.tipo_tarea})">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-eliminar-tarea" data-tarea-id="${row.id}" onclick="eliminarTarea(${row.id}, '${row.nombre}')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        responsive: true,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        },
        paging: true,
        pageLength: 10,
        searching: true,
        ordering: true,
        info: true
    });

}

// Función para cargar categorías en el DOM
function cargarCategorias() {
    const container = document.getElementById("categoriasContainer");

    fetch('categorias/get-all')
        .then(res => res.json())
        .then(data => {
            const datos = data.result;

            container.innerHTML = datos.map(categoria => `
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card" style="border-left: 4px solid ${categoria.color};">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0">${categoria.tipo}</h6>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary btn-editar-categoria" data-categoria-id="${categoria.id}" onclick="editarCategoria(${categoria.id}, '${categoria.tipo}', '${categoria.color}')">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-eliminar-categoria" data-categoria-id="${categoria.id}" onclick="eliminarCategoria(${categoria.id}, '${categoria.tipo}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `).join("");

            const tareaCategoria = document.getElementById("tareaCategoria");
            tareaCategoria.innerHTML = '<option value="">Selecciona una categoría</option>' +
                datos.map(cat => `<option value="${cat.id}">${cat.tipo}</option>`).join("");
        })
}

// Función para inicializar eventos
function inicializarEventosTareas() {
    const btnAdd = document.getElementById("btnAdd");
    const btnAddCategoria = document.getElementById("btnAddCategoria");
    const categoriaColor = document.getElementById("categoriaColor");

    // Botón agregar tarea
    if (btnAdd) {
        btnAdd.addEventListener("click", function () {
            abrirModalAgregarTarea();
        });
    }

    // Botón agregar categoría
    if (btnAddCategoria) {
        btnAddCategoria.addEventListener("click", function () {
            abrirModalAgregarCategoria();
        });
    }

    // Preview de color
    if (categoriaColor) {
        categoriaColor.addEventListener("change", function () {
            document.getElementById("colorPreview").style.backgroundColor = this.value;
        });
    }
}

// Función para abrir modal de agregar tarea
function abrirModalAgregarTarea() {
    document.getElementById("modalTareaTitle").textContent = "Agregar Tarea";
    document.getElementById("tareaId").value = "0";
    document.getElementById("formTarea").reset();

    const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarTarea"));
    modal.show();
}

// Función para editar tarea
function editarTarea(tareaId, tareaNombre, tareaHoras, tareaCategoria) {
    document.getElementById("modalTareaTitle").textContent = "Editar Tarea";
    document.getElementById("tareaId").value = tareaId;
    document.getElementById("tareaCategoria").value = tareaCategoria;
    document.getElementById("tareaNombre").value = tareaNombre;
    document.getElementById("tareasHoras").value = tareaHoras;

    const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarTarea"));
    modal.show();
}

// Función para eliminar tarea
function eliminarTarea(tareaId, nombre) {

    Swal.fire({
        title: "¿Eliminar tarea?",
        text: `¿Estás seguro de que deseas eliminar la tarea "${nombre}"?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`tareas/delete/${tareaId}`)
                .then(res => res.json())
                .then(data => {
                    
                    if (data.status === 'error') {
                        Swal.fire({
                            title: "¡Error!",
                            text: data.message,
                            icon: "error"
                        });
                        return;
                    }

                    tareasTable.ajax.reload(null, false);

                    Swal.fire({
                        title: "¡Eliminada!",
                        text: "La tarea ha sido eliminada correctamente.",
                        icon: "success"
                    });
                })
        }
    });
}

// Función para abrir modal de agregar categoría
function abrirModalAgregarCategoria() {
    document.getElementById("modalCategoriaTitle").textContent = "Agregar Categoría";
    document.getElementById("categoriaId").value = "0";
    document.getElementById("formCategoria").reset();
    document.getElementById("categoriaColor").value = "#007bff";
    document.getElementById("colorPreview").style.backgroundColor = "#007bff";

    const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarCategoria"));
    modal.show();
}

// Función para editar categoría
function editarCategoria(categoriaId, categoriaNombre, categoriaColor) {

    document.getElementById("modalCategoriaTitle").textContent = "Editar Categoría";
    document.getElementById("categoriaId").value = categoriaId;

    document.getElementById("categoriaNombre").value = categoriaNombre;
    document.getElementById("categoriaColor").value = categoriaColor;
    document.getElementById("colorPreview").style.backgroundColor = categoriaColor;

    const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarCategoria"));
    modal.show();
}

// Función para eliminar categoría
function eliminarCategoria(categoriaId, categoriaTipo) {

    Swal.fire({
        title: "¿Eliminar categoría?",
        text: `¿Estás seguro de que deseas eliminar la categoría "${categoriaTipo}"?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`categorias/delete/${categoriaId}`)
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'error') {
                        Swal.fire({
                            title: "¡Error!",
                            text: data.message,
                            icon: "error"
                        });
                        return;
                    }

                    tareasTable.ajax.reload(null, false);
                    cargarCategorias();

                    Swal.fire({
                        title: "¡Eliminada!",
                        text: "La categoría ha sido eliminada correctamente.",
                        icon: "success"
                    });
                })

        }
    });
}

const formTarea = document.getElementById("formTarea");

formTarea.addEventListener("submit", (e) => {
    e.preventDefault();

    const formData = new FormData(formTarea);

    fetch('tareas/save', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'error') {
                Swal.fire({
                    title: "¡Error!",
                    text: data.message,
                    icon: "error"
                });
                return;
            }

            tareasTable.ajax.reload(null, false);

            Swal.fire({
                title: "¡Éxito!",
                text: data.message,
                icon: "success"
            }).then(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById("modalAgregarEditarTarea"));
                if (modal) modal.hide();
            });
        })
})

// Función para guardar categoría

const formCategoria = document.getElementById("formCategoria");

formCategoria.addEventListener("submit", (e) => {
    e.preventDefault();

    const categoriaId = document.getElementById("categoriaId").value;

    const formData = new FormData(formCategoria);

    fetch('categorias/save', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {

            if (data.status === 'error') {
                Swal.fire({
                    title: "¡Error!",
                    text: data.message,
                    icon: "error"
                });
                return;
            }

            if (categoriaId != 0) {
                tareasTable.ajax.reload(null, false);
            }

            cargarCategorias();

            Swal.fire({
                title: "¡Éxito!",
                text: data.message,
                icon: "success"
            }).then(() => {
                const modal = bootstrap.Modal.getInstance(document.getElementById("modalAgregarEditarCategoria"));
                if (modal) modal.hide();
            });

        })
})
