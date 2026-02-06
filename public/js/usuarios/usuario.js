"use strict";

// Variables globales
let usuariosTable;

// Inicializar cuando DOM esté listo
document.addEventListener("DOMContentLoaded", function () {
  initDataTable();
  inicializarEventosUsuarios();
});

// Función para inicializar DataTable
function initDataTable() {
  // Verificar si jQuery y DataTables están disponibles
  if (typeof $ === "undefined") {
    setTimeout(initDataTable, 100);
    return;
  }

  usuariosTable = $("#usuariosTable").DataTable({
    ajax: {
      url: "usuarios/get-all",
      type: "GET",
      dataSrc: "result",
    },
    columns: [
      { data: "id" },
      { data: "rol" },
      {
        data: null,
        render: function (data, type, row) {
          return row.nombres + " " + row.apellidos;
        },
      },
      { data: "celular" },
      { data: "usuario" },
      {
        data: null,
        render: function (data, type, row) {
          return `
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary btn-editar-usuario" onclick="editarUsuario(${row.id})" data-usuario-id="${row.id}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-eliminar-usuario" data-usuario-id="${row.id}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    `;
        },
      },
    ],
    responsive: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    paging: true,
    pageLength: 10,
    searching: true,
    ordering: true,
    info: true,
  });

  // Agregar event listeners para editar y eliminar
  document.addEventListener("click", function (e) {
    if (e.target.closest(".btn-editar-usuario")) {
      const usuarioId = e.target
        .closest(".btn-editar-usuario")
        .getAttribute("data-usuario-id");
      //editarUsuario(usuarioId);
    }
    if (e.target.closest(".btn-eliminar-usuario")) {
      const usuarioId = e.target
        .closest(".btn-eliminar-usuario")
        .getAttribute("data-usuario-id");
      eliminarUsuario(usuarioId);
    }
  });
}

// Función para inicializar eventos de usuarios
function inicializarEventosUsuarios() {
  const btnAdd = document.getElementById("btnAdd");
  const btnBuscarDocumento = document.getElementById("btnBuscarDocumento");

  // Botón agregar usuario
  if (btnAdd) {
    btnAdd.addEventListener("click", function () {
      abrirModalAgregarUsuario();
    });
  }

  // Botón buscar documento
  if (btnBuscarDocumento) {
    btnBuscarDocumento.addEventListener("click", function () {
      buscarDocumento();
    });
  }
}

// Función para abrir modal para agregar usuario
function abrirModalAgregarUsuario() {
  document.getElementById("modalTitle").textContent = "Agregar Usuario";
  document.getElementById("usuarioId").value = "0";
  document.getElementById("formUsuario").reset();
  document.getElementById("tipoDocumento").value = "2";

  const modal = new bootstrap.Modal(
    document.getElementById("modalAgregarEditarUsuario"),
  );
  modal.show();
}

// Función para editar usuario
function editarUsuario(usuarioId) {
  document.getElementById("modalTitle").textContent = "Editar Usuario";

  const modal = new bootstrap.Modal(
    document.getElementById("modalAgregarEditarUsuario"),
  );
  modal.show();

  fetch("usuario/get-row/" + usuarioId)
    .then((res) => res.json())
    .then((data) => {
      const datos = data.result;
      document.getElementById("usuarioId").value = datos.id;
      document.getElementById("tipoDocumento").value = datos.tipoDocumento_id;
      document.getElementById("numeroDocumento").value = datos.numero_documento;
      document.getElementById("nombres").value = datos.nombres;
      document.getElementById("apellidos").value = datos.apellidos;
      document.getElementById("fechaNacimiento").value = datos.fecha_nacimiento;
      document.getElementById("celular").value = datos.celular;
      document.getElementById("direccion").value = datos.direccion;
      document.getElementById("rol_id").value = datos.rol_id;
      document.getElementById("correo").value = datos.usuario;
      document.getElementById("password").value = datos.clave;
    });
}

// Función para eliminar usuario
function eliminarUsuario(usuarioId) {
  const usuario = usuariosData.find((u) => u.id == usuarioId);

  if (!usuario) {
    alert("Usuario no encontrado");
    return;
  }

  const nombreCompleto = usuario.nombres + " " + usuario.apellidos;

  if (typeof Swal !== "undefined") {
    Swal.fire({
      title: "¿Eliminar usuario?",
      text: `¿Estás seguro de que deseas eliminar a ${nombreCompleto}?`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#dc3545",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        // TODO: Hacer llamada AJAX para eliminar usuario
        const index = usuariosData.findIndex((u) => u.id == usuarioId);
        if (index > -1) {
          usuariosData.splice(index, 1);
          usuariosTable.clear().rows.add(usuariosData).draw();
        }

        Swal.fire({
          title: "¡Eliminado!",
          text: `${nombreCompleto} ha sido eliminado correctamente.`,
          icon: "success",
        });
      }
    });
  } else {
    if (confirm(`¿Eliminar a ${nombreCompleto}?`)) {
      const index = usuariosData.findIndex((u) => u.id == usuarioId);
      if (index > -1) {
        usuariosData.splice(index, 1);
        usuariosTable.clear().rows.add(usuariosData).draw();
      }
      alert("Usuario eliminado correctamente");
    }
  }
}

// Función para buscar documento
function buscarDocumento() {
  const tipoDocumento = document.getElementById("tipoDocumento").value;
  const numeroDocumento = document
    .getElementById("numeroDocumento")
    .value.trim();

  if (!numeroDocumento) {
    alert("Por favor, ingresa un número de documento");
    return;
  }

  fetch("/consulta-dni/dni/" + numeroDocumento)
    .then((res) => res.json())
    .then((data) => {
      if (data.encontrado == true) {
        const nombres = document.getElementById("nombres");
        const apellidos = document.getElementById("apellidos");

        nombres.value = data.data.nombres;
        apellidos.value = data.data.ap_paterno + " " + data.data.ap_materno;
      }
    });
}

const formUsuario = document.getElementById("formUsuario");

formUsuario.addEventListener("submit", (e) => {
  e.preventDefault();

  const formData = new FormData(formUsuario);

  fetch("save-user", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status == "error") {
        alert(data.message);
        return false;
      }

      bootstrap.Modal.getInstance(
        document.getElementById("modalAgregarEditarUsuario"),
      )?.hide();

      alert(data.message);

      usuariosTable.ajax.reload();
    });
});
