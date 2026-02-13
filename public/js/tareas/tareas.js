"use strict";

// Variables globales
let tareasTable;
let categoriasCache = {}; // Cache de categorías
let rolesData = []; // Array para almacenar roles
let rolesSeleccionados = []; // Array para almacenar los roles agregados a la tarea actual

// Inicializar cuando DOM esté listo
document.addEventListener("DOMContentLoaded", function () {
  //cargarRoles();
  cargarCategorias();
  initDataTable();
  inicializarEventosTareas();
});

// La carga de roles ya se maneja via PHP en el select,
// pero mantenemos la estructura por si se necesita recargar dinámicamente.
function actualizarRolesUI() {
  const container = document.getElementById("rolesListContainer");
  const noRolesMsg = document.getElementById("noRolesMsg");

  if (rolesSeleccionados.length === 0) {
    container.innerHTML =
      '<p class="text-muted small mb-0 text-center py-2" id="noRolesMsg">No hay roles agregados</p>';
    return;
  }

  container.innerHTML = rolesSeleccionados
    .map(
      (rol, index) => `
        <div class="list-group-item d-flex justify-content-between align-items-center py-1 px-2 border-0 mb-1 rounded bg-light">
            <div class="d-flex align-items-center">
                <span class="fw-bold me-2">${rol.nombre}</span>
                <span class="badge ${rol.es_primaria ? "bg-primary" : "bg-secondary"} small">
                    ${rol.es_primaria ? "Primaria" : "Complementaria"}
                </span>
            </div>
            <button type="button" class="btn btn-sm text-danger" onclick="removerRol(${index})">
                <i class="bi bi-trash"></i>
            </button>
            <input type="hidden" name="roles[]" value="${rol.id}">
            <input type="hidden" name="prioridad[]" value="${rol.es_primaria ? 1 : 0}">
        </div>
    `,
    )
    .join("");
}

function agregarRol() {
  const select = document.getElementById("selectRolNuevo");
  const checkPrimaria = document.getElementById("checkPrimaria");

  if (!select.value) {
    Swal.fire("Atención", "Selecciona un rol primeiro", "warning");
    return;
  }

  const id = select.value;
  const nombre =
    select.options[select.selectedIndex].getAttribute("data-nombre");
  const es_primaria = checkPrimaria.checked;

  // Evitar duplicados
  if (rolesSeleccionados.some((r) => r.id == id)) {
    Swal.fire("Atención", "Este rol ya ha sido agregado", "warning");
    return;
  }

  rolesSeleccionados.push({ id, nombre, es_primaria });

  // Reset inputs
  select.value = "";
  checkPrimaria.checked = false;

  actualizarRolesUI();
}

function removerRol(index) {
  rolesSeleccionados.splice(index, 1);
  actualizarRolesUI();
}

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
        },
      },
      { data: "nombre" },
      {
        data: "horas_estimadas",
        render: function (data, type, row) {
          return data + " hrs";
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          let rolesHtml = "";
          row.roles.forEach((rol) => {
            let prioridad = "";

            if (rol.prioridad == 0) {
              prioridad = `<span class="badge rounded-pill bg-warning me-1">C</span>`;
            } else {
              prioridad = `<span class="badge rounded-pill bg-success me-1">P</span>`;
            }

            rolesHtml += `<span class="badge rounded-pill bg-secondary me-1">${rol.nombre} ${prioridad} </span>`;
          });
          return rolesHtml;
        },
      },
      {
        data: null,
        render: function (data, type, row) {
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
        },
      },
    ],
    responsive: true,
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    paging: true,
    pageLength: 10,
    searching: true,
    ordering: true,
    info: true,
  });
}

// Función para cargar categorías en el DOM
function cargarCategorias() {
  const container = document.getElementById("categoriasContainer");

  fetch("categorias/get-all")
    .then((res) => res.json())
    .then((data) => {
      const datos = data.result;

      container.innerHTML = datos
        .map(
          (categoria) => `
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
        `,
        )
        .join("");

      const tareaCategoria = document.getElementById("tareaCategoria");
      tareaCategoria.innerHTML =
        '<option value="">Selecciona una categoría</option>' +
        datos
          .map((cat) => `<option value="${cat.id}">${cat.tipo}</option>`)
          .join("");
    });
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

  // Botón agregar rol a la lista
  const btnAddRolToList = document.getElementById("btnAddRolToList");
  if (btnAddRolToList) {
    btnAddRolToList.addEventListener("click", agregarRol);
  }

  // Preview de color
  if (categoriaColor) {
    categoriaColor.addEventListener("change", function () {
      document.getElementById("colorPreview").style.backgroundColor =
        this.value;
    });
  }

  // Event listeners delegados para botones de la tabla
  document.addEventListener("click", function (e) {
    if (e.target.closest(".btn-editar-tarea")) {
      const tareaId = e.target
        .closest(".btn-editar-tarea")
        .getAttribute("data-tarea-id");
      editarTarea(tareaId);
    }
    if (e.target.closest(".btn-eliminar-tarea")) {
      const tareaId = e.target
        .closest(".btn-eliminar-tarea")
        .getAttribute("data-tarea-id");
      const nombreTarea =
        e.target.closest("tr").querySelector("td:nth-child(2)")?.textContent ||
        "esta tarea";
      eliminarTarea(tareaId, nombreTarea);
    }
  });
}

// Función para abrir modal de agregar tarea
function abrirModalAgregarTarea() {
  document.getElementById("modalTareaTitle").textContent = "Agregar Tarea";
  document.getElementById("tareaId").value = "0";
  document.getElementById("formTarea").reset();

  rolesSeleccionados = [];
  actualizarRolesUI();

  const modal = new bootstrap.Modal(
    document.getElementById("modalAgregarEditarTarea"),
  );
  modal.show();
}

// Función para editar tarea
function editarTarea(tareaId) {
  document.getElementById("modalTareaTitle").textContent = "Editar Tarea";
  document.getElementById("formTarea").reset();
  document.getElementById("tareaId").value = tareaId;

  const modal = new bootstrap.Modal(
    document.getElementById("modalAgregarEditarTarea"),
  );
  modal.show();

  // Cargar datos desde la API
  fetch(`tareas/get-row/${tareaId}`)
    .then((res) => res.json())
    .then((data) => {
      if (data.result) {
        const tarea = data.result.tarea;
        document.getElementById("tareaCategoria").value = tarea.tipo_tarea;
        document.getElementById("tareaNombre").value = tarea.nombre;
        document.getElementById("tareasHoras").value = tarea.horas_estimadas;

        const rolesTarea = data.result.roles;
        rolesSeleccionados = rolesTarea.map((rol) => ({
          id: rol.rol_id,
          nombre: rol.nombre || rol.nombre_rol || rol.rol_nombre || "Rol", // Depende de lo que devuelva el backend
          es_primaria: rol.prioridad == 1,
        }));
        actualizarRolesUI();
      }
    })
    .catch((err) => console.error("Error cargando tarea:", err));
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
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`tareas/delete/${tareaId}`)
        .then((res) => res.json())
        .then((data) => {
          if (data.status === "error") {
            Swal.fire({
              title: "¡Error!",
              text: data.message,
              icon: "error",
            });
            return;
          }

          tareasTable.ajax.reload(null, false);

          Swal.fire({
            title: "¡Eliminada!",
            text: "La tarea ha sido eliminada correctamente.",
            icon: "success",
          });
        });
    }
  });
}

// Función para abrir modal de agregar categoría
function abrirModalAgregarCategoria() {
  document.getElementById("modalCategoriaTitle").textContent =
    "Agregar Categoría";
  document.getElementById("categoriaId").value = "0";
  document.getElementById("formCategoria").reset();
  document.getElementById("categoriaColor").value = "#007bff";
  document.getElementById("colorPreview").style.backgroundColor = "#007bff";

  const modal = new bootstrap.Modal(
    document.getElementById("modalAgregarEditarCategoria"),
  );
  modal.show();
}

// Función para editar categoría
function editarCategoria(categoriaId, categoriaNombre, categoriaColor) {
  document.getElementById("modalCategoriaTitle").textContent =
    "Editar Categoría";
  document.getElementById("categoriaId").value = categoriaId;

  document.getElementById("categoriaNombre").value = categoriaNombre;
  document.getElementById("categoriaColor").value = categoriaColor;
  document.getElementById("colorPreview").style.backgroundColor =
    categoriaColor;

  const modal = new bootstrap.Modal(
    document.getElementById("modalAgregarEditarCategoria"),
  );
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
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      fetch(`categorias/delete/${categoriaId}`)
        .then((res) => res.json())
        .then((data) => {
          if (data.status === "error") {
            Swal.fire({
              title: "¡Error!",
              text: data.message,
              icon: "error",
            });
            return;
          }

          tareasTable.ajax.reload(null, false);
          cargarCategorias();

          Swal.fire({
            title: "¡Eliminada!",
            text: "La categoría ha sido eliminada correctamente.",
            icon: "success",
          });
        });
    }
  });
}

const formTarea = document.getElementById("formTarea");

formTarea.addEventListener("submit", (e) => {
  e.preventDefault();

  const formData = new FormData(formTarea);

  fetch("tareas/save", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "error") {
        Swal.fire({
          title: "¡Error!",
          text: data.message,
          icon: "error",
        });
        return;
      }

      tareasTable.ajax.reload(null, false);

      Swal.fire({
        title: "¡Éxito!",
        text: data.message,
        icon: "success",
      }).then(() => {
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalAgregarEditarTarea"),
        );
        if (modal) modal.hide();
      });
    });
});

// Función para guardar categoría

const formCategoria = document.getElementById("formCategoria");

formCategoria.addEventListener("submit", (e) => {
  e.preventDefault();

  const categoriaId = document.getElementById("categoriaId").value;

  const formData = new FormData(formCategoria);

  fetch("categorias/save", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "error") {
        Swal.fire({
          title: "¡Error!",
          text: data.message,
          icon: "error",
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
        icon: "success",
      }).then(() => {
        const modal = bootstrap.Modal.getInstance(
          document.getElementById("modalAgregarEditarCategoria"),
        );
        if (modal) modal.hide();
      });
    });
});
