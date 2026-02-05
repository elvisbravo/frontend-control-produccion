"use strict";

// Variables globales
let tareasTable;
let categorias = [
    { id: 1, nombre: "Desarrollo", color: "#007bff" },
    { id: 2, nombre: "Testing", color: "#28a745" },
    { id: 3, nombre: "Diseño", color: "#ffc107" },
    { id: 4, nombre: "Documentación", color: "#17a2b8" }
];

let tareas = [
    {
        id: 1,
        categoriaId: 1,
        nombre: "Crear componente de login",
        horas: 8,
        estado: "Completada"
    },
    {
        id: 2,
        categoriaId: 1,
        nombre: "Implementar validación de formulario",
        horas: 6,
        estado: "En Progreso"
    },
    {
        id: 3,
        categoriaId: 2,
        nombre: "Testing de API endpoints",
        horas: 12,
        estado: "Pendiente"
    },
    {
        id: 4,
        categoriaId: 3,
        nombre: "Diseño de interfaz de usuario",
        horas: 10,
        estado: "En Progreso"
    },
    {
        id: 5,
        categoriaId: 4,
        nombre: "Documentar API REST",
        horas: 5,
        estado: "Pendiente"
    }
];

// Inicializar cuando DOM esté listo
document.addEventListener("DOMContentLoaded", function() {
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
        data: tareas,
        columns: [
            {
                data: null,
                render: function(data, type, row) {
                    const categoria = categorias.find(c => c.id == row.categoriaId);
                    if (!categoria) return "Sin categoría";
                    return `<span class="badge rounded-pill" style="background-color: ${categoria.color};">${categoria.nombre}</span>`;
                }
            },
            { data: "nombre" },
            { 
                data: "horas",
                render: function(data, type, row) {
                    return data + " hrs";
                }
            },
            {
                data: "estado",
                render: function(data, type, row) {
                    let clase = "";
                    if (data === "Pendiente") clase = "text-bg-secondary";
                    else if (data === "En Progreso") clase = "text-bg-warning";
                    else if (data === "Completada") clase = "text-bg-success";
                    
                    return `<span class="badge ${clase}">${data}</span>`;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return `
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary btn-editar-tarea" data-tarea-id="${row.id}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-eliminar-tarea" data-tarea-id="${row.id}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        responsive: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json"
        },
        paging: true,
        pageLength: 10,
        searching: true,
        ordering: true,
        info: true
    });

    // Event listeners para editar y eliminar
    document.addEventListener("click", function(e) {
        if (e.target.closest(".btn-editar-tarea")) {
            const tareaId = e.target.closest(".btn-editar-tarea").getAttribute("data-tarea-id");
            editarTarea(tareaId);
        }
        if (e.target.closest(".btn-eliminar-tarea")) {
            const tareaId = e.target.closest(".btn-eliminar-tarea").getAttribute("data-tarea-id");
            eliminarTarea(tareaId);
        }
    });
}

// Función para cargar categorías en el DOM
function cargarCategorias() {
    const container = document.getElementById("categoriasContainer");
    
    container.innerHTML = categorias.map(categoria => `
        <div class="col-md-6 col-lg-4 mb-3">
            <div class="card" style="border-left: 4px solid ${categoria.color};">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">${categoria.nombre}</h6>
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary btn-editar-categoria" data-categoria-id="${categoria.id}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-eliminar-categoria" data-categoria-id="${categoria.id}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `).join("");

    // Event listeners para categorías
    document.querySelectorAll(".btn-editar-categoria").forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const categoriaId = this.getAttribute("data-categoria-id");
            editarCategoria(categoriaId);
        });
    });

    document.querySelectorAll(".btn-eliminar-categoria").forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const categoriaId = this.getAttribute("data-categoria-id");
            eliminarCategoria(categoriaId);
        });
    });

    // Cargar opciones de categorías en el select
    const tareaCategoria = document.getElementById("tareaCategoria");
    tareaCategoria.innerHTML = '<option value="">Selecciona una categoría</option>' + 
        categorias.map(cat => `<option value="${cat.id}">${cat.nombre}</option>`).join("");
}

// Función para inicializar eventos
function inicializarEventosTareas() {
    const btnAdd = document.getElementById("btnAdd");
    const btnAddCategoria = document.getElementById("btnAddCategoria");
    const btnGuardarTarea = document.getElementById("btnGuardarTarea");
    const btnGuardarCategoria = document.getElementById("btnGuardarCategoria");
    const categoriaColor = document.getElementById("categoriaColor");

    // Botón agregar tarea
    if (btnAdd) {
        btnAdd.addEventListener("click", function() {
            abrirModalAgregarTarea();
        });
    }

    // Botón agregar categoría
    if (btnAddCategoria) {
        btnAddCategoria.addEventListener("click", function() {
            abrirModalAgregarCategoria();
        });
    }

    // Botón guardar tarea
    if (btnGuardarTarea) {
        btnGuardarTarea.addEventListener("click", function() {
            guardarTarea();
        });
    }

    // Botón guardar categoría
    if (btnGuardarCategoria) {
        btnGuardarCategoria.addEventListener("click", function() {
            guardarCategoria();
        });
    }

    // Preview de color
    if (categoriaColor) {
        categoriaColor.addEventListener("change", function() {
            document.getElementById("colorPreview").style.backgroundColor = this.value;
        });
    }
}

// Función para abrir modal de agregar tarea
function abrirModalAgregarTarea() {
    document.getElementById("modalTareaTitle").textContent = "Agregar Tarea";
    document.getElementById("tareaIdEdit").value = "";
    document.getElementById("formTarea").reset();
    document.getElementById("tareaEstado").value = "Pendiente";
    
    const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarTarea"));
    modal.show();
}

// Función para editar tarea
function editarTarea(tareaId) {
    const tarea = tareas.find(t => t.id == tareaId);
    
    if (!tarea) {
        alert("Tarea no encontrada");
        return;
    }

    document.getElementById("modalTareaTitle").textContent = "Editar Tarea";
    document.getElementById("tareaIdEdit").value = tarea.id;
    document.getElementById("tareaCategoria").value = tarea.categoriaId;
    document.getElementById("tareaNombre").value = tarea.nombre;
    document.getElementById("tareasHoras").value = tarea.horas;
    document.getElementById("tareaEstado").value = tarea.estado;
    
    const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarTarea"));
    modal.show();
}

// Función para eliminar tarea
function eliminarTarea(tareaId) {
    const tarea = tareas.find(t => t.id == tareaId);
    
    if (!tarea) {
        alert("Tarea no encontrada");
        return;
    }

    if (typeof Swal !== "undefined") {
        Swal.fire({
            title: "¿Eliminar tarea?",
            text: `¿Estás seguro de que deseas eliminar la tarea "${tarea.nombre}"?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                const index = tareas.findIndex(t => t.id == tareaId);
                if (index > -1) {
                    tareas.splice(index, 1);
                    tareasTable.clear().rows.add(tareas).draw();
                }
                
                Swal.fire({
                    title: "¡Eliminada!",
                    text: "La tarea ha sido eliminada correctamente.",
                    icon: "success"
                });
            }
        });
    } else {
        if (confirm(`¿Eliminar la tarea "${tarea.nombre}"?`)) {
            const index = tareas.findIndex(t => t.id == tareaId);
            if (index > -1) {
                tareas.splice(index, 1);
                tareasTable.clear().rows.add(tareas).draw();
            }
            alert("Tarea eliminada correctamente");
        }
    }
}

// Función para abrir modal de agregar categoría
function abrirModalAgregarCategoria() {
    document.getElementById("modalCategoriaTitle").textContent = "Agregar Categoría";
    document.getElementById("categoriaIdEdit").value = "";
    document.getElementById("formCategoria").reset();
    document.getElementById("categoriaColor").value = "#007bff";
    document.getElementById("colorPreview").style.backgroundColor = "#007bff";
    
    const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarCategoria"));
    modal.show();
}

// Función para editar categoría
function editarCategoria(categoriaId) {
    const categoria = categorias.find(c => c.id == categoriaId);
    
    if (!categoria) {
        alert("Categoría no encontrada");
        return;
    }

    document.getElementById("modalCategoriaTitle").textContent = "Editar Categoría";
    document.getElementById("categoriaIdEdit").value = categoria.id;
    document.getElementById("categoriaNombre").value = categoria.nombre;
    document.getElementById("categoriaColor").value = categoria.color;
    document.getElementById("colorPreview").style.backgroundColor = categoria.color;
    
    const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarCategoria"));
    modal.show();
}

// Función para eliminar categoría
function eliminarCategoria(categoriaId) {
    const categoria = categorias.find(c => c.id == categoriaId);
    
    if (!categoria) {
        alert("Categoría no encontrada");
        return;
    }

    // Verificar si hay tareas con esta categoría
    const tareasConCategoria = tareas.filter(t => t.categoriaId == categoriaId).length;

    if (tareasConCategoria > 0) {
        alert(`No se puede eliminar la categoría porque tiene ${tareasConCategoria} tarea(s) asociada(s)`);
        return;
    }

    if (typeof Swal !== "undefined") {
        Swal.fire({
            title: "¿Eliminar categoría?",
            text: `¿Estás seguro de que deseas eliminar la categoría "${categoria.nombre}"?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                const index = categorias.findIndex(c => c.id == categoriaId);
                if (index > -1) {
                    categorias.splice(index, 1);
                    cargarCategorias();
                }
                
                Swal.fire({
                    title: "¡Eliminada!",
                    text: "La categoría ha sido eliminada correctamente.",
                    icon: "success"
                });
            }
        });
    } else {
        if (confirm(`¿Eliminar la categoría "${categoria.nombre}"?`)) {
            const index = categorias.findIndex(c => c.id == categoriaId);
            if (index > -1) {
                categorias.splice(index, 1);
                cargarCategorias();
            }
            alert("Categoría eliminada correctamente");
        }
    }
}

// Función para guardar tarea
function guardarTarea() {
    const form = document.getElementById("formTarea");
    
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const tareaIdEdit = document.getElementById("tareaIdEdit").value;
    const categoriaId = document.getElementById("tareaCategoria").value;
    const nombre = document.getElementById("tareaNombre").value;
    const horas = parseFloat(document.getElementById("tareasHoras").value);
    const estado = document.getElementById("tareaEstado").value;

    const tareaData = {
        categoriaId: parseInt(categoriaId),
        nombre,
        horas,
        estado
    };

    if (tareaIdEdit) {
        // Editar tarea
        const tarea = tareas.find(t => t.id == tareaIdEdit);
        if (tarea) {
            Object.assign(tarea, tareaData);
            tareasTable.clear().rows.add(tareas).draw();
        }
        mensajeExito = `La tarea "${nombre}" ha sido actualizada correctamente.`;
    } else {
        // Crear nueva tarea
        const nuevoId = Math.max(...tareas.map(t => t.id), 0) + 1;
        tareas.push({
            id: nuevoId,
            ...tareaData
        });
        tareasTable.clear().rows.add(tareas).draw();
        mensajeExito = `La tarea "${nombre}" ha sido agregada correctamente.`;
    }

    // TODO: Hacer llamada AJAX para guardar
    console.log("Guardando tarea:", tareaData);

    if (typeof Swal !== "undefined") {
        Swal.fire({
            title: "¡Éxito!",
            text: mensajeExito,
            icon: "success"
        }).then(() => {
            const modal = bootstrap.Modal.getInstance(document.getElementById("modalAgregarEditarTarea"));
            if (modal) modal.hide();
        });
    } else {
        alert(mensajeExito);
        const modal = bootstrap.Modal.getInstance(document.getElementById("modalAgregarEditarTarea"));
        if (modal) modal.hide();
    }
}

// Función para guardar categoría
function guardarCategoria() {
    const form = document.getElementById("formCategoria");
    
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const categoriaIdEdit = document.getElementById("categoriaIdEdit").value;
    const nombre = document.getElementById("categoriaNombre").value;
    const color = document.getElementById("categoriaColor").value;

    const categoriaData = {
        nombre,
        color
    };

    if (categoriaIdEdit) {
        // Editar categoría
        const categoria = categorias.find(c => c.id == categoriaIdEdit);
        if (categoria) {
            Object.assign(categoria, categoriaData);
            cargarCategorias();
            tareasTable.clear().rows.add(tareas).draw();
        }
        mensajeExito = `La categoría "${nombre}" ha sido actualizada correctamente.`;
    } else {
        // Crear nueva categoría
        const nuevoId = Math.max(...categorias.map(c => c.id), 0) + 1;
        categorias.push({
            id: nuevoId,
            ...categoriaData
        });
        cargarCategorias();
        mensajeExito = `La categoría "${nombre}" ha sido agregada correctamente.`;
    }

    // TODO: Hacer llamada AJAX para guardar
    console.log("Guardando categoría:", categoriaData);

    if (typeof Swal !== "undefined") {
        Swal.fire({
            title: "¡Éxito!",
            text: mensajeExito,
            icon: "success"
        }).then(() => {
            const modal = bootstrap.Modal.getInstance(document.getElementById("modalAgregarEditarCategoria"));
            if (modal) modal.hide();
        });
    } else {
        alert(mensajeExito);
        const modal = bootstrap.Modal.getInstance(document.getElementById("modalAgregarEditarCategoria"));
        if (modal) modal.hide();
    }
}
