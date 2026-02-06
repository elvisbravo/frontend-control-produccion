"use strict";

// Variables globales
let usuariosTable;
const usuariosData = [
  {
    id: 1,
    tipoDocumento: "DNI",
    numeroDocumento: "12345678",
    nombres: "Juan",
    apellidos: "García López",
    fechaNacimiento: "1990-05-15",
    celular: "987654321",
    direccion: "Av. Principal 123, Lima",
    correo: "juan.garcia@example.com",
  },
  {
    id: 2,
    tipoDocumento: "DNI",
    numeroDocumento: "87654321",
    nombres: "María",
    apellidos: "Martínez Rodríguez",
    fechaNacimiento: "1992-08-20",
    celular: "987123456",
    direccion: "Calle Secundaria 456, Lima",
    correo: "maria.martinez@example.com",
  },
  {
    id: 3,
    tipoDocumento: "CARNET",
    numeroDocumento: "PE123456",
    nombres: "Carlos",
    apellidos: "Sánchez Pérez",
    fechaNacimiento: "1988-12-10",
    celular: "987999888",
    direccion: "Pasaje Terciaria 789, Lima",
    correo: "carlos.sanchez@example.com",
  },
];

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
    data: usuariosData,
    columns: [
      { data: "tipoDocumento" },
      { data: "numeroDocumento" },
      {
        data: null,
        render: function (data, type, row) {
          return row.nombres + " " + row.apellidos;
        },
      },
      { data: "celular" },
      { data: "correo" },
      {
        data: null,
        render: function (data, type, row) {
          return `
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-primary btn-editar-usuario" data-usuario-id="${row.id}">
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
      editarUsuario(usuarioId);
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
  document.getElementById("usuarioIdEdit").value = "";
  document.getElementById("formUsuario").reset();
  document.getElementById("tipoDocumento").value = "2";

  const modal = new bootstrap.Modal(
    document.getElementById("modalAgregarEditarUsuario"),
  );
  modal.show();
}

// Función para editar usuario
function editarUsuario(usuarioId) {
  const usuario = usuariosData.find((u) => u.id == usuarioId);

  if (!usuario) {
    alert("Usuario no encontrado");
    return;
  }

  document.getElementById("modalTitle").textContent = "Editar Usuario";
  document.getElementById("usuarioIdEdit").value = usuario.id;
  document.getElementById("tipoDocumento").value = usuario.tipoDocumento;
  document.getElementById("numeroDocumento").value = usuario.numeroDocumento;
  document.getElementById("nombres").value = usuario.nombres;
  document.getElementById("apellidos").value = usuario.apellidos;
  document.getElementById("fechaNacimiento").value = usuario.fechaNacimiento;
  document.getElementById("carrera").value = usuario.carrera;

  // Seleccionar especialidades
  const especialidadSelect = document.getElementById("especialidad");
  for (let option of especialidadSelect.options) {
    option.selected = usuario.especialidad.includes(option.value);
  }

  document.getElementById("celular").value = usuario.celular;
  document.getElementById("ubigeo").value = usuario.ubigeo;
  document.getElementById("direccion").value = usuario.direccion;
  document.getElementById("correo").value = usuario.correo;

  const modal = new bootstrap.Modal(
    document.getElementById("modalAgregarEditarUsuario"),
  );
  modal.show();
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

// Función para guardar usuario
function guardarUsuario() {
  const form = document.getElementById("formUsuario");

  // Validar que el formulario sea válido
  if (!form.checkValidity()) {
    form.reportValidity();
    return;
  }

  const usuarioIdEdit = document.getElementById("usuarioIdEdit").value;
  const tipoDocumento = document.getElementById("tipoDocumento").value;
  const numeroDocumento = document.getElementById("numeroDocumento").value;
  const nombres = document.getElementById("nombres").value;
  const apellidos = document.getElementById("apellidos").value;
  const fechaNacimiento = document.getElementById("fechaNacimiento").value;
  const carrera = document.getElementById("carrera").value;

  // Obtener especialidades seleccionadas
  const especialidadSelect = document.getElementById("especialidad");
  const especialidad = Array.from(especialidadSelect.selectedOptions).map(
    (opt) => opt.value,
  );

  const celular = document.getElementById("celular").value;
  const ubigeo = document.getElementById("ubigeo").value;
  const direccion = document.getElementById("direccion").value;
  const correo = document.getElementById("correo").value;

  if (especialidad.length === 0) {
    alert("Por favor, selecciona al menos una especialidad");
    return;
  }

  const usuarioData = {
    tipoDocumento,
    numeroDocumento,
    nombres,
    apellidos,
    fechaNacimiento,
    celular,
    direccion,
    correo,
  };

  if (usuarioIdEdit) {
    // Editar usuario
    const usuario = usuariosData.find((u) => u.id == usuarioIdEdit);
    if (usuario) {
      Object.assign(usuario, usuarioData);
      usuariosTable.clear().rows.add(usuariosData).draw();
    }

    mensajeExito = `${nombres} ${apellidos} ha sido actualizado correctamente.`;
  } else {
    // Crear nuevo usuario
    const nuevoId = Math.max(...usuariosData.map((u) => u.id), 0) + 1;
    usuariosData.push({
      id: nuevoId,
      ...usuarioData,
    });
    usuariosTable.clear().rows.add(usuariosData).draw();

    mensajeExito = `${nombres} ${apellidos} ha sido agregado correctamente.`;
  }

  // TODO: Hacer llamada AJAX para guardar en servidor
  console.log("Guardando usuario:", usuarioData);

  if (typeof Swal !== "undefined") {
    Swal.fire({
      title: "¡Éxito!",
      text: mensajeExito,
      icon: "success",
    }).then(() => {
      const modal = bootstrap.Modal.getInstance(
        document.getElementById("modalAgregarEditarUsuario"),
      );
      if (modal) modal.hide();
    });
  } else {
    alert(mensajeExito);
    const modal = bootstrap.Modal.getInstance(
      document.getElementById("modalAgregarEditarUsuario"),
    );
    if (modal) modal.hide();
  }
}
